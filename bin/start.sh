#!/bin/bash

. ../etc/vlans.conf

VCFG=/sbin/vconfig
IFCFG=/sbin/ifconfig
IPCFG=/sbin/ip
IPT=/sbin/iptables 

GLOBAL_I=0

# reruning ifb
#/sbin/rmmod ifb
#/sbin/modprobe ifb numifbs=$IFB_COUNT


$VCFG set_name_type DEV_PLUS_VID_NO_PAD

for PVLAN in $PRIMARY_VLANS
do
    # Создадим базовый влан
    $VCFG add $DOWNLINK $PVLAN
    $IFCFG $DOWNLINK.$PVLAN up
    
    #Создадим lo
    eval TEMP_NET=\$NET4_VLAN_GW_$PVLAN
    $IFCFG lo:$PVLAN inet $TEMP_NET netmask 255.255.255.255 up

    eval SECONDARY_VLANS=\$SECONDARY_VLANS_$PVLAN

    for SVLAN in $SECONDARY_VLANS 
    do
	$VCFG add $DOWNLINK.$PVLAN $SVLAN
	$IPCFG link set $DOWNLINK.$PVLAN.$SVLAN up
	/bin/echo 1 > /proc/sys/net/ipv4/conf/$DOWNLINK.$PVLAN.$SVLAN/proxy_arp
    done

    eval VLIFB=\$VLAN_${PVLAN}_IFB
    $IPCFG link set ifb$VLIFB up
done




# iptables

#$IPT -F
#$IPT -F -t nat
#$IPT -t nat -I PREROUTING -p tcp -m tcp --dport 80 -j DNAT --to-destination 10.255.12.254:80
#$IPT -I INPUT -d 172.16.1.160 -j ACCEPT
#$IPT -I INPUT -p udp -m udp --dport 53 -j ACCEPT
#$IPT -I INPUT -p tcp -m tcp --dport 53 -j ACCEPT

#$IPT --policy FORWARD DROP
#$IPT -I FORWARD -p udp -m udp --dport 53 -j ACCEPT
#$IPT -I FORWARD -p tcp -m tcp --dport 53 -j ACCEPT
#$IPT -I FORWARD -p udp -m udp --sport 53 -j ACCEPT
#$IPT -I FORWARD -p tcp -m tcp --sport 53 -j ACCEPT
