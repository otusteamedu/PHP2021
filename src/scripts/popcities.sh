#!/bin/bash

[ $# < 1 ] && echo "Please specify file name" ||
awk 'NR>1 {a[$3]++} END {for (x in a) print a[x], x}' $1 |
sort -k1,1r -k2,2 |
awk 'NR==1 {print "Three most popular cities are:"} NR <=3 {print $2} '
