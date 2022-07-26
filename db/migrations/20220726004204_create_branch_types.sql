-- migrate:up

CREATE TABLE branch_types (
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name	VARCHAR(11) NOT NULL
);

-- migrate:down

DROP TABLE IF EXISTS branch_types;