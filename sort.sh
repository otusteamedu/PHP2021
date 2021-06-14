#!/bin/bash

file='sort_data.txt'
awk 'NR!=1{ print $3 }' $file | sort | uniq -c | sort -r | head -3
