#!/bin/bash

a=$1
b=$2
re='[+-]?([0-9]*[.])?[0-9]+'
if ! [[ $a =~ $re ]] || ! [[ $b =~ $re ]]; then
    echo 'ERROR'
    exit 1
fi

echo "$a + $b" |bc