-- migrate:up

CREATE TABLE services (
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name	VARCHAR(25) NOT NULL,
  url	VARCHAR(60) NOT NULL
);

-- migrate:down

DROP TABLE IF EXISTS services;