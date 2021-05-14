#!/bin/bash
tail -n +2 table.txt | awk '{print $3}' | sort|uniq -c | sort -k 1r | awk '{print $2}' | head -3>&2