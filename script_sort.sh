#!/bin/bash

tail -n +2 data.txt | 
awk -F" " '{print $3}' | 
sort | 
uniq -c | 
sort -r | 
awk -F" " '{print $2}' | 
head -n 3
