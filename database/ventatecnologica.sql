-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2022 a las 02:11:02
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
-- Base de datos: `ventatecnologica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(100) NOT NULL,
  `categoria_fk` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `categoria_fk`) VALUES
(1, 'Procesador'),
(2, 'Placa de Video'),
(3, 'Memoria RAM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `id` int(200) NOT NULL,
  `marca_fk` varchar(250) NOT NULL,
  `img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `marca_fk`, `img`) VALUES
(1, 'ASUS', 'https://dlcdnimgs.asus.com/websites/global/Sno/79183.jpg'),
(2, 'MSI', 'https://www.topmacronetworkstore.com/image/topmacro/image/data/Manufacturer/msi.png\r\n'),
(3, 'ASROCK', 'https://fanaticosdelhardware.com/wp-content/uploads/2017/05/asrock-logo.png'),
(4, 'ZOTAC', 'https://www.zotacstore.com/media/logo/stores/1/zotac-store-logo.png'),
(5, 'GALAX', 'https://cdn.wccftech.com/wp-content/uploads/2017/04/GALAX-GTX-1080-TI-HOF-4.png'),
(6, 'GEIL', 'https://www.store.pcimage.com.my/image/shoppcimage/image/data/Manufacturer/geil.png'),
(7, 'ADATA', 'https://logos-world.net/wp-content/uploads/2022/03/ADATA-Logo.png'),
(8, 'KINGSTON', 'https://logos-world.net/wp-content/uploads/2020/11/Kingston-Emblem.png'),
(9, 'PATRIOT', 'https://www.inpower.com.br/Custom/Content/Themes/Shared/Images/Brands/patriot.png'),
(10, 'AMD', 'https://images.hdqwalls.com/download/amd-4k-1w-1280x1024.jpg'),
(11, 'INTEL', 'https://images.hdqwalls.com/wallpapers/intel-brand-logo.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `precio` double NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `categoria_fk` int(11) NOT NULL,
  `marca_fk` int(11) NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `precio`, `nombre`, `categoria_fk`, `marca_fk`, `imagen`) VALUES
(2, 50000, 'RX 570 8GB GDDR5 Phantom Gaming Elite', 2, 3, 'img/634dc96f2847d.jpg'),
(3, 210000, 'GeForce RTX 3080 10GB GDDR6X SG LHR (1-Click OC) ', 2, 5, 'img/634dc9c896ade.jpg'),
(4, 21100, ' DDR4 16GB 3000MHz Super Luce RGB Black', 3, 6, 'img/634dca2ae9341.jpg'),
(5, 31500, 'Ryzen 5 1600 AF Zen+ 12nm AM4 Wraith Stealth Cooler', 1, 1, 'img/634dc8d9f39ad.jpg'),
(25, 20250, 'DDR4 16GB (2x8GB) 3200MHz EVO X II RGB Black', 3, 6, 'img/634dcf822baec.jpg'),
(26, 15850, 'DDR4 16GB 3000MHz EVO POTENZA RED', 3, 6, 'img/634dcfbb1caa2.jpg'),
(27, 41400, 'Core i5 9500 9th Gen LGA1151', 1, 11, 'img/634dcffda09ee.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` text NOT NULL,
  `nombre` text NOT NULL,
  `contrasenia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id_user`, `email`, `nombre`, `contrasenia`) VALUES
(1, 'leo@exactas.com', 'Leonel', '$2a$12$IHRBAhY4n70SgfouyBbGaOjBTqN6Nv4YLLJ84p.55VSP1alQ4JG5.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `marca_fk` (`marca_fk`),
  ADD KEY `categoria_fk` (`categoria_fk`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`marca_fk`) REFERENCES `marca` (`id`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`categoria_fk`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
