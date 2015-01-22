#!/usr/bin/perl

$config = "/opt/ipoev2/etc/billing-db.conf";

use billinglib::user;
use Time::localtime;
use Text::Iconv;
use DBI;

require $config;
require "/opt/ipoev2/etc/ipoe.conf";

print "Content-Type: text/html; charset=utf-8\n";
print "Cache-Control: no-store, no-cache, must-revalidate\n";
print "Expires: Mon, 26 Jul 1997 05:00:00 GMT\n";
print "Pragma: no-cache\n";
print "\n";

print <<EOL;
<html>
<head>
    <title>LUGLink.Net Процесс Идентификации пользователя</title>
    <META HTTP-EQUIV="Cache-Control" content="no-cache" > 
    <META HTTP-EQUIV="Pragma" CONTENT="no-cache" > 
    <META HTTP-EQUIV="Expires" CONTENT="Thu, 18 Aug 2011 14:20:04 GMT" > 
</head>

<body>
<table border="0" width="100%" height="100%"><tr><td><center>
<img src="/logo.gif" /><hr />
EOL

read(STDIN, $params,$ENV{'CONTENT_LENGTH'});
if(!$params) {
  $params = $ENV{'QUERY_STRING'};
  };
  @params = split(/[&;]/, $params);
  
  $page = 'start';
  
  foreach $i (0..$#params) {
    $params[$i] =~ s/\+/ /g;
    ($key, $val) = split(/=/,$params[$i],2);
    $key =~ s/%(..)/pack("c",hex($1))/ge;
    $val =~ s/%(..)/pack("c",hex($1))/ge;

    $params1{$key} .= "\0" if(defined($params1{$key}));
    $params1{$key} .= $val;
};

my $ip = `env | grep REMOTE_ADDR`;
@ip = split /=/, $ip;
$ip = $ip[1];
$ip =~ s/\n//;

my $mac = `arp -n | grep -w $ip`;
###$mac = `arp -n | grep -w 10.3.34.24 `;
$mac =~ s/(\s)|(\t)/-/go;
$mac =~ s/(-+)/|/go;
my @mac = split /\|/, $mac;
$vlan = $mac[4];
$mac = $mac[2];


my $username = $params1{'username'};
my $password = $params1{'password'};
my $radius_result = `/opt/ipoev2/sbin/auth_user.pl $username $password`;

@radius = split /\n/, $radius_result;
$radius[0] =~ /(\d)/;
$auth_result = $1;

$speed = $radius[4];
@speed = split /\ /, $speed;
$speed = $speed[5];

#Времянка!!!! (Про которую можно в принципе забыть)
if($speed < 1100000) { $speed = $speed*10; };

if($auth_result == 1) {
    # Радиус ответил согласием, соберём инфу о пользователе 
    
    $user = new billinglib::user(Login => $username,dbhost => $dbhost,dbuser => $dbuser,
        dbpass => $dbpass,dbname => $dbname);
    
    $conv = Text::Iconv->new('windows-1251', 'utf-8');
    $user_title = $conv->convert($user->get_title);
    $user_dog = $user->get_contractnumber;
    
    $userid = $user->get_user_id();
    $starttime = (time + 3*60*60)/24/60/60 + 25569 + 1;

    my $accid = $user->get_accnumber_bylogin($username);
    my ($admgrpid, $tarifid) = $user->get_admgrpid($accid);
    my $tarif_name = $conv->convert($user->get_admgrpname($tarifid));
    

    print "<h2>Идентификация успешна!</h2>";
    print <<EOF;
	<table border="0">
	    <tr><td align="right">IP адрес:</td><td>$ip</td></tr>
	    <tr><td align="right">MAC адрес:</td><td>$mac</td></tr>
	    <tr><td align="right">Имя пользователя:</td><td>$username</td></tr>
	    <tr><td align="right">Абонент:</td><td>$user_title</td></tr>
	    <tr><td align="right">Номер договора:</td><td>$user_dog</td></tr>
	    <tr><td align="right">Тарифный план:</td><td>$tarif_name</td></tr>
<!--	    <tr><td align="right">Скорость доступа:</td><td>$speed бит/с</td></tr> -->
	</table>
	<hr />
EOF

    my $sql = "";
    my $sth; my @data;
    
    my $dbh = DBI->connect('DBI:Sybase:server='.$dbhost.',database='.$dbname, $dbuser, $dbpass) or die "<h2>Произошла ошибка, попробуйте позже</h2>";

    # Проверим, не был ли аккаунт идентифициорван на другом интерфейсе/насе
    $sql = "select interface,nas from ipoe2_inttoacc where accid=$accid;";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    
    if(@data=$sth->fetchrow_array()) {
	# клиент был аутентифицирован, сбросим его
	$r = `sudo /opt/ipoev2/sbin/drop_user.pl $accid $data[0] $data[1]`;
    }
    $sth->finish();
    
    # Проверим, не было ли аутентифицированных пользоватеолей на этом интерфейсе
    $sql = "select interface,nas,accid,ipaddr from ipoe2_inttoacc where interface='$vlan' and nas=$NAS;";
    $sth = $dbh->prepare($sql);
    $sth->execute();
    while(@data=$sth->fetchrow_array()) {
	$r = `sudo /opt/ipoev2/sbin/drop_user.pl $data[2] $data[0] $data[1]`;
    }
    $sth->finish();
    
    
    # запустим сессию
#    print "$accid $ip $vlan $speed";
    my $start_result = `sudo /opt/ipoev2/sbin/start_user.pl $accid $ip $vlan $speed`;
#    if($start_result != 1) { print "<h2>User start session error!</h2>"; die; }
    
    print "res= $start_result \n";
    
    print <<EOF;
    <h2>Доступ к сети Интернет Активирован!</h2>
    <b color="red">Для пользования услугой перезагрузите ваш браузер!</b>
EOF
} else {
    print <<EOF;
    <h2>Идентификация не удалась!</h2>
    Возможно вы указали неправильные имя или пароль, либо у вас закончились средства на счету.<br><br>
    <table border=0>
	<tr><td align="right">Телефон бухгалтерии</td><td>2-33-56</td></tr>
	<tr><td align="right">Телефон тех. поддержки</td><td>4-27-42</td></tr>
    </table>
EOF
}

##my @radius = $radius_result~= m/(\n)/g

#print "<pre>";
#print $ip, "\n", $username, ":", $password, "\n";

#print $radius_result;

#print "<hr>";
#print `env`;
#print "</pre>";

#print <<<EOL
#</center></td></tr></table>
#</body>
#</html>
#EOL;