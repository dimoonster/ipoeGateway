#!/usr/bin/perl

#------------------------------------------------------------------------------------------
#
#    Ручное обновление скорости установленных сессий/запуск не активных сессий.
#    Получаются значения текущей скорости из таблицы сессий и умножаются на множитель, после 
#    этого ipoe сессия рестартует
#
#------------------------------------------------------------------------------------------

#------------------------------------------------------------------------------------------

use DBI;
use Socket;

my ($dbh, $sth, @data, $sql, $r);
our ($dbhost, $dbname, $dbuser, $dbpass);
our $NAS;


require "/opt/ipoev2/etc/billing-db.conf";
require "/opt/ipoev2/etc/ipoe.conf";

$dbh = DBI->connect('DBI:Sybase:server='.$dbhost.',database='.$dbname, $dbuser, $dbpass) or die "dbconn";
$sql = "select interface, accid, ipaddr, speed from ipoe2_inttoacc where nas=$NAS";
$sth = $dbh->prepare($sql);
$sth->execute() or die $!;

while(@fa = $sth->fetchrow_array()) {
    my $vlan = $fa[0];
    my $accid = $fa[1];
    my $ip = $fa[2];
    my $speed = 0;
    
    if($fa[3]==2000000)  { $speed = 2; }
    if($fa[3]==6000000)  { $speed = 20; }
    if($fa[3]==12000000) { $speed = 30; }
    if($fa[3]==18000000) { $speed = 40; }
    if($fa[3]==24000000) { $speed = 50; }
    
    $speed = $speed*1000000;
    
    if($speed==0) { $speed = $fa[3]; }
    
    my $sql1 = "delete from ipoe2_inttoacc where nas=$NAS and accid=$accid";
    $dbh->prepare($sql1)->execute() or die $!;
    
    my $start_result = `sudo /opt/ipoev2/sbin/start_user.pl $accid $ip $vlan $speed`;
    print "$vlan changed speed from $fa[3] to $speed with result: $start_result\n";
};