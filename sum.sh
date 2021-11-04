#!/bin/zsh

regular='^[+-]?[0-9]+([.][0-9]+)?$'
if ! [[ $1 =~ $regular ]]; then
  echo "error: '$1' not a number" >&2
  exit 1
fi

if ! [[ $2 =~ $regular ]]; then
  echo "error: '$2' not a number" >&2
  exit 1
fi

echo "Result:" $(($1 + $2))
