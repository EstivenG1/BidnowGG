-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-08-2025 a las 02:49:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bidnow`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `producto_id` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_inicial` decimal(12,2) NOT NULL,
  `precio_actual` decimal(12,2) NOT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `nombre`, `descripcion`, `precio_inicial`, `precio_actual`, `fecha_inicio`, `fecha_fin`, `usuario_id`, `estado`, `imagen`) VALUES
(2, 'flor', 'orquidea', 12000.00, 12000.00, '2025-08-17 19:33:26', '2025-08-17 12:39:00', 11, 'activa', '68a21266b5b96.png'),
(3, 'cadenon', 'linda cadena solo vvs no muaisanita', 1000000.00, 1000000.00, '2025-08-17 19:58:37', '2025-08-17 13:20:00', 11, 'activa', '68a2184ddbc45.png'),
(4, 'patek tiffany blue', 'el mas cabron y caro patek', 99999999.99, 99999999.99, '2025-08-17 20:09:27', '2025-08-18 13:09:00', 12, 'activa', '68a21ad76d910.png'),
(5, 'esmeraldita bien cara', 'una pepota de esmralda bien linda', 12000000.00, 15000000.00, '2025-08-17 20:15:18', '2025-08-26 13:18:00', 12, 'activa', '68a21c36731ad.png'),
(6, 'camisetica del tino', 'camiseta del tino en new castle', 500000.00, 900000.00, '2025-08-17 22:26:24', '2025-08-18 15:26:00', 12, 'activa', '68a23af0543c4.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pujas`
--

CREATE TABLE `pujas` (
  `puja_id` int(10) NOT NULL,
  `producto_id` int(10) NOT NULL,
  `usuario_id` int(10) NOT NULL,
  `monto` decimal(12,2) NOT NULL,
  `fecha_puja` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`puja_id`, `producto_id`, `usuario_id`, `monto`, `fecha_puja`) VALUES
(1, 6, 11, 600000.00, '2025-08-17'),
(2, 6, 11, 800000.00, '2025-08-17'),
(3, 5, 11, 13000000.00, '2025-08-17'),
(4, 6, 11, 900000.00, '2025-08-17'),
(5, 5, 12, 15000000.00, '2025-08-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `tipo_usuario` varchar(255) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `email`, `password`, `telefono`, `tipo_usuario`, `fecha_registro`) VALUES
(1, 'sara', 'sar@gmail.com', '123', '70000', 'estandar', '2017-06-25'),
(2, 'cam', 'cmm@g.com', '45', '89999', 'estandar', '0000-00-00'),
(3, 'cam', 'cmm@g.com', '45', '89999', 'estandar', '2017-06-25'),
(4, 'cam', 'cmm@g.com', '45', '89999', 'estandar', '2025-06-17'),
(5, 'sara', 'sar@gmail.com', '444', '70000', 'estandar', '2025-06-17'),
(6, 'sara', 'sar@gmail.com', '1111', '65000', 'estandar', '2025-06-19'),
(7, '???', '3232@k.com', '333', '33333', 'estandar', '2025-06-19'),
(8, 'tt', 'yyyy@1.com', 'gggg', '54345', 'estandar', '2025-06-20'),
(9, 'mt', 'mt09@g.com', '$2y$10$XhR94GQd2mWlgwIXR8Ez.ObWwsCUqp6lTEe8zg411pw3eLbn3MZCy', '223232', 'estandar', '2025-06-20'),
(10, 'gg', 'gg4@6.com', '$2y$10$oTi5Q0L7UcHvzNNroZW.lOHEh8Wko.Gq8oZuNXUrIhcmjDf1/3tQu', '66666', 'estandar', '2025-06-20'),
(11, 'ttt', 't@t.com', '$2y$10$8QHaJXobuN4mAziYOPN/xOeD/rb4pkfdZs2bI8qzSLsXnL1sv0W6S', 'lllll', 'estandar', '2025-06-20'),
(12, 'hola', 'hola@g.co', '$2y$10$BG.t73zDiks2MZE5NhuQVe8cCcZFVJsCPKKKc3D.uYHJvnOvcd8Ku', '9999', 'estandar', '2025-06-21'),
(13, 'h', 'h3@3.com', '$2y$10$SE0srzdrZf51/iewglOaJegn/XhDYethuprsAWdNJVehuZuAEVceS', '333', 'estandar', '2025-06-27');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`producto_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD PRIMARY KEY (`puja_id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `producto_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pujas`
--
ALTER TABLE `pujas`
  MODIFY `puja_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);

--
-- Filtros para la tabla `pujas`
--
ALTER TABLE `pujas`
  ADD CONSTRAINT `pujas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`),
  ADD CONSTRAINT `pujas_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
