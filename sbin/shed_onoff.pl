#!/usr/bin/perl

#-------------------------------------------------------------------------
#    Скрипт ищет подключенных абонентов, которых пора отключать (т.е. которых отключил расчётчик биллинга)

use strict;
use DBI;
use DateTime;

my $log = "shed_onoff.log";

my ($dbh, $sth, @data, $sql, $r, $dt);
our ($dbhost, $dbname, $dbuser, $dbpass);
our $NAS;
our $LOGDIR;

require "/opt/ipoev2/etc/billing-db.conf";
require "/opt/ipoev2/etc/ipoe.conf";

$log = $LOGDIR."/".$log;


$sql = "
SELECT	ipoe2_inttoacc.interface, ipoe2_inttoacc.accid, ipoe2_inttoacc.ipaddr, ipoe2_inttoacc.nas,
	Accounts.UserID, Accounts.AccountName
FROM    ipoe2_inttoacc INNER JOIN
                  Accounts ON ipoe2_inttoacc.accid = Accounts.Number
WHERE     (Accounts.Disabled = 1) AND (ipoe2_inttoacc.nas = $NAS)";

$dbh = DBI->connect('DBI:Sybase:server='.$dbhost.',database='.$dbname, $dbuser, $dbpass) or die "dbconn";

open(LOGFILE, '>>'.$log);

$sth = $dbh->prepare($sql); $sth->execute();
while(@data=$sth->fetchrow_array()) {
    my($interface, $accid, $ipaddr, $nas, $userid, $accname) = @data;
    
    print DateTime->now()." Drop user $userid ($accid:$accname) on interface $interface with ip $ipaddr\n";
    print LOGFILE DateTime->now()." Drop user $userid ($accid:$accname) on interface $interface with ip $ipaddr\n";
    print "/opt/ipoev2/sbin/drop_user.pl $accid $interface $NAS";
    my $result = `/opt/ipoev2/sbin/drop_user.pl $accid $interface $NAS`;
}

close(LOGFILE);