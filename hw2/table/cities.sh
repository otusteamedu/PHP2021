#!/bin/bash

if [ $# -eq 0 ]; then
    echo 'Usage: cities.sh {filename}, where the {filename} is path to file with cities table';
    exit;
fi

awk '{if (NR>1) print $3}' $1 | sort | uniq -c | sort -r | awk '{print $2}'
