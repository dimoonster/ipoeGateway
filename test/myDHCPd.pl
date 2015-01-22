#!/usr/bin/perl

use threads;
use threads::shared;
use Socket;
use Net::DHCP::Packet;
use Net::DHCP::Constants;
use POSIX qw(strftime);

my ($DEBUG, $BIND_ADDR, $SERVER_PORT, $CLIENT_PORT, $DHCP_SERVER_ID, $LOG_FILE, $PID_FILE);
my ($RUNNING, $DHCP_SOCKET, $ADDR_BCAST);

share($RUNNING);

init();

sub init {
    $BIND_ADDR 		= '255.255.255.255';
    $SERVER_PORT 	= 67;
    $CLIENT_PORT 	= 68;
    $DHCP_SERVER_ID	= '172.16.1.160';
    
    $DEBUG		= 1;
    $LOG_FILE		= STDOUT;
    
    $SIG{INT} = $SIG{TERM} = $SIG{HUP} = \&signal_handler;
    
    main();
}

sub main {
    logg("Program Started. Pid is $$");
    
    $RUNNING = 1;
    
    $ADDR_BCAST = sockaddr_in($CLIENT_PORT, INADDR_BROADCAST);
    
    socket($DHCP_SOCKET, PF_INET, SOCK_DGRAM, getprotobyname('udp')) || die "Socket creation error: $@\n";
    bind($DHCP_SOCKET, sockaddr_in($SERVER_PORT, inet_aton($BIND_ADDR))) || die "bind: $!";
    
    request_loop();
    
    if(defined($PIDFILE)) { unlink($PIDFILE); }
    
    close($DHCP_SOCKET);
    logg("Program ended");
}

sub request_loop {
    my ($buf, $fromaddr, $dhcpreq);
    
    while($RUNNING == 1) {
	$buf = undef;
	
	$fromaddr = recv($DHCP_SOCKET, $buf, 16384, 0) || logg("recv err: $!");
	next if(length($buf) < 300);
	
	$dhcpreq = new Net::DHCP::Packet($buf);
	
	if($DEBUG) {
	    my($port, $addr) = unpack_sockaddr_in($fromaddr);
	    my $ipaddr = inet_ntoa($addr);
	    
	    logg("Got a packet src = $ipaddr:$port length = ".length($buf));
	    logg($dhcpreq->toString());
	}
    }
}

sub logg {
    if(!$DEBUG) { return; }
    
    print STDOUT strftime "[%d/%b/%Y %H:%M:%S] ", localtime;
    print STDOUT $_[0]."\n";
}

sub signal_handler {
    $RUNNING = 0;
    close($DHCP_SOCKET);
    logg("Ended by signal_handler");
    exit();
}