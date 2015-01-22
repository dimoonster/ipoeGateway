#!/usr/bin/perl

$vlan = "eth2.12";

my ($mint, $mvlan, $svlan) = split /\./, $vlan;

print "mint=$mint, mvlan=$mvlan, svlan=$svlan";