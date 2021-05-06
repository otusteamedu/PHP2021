#!/bin/bash

#USAGE ./sort.sh FILE_NAME

cat $1 | awk '{print $3}' | sort | uniq -c | sort -r | head -n +3