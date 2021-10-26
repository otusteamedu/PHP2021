#!/bin/bash

tail -n 5 table | awk '{print ($3)}' | sort | uniq -i -c | sort -k 1 -r | awk '{ if(FNR!=4) print $2; }'