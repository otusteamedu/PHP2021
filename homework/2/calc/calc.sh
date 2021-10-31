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

I=`bc -v`;
if ! [ -n "$I" ]
then
   echo "error: Install bc!";
   exit 1;
fi

result=$(echo "$1+$2" | bc);
echo $result;

exit 0;
