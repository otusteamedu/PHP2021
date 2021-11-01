#!/bin/bash

errorMessage="Error";
regexCheckNumber='^[+-]?([0-9]*[.])?[0-9]+$'

function checkNumber {
    if ! [[ $1 =~ $regexCheckNumber ]]; then
        echo "$errorMessage";
    else
        echo "$1";
    fi
}

function input {
    read -p $1 number

    result=$(checkNumber $number)

    if [ "$result" == "$errorMessage" ]; then
        input $1
    else
        echo $number
    fi
}

echo "Please input integer or fractional number through a dot: "
sleep 1

numberOne=$( input "Enter_first_number:" );
numberTwo=$( input "Enter_second_number:" );

sleep 1

result=`awk "BEGIN {print $numberOne+$numberTwo; exit}"`

echo "Summa - $result"