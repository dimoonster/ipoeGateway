#!/usr/bin/perl

use strict;
use DBI;
use DateTime;

my $net = shift;
if(!$net) {
    die "use net!";
}

my $log = "clear_routes_on_dev.log";

my ($dbh, $sth, @data, $sql, $r, $dt);
our ($dbhost, $dbname, $dbuser, $dbpass);
our $NAS;
our $LOGDIR;

require "/opt/ipoev2/etc/dhcp-db.conf";
require "/opt/ipoev2/etc/ipoe.conf";

$log = $LOGDIR."/".$log;

open(LOGFILE, '>>'.$log);

open(IPS, "/bin/netstat -nr | /bin/grep $net |");
while(<IPS>) {
    my @elems = split /\s+/, $_;
    
    my $prefix    = $elems[0];
    my $interface = $elems[7];
    
    #print "/sbin/route del -host $prefix dev $interface \n";
    `/sbin/route del -host $prefix dev $interface`;
};
close(IPS);

close(LOGFILE);
