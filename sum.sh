#!/bin/bash

regex='^[+-]?[0-9]+([,][0-9]+)?$'

if [[ $1 =~ $regex ]]; then
    if [[ $2 =~ $regex ]]; then
        sum=$(echo "$1 $2" | awk '{sum=($1+$2);print sum}')
        echo "сумма=$sum"
    else
        echo "Ошибка: вторая переменная должна быть числом" >&2
    fi
else
    echo "Ошибка: первая переменная должна быть числом" >&2
fi