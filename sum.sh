#!/bin/bash

re='^[0-9]*\.?[0-9]+$'
if ! [[ $1 =~ $re ]] ; then
   echo "error: $1 not a number" >&2;
fi
if ! [[ $2 =~ $re ]] ; then
   echo "error: $2 not a number" >&2;
fi

if ! [[ $1 =~ $re ]] | [[ $2 =~ $re ]] ; then
    exit 1
fi

lst="dc"

for package in $lst
do
  cmd=$(dpkg --status $package 2>/dev/null | grep "ok installed")
  if [ $? != 0 ]
    then

      echo -n "Для продолжения необходимо уствновить пакет «$package», продолжить? (y/n) "
      read item
      case "$item" in
          y|Y) echo "Вы ввели «y», продолжаем..."
              echo "Установка пакета «$package»"
              apt-get update
              sudo apt-get install $package
              if [ "$?" = "0" ];
                  then echo Пакет "«$package»" успешно установлен.
              fi
              ;;
          n|N) echo "Вы ввели «n», завершаем..."
              exit 0
              ;;
          *) echo "Для установки пакета «$package» нужно ввести «y», завершаем.."
              exit 0
              ;;
      esac



  fi
done

result=$(echo "Результат: $1 $2 + p" | dc)
echo "$1+$2=$result"