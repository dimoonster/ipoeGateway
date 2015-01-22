#!/usr/bin/perl

use strict;
use DBI;
use DateTime;

my $ip = shift;
my $interface = shift;

my ($dbh, $sth, @data, $sql, $r);
our ($dbhost, $dbname, $dbuser, $dbpass);
our $NAS;

require "/opt/ipoev2/etc/billing-db.conf";
require "/opt/ipoev2/etc/ipoe.conf";

$dbh = DBI->connect('DBI:Sybase:server='.$dbhost.',database='.$dbname, $dbuser, $dbpass) or die "dbconn";

open(MYFILE, ">>/opt/ipoev2/bin/ipoffered.txt");
print MYFILE "$$ ip=$ip, interface=$interface\n";
close(MYFILE);

# Была произведена выдача IP адреса.

# 1. Проверим, не была ли на интерфейсе активная сессия
$sql = "select accid,ipaddr,speed from ipoe2_inttoacc where interface='$interface' and nas=$NAS";
$sth=$dbh->prepare($sql); $sth->execute();
if(@data=$sth->fetchrow_array()) {
    $sth->finish();
    # на интефейсе есть активная сессия
    
    
    # посмотрим, не изменился ли IP адрес
    if(!($data[1] eq $ip)) {
	# ip адрес сменился.
	
	my ($mint, $mvlan, $svlan) = split /\./, $interface;
	if($svlan eq "") { $svlan="notq"; }
	
#	my $result = `/opt/ipoev2/bin/shaper_up.sh $mint $mvlan $svlan $data[2] $ip`;
	
	$sql = "update ipoe2_inttoacc set ipaddr='$ip' where interface='$interface' and nas=$NAS";
	$sth = $dbh->prepare($sql); $sth->execute();
	
    };
};