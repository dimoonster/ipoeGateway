#!/bin/bash

#. /opt/ipoev2/etc/vlans.conf

VCFG=/sbin/vconfig
IFCFG=/sbin/ifconfig
IPCFG=/sbin/ip
IPT=/sbin/iptables 

GLOBAL_I=0

DOWNLINK=eth1
PVLAN=81
SECONDARY_VLANS_81=$( echo {1401..1408} {1451..1458} {1501..1508} {1551..1558} )

# Создадим базовый влан
#$VCFG add $DOWNLINK $PVLAN
#$IFCFG $DOWNLINK.$PVLAN up

eval SECONDARY_VLANS=\$SECONDARY_VLANS_$PVLAN

# создадим вторичные вланы
for SVLAN in $SECONDARY_VLANS 
do
    $VCFG add $DOWNLINK.$PVLAN $SVLAN
    $IPCFG link set $DOWNLINK.$PVLAN.$SVLAN up
    /bin/echo 1 > /proc/sys/net/ipv4/conf/$DOWNLINK.$PVLAN.$SVLAN/proxy_arp
done

# Удаление VLAN Zakl Wi-Fi
#$VCFG rem eth1.81.203

# Востановим маршруты на выданные до перезагрузки сервера адреса
#/opt/ipoev2/bin/restore_routes_on_boot.pl

exit 0




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
