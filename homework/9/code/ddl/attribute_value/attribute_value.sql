create table if not exists attribute_value (
   id int(11) unsigned auto_increment not null
  ,constraint pk_attribute_value primary key (id)
) engine=InnoDB collate=utf8_general_ci
;

alter table attribute_value add
  string_value varchar(255) null
;

alter table attribute_value add index ix_string_value (
  string_value
);

alter table attribute_value add index ix_bool_value (
  bool_value
);

alter table attribute_value add index ix_datetime_value (
  datetime_value
);

alter table attribute_value add index ix_int_value (
  int_value
);

alter table attribute_value add index ix_float_value (
  float_value
);
