#!/bin/bash

#Функция, проверяющая является ли аргумент числом
function isNumber {
	if [[ $1 =~ ^\-?[0-9]{1,}(\.[0-9]{1,})?$ ]]
	then
		return 0
	fi
	return 1
}

#Проверка наличия пакета bc
if ! dpkg -l bc &> /dev/null
then
    echo "Please install bc!"
    exit 1
fi

var1=$1
var2=$2

if $(isNumber $var1) && $(isNumber $var2) && [[ ${#} -eq 2 ]]
then
	sum=$(echo "$var1+$var2" |bc)
	echo $sum
	exit 0
else
	echo 'error: wrong data'
	exit 1
fi

