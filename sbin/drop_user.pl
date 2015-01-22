#!/usr/bin/perl

use strict;
use DBI;

my $accid = shift;
my $vlan = shift;
my $nas = shift;

my $log = "/dev/null";

my ($dbh, $sth, @data, $sql, $r);
our ($dbhost, $dbname, $dbuser, $dbpass);
our $NAS;

require "/opt/ipoev2/etc/billing-db.conf";
require "/opt/ipoev2/etc/ipoe.conf";

if($NAS!=$nas) {
    # клиент был на другом серваке.
    print "other";
    exit();
}

#закроем доступ фаерволом
print `/sbin/iptables -D FORWARD -i $vlan -j ACCEPT `;
#print `/sbin/iptables -D FORWARD -o $vlan -j ACCEPT `;
print `/sbin/iptables -t nat -D PREROUTING -i $vlan -j RETURN `;

$dbh = DBI->connect('DBI:Sybase:server='.$dbhost.',database='.$dbname, $dbuser, $dbpass) or die 0;

my ($mint, $mvlan, $svlan) = split /\./, $vlan;
# загасим шейпер на интерфейсе
print `/sbin/tc qdisc del dev $vlan root`;
#print `/sbin/tc qdisc del dev $vlan ingress`;

# удалим информацию о сессии
$sql = "delete from ipoe2_inttoacc where accid=$accid and nas=$NAS;";
$dbh->prepare($sql)->execute();

print 1;
