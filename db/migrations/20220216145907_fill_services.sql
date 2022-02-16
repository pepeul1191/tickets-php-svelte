-- migrate:up

INSERT INTO services (name, url) VALUES 
  ('Asesoría', 'uploads/iew35CBSWAZNzPR9d4aK.png'),
  ('Diseño', 'uploads/6TbJUZna30pVwWxLd8Yz.png'),
  ('Instalación', 'uploads/OwedcyLQ4zHkDsKNjFmY.png'),
  ('Supervisión', 'uploads/bfaFiITMW7G85PAQmUL9.png'),
  ('Remodelación', 'uploads/mpf62FvdlGjkaWVRDQsL.png'),
  ('Diseño de Mobiliario', 'uploads/Hhpa3XLcCeZsPqOu7AJI.png'),
  ('Obra Civil', 'uploads/4vftgWOX0LZJ72QmFelh.png'),
  ('Presupuestos', 'uploads/dsFR7D8KLfvn5jOZJUpl.png');


-- migrate:down

TRUNCATE services;