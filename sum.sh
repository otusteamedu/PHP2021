#!/bin/bash
number_reg_exp='^[-]?[0-9]+([.][0-9]+)?$'
if ! [[ $1 =~ $number_reg_exp ]] ; then
   echo "error: 1st parameter is not number" >&2; exit 1
fi
if ! [[ $2 =~ $number_reg_exp ]] ; then
   echo "error: 2nd parameter is not number" >&2; exit 1
fi
printf '%s %s' "$1 $2" | awk '{print $1+$2}'
