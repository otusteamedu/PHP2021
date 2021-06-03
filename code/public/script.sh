#!/bin/bash
re="^-?[0-9]*[.,]?[0-9]+$"
if [[ $1 =~ $re ]]  && [[ $2 =~ $re ]]; then
  echo $1+$2 |bc
  echo $sum
else
  echo "Не целые числа"
fi

