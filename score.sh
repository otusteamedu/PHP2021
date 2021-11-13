#!/bin/bash
cat $1 | awk '(NR>1) {print $3}' | sort | uniq -i -c | sort -r | awk '(NR<4) {print $2}'