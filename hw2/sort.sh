#!/bin/bash

if [[ $# -lt 1 ]]
then
	echo "no file name entered"
	exit 1
fi

# looking for the name of a recurring city
town="$(awk '{print $3}' $1 | sort -k3 | uniq -D | head -n1)"

# summing up calls for a recurring city
summ="$(awk -v t=$town '$3 == t {n += $4}; END{print n}' $1)"

echo "three most popular cities are:"
awk -v t=$town -v s=$summ '(NR > 1) && ($3 != t) {print $3, $4}; END{print t, s}' $1 | sort -k2 -n -r | head -n3 | awk '{print $1}'