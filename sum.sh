#!/bin/bash

rex='^[+-]?[0-9]+([.][0-9]+)?$'

if [[ $1 =~ $rex ]] && [[ $2 =~ $rex ]]; then
    echo "$1 $2" | awk '{print $1 + $2}'
else
  echo 'error: wrong data'
	exit 1
fi