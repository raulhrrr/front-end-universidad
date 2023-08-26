CREATE DATABASE IF NOT EXISTS activities;

USE activities;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-08-2023 a las 04:27:13
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `formulario-web`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuario`
--

CREATE TABLE `datos_usuario` (
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL,
  `age` tinyint NOT NULL,
  `interests` varchar(100) NOT NULL,
  `message` varchar(200) NOT NULL,
  `id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_usuario`
--
ALTER TABLE `datos_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `datos_usuario`
--
ALTER TABLE `datos_usuario`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO datos_usuario (name, lastname, user, password, email, gender, country, age, interests, message) VALUES
('John', 'Doe', 'john123', 'pass123', 'john@example.com', 'Male', 'United States', 30, 'Sports, Music', 'Hello, this is John!'),
('Jane', 'Smith', 'jane456', 'pwd456', 'jane@example.com', 'Female', 'Canada', 25, 'Reading, Travel', 'Hi, this is Jane!'),
('Michael', 'Johnson', 'michael789', '12345', 'michael@example.com', 'Male', 'United Kingdom', 28, 'Movies, Cooking', 'Hey, this is Michael!'),
('Emily', 'Williams', 'emily22', 'pswd22', 'emily@example.com', 'Female', 'Australia', 22, 'Photography, Hiking', 'Hi there, this is Emily!'),
('William', 'Brown', 'will84', 'passw0rd', 'will@example.com', 'Male', 'New Zealand', 32, 'Gaming, Technology', 'Hello from William!'),
('Sophia', 'Jones', 'sophia11', 'pwd11', 'sophia@example.com', 'Female', 'France', 27, 'Art, Fashion', 'Greetings, this is Sophia!'),
('Daniel', 'Garcia', 'daniel99', '45678', 'daniel@example.com', 'Male', 'Spain', 29, 'Music, Dancing', 'Hello, this is Daniel!'),
('Olivia', 'Martinez', 'olivia75', 'pwd75', 'olivia@example.com', 'Female', 'Mexico', 23, 'Cooking, Sports', 'Hi, its Olivia!'),
('James', 'Rodriguez', 'james66', 'pass66', 'james@example.com', 'Male', 'Colombia', 26, 'Soccer, Travel', 'Hello from James!'),
('Isabella', 'Lopez', 'isabella88', '123pass', 'isabella@example.com', 'Female', 'Brazil', 31, 'Movies, Music', 'Hi there, this is Isabella!');
