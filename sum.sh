#!/bin/bash
INT1=$1
INT2=$2
re='^-?[0-9]+([.][0-9]+)?'
if ! [[ $1 =~ $re ]] || ! [[ $2 =~ $re ]]; then
   echo "error: Not a number" >&2; exit 1
fi
awk -v a=$INT1 -v b=$INT2 'BEGIN {print "(a + b) = ", (a + b) }'
