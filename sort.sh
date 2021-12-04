#!/bin/bash

eval sort -k 4 -nr sort.txt | head -n 3 | awk '{print ($3)}'