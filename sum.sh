#!/bin/bash
num1=$1
num2=$2
reg='^[+-]?[0-9]+([.][0-9]+)?$'

if ! [[ $num1 =~ $reg ]] ; then 
 echo "Ошибка: введите 1 аргумент правильно" >&2; exit 1
fi

if ! [[ $num2 =~ $reg ]] ; then 
 echo "Ошибка: введите 2 аргумент правильно" >&2; exit 1
fi

echo "Сумма чисел: "
awk "BEGIN {print $num1+$num2; exit}"