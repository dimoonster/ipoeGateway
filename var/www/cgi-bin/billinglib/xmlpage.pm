package billinglib::xmlpage;

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
#    die "Unknown params!" unless $vars{'PARAMS'};
    
    $self->{'USER'} = $vars{'USER'};
    $self->{'PARAMS'} = $vars{'PARAMS'};
    
    my @TECHGROUPS = (80, 162, 87);

    my $template = HTML::Template->new(filename => 'tpls/xmlpage.html', case_sensitive => 0);
#    $template->param(PAGETITLE => "Информация о пользователе");
#    $template->param(SCRIPT_NAME => $ENV{SCRIPT_NAME});
    $template->param(USER_FULLNAME => $self->{'USER'}->get_fullname());
    $template->param(USER_CONTRACT => $self->{'USER'}->get_contractnumber());
    
    my $contdate = $self->{'USER'}->get_contractdate();
    my $conttime = localtime($contdate);
    $contdate = $conttime->mday."-".($conttime->mon+1)."-".($conttime->year+1900);
    $template->param(USER_CONTRACTDATE => $contdate);
    
    $template->param(USER_BALANCE => $self->{'USER'}->get_balance());
    
    my $accid    = $self->{'USER'}->get_accnumber(@TECHGROUPS);
    my $admgrpid = $self->{'USER'}->get_admgrpid($accid);
    $template->param(USER_ADMGROUP => $self->{'USER'}->get_admgrpname($admgrpid));

    my @tarifinfo = $self->{'USER'}->get_tarifinfo($admgrpid);
    $template->param(USER_ABONENTPAY => $tarifinfo[2]);
    $template->param(USER_MOUNTHTRAFLIMIT => $tarifinfo[4]);

    $template->param(USER_PREPAYTRAF => sprintf("%.4f", $self->{'USER'}->get_prepay_traf()/1024/1024));
    
    print $template->output;
    return $self;
}

	
1;
}