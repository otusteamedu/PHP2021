#!/bin/bash

reg='^[+-]?[0-9]+([.][0-9]+)?$'

if [ $# -lt 2 ]
  then
    echo Not enough arguments passed; exit 1
fi

if ! [[ $1 =~ $reg ]] || ! [[ $2 =~ $reg ]]; then
   echo One of the arguments is not a number; exit 1
fi

awk -v first="$1" -v second="$2" 'BEGIN{print first+second}';
