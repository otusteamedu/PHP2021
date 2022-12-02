#!/bin/bash

re='^[+-]?[0-9]+([.][0-9]+)?$'

echo "Введите первре число:"
read N1

if ! [[ $N1 =~ $re ]]; then
  echo "$N1 не число, давай сначала"
  exit
fi

echo "Введите второе число:"
read N2

if ! [[ $N2 =~ $re ]]; then
  echo "$N2 не число, давай сначала"
  exit
fi

echo "Сумма $N1 и $N2 равна:"
awk "BEGIN {print $N1+$N2; exit}"

