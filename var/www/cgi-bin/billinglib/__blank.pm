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
    
        
    return $self;
}

	
1;
}