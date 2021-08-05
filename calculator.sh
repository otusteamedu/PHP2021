#!/bin/bash

checking_the_number () {
rex='^[+-]?[0-9]+([.][0-9]+)?$'
if [[ $1 =~ $rex ]]; then
	i=1
    else
	i=0
    fi
}


number1=$1
number2=$2

checking_the_number $number1
check1=$i
checking_the_number $number2
check2=$i

if [ $check1 == 1 ] && [ $check2 == 1 ]; then
    result=`echo "$number1 $number2" | awk '{print $1 + $2}'`
    echo $result
else
    if [ $check1 == 0 ] && [ $check2 == 1 ]; then
	echo "Первое значение не является числом"
    elif [ $check1 == 1 ] && [ $check2 == 0 ]; then
	echo "Второе значение не является числом"
    else
	echo "Оба значения не являются числами"
    fi
fi