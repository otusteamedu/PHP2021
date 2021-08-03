#!/bin/bash

echo 'Enter the first number: '
read firstNumber

re='^[+-]?[0-9]+([.][0-9]+)?$' # The rule for validation

if ! [[ $firstNumber =~ $re ]]; then
  echo "error: Not a number" >&2; exit 1
fi

echo 'Enter the second number: '
read secondNumber

if ! [[ $secondNumber =~ $re ]]; then
  echo "error: Not a number" >&2; exit 1
fi

echo $firstNumber $secondNumber | awk '{print "The sum is " $1 + $2"."}'
