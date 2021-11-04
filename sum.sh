#!/bin/bash
apt-get install -y bc

reg='^[+-]?[0-9]+([.][0-9]+)?$'

if [ $# -lt 2 ]
  then
    echo Not enough arguments passed; exit 1
fi

if ! [[ $1 =~ $reg ]]; then
   echo One of the arguments not a number; exit 1
fi

echo "$1+$2" | bc;
