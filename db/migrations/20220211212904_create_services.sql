-- migrate:up

CREATE TABLE 'services' (
	'id'	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	'name'	VARCHAR(25) NOT NULL,
  'url'	VARCHAR(60) NOT NULL
);

-- migrate:down

DROP TABLE IF EXISTS 'services';