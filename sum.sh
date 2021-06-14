#!/bin/bash

if [ "$#" -ne 2 ]; then
    echo "Error: this script expects 2 numbers as arguments" >&2
    exit 2
fi

regex='^[-+]?[0-9]*\.?[0-9]+$'

for arg in "$@"; do
    if ! [[ $arg =~ $regex ]] ; then
       echo "Error: argument with value \"$arg\" is not a number" >&2
       exit 2
    fi
done

sum=`awk "BEGIN {print $1+$2; exit}"`

echo $sum  >&1
