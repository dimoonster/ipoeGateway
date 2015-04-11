package billinglib::admtrafpage;

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
    
    # Çàïîìíèì èíèöèàëèçèðóþùóþ èíôîðìàöèþ
    die "Unknown user class!" unless $vars{'USER'};
    die "Unknown params!" unless $vars{'PARAMS'};
    
    $self->{'USER'} = $vars{'USER'};
    $self->{'PARAMS'} = $vars{'PARAMS'};
    

    my $my_host = "host";
    my $my_user = "root";
    my $my_pass = "---000---";
    my $my_dbname = "ciscologdb";
    
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
    
    $self->{'uid'} = $params{'uid'};
    $self->{'accid'} = $params{'accid'};
    $self->{'fullname'} = $self->{'USER'}->get_title();
    
    $self->show_by_year() if($act eq 'det0');
    $self->show_by_mounth(int($params{'year'}), int($params{'mounth'})) if($act eq 'det1');
    $self->show_ext_detail(int($params{'year'}), int($params{'mounth'}), int($params{'day'})) if($act eq 'det2');
    $self->show_int_detail(int($params{'year'}), int($params{'mounth'}), int($params{'day'})) if($act eq 'det3');
        
    return $self;
}

sub show_ext_detail() {
    my ($self, $type) = @_;
    shift;
    
    my $year = shift;
    my $mounth = shift;
    my $day = shift;
    
    $day += 1;
    $mounth += 1;
    
    my @mounths = ("ÿíâàðÿ", "ôåâðàëÿ", "ìàðòà", "àïðåëÿ", "ìàÿ", "èþíÿ", "èþëÿ", "àâãóñòà", "ñåíòÿáðÿ", "îêòÿáðÿ", "íîÿáðÿ", "äåêàáðÿ");
    
    my $template = HTML::Template->new(filename => 'tpls/admin_index_traf_detail.html', case_sensitive => 0);
    $template->param(PAGETITLE => "Ñòàòèñòèêà ïîëüçîâàíèÿ");
    $template->param(SCRIPT_NAME => $ENV{SCRIPT_NAME});
    $template->param(MOUNTH => $mounths[$mounth-1]);
    $template->param(YEAR => $year);
    $template->param(DAY => $day);
    my $user_full = $self->{'fullname'};
    $template->param(USER_FULL => $user_full);
    
    my @ips = $self->{'USER'}->get_ips();
    my $i;
    my $j;
    my @arr;
    my @temp;
    my $totip;
    
    for($i=0;$i<=$#ips;$i++) {
      $totip = 0;
      my $sql = "select FromIP,Bytes from traffic where day='".$year."-".($mounth<10?"0":"").$mounth."-".($day<10?"0":"").$day." 00:00:00' and ToIP='".$ips[$i]."' order by Bytes desc;";
      $temp[$i]{'IP'} = $ips[$i];
      
      my $sth = $self->{'mysql'}->prepare($sql);
      $sth->execute();
      
      my @temp_sub;
      $j=0;
      $totip=0;
      while(@arr=$sth->fetchrow_array()) {
        if($self->ip_is_external($arr[0])==1) {
	  $temp_sub[$j]{'ADDR'} = $arr[0];
	  $temp_sub[$j]{'TRAF'} = $arr[1];
	  $totip += $arr[1];
	  $j++;
	};
      };
      $temp[$i]{'STAT'}   = [@temp_sub];
      $temp[$i]{'IPTRAF'} = $totip;
      $sth->finish();
    };
    
    $template->param(DETIP => [@temp]);
    
    print $template->output;
    
}

sub show_int_detail() {
    my ($self, $type) = @_;
    shift;
    
    my $year = shift;
    my $mounth = shift;
    my $day = shift;
    
    $day += 1;
    $mounth += 1;
    
    my @mounths = ("ÿíâàðÿ", "ôåâðàëÿ", "ìàðòà", "àïðåëÿ", "ìàÿ", "èþíÿ", "èþëÿ", "àâãóñòà", "ñåíòÿáðÿ", "îêòÿáðÿ", "íîÿáðÿ", "äåêàáðÿ");
    
    my $template = HTML::Template->new(filename => 'tpls/admin_index_traf_detail.html', case_sensitive => 0);
    $template->param(PAGETITLE => "Ñòàòèñòèêà ïîëüçîâàíèÿ");
    $template->param(SCRIPT_NAME => $ENV{SCRIPT_NAME});
    $template->param(MOUNTH => $mounths[$mounth-1]);
    $template->param(YEAR => $year);
    $template->param(DAY => $day);
    my $user_full = $self->{'fullname'};
    $template->param(USER_FULL => $user_full);
    
    my @ips = $self->{'USER'}->get_ips();
    my $i;
    my $j;
    my @arr;
    my @temp;
    my $totip;
    
    for($i=0;$i<=$#ips;$i++) {
      $totip = 0;
      my $sql = "select FromIP,Bytes from traffic where day='".$year."-".($mounth<10?"0":"").$mounth."-".($day<10?"0":"").$day." 00:00:00' and ToIP='".$ips[$i]."' order by Bytes desc;";
      $temp[$i]{'IP'} = $ips[$i];
      
      my $sth = $self->{'mysql'}->prepare($sql);
      $sth->execute();
      
      my @temp_sub;
      $j=0;
      $totip=0;
      while(@arr=$sth->fetchrow_array()) {
        if($self->ip_is_external($arr[0])==0) {
	  $temp_sub[$j]{'ADDR'} = $arr[0];
	  $temp_sub[$j]{'TRAF'} = $arr[1];
	  $totip += $arr[1];
	  $j++;
	};
      };
      $temp[$i]{'STAT'}   = [@temp_sub];
      $temp[$i]{'IPTRAF'} = $totip;
      $sth->finish();
    };
    
    $template->param(DETIP => [@temp]);
    
    print $template->output;
    
}

sub ip_is_external() {
    my ($self, $type) = @_;
    shift;
    
    my $ip = shift;
    
    my $sql = "select ip,type from calc_options order by type desc";
    my $sth = $self->{'mysql'}->prepare($sql);
    $sth->execute();
    my @arr;
        
    while(@arr=$sth->fetchrow_array()) {
      if($ip =~ /\b($arr[0])\b/g) {
        my $t = $arr[1];
        if($t eq "spec") { return 1; };
	if($t eq 'free') { return 0; };
      };
    };
    
    return 1;
}

sub show_by_mounth() {
    my ($self, $type) = @_; 
    shift;
    my $year = shift;
    my $mounth = shift;

    my @mounths = ("ÿíâàðü", "ôåâðàëü", "ìàðò", "àïðåëü", "ìàé", "èþíü", "èþëü", "àâãóñò", "ñåíòÿáðü", "îêòÿáðü", "íîÿáðü", "äåêàáðü");
    my @days = (31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    
    my $template = HTML::Template->new(filename => 'tpls/admin_index_traf_mounth.html', case_sensitive => 0);
    $template->param(PAGETITLE => "Ñòàòèñòèêà ïîëüçîâàíèÿ");
    $template->param(SCRIPT_NAME => $ENV{SCRIPT_NAME});
    $template->param(MOUNTH => $mounths[$mounth]);
    $template->param(YEAR => $year);
    my $user_full = $self->{'fullname'};
    $template->param(USER_FULL => $user_full);
    
    my $i;
    my @temp;
    my $td;
    my $cd;
        
    for($i=0; $i<$days[$mounth]; $i++) {
      $temp[$i]{'DAY'} = $i+1;
      
      my $traf = $self->get_day_pay_traf($year, $mounth+1, $i+1);
      $temp[$i]{'PAY'} = sprintf("%.2f Ìáàéò", $traf/1024/1024);

      my $traf = $self->get_day_free_traf($year, $mounth+1, $i+1);
      $temp[$i]{'FREE'} = sprintf("%.2f Ìáàéò", $traf/1024/1024);
      
      $temp[$i]{'DET1'} = "(<a href=\"/admin?page=index&action=user&uid=".$self->{'uid'}."&accid=".$self->{'accid'}."&cmd=stat&act=det2&year=".$year."&mounth=".$mounth."&day=".$i."\">Ïîäðîáíåå</a>)";
      $temp[$i]{'DET2'} = "(<a href=\"/admin?page=index&action=user&uid=".$self->{'uid'}."&accid=".$self->{'accid'}."&cmd=stat&act=det3&year=".$year."&mounth=".$mounth."&day=".$i."\">Ïîäðîáíåå</a>)";
#      $temp[$i]{'DET2'} = "(<a href=\"/admin?page=traf&act=det3&year=".$year."&mounth=".$mounth."&day=".$i."\">Ïîäðîáíåå</a>)";
    };
#    print $self->get_day_pay_traf($year, $mounth, 1);

    $template->param(STAT => [@temp]);

    print $template->output;
}

sub show_by_year {
  my ($self, $type) = @_;

    my @mounths = ("ÿíâàðü", "ôåâðàëü", "ìàðò", "àïðåëü", "ìàé", "èþíü", "èþëü", "àâãóñò", "ñåíòÿáðü", "îêòÿáðü", "íîÿáðü", "äåêàáðü");

    my $template = HTML::Template->new(filename => 'tpls/admin_index_traf_choose.html', case_sensitive=> 0);
    $template->param(PAGETITLE => "Ñòàòèñòèêà ïîëüçîâàíèÿ");
    $template->param(SCRIPT_NAME => $ENV{SCRIPT_NAME});
    my $user_full = $self->{'fullname'};
    $template->param(USER_FULL => $user_full);
    
    my @temp_data;
    
    my @years;
    my $i;
    my $j;
    my $traf;
    
    my $tot_free_traf;
    my $tot_pay_traf;
    
    @years = $self->get_years();
    
    for($i=0; $i <= $#years; $i++) {
      $temp_data[$i]{'YEAR_INFO_YEAR'} = $years[$i];
      
      $tot_free_traf = 0;
      $tot_pay_traf = 0;

      my @temp_sub;
      
      for($j=0; $j<12; $j++) {
        $temp_sub[$j]{'DET_MOUNTH'} = $mounths[$j];

	$traf = $self->get_sum_pay_traf($years[$i], $j+1);
	$tot_pay_traf += $traf;
	$temp_sub[$j]{'PAY_TRAF'} = ($traf==0?'n/a':sprintf("%.2f Ìáàéò", $traf/1024/1024));

        $traf = $self->get_sum_free_traf($years[$i], $j+1);
	$tot_free_traf += $traf;
	$temp_sub[$j]{'FREE_TRAF'} = ($traf==0?'n/a':sprintf("%.2f Ìáàéò", $traf/1024/1024));
	
	$temp_sub[$j]{'DET_LINK'} = "/admin?page=index&action=user&uid=".$self->{'uid'}."&accid=".$self->{'accid'}."&cmd=stat&act=det1&year=".$years[$i]."&mounth=".$j;
      };
      
      $temp_data[$i]{'TOTAL_FREE'} = sprintf("%.2f Ìáàéò", $tot_free_traf/1024/1024);
      $temp_data[$i]{'TOTAL_PAY'} = sprintf("%.2f Ìáàéò", $tot_pay_traf/1024/1024);
      $temp_data[$i]{'TOTAL_TRAF'} = sprintf("%.2f Ìáàéò", ($tot_free_traf+$tot_pay_traf)/1024/1024);
            
      $temp_data[$i]{'YEAR_DET_INFO'} = [@temp_sub];
    };
    
    $template->param(YEAR_INFO => [@temp_data]);

    print $template->output;
}

sub get_years {
  my ($self, $type) = @_;
  
  my @rv;
  my @year;
  
  my $sth = $self->{'mysql'}->prepare("select DATE_FORMAT(param1, '%Y') as year from temp_traff where uid=".$self->{'USER'}->get_user_id()." group by year order by year desc");
  $sth->execute();
  
  my $i = 0;
  while(@year = $sth->fetchrow_array()) {
    push(@rv, $year[0]) if($i++<2);
  };
  
  return @rv;
}

sub get_sum_pay_traf() {
  my ($self, $type) = @_;
  shift;
  my $year = shift;
  my $mounth = shift;

  if($mounth<10) { $mounth="0".$mounth; };
  
  my $sql = "select sum(traff) from temp_traff where DATE_FORMAT(param1, '%Y-%m')='".$year."-".$mounth."' and uid=".$self->{'USER'}->get_user_id();
  
  my $sth = $self->{'mysql'}->prepare($sql);
  $sth->execute;
  
  my ($count) = $sth->fetchrow_array();
  if(!$count) {
    $count = 0;
  };
  $sth->finish();
  
  return $count;
}

sub get_sum_free_traf() {
  my ($self, $type) = @_;
  shift;
  my $year = shift;
  my $mounth = shift;

  if($mounth<10) { $mounth="0".$mounth; };
  
  my $sql = "select sum(traff) from temp_traff_free where DATE_FORMAT(param1, '%Y-%m')='".$year."-".$mounth."' and uid=".$self->{'USER'}->get_user_id();
  
  my $sth = $self->{'mysql'}->prepare($sql);
#  $sth->execute;
  
  my ($count) = $sth->fetchrow_array();
  if(!$count) {
    $count = 0;
  };
  $sth->finish();
  
  return $count;
}

sub get_day_pay_traf() {
  my ($self, $type) = @_;
  shift;
  my $year = shift;
  my $mounth = shift;
  my $day = shift;

  if($mounth<10) { $mounth="0".$mounth; };
  if($day<10) { $day="0".$day; };
  
  my $sql = "select sum(traff) as tr from temp_traff where param1='".$year."-".$mounth."-".$day." 00:00:00' and uid=".$self->{'USER'}->get_user_id();
  
  my $sth = $self->{'mysql'}->prepare($sql);
  $sth->execute;
  
  my ($count) = $sth->fetchrow_array();
  if(!$count) {
    $count = 0;
  };
  $sth->finish();
  
  return $count;
}

sub get_day_free_traf() {
  my ($self, $type) = @_;
  shift;
  my $year = shift;
  my $mounth = shift;
  my $day = shift;

  if($mounth<10) { $mounth="0".$mounth; };
  if($day<10) { $day="0".$day; };
  
  my $sql = "select sum(traff) as tr from temp_traff_free where DATE_FORMAT(param1, '%Y-%m-%d')='".$year."-".$mounth."-".$day."' and uid=".$self->{'USER'}->get_user_id();
  
  my $sth = $self->{'mysql'}->prepare($sql);
#  $sth->execute;
  
  my ($count) = $sth->fetchrow_array();
  if(!$count) {
    $count = 0;
  };
  $sth->finish();
  
  return $count;
}
	
1;
}
