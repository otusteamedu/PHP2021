#!/bin/bash
reg='^[+-]?[0-9]+([.][0-9]+)?$'

# Обработка первого числа
echo "Введите первое число"
read number1
while ! [[ $number1 =~ $reg ]]
do
echo "Кого ты обманываешь? Это не число." >&2; 
read number1
done

# Обработка второго числа
echo "Введите второе число"
read number2
while ! [[ $number2 =~ $reg ]]
do
echo "Не отличаешь число от букв? Попробуй еще." >&2; 
read number2
done

# Результат
echo "Результат: "
awk "BEGIN {print $number1+$number2; exit}"
