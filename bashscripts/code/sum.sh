#!/bin/ash

ARGS=2
E_BADARGS=65

if [ $# -ne "$ARGS" ]
then
  echo "Порядок использования: `basename $0` первое-число второе-число"
  exit $E_BADARGS
fi

checknumber(){
    
    if ! [[ $1 =~ ^[+-]?[0-9]+([.][0-9]+)?$ ]] ; then
    #^[[:digit:].e+-]+$
    echo "Ошибка:" $1 "не является числом" >&2; exit 1
  fi
}

checknumber $1
checknumber $2

echo -n "Сумма чисел $1 и $2 = " 
awk "BEGIN {print $1+$2; exit}"
