#!/bin/bash

numreg='^[-]?[0-9]+([.][0-9]+)?'

if [[ $# != 2 ]] ; then
	echo "error: you must pass two numbers" ; exit 1
fi

if ! [[ $1 =~ $numreg ]] ; then
	echo "error: $1 is not a number" ; exit 1
fi

if ! [[ $2 =~ $numreg ]] ; then
	echo "error: $2 is not a number" ; exit 1
fi

awk "BEGIN { print $1+$2; exit }"
