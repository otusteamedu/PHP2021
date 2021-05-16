#!/bin/bash

exp='^[+-]?[0-9]+([.][0-9]+)?$'
function tryNumber {
  if ! [[ $1 =~ $exp ]]; then
    echo "error: $2 arg not a number" >&2
    exit 1
  fi
}

tryNumber "$1" 'First'
tryNumber "$2" 'Second'
echo "$1 $2" | awk '{print $1+$2}'
