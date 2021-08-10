#!/bin/bash

# Коды ошибок
E_BADARGS=65

echo "О... Ты кто?!"
echo "Тебя как зовут?"
read freand
echo "Ну привет $freand !! А я умею числа складывать..."
echo "Давай число!"
read var1
re='^[+-]?[0-9]+([.][0-9]+)?$'
if ! [[ $var1 =~ $re ]];
then
echo "Я же число просил... :( Я не играю."
exit $E_BADARGS
fi

echo "Давай еще одно число!"
read var2
if ! [[ $var2 =~ $re ]];
then
echo "Я же число просил... :( Я не играю."
exit $E_BADARGS
fi

echo "Лови сумму: "
echo $(( $var1 + $var2 ))
