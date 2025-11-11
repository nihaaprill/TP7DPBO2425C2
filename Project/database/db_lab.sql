CREATE DATABASE db_lab;
USE db_lab;

CREATE TABLE item (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    type VARCHAR(50),
    stock INT
);

CREATE TABLE student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    major VARCHAR(50)
);

CREATE TABLE loan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_item INT,
    id_student INT,
    loan_date DATE,
    FOREIGN KEY (id_item) REFERENCES item(id),
    FOREIGN KEY (id_student) REFERENCES student(id)
);

INSERT INTO item (name, type, stock) VALUES
('Microscope', 'Optical', 5),
('Beaker 250ml', 'Glassware', 20),
('Pipette 10ml', 'Glassware', 30),
('Thermometer', 'Measuring Tool', 10),
('Test Tube Rack', 'Container', 15);

INSERT INTO student (name, major) VALUES
('Nabila Putri', 'Informatics'),
('Rizky Pratama', 'Biology'),
('Siti Aisyah', 'Chemistry'),
('Bima Saputra', 'Physics'),
('Dewi Melati', 'Pharmacy');

INSERT INTO loan (id_item, id_student, loan_date) VALUES
(1, 2, '2025-11-10'),   -- Rizky meminjam Microscope
(3, 1, '2025-11-09'),   -- Nabila meminjam Pipette
(4, 5, '2025-11-08'),   -- Dewi meminjam Thermometer
(2, 3, '2025-11-11');   -- Siti meminjam Beaker
