-- migrate:up

CREATE TABLE users (
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  user	VARCHAR(145) NOT NULL,
  password	VARCHAR(145) NOT NULL,
	last_login	DATETIME NOT NULL,
  worker_id	INT,
  activation_key VARCHAR(25),
  reset_key VARCHAR(25),
  FOREIGN KEY(`worker_id`) REFERENCES workers ( id ) ON DELETE CASCADE
);

-- migrate:down

DROP TABLE IF EXISTS users;