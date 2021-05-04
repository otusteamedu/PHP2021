#!/bin/bash

awk 'NR>1 { print $3 }' file.txt | sort -f | uniq -c | sort -r | awk '{print $2}' | head -n 3
