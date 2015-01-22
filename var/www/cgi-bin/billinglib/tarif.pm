package billinglib::tarif;

use strict;
use DBI;
use HTML::Template;
use Time::localtime;

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
    die "Unknown user class!" unless $vars{'USER'};
    die "Unknown params!" unless $vars{'PARAMS'};
    
    $self->{'USER'} = $vars{'USER'};
    $self->{'PARAMS'} = $vars{'PARAMS'};
    

    my $my_host = "mysql2.luga.ru";
    my $my_user = "root";
    my $my_pass = "g[gvfqflvby";
    my $my_dbname = "cisco";
    
    my $my_dsn = 'DBI:mysql:'.$my_dbname.':'.$my_host;
    
    $self->{'mysql'} = DBI->connect($my_dsn, $my_user, $my_pass)
      or die "Error to connect to stat db!";


    my @params = split(/[&;]/, $vars{'PARAMS'});
    my $i;
    my %params;
    my $key;
    my $val;

    foreach $i (0..$#params) {
      $params[$i] =~ s/\+/ /g;
      ($key, $val) = split(/=/,$params[$i],2);
      $key =~ s/%(..)/pack("c",hex($1))/ge;
      $val =~ s/%(..)/pack("c",hex($1))/ge;
      
      $params{$key} .= "\0" if(defined($params{$key}));
      $params{$key} .= $val;
    };
    
    my $act = $params{'act'};
    if(!$act) { $act = 'det0'; };
    
    $self->show_tarif_list() if ($act eq 'det0');
        
    return $self;
}

sub show_tarif_list() {
    my ($self, $type) = @_;
    
    my $template = HTML::Template->new(filename => 'tpls/tarifs.html', case_sensitive => 0);
    $template->param(PAGETITLE => "Тарифы");
    $template->param(SCRIPT_NAME => $ENV{SCRIPT_NAME});
    
    my @TECHGROUPS = (17, 19);
    
    my $accid = $self->{'USER'}->get_accnumber(@TECHGROUPS);
    my ($admgrpid, $tarifid) = $self->{'USER'}->get_admgrpid($accid);
    
    my @tarif_info = $self->get_tarif_info($tarifid);
    $template->param(MY_TARIF => $tarif_info[1]);    


    my $my_techgrp = $self->{'USER'}->get_acctechgrp($accid);
    my @temp;
    my @arr;
    my $i;
    my $sql = "select id,name,ap,mbinap,cost1mb,active from bilv2_tarifs where techgr='".$my_techgrp."' and active=1";
    my $sth = $self->{'mysql'}->prepare($sql);
    $sth->execute();
    
    for($i=0;@arr=$sth->fetchrow_array();$i++) {
      $temp[$i]{'NAME'} = $arr[1];
      $temp[$i]{'AP'} = "\$".$arr[2];
      if($arr[3]==-1) {
        $temp[$i]{'TRAFINAP'} = "Unlimited";
      } else {
        $temp[$i]{'TRAFINAP'} = $arr[3]." MByte";
      };
      $temp[$i]{'COSTMB'} = "\$".$arr[4];
      if($tarif_info[0]==$arr[0]) {
        $temp[$i]{'ACTION'} = "Перейти";
      } else {
        if($arr[5]==0) {
	  $temp[$i]{'ACTION'} = "Неактивен";
	} else {
	  $temp[$i]{'ACTION'} = '<a href="/billing.v2.pl?page=tarif&act=det1&t='.$arr[0].'">Перейти</a>';
	};
      };
      
    };
    
    $template->param(TARIF_INFO => [@temp]);

    print $template->output;
}

sub get_tarif_info() {
    my ($self, $type) = @_;
    shift;
    
    my $tid = shift;
    my @arr;
    
    my $sth = $self->{'mysql'}->prepare("select id,name,ap,mbinap,cost1mb from bilv2_tarifs where peid=$tid");
    $sth->execute();
    
    @arr = $sth->fetchrow_array();
    
    return @arr;
}

1;
}