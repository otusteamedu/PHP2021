#!/bin/bash

exp='^[+-]?[0-9]+([.][0-9]+)?$'
if ! [[ $1 =~ $exp ]] ; then
   echo "error: First arg not a number" >&2; exit 1
fi

if ! [[ $2 =~ $exp ]] ; then
   echo "error: Second arg not a number" >&2; exit 1
fi
echo "$1 $2" | awk '{print $1+$2}'