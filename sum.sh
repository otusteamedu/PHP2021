#!/bin/bash

re='^[0-9]*\.?[0-9]+$'
if ! [[ $1 =~ $re ]] ; then
   echo "error: $1 not a number" >&2;
fi
if ! [[ $2 =~ $re ]] ; then
   echo "error: $2 not a number" >&2;
fi

if ! [[ $1 =~ $re ]] | [[ $2 =~ $re ]] ; then
    exit 1
fi

result=$(echo "$1 $2 + p" | dc)
echo "$1+$2=$result"