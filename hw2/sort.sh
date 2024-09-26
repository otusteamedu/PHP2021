#!/bin/bash

if [ ! -f "$1" ]; then
    echo "$1 файл не найден"; exit 1
fi

tail -n +2 $1 | sort  -r -nk4 |awk '{print $3}' |uniq | head -3