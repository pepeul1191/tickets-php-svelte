-- migrate:up

CREATE TABLE service_tickets (
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ticket_id	INT,
	FOREIGN KEY(`ticket_id`) REFERENCES tickets ( id ) ON DELETE CASCADE
);

-- migrate:down

DROP TABLE IF EXISTS service_tickets;