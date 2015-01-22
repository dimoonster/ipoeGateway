#!/bin/sh

VLAN_INTERFACE=$1
VLAN_PRIMARY=$2
VLAN_SECONDARY=$3
SPEED=$4


SPEED=$((${SPEED}/1000))

echo speed=$SPEED

#####INPUT=ifb0.$VLAN_PRIMARY.$VLAN_SECONDARY
###INPUT=ifb0
VLAN=$VLAN_INTERFACE.$VLAN_PRIMARY.$VLAN_SECONDARY

UBURST="burst 512k"
DBURST="burst 512k"

TCFR="/sbin/tc filter replace"
TCCR="/sbin/tc class replace"
TCQR="/sbin/tc qdisc replace"
TCQD="/sbin/tc qdisc del"

TCFR="/sbin/tc filter add"
TCCR="/sbin/tc class add"
TCQR="/sbin/tc qdisc add"
TCQD="/sbin/tc qdisc del"

TCQR2="/sbin/tc qdisc replace"

DOWNSPEED=$(($SPEED*110/100))
UPSPEED=$(($SPEED*105/100))

#ip l s $INPUT up
#$TCQD dev $INPUT root &>/dev/null
#$TCQR dev $INPUT root handle 1: htb default 2 r2q 100
#$TCCR dev $INPUT parent 1: classid 1:1 htb rate 100mbit ceil 100mbit burst 1024k cburst 64k prio 2
#$TCQR dev $INPUT parent 1:1 handle 2: sfq perturb 10 quantum 1514

ip l s $VLAN up
$TCQD dev $VLAN root
$TCQD dev $VLAN ingress

$TCQR dev $VLAN root handle 1: htb default 2 r2q 100
$TCCR dev $VLAN parent 1: classid 1:1 htb rate 100mbit ceil 100mbit burst 1024k cburst 64k prio 2
$TCQR dev $VLAN parent 1:1 handle 2: sfq perturb 10 quantum 1514
$TCQR dev $VLAN ingress handle ffff:

if [ "$UPSEED" != "0" ] ; then
    echo Runing UP
    $TCCR dev $VLAN parent 1: classid 1:20 htb rate 100mbit $UBURST quantum 1514
    $TCCR dev $VLAN parent 1:20 classid 1:201 htb rate 100mbit $UBURST quantum 1514
    $TCCR dev $VLAN parent 1:20 classid 1:202 htb rate ${UPSPEED}kbit $UBURST quantum 1514

    $TCQR dev $VLAN parent 1:201 handle 201: sfq perturb 10 quantum 1514
    $TCQR dev $VLAN parent 1:202 handle 202: sfq perturb 10 quantum 1514

    # Скорость доступа к локальным ресурсам ограничеивать не будем
    $TCFR dev $VLAN parent 1: protocol ip prio 0 u32 match ip src 192.166.12.0/22 match ip dst 0.0.0.0/0 flowid 1:201
    $TCFR dev $VLAN parent 1: protocol ip prio 1 u32 match ip src 10.0.0.0/8 match ip dst 0.0.0.0/0 flowid 1:201


    # Откроем vkontakte (AS47541) на полной скорости
    $TCFR dev $VLAN parent 1: protocol ip prio 2 u32 match ip src 93.186.224.0/21 match ip dst 0.0.0.0/0 flowid 1:201
    $TCFR dev $VLAN parent 1: protocol ip prio 3 u32 match ip src 93.186.232.0/21 match ip dst 0.0.0.0/0 flowid 1:201
    $TCFR dev $VLAN parent 1: protocol ip prio 4 u32 match ip src 87.240.128.0/18 match ip dst 0.0.0.0/0 flowid 1:201

echo 4

    
    # Ограничение скорости в интернет    
    $TCFR dev $VLAN parent 1: protocol ip prio 99 u32 match ip dst 0.0.0.0/0 flowid 1:202
    echo UP
fi

if [ "$DOWNSPEED" != "0" ] ; then
    echo Runing Down
    DOWNSPEED=$[$DOWNSPEED*9/8]
    DRATE=$[$DOWNSPEED/2]
    DBURST=$[$DOWNSPEED/10]
    
    # Attach ingress policer:
    $TCFR dev $VLAN parent ffff: prio 98 proto ip u32 match ip dst 192.166.12.0/22 action pass
    $TCFR dev $VLAN parent ffff: prio 99 proto ip u32 match ip dst 0.0.0.0/0 police rate ${DOWNSPEED}kbit burst ${DBURST}kb action drop flowid ffff:
    
    
#    $TCFR dev $VLAN parent ffff: protocol ip prio 99 u32 match ip dst 0.0.0.0/0 action mirred egress redirect dev $INPUT
    
#    $TCFR dev $VLAN parent ffff: protocol ip prio 99 u32 0 0 action mirred egress redirect dev $INPUT

#    $TCQR dev $1 handle ffff: ingress
#    $TCFR dev $1 parent ffff: protocol ip u32 match u32 0 0 action mirred egress redirect dev $INPUT

#    $TCCR dev $INPUT parent 1:1 classid 1:20 htb rate 100mbit $DBURST quantum 1514
#    $TCCR dev $INPUT parent 1:20 classid 1:201 htb rate 100mbit $DBURST quantum 1514
#    $TCCR dev $INPUT parent 1:20 classid 1:202 htb rate ${DOWNSPEED}kbit $DBURST quantum 1514

#    $TCQR dev $INPUT parent 1:201 handle 201: sfq perturb 10 quantum 1514
#    $TCQR dev $INPUT parent 1:202 handle 202: sfq perturb 10 quantum 1514


    # Скорость доступа к локальным ресурсам ограничеивать не будем
#    $TCFR dev $INPUT parent 1: protocol ip prio 0 u32 match ip dst 192.166.12.0/22 match ip src 0.0.0.0/0 flowid 1:201
#    $TCFR dev $INPUT parent 1: protocol ip prio 1 u32 match ip dst 10.0.0.0/8 match ip src 0.0.0.0/0 flowid 1:201

    # Откроем vkontakte (AS47541) на полной скорости
#    $TCFR dev $INPUT parent 1: protocol ip prio 2 u32 match ip dst 93.186.224.0/21 match ip src 0.0.0.0/0 flowid 1:201
#    $TCFR dev $INPUT parent 1: protocol ip prio 3 u32 match ip dst 93.186.232.0/21 match ip src 0.0.0.0/0 flowid 1:201
#    $TCFR dev $INPUT parent 1: protocol ip prio 4 u32 match ip dst 87.240.128.0/18 match ip src 0.0.0.0/0 flowid 1:201


    # Ограничение входящей скорости из интернета
#    $TCFR dev $INPUT parent 1: protocol ip prio 99 u32 match ip src 0.0.0.0/0 flowid 1:202
    echo down
fi


echo $INPUT - $VLAN - $SPEED
