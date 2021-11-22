#!/bin/bash

if ! [[ "$1" =~ ^-?[0-9]+(\.[0-9]+)?$ ]]; then
  1>&2 echo "First argument is not number"
  exit 1
fi

if ! [[ "$2" =~ ^-?[0-9]+(\.[0-9]+)?$ ]]; then
  1>&2 echo "Second argument is not number"
  exit 1
fi

awk 'BEGIN { print ARGV[1] + ARGV[2] }' "$1" "$2"
exit
