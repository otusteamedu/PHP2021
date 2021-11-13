#!/bin/bash
reg="^[+-]?[0-9]+([.,][0-9]+)?$"
if ! [[ $1 =~ $reg ]]
then
  echo "$1 не число"
fi
if ! [[ $2 =~ $reg ]]
then 
  echo "$2 не число"
else
  echo $1 $2 | awk "{print $1 + $2}"
fi