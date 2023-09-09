CREATE DATABASE IF NOT EXISTS parcial;

USE parcial;

CREATE TABLE `usuarios` (
  `id` int(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` tinyint NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `ordenes` (
  `id` int(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `fecha` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE `platillos` (
  `id` int(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(12, 2) NOT NULL,
  `description` varchar(250) NOT NULL,
  `path` varchar(100) NOT NULL
)

CREATE TABLE `ordenes_platillos` (
  `id` int(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `orden_id` int(10) NOT NULL,
  `platillo_id` int(10) NOT NULL,
  FOREIGN KEY (`orden_id`) REFERENCES `ordenes` (`id`),
  FOREIGN KEY (`platillo_id`) REFERENCES `platillos` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;


INSERT INTO
  `platillos`
VALUES
  (1, "Fusce dictum finibus", 35000, "Nam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus accumsan", "images/gallery/01.jpg"),
  (2, "Aliquam sagittis", 30000, "Nam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus accumsan", "images/gallery/02.jpg"),
  (3, "Sed varius turpis", 25000, "Nam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus accumsan", "images/gallery/03.jpg"),
  (4, "Aliquam sagittis", 40000, "Nam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus accumsan", "images/gallery/04.jpg"),
  (5, "Maecenas eget justo", 15000, "Nam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus accumsan", "images/gallery/05.jpg"),
  (6, "Quisque et felis eros", 45000, "Nam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus accumsan", "images/gallery/06.jpg"),
  (7, "Sed ultricies dui", 40000, "Nam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus accumsan", "images/gallery/07.jpg"),
  (8, "Donec porta consequat", 35000, "Nam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus accumsan", "images/gallery/08.jpg"),
  (9, "Donec porta consequat", 15000, "Nam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus accumsan", "images/gallery/09.jpg"),
  (10, "Donec porta consequat", 25000, "Nam in suscipit nisi, sit amet consectetur metus. Ut sit amet tellus accumsan", "images/gallery/10.jpg");