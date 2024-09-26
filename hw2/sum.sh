#!/bin/bash

I=`dpkg -s bc | grep "Status" | grep "installed"`
if [ "$I" ]
then
   echo "bc installed"
else
   echo "bc not installed"
   sudo apt-get install -y bc
fi


is_num()
{
  if ! [[ $1 =~ ^[+-]?[0-9]+([.][0-9]+)?$ ]] ; then
    echo "Аргумент $1 не число" >&2; exit 1
  fi
}

is_num $1;
is_num $2;
sum=$(bc<<<"scale=3;$1+$2");
echo $1 " + " $2 " = " $sum;