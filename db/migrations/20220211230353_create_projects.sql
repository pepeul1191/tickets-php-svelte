-- migrate:up

CREATE TABLE 'projects' (
	'id'	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  'date'	DATE NOT NULL,
	'name'	VARCHAR(100) NOT NULL,
  'description'	VARCHAR(200) NOT NULL,
  'url'	VARCHAR(60) NOT NULL
);

-- migrate:down

DROP TABLE IF EXISTS 'projects';