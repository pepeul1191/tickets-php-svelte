CREATE TABLE IF NOT EXISTS "schema_migrations" (version varchar(255) primary key);
CREATE TABLE IF NOT EXISTS 'project_types' (
	'id'	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	'name'	VARCHAR(25) NOT NULL
);
CREATE TABLE sqlite_sequence(name,seq);
-- Dbmate schema migrations
INSERT INTO "schema_migrations" (version) VALUES
  ('20220211210442');
