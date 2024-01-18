FROM postgres:latest

COPY ./db_dump/super_hero_storage.dump /var/lib/postgresql/dump/super_hero_storage.dump

CMD psql super_hero_storage < /var/lib/postgresql/dump/super_hero_storage.dump