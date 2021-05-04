#!/bin/bash
BC=`dpkg -s bc | grep "Status"`
statusBC="Status: install ok installed"
if [ "$BC" = "$statusBC" ]
then
	regular='^[+-]?[0-9]+\.?[0-9]*$'
	if ! [[ $1 =~ $regular ]] || ! [[ $2 =~ $regular ]]
	then
		echo "error: Укажите правильные аргументы!" >&2
	else
		sum=$(bc<<<"scale=4; $1+$2")
		echo "$1 + $2 = $sum"
	fi
else
	echo "error: Не найден пакет bc" >&2
fi
