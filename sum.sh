#!/bin/bash

Help()
{
   echo "Takes two numbers and displays their sum."
   echo
   echo "Usage:"
   echo "  sum.sh number1 number2   calculate the sum of the numbers"
   echo "  sum.sh -h                show this help"
   echo
}

re="^-{0,1}[0-9\.]+$"

if [ -z $1 ] || [ $1 = "-h" ] || [[ ! $1 =~ $re ]] || [[ ! $2 =~ $re ]]; then
   Help
   exit
fi

total=`awk -v NUM1=$1 -v NUM2=$2 'BEGIN { print  (NUM1 + NUM2) }'`

echo Result is $total.
