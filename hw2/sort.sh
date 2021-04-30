#!/bin/bash

tail -n +2 "$1" | awk '{print $3}' | sort -f | uniq -c -i | sort -k1 -n -r | awk '{print $2}' | head -n 3
