-- migrate:up

CREATE VIEW vw_project_types_projects AS
  SELECT PT.id as project_type_id, PT.name as project_type_name, P.id as project_id, P.name as project_name
    FROM projects P
    JOIN project_types_projects PTP ON PTP.project_id= P.id
    JOIN project_types PT ON PTP.project_type_id= PT.id
    LIMIT 2000

-- migrate:down

DROP VIEW IF EXISTS vw_project_types_projects