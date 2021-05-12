#!/bin/bash
file=$1
awk '{ if (NR > 1) print $3}' "$file" | sort | uniq -c | sort -n -r |head -n 3
exit 0