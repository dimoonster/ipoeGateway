#!/usr/bin/perl

# on gentoo: need
#      emerge -av RadiusPerl

$config = "/opt/ipoev2/etc/parent-radius.conf";

use Authen::Radius;

my $user = shift;
my $pwd = shift;

require $config;

my $radius = new Authen::Radius(Host => $radius_host, Secret => $radius_key, Debug => 0);
Authen::Radius->load_dictionary;

#my $rv = $radius->check_pwd($user, $pwd, $nas) ? 1 : 0;
#print $rv, "\n";

$radius->add_attributes (
	{ Name => 1, Value => $user, Type => 'string' },
	{ Name => 2, Value => $pwd, Type => 'string' }
#        { Name => 1, Value => $user },
#        { Name => 2, Value => $pwd },
#	{ Name => 4, Value => $nas, Type => 'ipaddr' }
);

$radius->send_packet (ACCESS_REQUEST);
$type = $radius->recv_packet;

my $res = (defined($type) and $type == 2) ? 1 : 0;

print "result: $res\n";

for $a ($radius->get_attributes) {
     print "$a->{'Name'}:$a->{'Value'}\n";
}

print $radius->strerror;
