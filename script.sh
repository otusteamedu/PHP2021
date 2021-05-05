#!/bin/bash
touch temporaryfile.txt

while read LINE;
do  echo "$LINE" | awk '{ print $3 }' >> temporaryfile.txt  
done < ./database.txt 


STR="`head temporaryfile.txt | sort | uniq -c | sort -r`"
echo $STR | awk '{print $2"\n"$4"\n"$6}'


rm temporaryfile.txt

