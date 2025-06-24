-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2025 a las 04:10:14
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `directorio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrio`
--

CREATE TABLE `barrio` (
  `id_barrio` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `barrio`
--

INSERT INTO `barrio` (`id_barrio`, `nombre`, `estado`) VALUES
(1, 'Agrario', 'Activo'),
(2, 'Alameda', 'Activo'),
(3, 'Antonio Nariño', 'Activo'),
(4, 'Balcones de las Colinas', 'Activo'),
(5, 'Bellavista', 'Activo'),
(6, 'Berlín', 'Activo'),
(7, 'Bolívar', 'Activo'),
(8, 'Botero Obirne', 'Activo'),
(9, 'Brisas del Río', 'Activo'),
(10, 'Bulevar de las Palmas', 'Activo'),
(11, 'Bulevar de las Villas', 'Activo'),
(12, 'Buenos Aires', 'Activo'),
(13, 'Camellón del Quindío', 'Activo'),
(14, 'Camilo Torres', 'Activo'),
(15, 'Caracolí', 'Activo'),
(16, 'Carlos H. Trujillo', 'Activo'),
(17, 'Casierra', 'Activo'),
(18, 'Ciudad Jardín', 'Activo'),
(19, 'Ciudadela Comfandi', 'Activo'),
(20, 'Ciudadela Paz', 'Activo'),
(21, 'Collarejo', 'Activo'),
(22, 'Cooperativo', 'Activo'),
(23, 'Divino Niño', 'Activo'),
(24, 'El Guabal', 'Activo'),
(25, 'El Guadual', 'Activo'),
(26, 'El Jardín', 'Activo'),
(27, 'El Libertador', 'Activo'),
(28, 'El Palatino', 'Activo'),
(29, 'El Paraíso', 'Activo'),
(30, 'El Polo', 'Activo'),
(31, 'El Porvenir', 'Activo'),
(32, 'El Samán', 'Activo'),
(33, 'Empresas Municipales', 'Activo'),
(34, 'Fabio Salazar', 'Activo'),
(35, 'Flor de Damas', 'Activo'),
(36, 'Horizonte', 'Activo'),
(37, 'Jorge Eliécer Gaitán', 'Activo'),
(38, 'Juan XXIII', 'Activo'),
(39, 'Koralyn', 'Activo'),
(40, 'La Arenera', 'Activo'),
(41, 'La Cascada', 'Activo'),
(42, 'La Castellana', 'Activo'),
(43, 'La Cristina', 'Activo'),
(44, 'La Esperanza', 'Activo'),
(45, 'La Floresta', 'Activo'),
(46, 'La Fresneda I Etapa', 'Activo'),
(47, 'La Guaca', 'Activo'),
(48, 'La Libertad', 'Activo'),
(49, 'La Milagrosa', 'Activo'),
(50, 'La Playa', 'Activo'),
(51, 'La Platanera', 'Activo'),
(52, 'La Trinidad', 'Activo'),
(53, 'La Viña', 'Activo'),
(54, 'Las Colinas', 'Activo'),
(55, 'Las Veraneras', 'Activo'),
(56, 'Los Alpez', 'Activo'),
(57, 'Los Chorros', 'Activo'),
(58, 'Los Conquistadores', 'Activo'),
(59, 'Los Naranjos', 'Activo'),
(60, 'Los Pinos', 'Activo'),
(61, 'Los Samanes', 'Activo'),
(62, 'Los Sauces', 'Activo'),
(63, 'Melquisedec Quintero', 'Activo'),
(64, 'Nuestra Señora de la Pobreza', 'Activo'),
(65, 'Ortez', 'Activo'),
(66, 'Pampa Linda', 'Activo'),
(67, 'Portal de Torre La Vega', 'Activo'),
(68, 'Pueblito Paisa', 'Activo'),
(69, 'Quintas de Navarra', 'Activo'),
(70, 'República de Francia', 'Activo'),
(71, 'Rincón de la Loma', 'Activo'),
(72, 'Rincón del Samán', 'Activo'),
(73, 'San Fernando', 'Activo'),
(74, 'San Francisco', 'Activo'),
(75, 'San José', 'Activo'),
(76, 'San Nicolás', 'Activo'),
(77, 'San Vicente', 'Activo'),
(78, 'Suizo', 'Activo'),
(79, 'Torrelavega', 'Activo'),
(80, 'UDETRASPCAR', 'Activo'),
(81, 'Veracruz', 'Activo'),
(82, 'Verona', 'Activo'),
(83, 'Villa del Mar', 'Activo'),
(84, 'Villa Esperanza', 'Activo'),
(85, 'Villa Hermosa', 'Activo'),
(86, 'Villa Luciana', 'Activo'),
(87, 'Villa Marcela', 'Activo'),
(88, 'Villa Mónica', 'Activo'),
(89, 'Villas del Samán', 'Activo'),
(90, 'La Estación', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrio_has_servicio`
--

CREATE TABLE `barrio_has_servicio` (
  `barrio_id_barrio` int(11) NOT NULL,
  `servicio_id_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `estado` varchar(100) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre`, `estado`) VALUES
(1, 'Electricista', 'Activo'),
(2, 'Mecánico', 'Activo'),
(3, 'Carpintero', 'Activo'),
(4, 'Pintor', 'Activo'),
(5, 'Plomero', 'Activo'),
(6, 'Jardinero', 'Activo'),
(7, 'Albañil', 'Activo'),
(8, 'Abogado', 'Activo'),
(9, 'Contador', 'Activo'),
(10, 'Gimnasio', 'Activo'),
(11, 'Estilista', 'Activo'),
(12, 'Masajista', 'Activo'),
(13, 'Arquitecto', 'Activo'),
(14, 'Psicólogo', 'Activo'),
(15, 'Diseñador Gráfico', 'Activo'),
(16, 'Transporte', 'Activo'),
(17, 'Servicio de Limpieza', 'Activo'),
(18, 'Veterinario', 'Activo'),
(19, 'Fotógrafo', 'Activo'),
(20, 'Cocinero', 'Activo'),
(21, 'Diseño Web', 'Activo'),
(22, 'Desarrollador de Software', 'Activo'),
(23, 'Mantenimiento de Computadoras', 'Activo'),
(24, 'Técnico en Electrónica', 'Activo'),
(25, 'Otro', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `usuario_id_usuario_pro` int(11) NOT NULL,
  `usuario_id_usuario_cli` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'Activo',
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Disparadores `chat`
--
DELIMITER $$
CREATE TRIGGER `set_nombre_chat` BEFORE INSERT ON `chat` FOR EACH ROW BEGIN
  DECLARE nombre_proveedor VARCHAR(100);
  DECLARE nombre_cliente VARCHAR(100);
  DECLARE segundos_actuales VARCHAR(2);
  DECLARE milisegundos_actuales VARCHAR(3);

  SELECT nombre INTO nombre_proveedor
  FROM Usuario
  WHERE id_usuario = NEW.usuario_id_usuario_pro;

  SELECT nombre INTO nombre_cliente
  FROM Usuario
  WHERE id_usuario = NEW.usuario_id_usuario_cli;

  SET segundos_actuales = LPAD(SECOND(NOW(3)), 2, '0');
  SET milisegundos_actuales = LPAD(FLOOR(MICROSECOND(NOW(3)) / 1000), 3, '0');

  SET NEW.nombre = CONCAT('Chat de ', nombre_proveedor, ' y ', nombre_cliente, ' | ', segundos_actuales, '.', milisegundos_actuales);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id`, `servicio_id`, `usuario_id`) VALUES
(6, 5, 1),
(94, 12, 10),
(96, 6, 10),
(97, 11, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id_mensaje` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `chat_id_chat` int(11) NOT NULL,
  `usuario_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reviews`
--

CREATE TABLE `reviews` (
  `id_review` int(11) NOT NULL,
  `calificacion` enum('1','2','3','4','5') NOT NULL,
  `comentario` text NOT NULL,
  `fecha` timestamp NULL DEFAULT current_timestamp(),
  `servicio_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `reviews`
--

INSERT INTO `reviews` (`id_review`, `calificacion`, `comentario`, `fecha`, `servicio_id`, `usuario_id`) VALUES
(14, '4', 'Su puta madre', '2025-06-19 22:46:14', 6, 11),
(15, '4', 'Muy buena señor tablos', '2025-06-24 03:46:51', 5, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id_servicio` int(11) NOT NULL,
  `titulo` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(10,0) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id_usuario` int(11) NOT NULL,
  `categoria_id_categoria` int(11) NOT NULL,
  `estado` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Activo',
  `barrio_id` int(11) NOT NULL,
  `direccion` varchar(100) DEFAULT 'No aplica'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `titulo`, `descripcion`, `precio`, `fecha_creacion`, `usuario_id_usuario`, `categoria_id_categoria`, `estado`, `barrio_id`, `direccion`) VALUES
(1, '🎨 Arte pixelado a medida — en 64x64 y 128x128', '¿Necesitás sprites, íconos o gráficos estáticos para tu proyecto? Yo me encargo.\r\nTrabajo con formatos 64x64 y 128x128, ideales para juegos, apps, interfaces o prototipos.\r\n\r\n🧑‍🎨 ¿Qué ofrezco?\r\n\r\nGráficos personalizados, sin animar\r\n\r\nEstilo limpio, visualmente claro y fácil de adaptar\r\n\r\nEntregas en PNG con fondo transparente\r\n\r\nComunicación directa y proceso ágil\r\n\r\n💡 Si tenés una idea pero no sabés cómo bajarla a lo visual, te ayudo a convertirla en algo concreto. También puedo trabajar desde', 12000, '2025-04-24 18:26:12', 2, 15, 'Activo', 1, 'Carrera 9 #4-760'),
(5, 'Lavadora', 'Alquilamos lavadora a los cabrones pobres de mierda, 15 mil pesos minimo', 15000, '2025-04-29 10:44:59', 2, 17, 'Activo', 9, 'Carrera 14 #4-45'),
(6, 'Venta de Camisetas Personalizadas', 'Vendemos camisetas con un mensaje estampado personalizado, matate', 15000, '2025-04-29 10:51:25', 11, 23, 'Activo', 17, 'No aplica'),
(7, 'Proyect nonas', 'Proyecto nonas', 1500, '2025-04-29 10:52:10', 2, 17, 'Activo', 1, 'Carrera 18 #4-27'),
(8, 'Arreglo de computadoras', 'Arreglamos computadoras porque de algo hay que vivir', 2500, '2025-05-19 19:10:03', 3, 23, 'Activo', 10, 'Por ahi'),
(9, 'Destruímos computadores', 'Esta vez es personal', 100000, '2025-06-19 11:45:55', 11, 23, 'Activo', 65, 'Carrera Sisas con 40'),
(10, 'Cosa', 'cosas', 10000, '2025-06-22 21:04:50', 11, 18, 'Activo', 17, 'Carrera 9 #8-10'),
(11, 'OOOO', 'IIIISISAS', 10000, '2025-06-22 21:48:51', 21, 1, 'Activo', 16, 'EEEE'),
(12, 'Test', 'test', 2000, '2025-06-22 22:02:55', 3, 17, 'Activo', 15, 'test');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_imagenes`
--

CREATE TABLE `servicio_imagenes` (
  `id` int(11) NOT NULL,
  `imagen_ref` varchar(200) NOT NULL,
  `servicio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio_imagenes`
--

INSERT INTO `servicio_imagenes` (`id`, `imagen_ref`, `servicio_id`) VALUES
(2, '1745941499-descarga.jpg', 5),
(3, '1745941885-ChatGPT Image 21 abr 2025, 06_48_36.png', 6),
(4, '1745941930-descarga.jpg', 7),
(5, '1745941499-descarga.jpg', 1),
(6, '1745941499-descarga.jpg', 8),
(7, '1745941930-descarga.jpg', 9),
(8, '1745941499-descarga.jpg', 6),
(9, '1750644290-profile-Photoroom.png', 10),
(10, '1750646931-profile-Photoroom.png', 11),
(11, '1750647775-cafe-logo-free.jpg', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_usuario`
--

CREATE TABLE `servicio_usuario` (
  `id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `barrio_usuario` int(11) NOT NULL,
  `direccion_usuario` varchar(100) NOT NULL,
  `metodo_pago` varchar(60) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio_usuario`
--

INSERT INTO `servicio_usuario` (`id`, `servicio_id`, `usuario_id`, `total`, `fecha`, `barrio_usuario`, `direccion_usuario`, `metodo_pago`, `estado`) VALUES
(26, 5, 11, 15000, '2025-06-23 19:09:37', 11, 'CRA 39 No. 22-18', 'pago_directo', 'Cancelado'),
(27, 5, 11, 15000, '2025-06-23 19:12:32', 10, 'CRA 39 No. 22-18', 'tarjeta', 'Cancelado'),
(28, 6, 10, 15000, '2025-06-23 22:41:59', 1, 'CRA 39 No. 22-18', 'pago_directo', 'Realizado'),
(29, 5, 11, 15000, '2025-06-23 22:46:14', 11, 'CRA 39 No. 22-18', 'tarjeta', 'Realizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `rol` varchar(255) DEFAULT 'cliente',
  `foto` varchar(120) DEFAULT NULL,
  `documento` varchar(45) NOT NULL,
  `nacimiento` date NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'Activo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `correo`, `password`, `telefono`, `rol`, `foto`, `documento`, `nacimiento`, `estado`, `created_at`) VALUES
(1, 'Camilo', 'jcvanegas@gmail.com', '123', '3001234567', 'admin', 'default-pfp.webp', '123456789', '1995-04-20', 'Activo', '2025-05-07 14:36:07'),
(2, 'Diana Delgado Delgado', 'didi@gmail.com', '123', '3007654321', 'cliente', 'default-pfp.webp', '987654321', '2007-04-20', 'Activo', '2025-05-07 14:36:07'),
(3, 'VictorNiby', 'nibyminson@gmail.com', '123', '3009876543', 'cliente', 'default-pfp.webp', '456123789', '2005-04-20', 'Activo', '2025-05-07 14:36:07'),
(4, 'Diego Alejandro Valdés', 'bitardos8@gmail.com', '123', '3001122334', 'proveedor', 'default-pfp.webp', '654321987', '2005-04-20', 'Activo', '2025-05-07 14:36:07'),
(8, 'Paco Pedro', 'paco@gmail.com', '123456', '3117160140', 'cliente', '1750014509-profile.jpg', '1113141910', '2000-06-17', 'Activo', '2025-06-15 19:08:29'),
(9, 'Lopez Hernandez', 'lopez@gmail.com', '$2y$10$/QDhTOC8onvsIt2h4D5Hlesu4ZOBEna3mGPXLhcZjKVpgJCh3HTfq', '3118014051', 'cliente', '1750015498-profile.jpg', '1115140197', '2007-01-14', 'Activo', '2025-06-15 19:24:58'),
(10, 'Kevin Lebron James', 'kevin@hotmail.com', '$2y$10$eu7E/colILr2NtWjRBjsaeAdUTfEdHddowxZccpr9/v68lSQjer.W', '3114019871', 'admin', '1750015589-WhatsApp Image 2025-06-11 at 6.jpeg', '1113140918', '2001-09-11', 'Activo', '2025-06-15 19:26:29'),
(11, 'Test Tésting', 'test@gmail.com', '$2y$10$1hPdrX/MNz94MKsa9WnE3.g3Xs7kbT7Szgb8eXTT6b8vaduyq9T4C', '3118019003', 'proveedor', 'default-pfp.webp', '1114150918', '2000-03-11', 'Activo', '2025-06-16 11:21:27'),
(21, 'Testing Test', 'testing@gmail.com', '$2y$10$68ys7WcPgX8VboAI9ikHyefQih/Ym/YOujbvRrNlWvYY5ukU17E.i', '3119018031', 'cliente', '', '11138907625', '2005-02-18', 'Inactivo', '2025-06-23 01:50:12'),
(22, 'test2', 'test2@gmail.com', '$2y$10$edul9D/psnzcCvGumAo4d.71LNKsk08NiOUSZmaoe0yf3opooJaPC', '3160472210', 'cliente', '', '11138907629', '2006-06-16', 'Activo', '2025-06-23 01:57:11'),
(23, 'Carlito Hernandes', 'carlo@gmail.com', '$2y$10$DrQRFsd9gcHQ3X/RioIZKuaXcGPvLxRqr.rJXna.o7gtueTuzKrB6', '3160472210', 'cliente', '', '11138907623', '2006-04-21', 'Inactivo', '2025-06-23 02:54:19'),
(24, 'Pachico Montes', 'pachico@gmail.com', '$2y$10$rENVcGMqNqqI5c8Oob1tGONwgBAvwf/JK28yIJNVFSXCOM85Ov.ZW', '3160472210', 'cliente', '', '1113890768', '2007-04-12', 'Inactivo', '2025-06-23 02:57:20'),
(25, 'Normie Manolo', 'normie@gmail.com', '$2y$10$MF83vTfTLqsogMqeKH6bGu2CV57PfCxYe/BPk1QHREmgf5E7CNEoK', '3160472210', 'cliente', '', '11138907639', '2006-02-10', 'Activo', '2025-06-23 03:00:53');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `barrio`
--
ALTER TABLE `barrio`
  ADD PRIMARY KEY (`id_barrio`);

--
-- Indices de la tabla `barrio_has_servicio`
--
ALTER TABLE `barrio_has_servicio`
  ADD PRIMARY KEY (`barrio_id_barrio`,`servicio_id_servicio`),
  ADD KEY `fk_barrio_has_servicio_servicio1_idx` (`servicio_id_servicio`),
  ADD KEY `fk_barrio_has_servicio_barrio1_idx` (`barrio_id_barrio`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `fk_chat_usuario1_idx` (`usuario_id_usuario_pro`),
  ADD KEY `fk_chat_usuario2_idx` (`usuario_id_usuario_cli`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `servicio_id` (`servicio_id`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `fk_mensaje_chat1_idx` (`chat_id_chat`),
  ADD KEY `fk_mensaje_usuario1_idx` (`usuario_id_usuario`);

--
-- Indices de la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `fk_reseña_servicio1_idx` (`servicio_id`),
  ADD KEY `fk_reseña_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `fk_servicio_usuario_idx` (`usuario_id_usuario`),
  ADD KEY `fk_servicio_categoria1_idx` (`categoria_id_categoria`),
  ADD KEY `fk_servicio_barrio` (`barrio_id`);

--
-- Indices de la tabla `servicio_imagenes`
--
ALTER TABLE `servicio_imagenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicio_id` (`servicio_id`);

--
-- Indices de la tabla `servicio_usuario`
--
ALTER TABLE `servicio_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicio_id` (`servicio_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `barrio` (`barrio_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`),
  ADD UNIQUE KEY `documento_UNIQUE` (`documento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `barrio`
--
ALTER TABLE `barrio`
  MODIFY `id_barrio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `servicio_imagenes`
--
ALTER TABLE `servicio_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `servicio_usuario`
--
ALTER TABLE `servicio_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `barrio_has_servicio`
--
ALTER TABLE `barrio_has_servicio`
  ADD CONSTRAINT `fk_barrio_has_servicio_barrio1` FOREIGN KEY (`barrio_id_barrio`) REFERENCES `barrio` (`id_barrio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barrio_has_servicio_servicio1` FOREIGN KEY (`servicio_id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_chat_usuario1` FOREIGN KEY (`usuario_id_usuario_pro`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chat_usuario2` FOREIGN KEY (`usuario_id_usuario_cli`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id_servicio`);

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `FK_Mensaje_Chat` FOREIGN KEY (`chat_id_chat`) REFERENCES `chat` (`id_chat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Mensaje_Usuario` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mensaje_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reseña_servicio1` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id_servicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reseña_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `fk_servicio_barrio` FOREIGN KEY (`barrio_id`) REFERENCES `barrio` (`id_barrio`),
  ADD CONSTRAINT `fk_servicio_categoria1` FOREIGN KEY (`categoria_id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servicio_usuario` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `servicio_imagenes`
--
ALTER TABLE `servicio_imagenes`
  ADD CONSTRAINT `servicio_imagenes_ibfk_1` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id_servicio`);

--
-- Filtros para la tabla `servicio_usuario`
--
ALTER TABLE `servicio_usuario`
  ADD CONSTRAINT `servicio_usuario_ibfk_1` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id_servicio`),
  ADD CONSTRAINT `servicio_usuario_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `servicio_usuario_ibfk_3` FOREIGN KEY (`barrio_usuario`) REFERENCES `barrio` (`id_barrio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
