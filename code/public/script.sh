#!/bin/bash
re="^[0-9]+$"

if [[ $1 =~ $re ]]  && [[ $2 =~ $re ]]; then
  let sum=$1+$2
  echo $sum
else
  echo "Не целые числа"
fi

