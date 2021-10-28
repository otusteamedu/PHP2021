#!/bin/bash

cat ./city.txt | awk '{print $3}' | sort -k1 | uniq -c | sort -rk1 | head -n3 | awk '{print $2}'

exit 0;