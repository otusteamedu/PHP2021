#!/bin/bash

tail -n +2 table.txt | awk '{print $3}' | sort | uniq -c | sort -r | head -n 3 | awk '{print $2}'