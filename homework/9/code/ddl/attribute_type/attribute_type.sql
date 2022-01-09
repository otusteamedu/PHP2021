create table if not exists attribute_type (
   id int(11) unsigned auto_increment not null
  ,constraint pk_attribute_type primary key (id)
) engine=InnoDB collate=utf8_general_ci
;

alter table attribute_type add 
  code varchar(128) not null
;

alter table attribute_type add
  name varchar(256) null
;

alter table attribute_type add unique index ix_uq_code (
  code
);
