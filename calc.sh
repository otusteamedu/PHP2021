#!/bin/bash
ARGS=2
E_BADARGS=65

if [ $# -ne "$ARGS" ]
then
  echo "Ошибка. Не корректные входные данные. Пример ввода: `basename $0` первое_число второе_число"
  exit $E_BADARGS
fi

check_num()
{
  if ! [[ $1 =~ ^[+-]?[0-9]+([.][0-9]+)?$ ]] ; then
    echo "Ошибка." $1 " не номер" >&2; exit 1
  fi
}

check_num $1
check_num $2
echo "Результат:"
awk "BEGIN {print $1+$2; exit}"

