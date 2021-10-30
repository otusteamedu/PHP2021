#!/bin/bash
INT1=$1
INT2=$2
INT=$(($INT1+$INT2))
re='^-?[0-9]\d*(\.\d+)?$'
if ! [[ $1 =~ $re ]] || ! [[ $2 =~ $re ]]; then
   echo "error: Not a number" >&2; exit 1
fi
echo $INT
