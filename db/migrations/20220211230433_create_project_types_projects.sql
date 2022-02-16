-- migrate:up

CREATE TABLE project_types_projects (
	id	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  project_type_id INTEGER NOT NULL,
  project_id INTEGER NOT NULL,
  FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
  FOREIGN KEY (project_type_id) REFERENCES project_types(id) ON DELETE CASCADE
);

-- migrate:down

DROP TABLE IF EXISTS project_types_projects;