#!/bin/bash

Help()
{
   echo "Takes two numbers and displays their sum."
   echo
   echo "Usage:"
   echo "  sum.sh -h - show this help"
   echo "  sum.sh number1 number2 - calculate the sum of the numbers"
   echo
}

re="^[0-9\.]+$"

if [ -z $1 ] || [ $1 = "-h" ] || [[ ! $1 =~ $re ]] || [[ ! $2 =~ $re ]]
then
   Help
   exit
fi

total=`echo "$1 + $2" | bc`

echo Result is $total.
