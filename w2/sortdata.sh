#!/bin/bash

dbfile="database"

if [ -e $dbfile ]; then
    if [ -r $dbfile ]; then
        if [ -s $dbfile ]; then
            if [ -O $dbfile ]; then
                resultSort=$(awk '
                    (NR>1)
                    {print "- count(s) city: " $3 ";"}
                ' $dbfile | sort | uniq -c | sort -r | head -n 3)
                IFS=';'

                for i in $(echo $resultSort | tr ";" "\n")
                do
                  echo $i
                done
            else
                echo "File is not your"
            fi
        else
            echo "File is empty"
        fi
    else
        echo "File is not readable"
    fi
else
    echo "File is not exist"
fi
