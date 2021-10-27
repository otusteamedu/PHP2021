#!/bin/bash

if ! [ $# == 2 ]; then
  echo "Two numeric parameters expected" >&2
  exit 1
fi

function is_number {
  [[ $1 =~ ^[-]?[0-9]*\.?[0-9]+([eE][-+]?[0-9]+)?$ ]]
}

function exit_if_not_number {
  echo "Parameter \"$1\" is not a number" >&2
  exit 1
}

if ! is_number $1; then
  exit_if_not_number $1
fi

if ! is_number $2; then
  exit_if_not_number $2
fi

echo -e "Calculation: $1 + $2 = \c"
awk "BEGIN { print $1 + $2; }"
