#!/bin/sh

. /opt/ipoev2/etc/shaper.conf

IPT=/sbin/iptables
IPT6=/sbin/ip6tables

GWINT=$UPLINK

GWIP=`/sbin/ifconfig $GWINT | /bin/grep "inet addr" | /bin/awk '{ print $2 }' | /bin/cut -d ':' -f 2`

# iptables

$IPT -F
$IPT -F -t nat
$IPT -F -t mangle
$IPT -F -t raw
$IPT -t nat -I PREROUTING -p tcp -m tcp --dport 80 -j DNAT --to-destination $GWIP:80
$IPT -I INPUT -p udp -m udp --dport 53 -j ACCEPT
$IPT -I INPUT -p tcp -m tcp --dport 53 -j ACCEPT
$IPT -I INPUT -s 127.0.0.1 -d 127.0.0.1 -j ACCEPT
$IPT -A INPUT -i $GWINT -p udp --dport 67 -j REJECT
$IPT -A INPUT -p tcp --dport ssh -s 172.16.0.0/16 -j ACCEPT
$IPT -A INPUT -p tcp --dport ssh -s 192.166.12.0/22 -j ACCEPT
$IPT -A INPUT -p tcp --dport ssh -j REJECT
$IPT -A INPUT -d $GWIP -j ACCEPT

$IPT --policy FORWARD DROP
$IPT -I FORWARD -p udp -m udp --dport 53 -j ACCEPT
$IPT -I FORWARD -p tcp -m tcp --dport 53 -j ACCEPT
$IPT -I FORWARD -p udp -m udp --sport 53 -j ACCEPT
$IPT -I FORWARD -p tcp -m tcp --sport 53 -j ACCEPT
$IPT -I FORWARD -i $GWINT -d 0.0.0.0/0 -j ACCEPT

$IPT -t raw -A PREROUTING -p udp --dport 1900 -j DROP
$IPT -t raw -A PREROUTING -p tcp --dport 137 -j DROP
$IPT -t raw -A PREROUTING -p tcp --dport 138 -j DROP
$IPT -t raw -A PREROUTING -p tcp --dport 139 -j DROP
$IPT -t raw -A PREROUTING -p tcp --dport 445 -j DROP
