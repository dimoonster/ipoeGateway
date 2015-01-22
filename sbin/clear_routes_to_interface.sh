#!/bin/sh

INTERFACE=eth1.81.212

ROUTES=`netstat -nr | grep $INTERFACE | awk '{print $1}'`

for ROUTE in $ROUTES; do
    route del -host $ROUTE dev $INTERFACE
done