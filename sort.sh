#!/bin/bash

patch="/home/vagrant/code/table.txt"

if [ ! -f "$patch" ]; then
  echo "файла /home/vagrant/code/table.txt нет"
  exit 1
fi

file="$(cat $patch)"
IFS=', ' read -r -a vals <<<$file
line=''

for index in "${!vals[@]}"; do
  def=$(expr $index % 4)
  if [[ "$def" == 2 && "$index" != 2 ]]; then
    line="$line ${vals[index]}"
  fi
done

echo "Три самых популярных города:"
echo $line | tr " " "\\n" | sort | uniq -c | sort -nr | head -n 3
