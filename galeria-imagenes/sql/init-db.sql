DROP DATABASE IF EXISTS activities;

CREATE DATABASE IF NOT EXISTS activities;

USE activities;

CREATE TABLE documents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  abbreviation VARCHAR(10) NOT NULL,
  name VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE genders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  lastname VARCHAR(50) NOT NULL,
  document_id INT NOT NULL,
  phone_number INT(15) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  address VARCHAR(100) NOT NULL,
  age tinyint NOT NULL,
  gender_id INT NOT NULL,
  country VARCHAR(100) NOT NULL,
  user VARCHAR(20) UNIQUE NOT NULL,
  password VARCHAR(128) NOT NULL,
  FOREIGN KEY (document_id) REFERENCES documents(id),
  FOREIGN KEY (gender_id) REFERENCES genders(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(12, 2) NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    discount TINYINT DEFAULT(0),
    amount INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  car_id INT NOT NULL,
  contact_number INT(15) NOT NULL,
  shipping_address VARCHAR(100) NOT NULL,
  cars_quantity INT NOT NULL,
  total DECIMAL(12, 2) NOT NULL,
  applied_discount TINYINT NOT NULL,
  datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (car_id) REFERENCES cars(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO documents
(id, abbreviation, name)
VALUES
(1, "CC", "Cédula de ciudadanía"),
(2, "CE", "Cédula de extrangería"),
(3, "NIT", "Número de Identificación Tributaria");

INSERT INTO genders
(id, name)
VALUES
(1, "Masculino"),
(2, "Femenino"),
(3, "Otro");

INSERT INTO cars
(name, description, price, file_name, discount, amount)
VALUES
('Carro 1', 'Descripción del vehiculo 1', 20000.12, '1.jfif', 0, 5),
('Carro 2', 'Descripción del vehiculo 2', 15000, '2.jfif', 10, 3),
('Carro 3', 'Descripción del vehiculo 3', 10000, '3.jfif', 0, 2),
('Carro 4', 'Descripción del vehiculo 4', 8000, '4.jpg', 0, 10),
('Carro 5', 'Descripción del vehiculo 5', 25000, '5.jpg', 10, 20),
('Carro 6', 'Descripción del vehiculo 6', 80000, '6.jpg', 20, 4),
('Carro 7', 'Descripción del vehiculo 7', 50000, '7.jpg', 0, 1),
('Carro 8', 'Descripción del vehiculo 8', 11000, '8.jpg', 0, 1),
('Carro 9', 'Descripción del vehiculo 9', 23000, '9.jpg', 0, 0),
('Carro 10', 'Descripción del vehiculo 10', 5500.15, '10.jpg', 0, 2),
('Carro 11', 'Descripción del vehiculo 11', 9500, '11.jpg', 0, 7),
('Carro 12', 'Descripción del vehiculo 12', 45000, '12.jpg', 15, 8),
('Carro 13', 'Descripción del vehiculo 13', 3500.1834, '13.jpg', 15, 7),
('Carro 14', 'Descripción del vehiculo 14', 30000, '14.jpg', 5, 6),
('Carro 15', 'Descripción del vehiculo 15', 32000, '15.jpg', 0, 5);

SELECT
	u.name,
	u.lastname,
	u.email,
	o.shipping_address,
	o.cars_quantity,
	o.total,
	o.applied_discount,
	c.name as car_name,
	c.description,
	c.price
FROM
	users u
INNER JOIN orders o ON
	o.user_id = u.id
INNER JOIN cars c ON
	c.id = o.car_id
WHERE
	u.id = 1;