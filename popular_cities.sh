#!/bin/bash
file=$1
awk '{ if ($3 != "city") print $3 }' $file | sort | uniq -c | sort -k1 -r | head --lines=3 | awk '{ print $2 }'
