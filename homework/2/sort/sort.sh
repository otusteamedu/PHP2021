#!/bin/bash
awk '{if (NR>1) print $3}' city | sort | uniq -c | sort -d -r | head -n3 # | awk '{print $2}'
