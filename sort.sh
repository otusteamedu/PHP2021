#!/bin/bash

awk 'NR>1 { print $3 }' < ./people.txt | sort | uniq -c | sort -nr | head -n 3
exit