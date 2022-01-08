create table if not exists film_attribute_value (
   id int(11) unsigned auto_increment not null
  ,constraint pk_film_attribute_value primary key (id)
) engine=InnoDB collate=utf8_general_ci
;

alter table film_attribute_value add
  film_id int(11) unsigned not null
;

alter table film_attribute_value add
  attribute_id int(11) unsigned not null
;

alter table film_attribute_value add
  attribute_value_id int(11) unsigned not null
;

alter table film_attribute_value add unique index ix_uq_link (
   film_id
  ,attribute_id
  ,attribute_value_id
);

alter table film_attribute_value add index ix_attribute_with_value (
   attribute_id
  ,attribute_value_id
);

alter table film_attribute_value add index ix_fk_attribute_value_id (
  attribute_value_id
);
