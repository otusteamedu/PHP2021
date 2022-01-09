create table if not exists attribute_value (
   id int(11) unsigned auto_increment not null
  ,constraint pk_attribute_value primary key (id)
) engine=InnoDB collate=utf8_general_ci
;

alter table attribute_value add
  string_value varchar(255) null
;

alter table attribute_value add
  text_value mediumtext null
;

alter table attribute_value add
  float_value decimal(16, 2) null
;

alter table attribute_value add index ix_string_value (
  string_value
);
