#!/bin/bash

REGEXP='^[+-]?[0-9]+([.][0-9]+)?$'

if ! [[ $1 =~ $REGEXP ]]
then
  echo "First argument is not a number" >&2; exit 1
fi

if ! [[ $2 =~ $REGEXP ]]
then
  echo "Second argument is not a number" >&2; exit 1
fi

echo "Sum is:"
awk "BEGIN { print $1 + $2; }"