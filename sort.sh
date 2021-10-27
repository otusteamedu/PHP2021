#!/bin/bash
table = $1

if [ ! -f "$table" ]; then
    echo "$table файл не найден!"; exit 1
fi

data=$(cat $table);

IFS=', ' read -r -a array <<< "$data"
formatted_data=''

for index in "${!array[@]}"
do

	el=$(expr $index % 4)
	
	if [[ "$el" == 3 ]]
	then
		formatted_data+="${array[index]}\n"
	else
		formatted_data+="${array[index]} "
	fi
	
done

echo "3 самых популярных города:"

echo -en $formatted_data | awk -F" " '{print $3}' | sort | uniq -c | sort -r | awk -F" " '{print $2}' | head -n 3