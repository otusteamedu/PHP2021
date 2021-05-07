#!/bin/bash
function validateNumber {
  check=`echo "$1" | grep -E ^\-?[0-9\.]+$`
  if [ ! $check ]; then
    echo "It's not a number" >&2
    return 1
  fi
  return 0
}

echo "Input first number"
read number1
$(validateNumber $number1) || exit

echo "Input second number"
read number2
$(validateNumber $number2) || exit

awk "BEGIN {print $number1+$number2; exit}"