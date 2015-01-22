#!/usr/bin/perl

use strict;
use DBI;
use DateTime;

my $accid = shift;
my $ip = shift;
my $vlan = shift;
my $speed = shift;

###print $speed;

my $log = "/dev/null";

my ($dbh, $sth, @data, $sql, $r);
our ($dbhost, $dbname, $dbuser, $dbpass);
our $NAS;

require "/opt/ipoev2/etc/billing-db.conf";
require "/opt/ipoev2/etc/ipoe.conf";

#откроем доступ фаерволом
print `/sbin/iptables -D FORWARD -i $vlan -j ACCEPT `;
#print `/sbin/iptables -D FORWARD -o $vlan -j ACCEPT `;
print `/sbin/iptables -t nat -D PREROUTING -i $vlan -j RETURN `;

print `/sbin/iptables -I FORWARD 2 -i $vlan -j ACCEPT `;
#print `/sbin/iptables -A FORWARD -o $vlan -j ACCEPT `;
print `/sbin/iptables -t nat -I PREROUTING -i $vlan -j RETURN `;


#установим скорость пользователю, в зависимости от тарифа
$dbh = DBI->connect('DBI:Sybase:server='.$dbhost.',database='.$dbname, $dbuser, $dbpass) or die "dbconn";

# проверим, не выбран ли у пользователя Мой.Тариф
$sql = "select top 1 trf_template from ipoe2_mytariff_users where accid=$accid and startdate < ".time();
#print $sql;
$sth=$dbh->prepare($sql); $sth->execute();
if(@data=$sth->fetchrow_array()) {
    # У пользователя свой тариф
    my ($trf_template, $chour, $dt);
    
    $trf_template = $data[0];
    $dt = DateTime->from_epoch(epoch => time(), time_zone => DateTime::TimeZone->new( name => 'local' ));
    $chour = $dt->hour;
    
    $sql = "select speed$chour from ipoe2_mytariff where id=$trf_template";
    $sth=$dbh->prepare($sql); $sth->execute();
    if(@data=$sth->fetchrow_array()) {
	$speed = $data[0]*1000000;
    }    
##    $speed = 1000000;
}

# у пользователя стандартный тариф
my ($mint, $mvlan, $svlan) = split /\./, $vlan;
if($svlan eq "") { $svlan="notq"; }
#print "/opt/ipoev2/bin/shaper_up.sh $mint $mvlan $svlan $speed $ip";
print `/opt/ipoev2/bin/shaper_up_v2.sh $mint $mvlan $svlan $speed $ip`;

# запишем информацию о стартовавшей сессии
$sql = "insert into ipoe2_inttoacc values('$vlan', $accid, '$ip', $NAS, '$speed');";
$dbh->prepare($sql)->execute();

#print 1;
