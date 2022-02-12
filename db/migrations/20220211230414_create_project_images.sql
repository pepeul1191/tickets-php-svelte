-- migrate:up

CREATE TABLE 'project_images' (
	'id'	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  'description'	VARCHAR(150) NOT NULL,
  'url'	VARCHAR(60) NOT NULL,
  'project_id' INTEGER NOT NULL,
  FOREIGN KEY ('project_id') REFERENCES 'projects'('id') ON DELETE CASCADE
);

-- migrate:down

DROP TABLE IF EXISTS 'project_images';