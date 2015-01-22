package billinglib::paypage;

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
    
    my $template = HTML::Template->new(filename => 'tpls/pay.html', case_sensitive => 0);
    $template->param(PAGETITLE => "Иcтория платежей");
    $template->param(SCRIPT_NAME => $ENV{SCRIPT_NAME});

    my @payhistory = $self->{'USER'}->get_pay();
    my @test;
    
    my @temp;
    my $i;
    
    my @mounths = ("января", "февраля", "марта", "апреля", "мая", "июня", "июля", "августа", "сентября", "октября", "ноября", "декабря");
    
    my $count = $#payhistory;
    
    for($i=0;$i<$count;$i++) {
      @temp = $payhistory[$i];

      my $ltime = localtime($temp[0][0]);
      my $stime = $ltime->mday." ".($mounths[$ltime->mon])." ".($ltime->year+1900);
	      
      $test[$i]{'PAY_DATE'} = $stime;
      $test[$i]{'PAY_SUM'} = $temp[0][1];
      $test[$i]{'PAY_PLACE'} = $self->{'USER'}->get_paytype($temp[0][2]);
    };
        
#    $test[0]{'PAY_DATE'} = "adasdasdsad";
#    $test[0]{'PAY_SUM'} = "300";
#    $test[0]{'PAY_PLACE'} = "1";

#    $test[1]{'PAY_DATE'} = "ad";
#    $test[1]{'PAY_SUM'} = "301";
#    $test[1]{'PAY_PLACE'} = "2";
    
    $template->param(PAY_INFO => [@test]);

    print $template->output;
    
    my @t = $payhistory[0];
#    print $t[0][1];
        
    return $self;
}

	
1;
}