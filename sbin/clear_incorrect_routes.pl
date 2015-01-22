#!/usr/bin/perl

#-------------------------------------------------------------------------
#    Скрипт ищет подключенных абонентов, которых пора отключать (т.е. которых отключил расчётчик биллинга)

use strict;
use DBI;
use DateTime;

my $net = shift;
if(!$net) {
    die "use net!";
}

my $log = "clear_routes.log";

my ($dbh, $sth, @data, $sql, $r, $dt);
our ($dbhost, $dbname, $dbuser, $dbpass);
our $NAS;
our $LOGDIR;

require "/opt/ipoev2/etc/dhcp-db.conf";
require "/opt/ipoev2/etc/ipoe.conf";

$log = $LOGDIR."/".$log;

$dbh = DBI->connect('DBI:mysql:'.$dbname.':'.$dbhost, $dbuser, $dbpass) or die "dbconn";

open(LOGFILE, '>>'.$log);

open(IPS, "/bin/netstat -nr | /bin/grep $net | /bin/grep -v $net.0 |");
while(<IPS>) {
    my @elems = split /\s+/, $_;
    
    my $prefix    = $elems[0];
    my $interface = $elems[7];
    
    my $sql = "select ipaddr from leases where interface='$interface' and ipaddr=INET_ATON('$prefix')";
    

    my $sth=$dbh->prepare($sql); $sth->execute();
    if(!$sth->fetchrow_array()) {
#	print $prefix." on ".$interface." is incorrect!\n";
	print LOGFILE DateTime->now()." /sbin/route del -host $prefix dev $interface\n";
	print "/sbin/route del -host $prefix dev $interface\n";
	`/sbin/route del -host $prefix dev $interface`;
	
	my $right_int = `/bin/netstat -nr | /bin/grep $prefix | /bin/awk '{ print \$8 }'`;
#	print "/sbin/route del -host $prefix dev $right_int\n";
#	print "/sbin/route add -host $prefix dev $right_int\n";
	`/sbin/route del -host $prefix dev $right_int`;
	`/sbin/route add -host $prefix dev $right_int`;
	
#	print "$right_int\n";
	
#	die();
    }
};
close(IPS);

close(LOGFILE);
