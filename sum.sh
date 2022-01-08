#!/bin/bash


checkNum1=`echo "$1" | grep -E ^\-?[0-9]*\.?[0-9]+$`

if [ "$checkNum1" = '' ]; then
  echo "error: $1 not a number" >&2;
fi

checkNum2=`echo "$2" | grep -E ^\-?[0-9]*\.?[0-9]+$`

if [ "$checkNum2" = '' ]; then
  echo "error: $2 not a number" >&2;
fi

if [ "$checkNum1" = ''  ] || [ "$checkNum2" = ''  ] ; then
    exit 1
fi

#re='^[0-9]*\.?[0-9]+$'
#if ! [[ $1 =~ $re ]] ; then
#   echo "error: $1 not a number" >&2;
#fi
#if ! [[ $2 =~ $re ]] ; then
#   echo "error: $2 not a number" >&2;
#fi
#
#if ! [[ $1 =~ $re ]] | [[ $2 =~ $re ]] ; then
#    exit 1
#fi

#lst="dc"
#
#for package in $lst
#do
#  cmd=$(dpkg --status $package 2>/dev/null | grep "ok installed")
#  if [ $? != 0 ]
#    then
#
#      echo -n "Для продолжения необходимо уствновить пакет «$package», продолжить? (y/n) "
#      read item
#      case "$item" in
#          y|Y) echo "Вы ввели «y», продолжаем..."
#              echo "Установка пакета «$package»"
#              apt-get update
#              sudo apt-get install $package
#              if [ "$?" = "0" ];
#                  then echo Пакет "«$package»" успешно установлен.
#              fi
#              ;;
#          n|N) echo "Вы ввели «n», завершаем..."
#              exit 0
#              ;;
#          *) echo "Для установки пакета «$package» нужно ввести «y», завершаем.."
#              exit 0
#              ;;
#      esac
#
#
#
#  fi
#done
#
#result=$(echo "Результат: $1 $2 + p" | dc)

result=$(echo "$1 $2" | LC_NUMERIC=C awk -F ' ' '{SUM+=$1+$2}END{print SUM}')
echo "$1+$2=$result"