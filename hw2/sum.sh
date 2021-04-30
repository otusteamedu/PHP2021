#!/bin/bash

function validate_number() {
	if [[ $1 =~ ^[+-]?[0-9]*.?[0-9]+$ ]]; then
		echo 1
		return
	fi

	echo 0
}

if [[ $(validate_number "$1") -eq 0 ]]; then
	echo "First param $1 - is not a number"
	exit 1
fi

if [[ $(validate_number "$2") -eq 0 ]]; then
	echo "Second param $2 - is not a number"
	exit 1
fi

awk "BEGIN{ printf(\"%.15f\n\", $1 + $2) }" | sed 's/,/./'
