select s."Name", count(1) as cnt, sum(ti."Price") as total
from "TicketRealization" ti
         join "Events" e on e."IdEvent" = ti."IdEvent"
         join "Shows" s on s."IdShow" = e."IdShow"
group by s."Name"
order by total desc
LIMIT 1