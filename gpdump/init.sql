CREATE TABLE person (
    id SERIAL PRIMARY KEY,
    name VARCHAR(20) NOT NULL
);

INSERT INTO person (name) VALUES
('William'),
('Marc'),
('John'),
('Alice'),
('Bob');