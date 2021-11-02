#!/bin/bash
re='^[+-]?([0-9]*[.])?[0-9]+$'

if ! [[ $1 =~ $re ]] ; then
   echo "error: Expected first arg positive or negative number" >&2;
   exit 1;
fi

if ! [[ $2 =~ $re ]] ; then
   echo "error: Expected second arg positive or negative number" >&2;
   exit 1;
fi

awk "BEGIN {print $1 + $2}"

exit 0;
