package billinglib::user;

use strict;
use Authen::Radius;
use DBI;

use vars qw($VERSION @ISA @EXPORT);

require Exporter;

@ISA = qw(Exporter);

@EXPORT = qw(new);
{

sub new {
    my	$class = shift;
    my	$self = {};
    my	%vars = @_;
    
    bless($self, $class);
    
    # Запомним инициализирующую информацию
    die "Unknown Login!" unless $vars{'Login'};
    die "Unknown DBHost" unless $vars{'dbhost'};
    die "Unknown DBUser" unless $vars{'dbuser'};
    die "Unknown DBPass" unless $vars{'dbpass'};
    die "Unknown DBName" unless $vars{'dbname'};
    
    $self->{'Login'} = $vars{'Login'};
    $self->{'dbhost'} = $vars{'dbhost'};
    $self->{'dbuser'} = $vars{'dbuser'};
    $self->{'dbpass'} = $vars{'dbpass'};
    $self->{'dbname'} = $vars{'dbname'};

#    print "1";    
    # Подключаемся к базе данных
    $self->{'dbh'} = DBI->connect('DBI:Sybase:server='.$self->{'dbhost'}.',database='.$self->{'dbname'}, $self->{'dbuser'}, $self->{'dbpass'})
	    or die "Couldn't connect to DB: ".DBI->errstr;
#    print "2";
    # Получим UserID для полученного логина
    my $sth = $self->{'dbh'}->prepare("select UserID from Accounts where AccountName='".$self->{'Login'}."'");
    $sth->execute();
    my @data = $sth->fetchrow_array(); my $userid = @data[0];
    if(!$userid) { die "Unknown UserID for login ".$self->{'Login'}; };
    $self->{'UserID'} = $userid;
    
    return $self;
}

sub get_user_login() {
    my ($self, $type) = @_;
    return $self->{'Login'};
}

sub get_user_id() {
    my ($self, $type) = @_;
    return $self->{'UserID'};
}

# -- Получим список ИП адресов для пользователя
sub get_ips() {
    my ($self, $type) = @_;
    my @ips = ();
    my @data;
    
    my $sth = $self->{'dbh'}->prepare('select distinct IPAddr from Accounts where UserID='.$self->{'UserID'}.' and IPaddr <> \'\'');
    $sth->execute();
    while(@data=$sth->fetchrow_array()) {
      push (@ips, $data[0]);
    };
    
    return @ips;
}

# -- Получим баланс пользователя
sub get_balance() {
    my ($self, $type) = @_;
    my @data;
    
    my $sth = $self->{'dbh'}->prepare('select RealRest from Users where UserID='.$self->{'UserID'});
    $sth->execute();
    if(@data=$sth->fetchrow_array()) {
      return $data[0];
    } else {
      $self->dieerr("Ошибка получения баланса пользователя!", __FILE__, __LINE__);
    };
}

# -- Полусение краткого ФИО пользователя
sub get_title() {
    my ($self, $type) = @_;
    my @data;
    
    my $sth = $self->{'dbh'}->prepare('select Title from Users where UserID='.$self->{'UserID'});
    $sth->execute();
    if(@data=$sth->fetchrow_array()) {
      return $data[0];
    } else {
      $self->dieerr("Ошибка получения title пользователя!", __FILE__, __LINE__);
    };
}

# -- Полусение адреса пользователя
sub get_address() {
    my ($self, $type) = @_;
    my @data;
    
    my $sth = $self->{'dbh'}->prepare('select OfficialAddress from Users where UserID='.$self->{'UserID'});
    $sth->execute();
    if(@data=$sth->fetchrow_array()) {
      return $data[0];
    } else {
      $self->dieerr("Ошибка получения адреса пользователя!", __FILE__, __LINE__);
    };
}

# -- Полусение телефона пользователя
sub get_phone() {
    my ($self, $type) = @_;
    my @data;
    
    my $sth = $self->{'dbh'}->prepare('select Phone from Users where UserID='.$self->{'UserID'});
    $sth->execute();
    if(@data=$sth->fetchrow_array()) {
      return $data[0];
    } else {
      $self->dieerr("Ошибка получения адреса пользователя!", __FILE__, __LINE__);
    };
}

# -- Получение ACCOUNT NUMBER для пользователя исходя из технических групп
sub get_accnumber() {
    my ($self, $type) = @_;
    shift;
    my @TGROUPS=();
    my @data;
    my $grp;

    while($grp = shift) {
      push (@TGROUPS, $grp);
    };
    
    my $sql = "select number from Accounts where UserID=".$self->{'UserID'}." and TechGroupID in (";
    foreach $grp (@TGROUPS) {
      $sql = $sql.$grp.", "
    };
    
    $sql = $sql."0)";
    
#    print $sql;"
    
    my $sth = $self->{'dbh'}->prepare($sql);
    $sth->execute();
    if(@data = $sth->fetchrow_array()) {
      return $data[0];
    } else {
      $self->dieerr("Ошибка получения ACC Number пользователя!", __FILE__, __LINE__);      
    };
}

sub get_accnumber_bylogin() {
    my ($self, $type) = @_;
    shift;
    my @TGROUPS=();
    my @data;
    
    my $login = shift;
        
    my $sql = "select number from Accounts where AccountName='".$login."';";
    
#    print $sql;
    
    my $sth = $self->{'dbh'}->prepare($sql);
    $sth->execute();
    if(@data = $sth->fetchrow_array()) {
      return $data[0];
    } else {
      $self->dieerr("Ошибка получения ACC Number пользователя!", __FILE__, __LINE__);      
    };
}

# -- Получение ID административной группы для аккаунта
sub get_admgrpid() {
    my ($self, $type) = @_;
    shift;
    my $accid = shift;
    my @data;
    my $tarifid;
    my $admgrpid;
    
    my $sth = $self->{'dbh'}->prepare("select AdmGroupID,AccountAdmID from AccountsAdm where UserID=".$self->{'UserID'}." and AccountID=".$accid." order by AccountAdmID asc");

#    print "select AdmGroupID,AccountAdmID from AccountsAdm where UserID=".$self->{'UserID'}." and AccountID=".$accid." order by AccountAdmID asc";

    $sth->execute();
    while(@data = $sth->fetchrow_array()) {
      ($tarifid, $admgrpid) = @data;
    };
    
    return ($admgrpid, $tarifid);
}

# -- Получение названия административной группы
sub get_admgrpname() {
    my ($self, $type) = @_;
    shift;
    my $tarifid = shift;
    my @data;
    
    my $sth = $self->{'dbh'}->prepare("select GroupName from Groups where GroupID=".$tarifid);
    $sth->execute();
    if(@data = $sth->fetchrow_array()) {
      return $data[0];
    } else {
      $self->dieerr("Ошибка получения тарифа!", __FILE__, __LINE__);
    };
}

# -- Получение текущего действующего тарифа для административной группы
sub get_tarifinfo() {
    my ($self, $type) = @_;
    shift;
    my $admgrp = shift;
    my @data;

    my $sql = "select Description,FirstDate,AbonentRate,AbonentPeriod,AbonentSizeLimit from Tariffs where GroupID=".$admgrp." order by FirstDate desc";
    
    my $sth = $self->{'dbh'}->prepare($sql);
    $sth->execute();
    if(@data = $sth->fetchrow_array()) {
      return @data;
    } else {
      $self->dieerr("Ошибка получения параметров тарифа", __FILE__, __LINE__);
    };
}
# -- Полусение краткого ФИО пользователя
sub get_fullname() {
    my ($self, $type) = @_;
    my @data;
    
    my $sth = $self->{'dbh'}->prepare('select FullName from Users where UserID='.$self->{'UserID'});
    $sth->execute();
    if(@data=$sth->fetchrow_array()) {
      return $data[0];
    } else {
      $self->dieerr("Ошибка получения полного имени пользователя!", __FILE__, __LINE__);
    };
}

# -- Получение номера договора
sub get_contractnumber() {
    my ($self, $type) = @_;
    my @data;
    
    my $sth = $self->{'dbh'}->prepare('select ContractNumber from Users where UserID='.$self->{'UserID'});
    $sth->execute();
    if(@data=$sth->fetchrow_array()) {
      return $data[0];
    } else {
      $self->dieerr("Ошибка получения номера договора пользователя!", __FILE__, __LINE__);
    };
}

# -- Получение даты заключения договора
sub get_contractdate() {
    my ($self, $type) = @_;
    my @data;
    
    my $sth = $self->{'dbh'}->prepare('select ContractDate from Users where UserID='.$self->{'UserID'});
    $sth->execute();
    if(@data=$sth->fetchrow_array()) {
      my $d = int($data[0]);
      $d = ($d-25569)*24*60*60-3*60*60;
      return $d;
    } else {
      $self->dieerr("Ошибка получения даты заключения договора пользователя!", __FILE__, __LINE__);
    };
};

# -- Получение технической группы для аккаунта
sub get_acctechgrp() {
    my ($self, $type) = @_;
    shift;
    
    my $accid = shift;
    
    my $sth = $self->{'dbh'}->prepare("select TechGroupID from Accounts where Number=$accid");
    $sth->execute();
    
    my @arr = $sth->fetchrow_array();
    
    return $arr[0];
};

# -- Получение массива с платежами
sub get_pay() {
    my ($self, $type) = @_;
    my @data;
    my @rv;
    
    my $sql = "select PayDate,SumInRubles,Cashe from Credits where UserID=".$self->{'UserID'}." order by PayDate desc";
    my $sth = $self->{'dbh'}->prepare($sql);
    $sth->execute();
    while(@data = $sth->fetchrow_array()) {
	$data[0] = ($data[0]-25569)*24*60*60-3*60*60;
	push (@rv, [@data]);
    };
    
    return @rv;
};

# -- PrePay Traf
sub get_prepay_traf () {
    my ($self, $type) = @_;
    my @data;
    my $rv;
    
    my $sql = "select PrePayTraf from bilv2_prepaytraf where UserID=".$self->{'UserID'};
    my $sth = $self->{'dbh'}->prepare($sql);
    $sth->execute();
    if(@data = $sth->fetchrow_array()) {
      return $data[0];
    };
    
    return 0;
};

sub store_prepaid_traf() {
    my ($self, $type) = @_;
    shift;
    my $traf12 = shift;
    my @data;
    
#    print $traf12; die();
    
    my $sql = "select PrePayTraf from bilv2_prepaytraf where UserID=".$self->{'UserID'};
    my $sth = $self->{'dbh'}->prepare($sql);
    $sth->execute();
    if(@data = $sth->fetchrow_array()) {
      $sql = "update bilv2_prepaytraf set PrePayTraf=".$traf12." where UserID=".$self->{'UserID'};
    } else {
      $sql = "insert into bilv2_prepaytraf(UserID, PrePayTraf) values(".$self->{'UserID'}.", ".$traf12.")";
    };
    
    $sth = $self->{'dbh'}->prepare($sql);
    $sth->execute();
};

# -- Получение места платежа "
sub get_paytype() {
    my ($self, $type) = @_;
    shift;
    my $payid = shift;
    my @data;
    
    my $sql = "select PaySource from PayTypes where PayID=".$payid;
    my $sth = $self->{'dbh'}->prepare($sql);
    $sth->execute();
    if(@data=$sth->fetchrow_array()) {
	return $data[0];
    } else {
	$self->dieerr("Ошибка получения типа платежа!", __FILE__, __LINE__);
    };
};

# -- Вывод ошибки и терминирование програмы
sub dieerr() {
    my ($self, $type) = @_;
    shift;
    my $errtxt = shift;
    my $atfile = shift;
    my $atline = shift;
   
    my $errtxt = "<html><head><title>Billing v2:Ошибка!</title></head><body><pre>".$errtxt."\nAt file ".$atfile." at line ".$atline."</pre></body></html>";
   
    print $errtxt;
    die();
};

#-- Списание средств для расчетчика PE
sub do_spis {
    my ($self, $type) = @_;
    shift;
    my $UserID          = shift;
    my $accid           = shift;
    my $opertime        = shift;
    my $group_id        = shift;
    my $tarif_id        = shift;
    my $rate_id         = shift;
    my $cost            = shift;
    my $quantity        = shift;
    my $rate            = shift;
    my $source          = shift;
    my $source_id       = shift;
    my $accounted       = shift;
    my $operator        = shift;

    my $sql = "insert into Debets(
      UserID, AccountID, OperTime, Source, SourceID, GroupID, TariffID, RateID, Rate,
      Quantity, [Time], Cost, PayedCost, Accounted, Operator) values (
      $UserID, $accid, '$opertime', $source, $source_id, $group_id, $tarif_id, $rate_id, $rate,
      '$quantity', 0, $cost, 0, 0, '$operator');
    ";
    my $sth = $self->{'dbh'}->prepare($sql);
    $sth->execute();
};
														  	
1;
}