#!/bin/bash

echo "Input first number"
read number1
check=`echo "$number1" | grep -E ^\-?[0-9\.]+$`
if [ ! $check ]; then
  echo "It's not a number"; exit 1;
fi

echo "Input second number"
read number2
check=`echo "$number2" | grep -E ^\-?[0-9\.]+$`
if [ ! $check ]; then
  echo "It's not a number"; exit 1;
fi

awk "BEGIN {print $number1+$number2; exit}"