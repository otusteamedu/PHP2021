#!/bin/bash
regular='^[+-]?[0-9]+\.?[0-9]*$'
if [[ $1 =~ $regular ]] && [[ $2 =~ $regular ]]
then
	awk "BEGIN { print $1, \" + \", $2, \" = \", $1+$2 }"
else
	echo "error: Укажите правильные аргументы!" >&2
fi
