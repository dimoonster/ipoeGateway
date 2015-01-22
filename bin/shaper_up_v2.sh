#!/bin/sh

. /opt/ipoev2/etc/vlans.conf
. /opt/ipoev2/etc/shaper.conf

VLAN_INTERFACE=$1
VLAN_PRIMARY=$2
VLAN_SECONDARY=$3
SPEED=$4
IP=$5

if [ ! -f $SHAPER_DB ]; then
    touch $SHAPER_DB
    echo "last: 100" > $SHAPER_DB
fi

OUT_INT="$UPLINK"

SPEED=$((${SPEED}/1000))

if [ "$VLAN_SECONDARY" == "notq" ]; then
    IFB=ifb$VLAN_NOTQ_IFB
    VLAN=$VLAN_INTERFACE.$VLAN_PRIMARY
    SUBVLAN=`/usr/bin/printf '%03x' $VLAN_PRIMARY`
    VLAN_SECONDARY=$VLAN_PRIMARY
    
    MARK=0x${SUBVLAN}000
else
    eval IFB=ifb\$VLAN_${VLAN_PRIMARY}_IFB
    VLAN=$VLAN_INTERFACE.$VLAN_PRIMARY.$VLAN_SECONDARY
    SUBVLAN=`/usr/bin/printf '%03x' $VLAN_SECONDARY`
    
    MARK=0x`/usr/bin/printf '%03x' $VLAN_PRIMARY`$SUBVLAN
fi

#if [ "$IFB" == "ifb" ]; then
#    echo "IFB interface for vlan $VLAN_INTERFACE.$VLAN_PRIMARY not found!"
#    echo "Check vlans.conf"
#    exit
#fi

#echo $VLAN_PRIMARY : $VLAN_SECONDARY

IFB=$OUT_INT

/sbin/ifconfig $IFB up

UBURST="burst 512k"
DBURST="burst 512k"

TCFR="/sbin/tc filter replace"
TCFD="/sbin/tc filter del"
TCCR="/sbin/tc class replace"
TCQR="/sbin/tc qdisc replace"
TCQD="/sbin/tc qdisc del"

TCQR2="/sbin/tc qdisc replace"

IPT="/sbin/iptables"
IPT6="/sbin/ip6tables"


# маркируем пакеты
$IPT -t mangle -D FORWARD -o $VLAN -j MARK --set-mark ${MARK}0
$IPT -t mangle -D FORWARD -i $VLAN -j MARK --set-mark ${MARK}1
$IPT -t mangle -A FORWARD -o $VLAN -j MARK --set-mark ${MARK}0
$IPT -t mangle -A FORWARD -i $VLAN -j MARK --set-mark ${MARK}1

$IPT6 -t mangle -D FORWARD -o $VLAN -j MARK --set-mark ${MARK}0
$IPT6 -t mangle -D FORWARD -i $VLAN -j MARK --set-mark ${MARK}1
$IPT6 -t mangle -A FORWARD -o $VLAN -j MARK --set-mark ${MARK}0
$IPT6 -t mangle -A FORWARD -i $VLAN -j MARK --set-mark ${MARK}1

#DOWNSPEED=$(($SPEED*110/100))
#UPSPEED=$(($SPEED*105/100))
DOWNSPEED=$(($SPEED*100/100))
UPSPEED=$(($SPEED*100/100))

##echo "/sbin/tc qdisc show dev $IFB | grep -v sfq | awk '{print $2}'"
##echo "$SUBVLAN"

#ifb
QDISC_IFB=`/sbin/tc qdisc show dev $IFB | grep -v sfq | awk '{print $2}'`
#echo qifb=$QDISC_IFB

if [ "$QDISC_IFB" != "htb" ];
then
#    echo "111"
    ip l s $IFB up
    $TCQD dev $IFB root &>/dev/null
    $TCQR dev $IFB root handle 1: htb default 2 r2q 10
    $TCCR dev $IFB parent 1: classid 1:1 htb rate 1000mbit ceil 1000mbit burst 1024k cburst 64k prio 2
    $TCQR dev $IFB parent 1:1 handle 2: sfq perturb 10 quantum 1514
    
    # local nets
    $TCFR dev $IFB parent 1: protocol ip prio 1 u32 match ip dst 192.166.12.0/22 flowid 1:1
    $TCFR dev $IFB parent 1: protocol ip prio 2 u32 match ip dst 10.0.0.0/8 flowid 1:1
    
    # vkontakte
    $TCFR dev $IFB parent 1: protocol ip prio 3 u32 match ip dst 93.186.224.0/21 flowid 1:1
    $TCFR dev $IFB parent 1: protocol ip prio 4 u32 match ip dst 93.186.232.0/21 flowid 1:1
    $TCFR dev $IFB parent 1: protocol ip prio 5 u32 match ip dst 87.240.128.0/21 flowid 1:1
    
    #iksnet - AS 48226
    $TCFR dev $IFB parent 1: protocol ip prio 10 u32 match ip dst 87.226.183.0/24 flowid 1:1
    $TCFR dev $IFB parent 1: protocol ip prio 11 u32 match ip dst 89.113.248.0/21 flowid 1:1
    
    
fi

#vlan.p.s
ip l s $VLAN up
$TCQD dev $VLAN root &>/dev/null
$TCQD dev $VLAN ingress &>/dev/null
$TCQR dev $VLAN root handle 1: htb default 2 r2q 10
$TCCR dev $VLAN parent 1: classid 1:1 htb rate 100mbit ceil 100mbit burst 1024k cburst 64k prio 2
$TCQR dev $VLAN parent 1:1 handle 2: sfq perturb 10 quantum 1514
$TCQR dev $VLAN handle ffff: ingress

# ограничение из мира к клиенту
if [ "$UPSEED" != "0" ] ; then
    echo Runing UP
    $TCCR dev $VLAN parent 1: classid 1:20 htb rate 100mbit $UBURST quantum 1514
    $TCCR dev $VLAN parent 1:20 classid 1:201 htb rate 100mbit $UBURST quantum 1514
    $TCCR dev $VLAN parent 1:20 classid 1:202 htb rate ${UPSPEED}kbit $UBURST quantum 1514

    
    $TCQR dev $VLAN parent 1:201 handle 201: sfq perturb 10 quantum 1514
    $TCQR dev $VLAN parent 1:202 handle 202: sfq perturb 10 quantum 1514

    # Скорость доступа к локальным ресурсам ограничеивать не будем
    $TCFR dev $VLAN parent 1: protocol ip prio 1 u32 match ip src 192.166.12.0/22 flowid 1:201
    $TCFR dev $VLAN parent 1: protocol ip prio 2 u32 match ip src 10.0.0.0/8 flowid 1:201

    # Откроем vkontakte (AS47541) на полной скорости
    $TCFR dev $VLAN parent 1: protocol ip prio 3 u32 match ip src 93.186.224.0/21 flowid 1:201
    $TCFR dev $VLAN parent 1: protocol ip prio 4 u32 match ip src 93.186.232.0/21 flowid 1:201
    $TCFR dev $VLAN parent 1: protocol ip prio 5 u32 match ip src 87.240.128.0/18 flowid 1:201

    #iksnet - AS 48226
    $TCFR dev $IFB parent 1: protocol ip prio 10 u32 match ip src 87.226.183.0/24 flowid 1:201
    $TCFR dev $IFB parent 1: protocol ip prio 11 u32 match ip src 89.113.248.0/21 flowid 1:201

    
    # Ограничение скорости в интернет    
#    $TCFR dev $VLAN parent 1: protocol ip prio 99 u32 match ip src 0.0.0.0/0 flowid 1:202
    $TCFR dev $VLAN parent 1: protocol ipv6 prio 98 handle ${MARK}0 fw flowid 1:202
    $TCFR dev $VLAN parent 1: protocol ip   prio 99 handle ${MARK}0 fw flowid 1:202
    echo UP
fi

# ограничение от клиента в мир
if [ "$DOWNSPEED" != "0" ] ; then
    echo Runing Down
    DOWNSPEED=$[$DOWNSPEED*9/8]
    DRATE=$[$DOWNSPEED/2]
    
    IFB=$OUT_INT
    
#    $TCFR dev $VLAN parent ffff: protocol ip prio 99 u32 match ip src 0.0.0.0/0 action mirred egress redirect dev $IFB

    # Ограничение исходящей скорости в интернет
#    CLS_FLOW_ID=${SUBVLAN}1

    CLS_FLOW_ID=`/bin/cat $SHAPER_DB | /bin/grep $MARK | /bin/awk '{ print $2 }'`

    if [ "$CLS_FLOW_ID" == "" ]; then
	CLS_FLOW_ID_LAST=`/bin/cat $SHAPER_DB | /bin/grep last | /bin/awk '{ print $2 }'`
	CLS_FLOW_ID=$[$CLS_FLOW_ID_LAST+1]
	/bin/sed -i -e "s/last:\ ${CLS_FLOW_ID_LAST}/last:\ ${CLS_FLOW_ID}/" $SHAPER_DB
	echo "$MARK $CLS_FLOW_ID" >> $SHAPER_DB
    fi

     $TCCR dev $IFB parent 1:1 classid 1:$CLS_FLOW_ID htb rate ${DOWNSPEED}kbit $DBURST quantum 1514
     $TCQR dev $IFB parent 1:$CLS_FLOW_ID handle $CLS_FLOW_ID: sfq perturb 10 quantum 1514

#    $TCFD dev $IFB parent 1: protocol ip prio $MARK
#    $TCFR dev $IFB parent 1: protocol ip prio ${VLAN_SECONDARY}00 u32 match ip src $IP flowid 1:${SUBVLAN}1
     $TCFR dev $IFB parent 1: protocol ipv6 prio ${CLS_FLOW_ID}0 handle ${MARK}1 fw flowid 1:$CLS_FLOW_ID
     $TCFR dev $IFB parent 1: protocol ip prio   ${CLS_FLOW_ID}1 handle ${MARK}1 fw flowid 1:$CLS_FLOW_ID
    echo down
fi


echo $INPUT - $VLAN - $SPEED
