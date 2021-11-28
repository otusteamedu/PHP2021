#!/bin/bash

regexp='^[+-]?[0-9]+([.][0-9]+)?$'

if [[ $# -lt 2 ]]
then
	echo "enter two arguments"
	exit 1
fi

if ! [[ $1 =~ $regexp ]] || ! [[ $2 =~ $regexp ]]
then
	echo "one of the arguments is not a number"
	exit 1
fi

awk -v a=$1 -v b=$2 'BEGIN {print (a + b)}'