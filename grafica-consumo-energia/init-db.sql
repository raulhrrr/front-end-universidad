CREATE DATABASE IF NOT EXISTS public_services;

USE public_services;

CREATE TABLE months (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL
);

CREATE TABLE energy_consumption (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_id INT NOT NULL,
    monthly_consumption_kwh SMALLINT NOT NULL,
    `year` VARCHAR(4) NOT NULL,
    FOREIGN KEY (date_id) REFERENCES months(id)
);

INSERT INTO
    months (id, name)
VALUES
    (1, 'Enero'),
    (2, 'Febrero'),
    (3, 'Marzo'),
    (4, 'Abril'),
    (5, 'Mayo'),
    (6, 'Junio'),
    (7, 'Julio'),
    (8, 'Agosto'),
    (9, 'Septiembre'),
    (10, 'Octubre'),
    (11, 'Noviembre'),
    (12, 'Diciembre');

INSERT INTO
    energy_consumption (date_id, monthly_consumption_kwh, `year`)
VALUES
    (1, 100, '2021'),
    (2, 120, '2021'),
    (3, 125, '2021'),
    (4, 110, '2021'),
    (5, 130, '2021'),
    (6, 140, '2021'),
    (7, 127, '2021'),
    (8, 105, '2021'),
    (9, 160, '2021'),
    (10, 155, '2021'),
    (11, 170, '2021'),
    (12, 140, '2021'),
    (1, 140, '2022'),
    (2, 138, '2022'),
    (3, 105, '2022'),
    (4, 155, '2022'),
    (5, 175, '2022'),
    (6, 160, '2022'),
    (7, 145, '2022'),
    (8, 167, '2022'),
    (9, 148, '2022'),
    (10, 134, '2022'),
    (11, 167, '2022'),
    (12, 150, '2022');
    
SELECT m.name FROM months m;

SELECT ec.monthly_consumption_kwh FROM energy_consumption ec WHERE ec.`year` = '2021' ORDER BY ec.date_id;
SELECT ec.monthly_consumption_kwh FROM energy_consumption ec WHERE ec.`year` = '2022' ORDER BY ec.date_id;