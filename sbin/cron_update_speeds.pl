#!/usr/bin/perl

#------------------------------------------------------------------------------------------
#
#    Скрипт по обновлению скоростей при смене тарифа в биллинге
#
#------------------------------------------------------------------------------------------

#------------------------------------------------------------------------------------------

use DBI;
use Socket;
use Time::localtime;
use Time::Local;

my ($dbh, $sth, @data, $sql, $r);
our ($dbhost, $dbname, $dbuser, $dbpass, @SPEED);
our $NAS;

my $ltime = localtime();
$timestamp = timelocal(0, 0, 1, $ltime->mday, $ltime->mon, $ltime->year+1900);
$biltime = ($timestamp + 3*60*60)/(24*60*60) + 25569;

require "/opt/ipoev2/etc/billing-db.conf";
require "/opt/ipoev2/etc/ipoe.conf";
require "/opt/ipoev2/etc/speed.conf";

$dbh = DBI->connect('DBI:Sybase:server='.$dbhost.',database='.$dbname, $dbuser, $dbpass) or die "dbconn";
$sql = "select interface, accid, ipaddr, speed from ipoe2_inttoacc where nas=$NAS";
$sth = $dbh->prepare($sql);
$sth->execute() or die $!;

while(@fa = $sth->fetchrow_array()) {
    my $vlan = $fa[0];
    my $accid = $fa[1];
    my $ip = $fa[2];
    my $cspeed = $fa[3];
    my $bspeed = 0;
    
    
    my $sql1 = "select top 1 AdmGroupID from AccountsAdm where AccountID=".$accid." and DateOn <= ".$biltime." order by AccountAdmID desc";
    my $sth1 = $dbh->prepare($sql1);
    
    $sth1->execute();
    my @fa1;
    
    if(@fa1 = $sth1->fetchrow_array()) {
	$bspeed = $SPEED[$fa1[0]];
	if($cspeed != $bspeed) {
#	    print "acc = $accid, bspeed = $bspeed, cspeed = $cspeed\n";
	    my $sql2 = "delete from ipoe2_inttoacc where nas=$NAS and accid=$accid";
    	    $dbh->prepare($sql2)->execute() or die $!;

            my $start_result = `sudo /opt/ipoev2/sbin/start_user.pl $accid $ip $vlan $bspeed`;
            print "$vlan changed speed from $cspeed to $bspeed with result: $start_result\n";
	}
    }
    
};