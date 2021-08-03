#!/bin/bash
echo "Введите путь до файла:"
read patch

if [ ! -f "$patch" ]; then
    echo "$patch файл не найден!"; exit 1
fi

echo "Результат сортировки городов:"

file="$(cat $patch)";
IFS=', ' read -r -a vals <<< $file
line=''

for index in "${!vals[@]}"
do
    def=$(expr $index % 4)
    if [[ "$def" == 2 &&  "$index" != 2 ]]
    then
       line="$line ${vals[index]}"
    fi
done

echo $line | tr " " "\\n" | sort | uniq -c | sort -nr | head -n 3
