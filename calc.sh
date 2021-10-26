#!/bin/bash

re='^[-+]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$'

if ! [[ $1 =~ $re ]] || ! [[ $2 =~ $re ]] ; then
   echo "error: Not a number" >&2; exit 1
fi

awk "BEGIN {print $1+$2; exit}"