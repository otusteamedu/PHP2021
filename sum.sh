#!/bin/bash
reg='^[+-]?[0-9]+([.][0-9]+)?$'

if [[ $# != 2 ]] ; then
  echo "function use only 2 parameters" >&2; exit 1
fi

for param in $@
do
  if ! [[ $param =~ $reg ]] ; then
    echo "parameter $param: not digital" >&2; exit 1
  fi
done

awk "BEGIN {print $1+$2}"