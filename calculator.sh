#!/bin/bash

rex='^[+-]?[0-9]+([.][0-9]+)?$'

if [[ $1 =~ $rex ]] && [[ $2 =~ $rex ]]; then
    echo "$1 $2" | awk '{print $1 + $2}'
else
    if ! [[ $1 =~ $rex ]]; then
    echo "Первое значение не является числом"
    fi
    if ! [[ $2 =~ $rex ]]; then
    echo "Второе значение не является числом"
    fi
fi