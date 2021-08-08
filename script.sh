sort city.txt | sort -rnk4 | head -n3 | awk '{print $3}' - если файл без первой текстовой строки "id user city phone"

sort city.txt | head -n-1 | sort -rnk4 | head -n3 | awk '{print $3}' - если файл с первой текстовой строкой "id user city phone"

sort city.txt | head -n-1 | sort -rnk4 | head -n5 | awk '{print $3 | "sort | uniq"}' - это чтобы проверить, что показывает только уникальные города

sort city.txt | head -n-1 | sort -rnk4 | head -n3 | awk '{print $3 | "sort | uniq"}' - окончательный вариант

