#!/bin/bash

tail -n +2 data.txt | sort -k3 | awk '{print $3}' | uniq -c | sort -k1 -r | head -n 3 | awk '{print $2}'
