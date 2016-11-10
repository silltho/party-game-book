DROP TABLE IF EXISTS games_tags;
DROP TABLE IF EXISTS games_materials;
DROP TABLE IF EXISTS games;
DROP TABLE IF EXISTS tags;
DROP TABLE IF EXISTS materials;
DROP TABLE IF EXISTS users;

DROP SEQUENCE IF EXISTS game_id_seq;
DROP SEQUENCE IF EXISTS tag_id_seq;
DROP SEQUENCE IF EXISTS material_id_seq;
DROP SEQUENCE IF EXISTS user_id_seq;

CREATE SEQUENCE game_id_seq START 1;
CREATE SEQUENCE tag_id_seq START 1;
CREATE SEQUENCE material_id_seq START 1;
CREATE SEQUENCE user_id_seq START 1;

CREATE TABLE users (
  id              integer PRIMARY KEY DEFAULT nextval('user_id_seq'),
  oauth_provider  varchar(10),
  oauth_uid       varchar(100),
  username        varchar(100)
);

CREATE TABLE games (
  id          integer PRIMARY KEY DEFAULT nextval('game_id_seq'),
  gamename        varchar(100) NOT NULL,
  description     text NOT NULL,
  recommended_age   integer,
  min_player_count  integer,
  max_player_count  integer,
  average_playtime  integer,
  creation_date   timestamp NOT NULL,
  user_id         integer REFERENCES users (id)
);

CREATE TABLE tags (
  id          integer PRIMARY KEY DEFAULT nextval('tag_id_seq'),
  name        varchar(80) NOT NULL
);

CREATE TABLE games_tags (
  game_id       integer REFERENCES games NOT NULL,
  tag_id        integer REFERENCES tags NOT NULL,
  PRIMARY KEY (game_id, tag_id)
);

CREATE TABLE materials (
  id          integer PRIMARY KEY DEFAULT nextval('material_id_seq'),
  name        varchar(80) NOT NULL
);

CREATE TABLE games_materials (
  game_id       integer REFERENCES games NOT NULL,
  material_id        integer REFERENCES materials NOT NULL,
  PRIMARY KEY (game_id, material_id)
);