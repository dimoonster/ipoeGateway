#!/bin/bash

cat ./start.sh | while read LINE; do
    echo $LINE
done