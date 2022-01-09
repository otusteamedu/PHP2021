create table if not exists attribute (
   id int(11) unsigned auto_increment not null
  ,constraint pk_attribute primary key (id)
) engine=InnoDB collate=utf8_general_ci
;

alter table attribute add 
  code varchar(128) not null
;

alter table attribute add
  name varchar(256) null
;

alter table attribute add
  attribute_type_id int(11) unsigned not null
;

alter table attribute add unique index ix_uq_code (
  code
);

alter table attribute add unique index ix_fk_attribute_type_id (
  attribute_type_id
);
