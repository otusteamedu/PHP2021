#!/bin/bash

I=`dpkg -s bc | grep "Status" ` 
installedStatus="Status: install ok installed"

function sum(){
    re='-?[1-9]\d*(\.\d*[1-9]$)?'

    if ! [[ $1 =~ $re && $2 =~ $re ]] ; then
    echo "error: Один из аргументов не является числом" >&2
    else
        echo "Результат сложения:"
        echo $(bc<<<"scale=3;$1+$2")
    fi
}


if [ "$I" = "$installedStatus" ] 
then
    sum $1 $2
else
   echo "[ Идет установка пакета bc ]"

   sudo apt --quiet -y  install bc 1>&1bc.txt  
   rm 1bc.txt

   sum $1 $2
fi




