CREATE TABLE IF NOT EXISTS "schema_migrations" (version varchar(255) primary key);
CREATE TABLE IF NOT EXISTS 'project_types' (
	'id'	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	'name'	VARCHAR(25) NOT NULL
);
CREATE TABLE sqlite_sequence(name,seq);
CREATE TABLE IF NOT EXISTS 'services' (
	'id'	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	'name'	VARCHAR(25) NOT NULL,
  'url'	VARCHAR(60) NOT NULL
);
CREATE TABLE IF NOT EXISTS 'projects' (
	'id'	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  'date'	DATE NOT NULL,
	'name'	VARCHAR(100) NOT NULL,
  'description'	VARCHAR(200) NOT NULL,
  'url'	VARCHAR(60) NOT NULL
);
CREATE TABLE IF NOT EXISTS 'project_images' (
	'id'	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  'description'	VARCHAR(150) NOT NULL,
  'url'	VARCHAR(60) NOT NULL,
  'project_id' INTEGER NOT NULL,
  FOREIGN KEY ('project_id') REFERENCES 'projects'('id') ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS 'project_types_projects' (
	'id'	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  'project_type_id' INTEGER NOT NULL,
  'project_id' INTEGER NOT NULL,
  FOREIGN KEY ('project_id') REFERENCES 'projects'('id') ON DELETE CASCADE,
  FOREIGN KEY ('project_type_id') REFERENCES 'project_types'('id') ON DELETE CASCADE
);
CREATE VIEW vw_project_types_projects AS
  SELECT PT.id as project_type_id, PT.name as project_type_name, P.id as project_id, PT.name as project_name
    FROM projects P
    JOIN project_types_projects PTP ON PTP.project_id= P.id
    JOIN project_types PT ON PTP.project_type_id= PT.id
    LIMIT 2000
/* vw_project_types_projects(project_type_id,project_type_name,project_id,project_name) */;
-- Dbmate schema migrations
INSERT INTO "schema_migrations" (version) VALUES
  ('20220211210442'),
  ('20220211212904'),
  ('20220211230353'),
  ('20220211230414'),
  ('20220211230433'),
  ('20220212150347');
