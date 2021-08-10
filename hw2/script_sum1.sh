#!/bin/bash

# Коды ошибок
E_BADARGS=65

re='^[+-]?[0-9]+([.][0-9]+)?$'

if [[ $1 ]]; then
var1=$1
else
read -r -p "Введите первое число: " var1
fi

if ! [[ $var1 =~ $re ]]; then
echo "Эта програма работает только с числами."
exit $E_BADARGS
fi

if [[ $2 ]]; then
var2=$2
else
read -p "Введите второе число: " var2
fi

if ! [[ $var2 =~ $re ]]; then
echo "Эта програма работает только с числами."
exit $E_BADARGS
fi

echo "Результат сложения: $(( $var1 + $var2 ))"
