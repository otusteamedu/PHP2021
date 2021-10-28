#!/bin/bash

validateNumber() {
  local value=$1

  local pattern='([0-9|/.{1}]{1,})'
  if ! [[ "$value" =~ $pattern ]] ; then
     echo "Параметр $value не является числом"
     exit 1
  fi
}

parseParam() {
  local value=$1

  local pattern='^([-{0,1)|0-9|.{0,1}]{1,})(.{1})([-{0,1)|0-9|.{0,1}]{1,})$'
  [[ $value =~ $pattern ]]

  first=${BASH_REMATCH[1]}
  second=${BASH_REMATCH[3]}
  operation=${BASH_REMATCH[2]};
}

operationSum() {
  local result=`echo - | awk "{print $1 + $2}"`

  echo "Сумма чисел: $result"
}

operationDifference() {
  local result=`echo - | awk "{print $1 - $2}"`

  echo "Разность чисел: $result"
}

operationMultiplication() {
  local result=`echo - | awk "{print $1 * $2}"`

  echo "Прозведение чисел: $result"
}

operationDivision() {
  local result=`echo - | awk "{print $1 / $2}"`

  echo "Частное чисел: $result"
}

parseParam $1

validateNumber $first
validateNumber $second

case $operation in
  '+')
    operationSum $first $second
  ;;
  '-')
    operationDifference $first $second
  ;;
  '*')
    operationMultiplication $first $second
  ;;
  '/')
    operationDivision $first $second
  ;;
  *)
    echo 'Тип операции не задан'
    exit 1
  ;;
esac

exit 0