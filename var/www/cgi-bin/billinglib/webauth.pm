package billinglib::webauth;

use strict;
use Authen::Radius;

use vars qw($VERSION @ISA @EXPORT);

require Exporter;

@ISA = qw(Exporter);

@EXPORT = qw(test print_auth radius_auth base64);
{

sub print_auth() {
    print "Status: 401\r\n",
        "WWW-Authenticate: Basic realm=\"test\"\r\n",
        "Content-type: text/plain\r\n\r\n",
        "Authorization required!\r\n";
    die;
}

sub test {
if(!$ENV{REMOTE_USER}) {
	print_auth();
    };

    my @authinfo = split(/:/, base64((split(/ /, $ENV{REMOTE_USER}))[1]));
    my $rv = radius_auth($authinfo[0], $authinfo[1]);
    
    if($rv) {
	print_auth();
    };
    
    $authinfo[0];
}

sub radius_auth() {
  my $user = shift;
  my $pwd = shift;
  my $radius_host = "172.16.1.xx:1645";
  my $radius_key  = "testing";
  my $nas = "172.16.1.xx";

  my $radius = new Authen::Radius(Host => $radius_host, Secret => $radius_key, Debug => 0);
  my $rv = $radius->check_pwd($user, $pwd, $nas) ? 0 : 1;
  
  $rv;
}

sub base64($)
{
    local($^W) = 0; my $str = shift; my $res = ""; $str =~ tr|A-Za-z0-9+=/||cd;
    if (length($str) % 4) {exit}
    $str =~ s/=+$//; $str =~ tr|A-Za-z0-9+/| -_|;
    while ($str =~ /(.{1,60})/gs) {
        my $len = chr(32 + length($1)*3/4);
        $res .= unpack("u", $len . $1 );
    }

    $res;
}
					
1;
}
