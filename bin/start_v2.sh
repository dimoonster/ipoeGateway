#!/bin/bash

. /opt/ipoev2/etc/vlans.conf

VCFG=/sbin/vconfig
IFCFG=/sbin/ifconfig
IPCFG=/sbin/ip
IPT=/sbin/iptables 

GLOBAL_I=0

# Поднимем DOWNLINK
$IPCFG link set $DOWNLINK up
$IFCFG $DOWNLINK mtu 1526

#Создадим lo
for MAINGW in $MAIN_GW_IP
do
    GLOBAL_I=$[$GLOBAL_I+1]
    $IFCFG lo:$GLOBAL_I inet $MAINGW netmask 255.255.255.255 up
done

for PVLAN in $PRIMARY_VLANS
do
    # Создадим базовый влан
    $VCFG add $DOWNLINK $PVLAN
    $IFCFG $DOWNLINK.$PVLAN up

    eval SECONDARY_VLANS=\$SECONDARY_VLANS_$PVLAN

    # создадим вторичные вланы
    for SVLAN in $SECONDARY_VLANS 
    do
	$VCFG add $DOWNLINK.$PVLAN $SVLAN
	$IPCFG link set $DOWNLINK.$PVLAN.$SVLAN up
	/bin/echo 1 > /proc/sys/net/ipv4/conf/$DOWNLINK.$PVLAN.$SVLAN/proxy_arp
    done
done

# Удаление VLAN Zakl Wi-Fi
$VCFG rem eth1.81.203

# Востановим маршруты на выданные до перезагрузки сервера адреса
/opt/ipoev2/bin/restore_routes_on_boot.pl

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
