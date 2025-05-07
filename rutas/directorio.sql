-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2025 a las 18:16:00
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
  `fecha_creacion` timestamp NULL DEFAULT NULL,
  `usuario_id_usuario_pro` int(11) NOT NULL,
  `usuario_id_usuario_cli` int(11) NOT NULL,
  `estado` varchar(45) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
-- Estructura de tabla para la tabla `reseña`
--

CREATE TABLE `reseña` (
  `id_reseña` int(11) NOT NULL,
  `calificacion` enum('1','2','3','4','5') NOT NULL,
  `comentario` text NOT NULL,
  `fecha` timestamp NULL DEFAULT NULL,
  `servicio_id_servicio` int(11) NOT NULL,
  `usuario_id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(6, 'Sisas proyect', 'Proyecto\r\n sisas', 2000, '2025-04-29 10:51:25', 4, 23, 'Activo', 17, 'No aplica'),
(7, 'Proyect nonas', 'Proyecto nonas', 1500, '2025-04-29 10:52:10', 2, 17, 'Activo', 1, 'Carrera 18 #4-27');

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
(4, '1745941930-descarga.jpg', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_usuario`
--

CREATE TABLE `servicio_usuario` (
  `id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `estado` varchar(20) DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio_usuario`
--

INSERT INTO `servicio_usuario` (`id`, `servicio_id`, `usuario_id`, `fecha`, `estado`) VALUES
(1, 1, 3, '2025-04-24 20:04:43', 'Pagado'),
(2, 6, 2, '2025-05-07 08:20:34', 'Pagado'),
(3, 6, 3, '2025-05-07 09:24:15', 'Pagado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
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
(1, 'Camilo', 'jcvanegas@gmail.com', '123', '3001234567', 'admin', NULL, '123456789', '1995-04-20', 'Activo', '2025-05-07 14:36:07'),
(2, 'Diana Delgado Delgado', 'didi@gmail.com', '123', '3007654321', 'cliente', NULL, '987654321', '2007-04-20', 'Activo', '2025-05-07 14:36:07'),
(3, 'VictorNiby', 'nibyminson@gmail.com', '123', '3009876543', 'cliente', NULL, '456123789', '2005-04-20', 'Inactivo', '2025-05-07 14:36:07'),
(4, 'Diego Alejandro', 'bitardos8@gmail.com', '123', '3001122334', 'proveedor', NULL, '654321987', '2005-04-20', 'Activo', '2025-05-07 14:36:07');

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
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `fk_mensaje_chat1_idx` (`chat_id_chat`),
  ADD KEY `fk_mensaje_usuario1_idx` (`usuario_id_usuario`);

--
-- Indices de la tabla `reseña`
--
ALTER TABLE `reseña`
  ADD PRIMARY KEY (`id_reseña`),
  ADD KEY `fk_reseña_servicio1_idx` (`servicio_id_servicio`),
  ADD KEY `fk_reseña_usuario1_idx` (`usuario_id_usuario`);

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
  ADD KEY `usuario_id` (`usuario_id`);

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
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reseña`
--
ALTER TABLE `reseña`
  MODIFY `id_reseña` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `servicio_imagenes`
--
ALTER TABLE `servicio_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicio_usuario`
--
ALTER TABLE `servicio_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_mensaje_chat1` FOREIGN KEY (`chat_id_chat`) REFERENCES `chat` (`id_chat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mensaje_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reseña`
--
ALTER TABLE `reseña`
  ADD CONSTRAINT `fk_reseña_servicio1` FOREIGN KEY (`servicio_id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reseña_usuario1` FOREIGN KEY (`usuario_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `servicio_usuario_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
