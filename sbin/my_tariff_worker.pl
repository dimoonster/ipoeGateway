#!/usr/bin/perl

#-------------------------------------------------------
#   Запуск раз в час по крону.
#      скрипт производит поиск подключенных абонентов с тарифом Мой.Тариф и производит переключение скорости


use strict;
use DBI;
use DateTime;

my $log = "my_tariff_worker/";

my ($dbh, $sth, @data, $sql, $r, $dt);
our ($dbhost, $dbname, $dbuser, $dbpass);
our $NAS;
our $LOGDIR;

my ($sqlupd, $sthupd);

require "/opt/ipoev2/etc/billing-db.conf";
require "/opt/ipoev2/etc/ipoe.conf";

$log = $LOGDIR."/".$log;

$dbh = DBI->connect('DBI:Sybase:server='.$dbhost.',database='.$dbname, $dbuser, $dbpass) or die "dbconn";


$dt = DateTime->from_epoch(epoch => time(), time_zone => DateTime::TimeZone->new( name => 'local' ));

$sql = "
SELECT ipoe2_inttoacc.interface, ipoe2_inttoacc.accid, ipoe2_inttoacc.ipaddr, ipoe2_inttoacc.nas, ipoe2_mytariff_users.accid AS Expr1, 
                   ipoe2_mytariff_users.trf_template, ipoe2_mytariff_users.startdate, ipoe2_mytariff.speed".$dt->hour." AS speed
FROM   ipoe2_inttoacc 
INNER JOIN  ipoe2_mytariff_users ON ipoe2_inttoacc.accid = ipoe2_mytariff_users.accid 
INNER JOIN  ipoe2_mytariff ON ipoe2_mytariff.id = ipoe2_mytariff_users.trf_template
WHERE     (ipoe2_inttoacc.nas = ".$NAS.") AND (ipoe2_mytariff_users.startdate < ".time().")
ORDER BY ipoe2_mytariff_users.startdate asc";

#print $sql;

$sth=$dbh->prepare($sql); $sth->execute();

while(@data=$sth->fetchrow_array()) {
    my ($interface, $accid, $ipaddr, $nas, $accid , $trf_template, $startdate, $speed) = @data;

    my $intlog = $log."/".$interface.".log";
    open(LOGFILE, '>>'.$intlog);
    
    print DateTime->now()." ACCID $accid ON INTERFACE $interface CHANGE SPEED TO $speed Mbit/s \n";
    print LOGFILE DateTime->now()." ACCID $accid ON INTERFACE $interface CHANGE SPEED TO $speed Mbit/s \n";
    $speed = $speed*1000000;
    
    my ($mint, $mvlan, $svlan) = split /\./, $interface;
    if($svlan eq "") { $svlan="notq"; }

    
    print "\t"."/opt/ipoev2/bin/shaper_up_v2.sh $mint $mvlan $svlan $speed $ipaddr\n";
    print LOGFILE "\t"."/opt/ipoev2/bin/shaper_up_v2.sh $mint $mvlan $svlan $speed $ipaddr\n";

    my $result = `/opt/ipoev2/bin/shaper_up_v2.sh $mint $mvlan $svlan $speed $ipaddr`;
    $result =~ s/\n/\n\t\t/g;
    print "\t\t".$result;
    print LOGFILE "\t\t".$result;

    print "\n....done\n";
    print LOGFILE "\n....done\n";
    close(LOGFILE);
    
    $sqlupd = "update ipoe2_inttoacc set speed='$speed' where nas=$NAS and interface='$interface' and accid=$accid;";
    $sthupd = $dbh->prepare($sqlupd); $sthupd->execute();
    $sthupd->finish();
}

