#!/bin/bash

echo '3 наиболее популярных города среди пользователей системы: '
awk 'NR > 1 { print $3 }' users.txt | sort | uniq -c | sort -k1,1nr -k2,2 | awk '{ print $2 }' | head -n 3

exit 0