#!/bin/bash

cat users.txt | awk '(NR>1) {print $3}' \
  | sort \
  | uniq -c \
  | sort -r \
  | awk '(NR<4) {print $2}'
