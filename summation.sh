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

sum=$(bc <<< "$1 + $2")

echo "Сумма равна: $sum"