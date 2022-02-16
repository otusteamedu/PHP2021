#!/bin/bash

digitalCheckReg='^[+-]?[0-9]+([.][0-9]+)?$'

if [ $# -lt 2 ]
  then
    echo 'Нужно передать 2 аргумента'
    exit 1
fi

if ! [[ $1 =~ $digitalCheckReg ]]
then
   echo 'Первый агрумент не является числом'
   exit 1
elif ! [[ $2 =~ $digitalCheckReg ]]
then
  echo 'Второй аргумент не является числом'
  exit 1
fi

summation="$(awk -v first="$1" -v second="$2" 'BEGIN{print first+second}')"

echo "Сумма равна: $summation"