#!/bin/bash

checking_the_number () {
rex='^[+-]?[0-9]+([.][0-9]+)?$'

    if [[ $1 =~ $rex ]]; then
	i=1
    else
	i=0
    fi
}

echo "Введите первое число:"
read number1
verification_number1=0

while ! [ $verification_number1 == 1 ]
do
    checking_the_number $number1
    if [ $i == 1 ]; then
	verification_number1=1
    else 
	verification_number1=0
	echo "Вы не ввели число!"
	echo "Введите число еще раз:"
	read number1
    fi
done


echo "Выберите действие"
echo "1 - сложение"
echo "2 - вычитание"
echo "3 - умножение"
echo "4 - деление"
read action
check_action1=1
check_action2=1

case $action in
1)
    action1=1;;
2)
    action1=2;;
3)
    action1=3;;
4)
    action1=4;;
*)
    check_action1=0
    check_action2=0;;
esac

while ! [ $check_action1 == 1 ]
do
    if [ $check_action2 == 1 ]; then
	check_action1=1
    else
	echo "Вы выбрали неправильное действие"
	echo "Выберите действие еще раз"
	echo "1 - сложение"
	echo "2 - вычитание"
	echo "3 - умножение"
	echo "4 - деление"
	read action

	case $action in
	1)
	    action1=1
	    check_action2=1;;
	2)
	    action1=2
	    check_action2=1;;
	3)
	    action1=3
	    check_action2=1;;
	4)
	    action1=4
	    check_action2=1;;
	*)
	    check_action2=0;;
	esac
    fi
done


echo "Введите второе число:"
read number2
verification_number2=0

while ! [ $verification_number2 == 1 ]
do
    checking_the_number $number2
    if [ $i == 1 ]; then
	verification_number2=1
    else 
	verification_number2=0
	echo "Вы не ввели число!"
	echo "Введите число еще раз:"
	read number2
    fi
done

if [ $action1 == 1 ]; then
    result=`echo "$number1 $number2" | awk '{print $1 + $2}'`
elif [ $action1 == 2 ]; then
    result=`echo "$number1 $number2" | awk '{print $1 - $2}'`
elif [ $action1 == 3 ]; then
    result=`echo "$number1 $number2" | awk '{print $1 * $2}'`
elif [ $action1 == 4 ]; then
    result=`echo "$number1 $number2" | awk '{print $1 / $2}'`
fi

echo "Результат: $result"
