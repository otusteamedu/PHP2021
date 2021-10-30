#!/bin/bash
INT1=$1
INT2=$2
I=`dpkg -s bc | grep "Status" ` #проверяем состояние пакета (dpkg) и ищем в выводе его статус (grep)
if [ -n "$I" ] #проверяем что нашли строку со статусом (что строка не пуста)
then
   echo "$INT1 + $INT2 = " #выводим результат
else
   echo "bc not installed, need install it"
   exit 1
fi
INT=$(echo "$INT1 + $INT2" | bc)
re='^-?[0-9]+([.][0-9]+)?'
if ! [[ $1 =~ $re ]] || ! [[ $2 =~ $re ]]; then
   echo "error: Not a number" >&2; exit 1
fi
echo $INT
