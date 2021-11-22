#!/bin/bash

pat=^-?[0-9\.]+$

if [[ $1 =~ $pat ]] && [[ $2 =~ $pat ]]; then
        awk "BEGIN {printf(\"Sum = %s \n\", $1 + $2 )}"
else
        echo an error occured
fi