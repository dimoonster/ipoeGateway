#!/usr/bin/perl

my $config = "../etc/billing-db.conf";

use strict;
use DBI;

our ($dbhost, $dbname, $dbuser, $dbpass);
require $config;

my ($dbh, $sth, @fa, $sql);
####./shaper_up.sh eth2 10 102 10000000 10.255.12.2/3

my $ip = shift;
my $interface = shift;
$ip = "10.255.12.1";
$interface = "eth2.12.101";

$dbh = DBI->connect('DBI:Sybase:server='.$dbhost.',database='.$dbname, $dbuser, $dbpass)
		or die "Couldn't connect to DB: ".DBI->errstr;
		

$sth = $dbh->prepare("select accid,ipaddr from ipoe2_inttoacc where interface='".$interface."'");
$sth->execute();

if(@fa=$sth->fetchrow_array()) {
    # Запись есть
};

# Абонент пришёл с "пустого" интерфейса
print "free\n";







