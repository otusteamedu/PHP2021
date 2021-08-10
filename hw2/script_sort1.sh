#!/bin/bash
# Поиск 3 самых популярных городов в текстовой таблице

# Коды ошибок
E_BADARGS=65
E_NOFILE=66

# Проверяем задан ли файл с данными
if ! [ $1 ]
then
  echo "Порядок использования: `basename $0` filename"
  exit $E_BADARGS
fi

# Проверяем существует ли указанный файл
if [ ! -f "$1" ]
then
  echo "Файл \"$1\" не найден."
  exit $E_NOFILE
fi

# Выполняем основной скрипт
sed -e 's/\.//g'  -e 's/ /\
/g' "$1" | grep -Eow '[A-Z]\w+' | sort | uniq -c | sort -nr | head --lines=3

