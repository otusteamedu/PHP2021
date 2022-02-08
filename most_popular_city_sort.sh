#!/bin/bash

if [ ! -e "$1" ]
then
  echo "Не удалось найти указанный файл: $1"
  exit 1
fi

awk '(NR>1) {print $3}' $1 | sort | uniq -c | sort -r | awk '(NR<4) {print $2}'