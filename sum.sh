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

if ! command -v bc &> /dev/null
then
    echo "Notice: your system doesn't support bc, the script will calculate arguments as integers"
    arg1=`printf "%.0f\n" $1`
    arg2=`printf "%.0f\n" $2`
    sum=$(expr $arg1 + $arg2 )
else
    sum=`echo $1 + $2 | bc`
fi

echo $sum  >&1
