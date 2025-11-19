-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2025 a las 17:30:34
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
-- Base de datos: `tpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director`
--

CREATE TABLE `director` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `sexo` char(1) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `reputacion` int(11) DEFAULT NULL,
  `pais_origen` varchar(30) NOT NULL,
  `imagen` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `director`
--

INSERT INTO `director` (`id`, `nombre`, `sexo`, `fecha_nacimiento`, `reputacion`, `pais_origen`, `imagen`) VALUES
(1, 'shawn levy', 'm', '1968-07-23', 3, 'canada', 'https://upload.wikimedia.org/wikipedia/commons/4/47/Shawn_Levy_in_Moscow%2C_October_2011.jpg'),
(2, 'andrew adamson', 'm', '1966-12-01', 4, 'nueva zelanda', 'https://m.media-amazon.com/images/M/MV5BNTU1Nzc4NTkyOV5BMl5BanBnXkFtZTcwODc3NjA4OA@@._V1_.jpg'),
(3, 'james cameron', 'm', '1954-08-16', 5, 'canada', 'https://cdn.britannica.com/84/160284-050-695B1DE3/James-Cameron-2012.jpg'),
(4, 'steven spielberg', 'm', '1946-12-18', 5, 'estados unidos', 'https://upload.wikimedia.org/wikipedia/commons/6/67/Steven_Spielberg_by_Gage_Skidmore.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pelicula`
--

CREATE TABLE `pelicula` (
  `id` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `duracion` int(11) NOT NULL,
  `imagen` text NOT NULL,
  `precio` float(6,2) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_lanzamiento` date NOT NULL,
  `atp` tinyint(1) NOT NULL,
  `director_id` int(11) NOT NULL,
  `genero` varchar(30) NOT NULL,
  `distribuidora` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pelicula`
--

INSERT INTO `pelicula` (`id`, `titulo`, `duracion`, `imagen`, `precio`, `descripcion`, `fecha_lanzamiento`, `atp`, `director_id`, `genero`, `distribuidora`) VALUES
(1, 'tiburon', 120, 'https://www.lascosasquenoshacenfelices.com/wp-content/uploads/2025/06/Tiburon-las-cosas-felices.01-e1749284997448.jpg', 120.00, 'Un gigantesco tiburón blanco amenaza a los habitantes y turistas de un pueblo costero. El alcalde encomienda la caza del escualo al jefe de la policía, un pescador y un científico. El grupo se da cuenta de que es un animal inteligente y violento.', '1975-06-20', 0, 4, 'terror', 'universal pictures'),
(2, 'jurassic park', 120, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjMRJwsLgcUJX7OuNQ7vlto88pnsTmXUnARU3q8TXu53FtESU47rXbIc_772jRZMJT9409K1NvZyQF9WiO9LAOmcGGChFrsswYKILgiOxTGw', 200.00, 'Tres expertos y otras personas son invitados a un parque de diversiones, donde se encuentran dinosaurios creados en base al ADN.', '1993-06-11', 1, 4, 'terror', 'universal pictures'),
(3, 'e.t. el extraterrestre', 120, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4NDtlwmypxwm_JJXozA5f9Eel75rsr2XWu5MWx8SM_8N01hZFdDkvyEfUVfItWSjTQ2hFjQRMYvS5717FeaCX_tpF1i9BN_TO5npPN4JK9w', 180.00, 'Elliott es un niño de nueve años que se encuentra con un extraterrestre y decide esconderlo en su casa para protegerlo. Contará con la ayuda de su pequeña hermana y su hermano mayor para mantener el secreto y juntos vivirán una aventura inolvidable.', '1982-06-11', 1, 4, 'ciencia ficcion', 'universal pictures'),
(4, 'terminator', 108, 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSsVMuYOj7eYifN6uZjCEkFfqBSOQRqcdvbDjSoBzAMWRQiB6EwYZoDwCJEERPmgNVHuIvBCAv6K0eUQO9tLYt53e8hroLLN3SF5Z3q7tR2', 600.00, 'Un asesino cibernético del futuro es enviado a Los Ángeles para matar a la mujer que procreará a un líder.\r\n', '1984-10-26', 1, 3, 'ciencia ficcion', 'orion pictures');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'webadmin', 'webadmin@gmail.com', '$2y$10$dHAHTDMTyoeNTDvTOXTlO.0JxV/pebIg0DcCZ2te33QMhygGJCdwa');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `director_id` (`director_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pelicula`
--
ALTER TABLE `pelicula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pelicula`
--
ALTER TABLE `pelicula`
  ADD CONSTRAINT `pelicula_ibfk_1` FOREIGN KEY (`director_id`) REFERENCES `director` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
