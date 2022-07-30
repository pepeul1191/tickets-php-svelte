-- migrate:up

ALTER TABLE users MODIFY last_login DATETIME NULL;

-- migrate:down

-- ALTER TABLE users MODIFY last_login DATETIME NOT NULL;
