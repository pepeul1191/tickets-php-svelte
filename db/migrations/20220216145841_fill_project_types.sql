-- migrate:up

INSERT INTO project_types (id, name) VALUES 
  (1, "Cocinas"),
  (2, "Salas Modernas"),
  (3, "Comedores"),
  (4, "Gimnasio");


-- migrate:down

TRUNCATE project_types;