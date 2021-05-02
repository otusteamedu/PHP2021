#!/bin/bash

if [[ $1 =~ ^[+-]?[0-9]+([.][0-9]+)?$ ]] && [[ $2 =~ ^[+-]?[0-9]+([.][0-9]+)?$ ]] 2>/dev/null; then
  awk "BEGIN {print $1+$2}"
else
  echo input data was not valid
fi
