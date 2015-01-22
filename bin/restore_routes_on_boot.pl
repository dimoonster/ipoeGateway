#!/usr/bin/perl

use DBI;
use Socket;

require "/opt/ipoev2/etc/ipoe.conf";

$dbh = DBI->connect("DBI:mysql:dhcp:localhost", "root", "g[gvfqflvby") or die $!;
$sth = $dbh->prepare("select ipaddr, interface from leases where state=2 and nasid=$NAS");
$sth->execute() or die $!;

print "Restore dhcp routes...";

while(@fa = $sth->fetchrow_array()) {
#    my $ip = unpack('N', inet_aton($fa[0]));
    my $ip = inet_ntoa(pack('N', $fa[0]));
    my $int = $fa[1];
#    print "/sbin/route add -host $ip dev $int\n";
    `/sbin/route add -host $ip dev $int`;
};

print "done";
