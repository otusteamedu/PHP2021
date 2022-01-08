create table if not exists attribute_value (
   id int(11) unsigned auto_increment not null
  ,constraint pk_attribute_value primary key (id)
) engine=InnoDB collate=utf8_general_ci
;

alter table attribute_value add
  value varchar(255) not null
;

alter table attribute_value add unique index ix_uq_value (
  value
);
