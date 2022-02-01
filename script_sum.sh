#!/bin/bash

reg='^([+-]?[0-9]+[.]?[0-9]*)$'

number1="new"
while ! [[ $number1 =~ $reg ]]
do
echo "Введите первое число"

read number1
done

number2="new"
while ! [[ $number2 =~ $reg ]]
do
echo "Введите второе число"

read number2
done


echo "Сумма: "
awk "BEGIN {print $number1+$number2; exit}"
