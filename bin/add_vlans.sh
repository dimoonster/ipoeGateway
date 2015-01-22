#!/bin/sh

# Массовое добавление вланов

DOWNLINK=eth1.85

for VLAN in {2001..2024}
do
    vconfig add $DOWNLINK $VLAN
    ifconfig $DOWNLINK.$VLAN up
done
