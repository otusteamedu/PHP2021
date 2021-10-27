#!/bin/bash

filename=$1

res=$(awk '{print $3}' $filename | sort | uniq -c | sort -r | head -n 3)

echo $res