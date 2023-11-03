DROP DATABASE IF EXISTS login_logout;

CREATE DATABASE IF NOT EXISTS login_logout;

USE login_logout;

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
    `user` varchar(20) UNIQUE NOT NULL,
    password varchar(128) NOT NULL,
    FOREIGN KEY (document_id) REFERENCES documents (id),
    FOREIGN KEY (gender_id) REFERENCES genders (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO documents (id, abbreviation, name)
VALUES (1, 'CC', 'Cédula de Ciudadanía'),
       (2, 'CE', 'Cédula de Extranjería'),
       (3, 'NIT', 'Número de Identificación Tributaria');

INSERT INTO genders (id, name)
VALUES (1, 'Masculino'),
       (2, 'Femenino'),
       (3, 'Otro');
