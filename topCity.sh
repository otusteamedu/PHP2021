#!/bin/bash
awk 'NR>1 {print$3}' table.txt | sort | uniq -c | sort -rnk1 | head -n 3 | awk '{print$2}'