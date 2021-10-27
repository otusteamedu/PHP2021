#!/bin/bash
table_name='table_cities.txt'

#пропускаем первую строку NR>1
cat $table_name | awk '(NR>1) {print $3}' \
  | sort \
  | uniq -c \
  | sort -r \
  