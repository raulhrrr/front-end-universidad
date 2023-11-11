DROP DATABASE IF EXISTS final_web_project;

CREATE DATABASE IF NOT EXISTS final_web_project;

USE final_web_project;

CREATE TABLE documents
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    abbreviation VARCHAR(10) NOT NULL,
    name VARCHAR(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE genders
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE roles
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE users
(
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(50) NOT NULL,
    lastname varchar(50) NULL,
    address varchar(100) NOT NULL,
    phone varchar(15) NOT NULL,
    age TINYINT NOT NULL,
    email varchar(100) UNIQUE NOT NULL,
    gender_id int NOT NULL,
    document_id int NOT NULL,
    document_number varchar(20) NOT NULL,
    role_id int NOT NULL,
    `user` varchar(20) UNIQUE NOT NULL,
    password varchar(128) NOT NULL,
    FOREIGN KEY (document_id) REFERENCES documents (id),
    FOREIGN KEY (gender_id) REFERENCES genders (id),
    FOREIGN KEY (role_id) REFERENCES roles (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE products
(
    id int AUTO_INCREMENT PRIMARY KEY,
    supplier_id int NOT NULL,
    name varchar(50) NOT NULL,
    price decimal(18, 2) NOT NULL,
    quantity int NOT NULL,
    FOREIGN KEY (supplier_id) REFERENCES users (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE orders
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    product_id INT NOT NULL,
    contact_number INT(15) NOT NULL,
    shipping_address VARCHAR(100) NOT NULL,
    products_quantity INT NOT NULL,
    total DECIMAL(12, 2) NOT NULL,
    applied_discount TINYINT NOT NULL DEFAULT (0),
    datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (client_id) REFERENCES users (id),
    FOREIGN KEY (product_id) REFERENCES products (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO documents (id, abbreviation, name)
VALUES (1, 'CC', 'Cédula de Ciudadanía'),
       (2, 'CE', 'Cédula de Extranjería'),
       (3, 'NIT', 'Número de Identificación Tributaria');

INSERT INTO genders (id, name)
VALUES (1, 'Masculino'),
       (2, 'Femenino'),
       (3, 'Otro');

INSERT INTO roles (id, name)
VALUES (1, 'Cliente'),
       (2, 'Proveedor'),
       (3, 'Administrador');

INSERT INTO users
(name, lastname, address, phone, age, email, gender_id, document_id, document_number, role_id, `user`, password)
VALUES('Mauricio', 'Velandia', 'Cll 55 #34 - 12 Sur', '321654987', 34, 'mauricio.velandia@mail.com', 1, 1, 123456789, 2, 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec');

INSERT INTO 
    products (supplier_id, name, price, quantity)
VALUES 
    (1, 'Mouse', 15000, 10),
    (1, 'Teclado', 30000, 5),
    (1, 'Monitor', 500000, 2),
    (1, 'Parlantes', 100000, 3),
    (1, 'Cámara', 200000, 1),
    (1, 'Impresora', 250000, 1),
    (1, 'Memoria USB', 50000, 10),
    (1, 'Disco Duro', 200000, 5),
    (1, 'Memoria RAM', 150000, 5),
    (1, 'Procesador', 500000, 2),
    (1, 'Tarjeta de Video', 500000, 2),
    (1, 'Tarjeta de Sonido', 50000, 5),
    (1, 'Tarjeta de Red', 50000, 5),
    (1, 'Tarjeta Madre', 500000, 2),
    (1, 'Fuente de Poder', 50000, 5),
    (1, 'Gabinete', 50000, 5),
    (1, 'Ventilador', 50000, 5),
    (1, 'Cable HDMI', 50000, 5),
    (1, 'Cable VGA', 50000, 5),
    (1, 'Cable USB', 50000, 5),
    (1, 'Cable de Red', 50000, 5),
    (1, 'Cable de Poder', 50000, 5),
    (1, 'Cable de Audio', 50000, 5),
    (1, 'Cable de Video', 50000, 5),
    (1, 'Cable de Teléfono', 50000, 5),
    (1, 'Cable de Energía', 50000, 5),
    (1, 'Cable de Datos', 50000, 5),
    (1, 'Cable de Alimentación', 50000, 5),
    (1, 'Cable de Carga', 50000, 5),
    (1, 'Cable de Red', 50000, 5);

SELECT * FROM users s;

SELECT p.id, p.name, p.price, p.quantity FROM products p INNER JOIN users u ON u.id = p.supplier_id WHERE supplier_id = 4

SELECT count(*) FROM users WHERE user = 'admin' OR email = 'admin@admin.com'