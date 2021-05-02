#!/bin/bash

awk 'NR>1' "$1" | awk '{print $3}' | sort | uniq -c | sort -r | awk '{print $2}' | head -n 3
