#!/bin/bash
re='^[+-]?[0-9]+([.][0-9]+)?$'

if [ "$#" -ne 2 ]; then
    echo "Illegal number of parameters"; exit 1
fi

if ! [[ $1 =~ ${re} ]] ; then
   echo "error: arg1 is not a number" >&2; exit 1
fi

if ! [[ $2 =~ $re ]] ; then
   echo "error: arg2 is not a number" >&2; exit 1
fi

awk "BEGIN {print ($1 + $2)}"