-- migrate:up

CREATE TABLE projects (
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  date	DATE NOT NULL,
	name	VARCHAR(100) NOT NULL,
  description	VARCHAR(200) NOT NULL,
  url	VARCHAR(60) NOT NULL
);

-- migrate:down

DROP TABLE IF EXISTS projects;