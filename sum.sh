#!/bin/bash

reg='^[+-]?[0-9]+([.][0-9]+)?$'

if ! [[ $1 =~ $reg ]]
then
	echo "$1 is not a number"
	exit 1
fi

if ! [[ $2 =~ $reg ]]
then
	echo "$2 is not a number"
	exit 1
fi

sum=$(echo "$1 $2" | awk "{print $1 + $2}");

echo $sum