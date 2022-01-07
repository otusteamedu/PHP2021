insert into "films"("id","name","description","duration")
select
    gs.id,
    random_string((1 + random()*10)::integer),
    random_string((1 + random()*100)::integer),
    (random()*60)::integer
from generate_series(1,10000000) as gs(id);

insert into "attribute_type"("id","name")
select
    gs.id,
    random_string((1 + random()*20)::integer)
from generate_series(1,10000000) as gs(id);

insert into "attribute"("id","name","attribute_type")
select
    gs.id,
    random_string((1 + random()*20)::integer), random() * 9 + 1
from generate_series(1,10000000) as gs(id);

insert into "attribute_value"("id","int","float","text","datetime","bool","film","atribute")
select
    gs.id,
    random() * 100,
    random()*(100-1)+1,
    random_string((1 + random()*100)::integer),
    timestamp '2021-01-01 00:00:00' + random() * (timestamp '2021-01-01 00:00:00' - timestamp '2021-12-31 23:59:59'),
    random() > 0.5,
    random() * 9 + 1,
    random() * 29 + 1
from generate_series(1,10000000) as gs(id);

insert into "halls"("id","name","description","seats","rows","places")
select
    gs.id,
    random_string((1 + random()*30)::integer),
    random_string((1 + random()*300)::integer),
    random()*10,
    random()*20,
    random()+100
from generate_series(1,10000000) as gs(id);

insert into "session"("id","date","time","hall","film","cost")
select
    gs.id,
    random() * 10000 + 1,
    random() * 1000 + 1,
    random() * 100 + 1,
    random() * 9 + 1,
    random() * 1000 + 1
from generate_series(1,10000000) as gs(id);

insert into "tickets"("id","session","datetime","cost","row","place")
select
    gs.id,
    random() * 100 + 1,
    random() * 100000 + 1,
    random() * 200 + 1,
    random() * 10 + 1,
    random() * 10 + 1
from generate_series(1,10000000) as gs(id);