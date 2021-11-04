#!/bin/zsh

if [ ! -f "$1" ]; then
  echo "Файл $1 не найден!"
  exit 1
fi

echo "Result:"

cat $1 | awk '(NR>1) {print $3}' | sort | uniq -c | sort -r | awk '(NR<4) {print $2}'
