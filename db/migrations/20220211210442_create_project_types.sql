-- migrate:up

CREATE TABLE 'project_types' (
	'id'	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	'name'	VARCHAR(25) NOT NULL
);

-- migrate:down

DROP TABLE IF EXISTS 'project_types';