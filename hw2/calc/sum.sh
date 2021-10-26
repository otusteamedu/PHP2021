#!/bin/bash
if ! (which bc &> /dev/null;) then
    echo 'There is no bc package installed! Please install it!';
    exit;
fi

if [ $# -eq 0 ]; then
    echo 'Usage: sum.sh {first_number} {second_number}, where the {first_number} and the {second_number} are numeric values';
    exit;
fi

if ! [[ $1 =~ ^-*0*[0-9]*\.{0,1}[0-9]*$ ]]; then
    echo 'The first argument must be numeric!';
    exit;
fi

if ! [[ $2 =~ ^-*0*[0-9]*\.{0,1}[0-9]*$ ]]; then
  echo $2;
    echo 'The second argument must be numeric!';
    exit;
fi

echo $1+$2 | bc;
