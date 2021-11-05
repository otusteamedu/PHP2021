#!/bin/bash


cat $1| cut -d" " -f3 | awk 'FNR>1' | sort | uniq -c | sort -rk1 | head -n 3