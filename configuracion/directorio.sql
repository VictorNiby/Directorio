-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2025 a las 15:33:11
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
(88, 1, 12);

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
(15, '5', 'EL mejor artista el mundo', '2025-06-24 13:30:04', 1, 12),
(16, '3', 'Buen trabajo!', '2025-06-24 13:32:04', 10, 12);

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
(10, 'Servicio de jardinería', 'Soy jardinero con experiencia, dedicado a cuidar, diseñar y mantener jardines de todo tipo. Ofrezco podas, siembras, mantenimiento general y asesoría personalizada para que tu espacio verde luzca siempre saludable y atractivo. Trabajo con responsabilidad, detalle y amor por la naturaleza. Si quieres darle vida y belleza a tu jardín, no dudes en contactarme. ¡Tu jardín estará en buenas manos!', 7000, '2025-06-24 08:01:49', 13, 6, 'Activo', 80, 'Carrera 14 #4-45'),
(11, 'Servicio de Electricista', 'Soy electricista profesional, con experiencia en instalaciones, reparaciones y mantenimiento eléctrico para hogares y negocios. Trabajo con responsabilidad, seguridad y atención a los detalles para garantizar que todo funcione correctamente y sin riesgos. Si necesitas un servicio confiable y bien hecho, no dudes en contactarme. ¡Tu tranquilidad es mi prioridad!', 12000, '2025-06-24 08:03:53', 2, 1, 'Activo', 45, 'calle 18a 16-19'),
(14, 'Creacion de paginas web a la medida', 'Diseño y desarrollo páginas web personalizadas, adaptadas a las necesidades de tu negocio o proyecto. Cada sitio es único, optimizado para ser rápido, atractivo y fácil de usar, garantizando que tu marca tenga presencia profesional en internet. Te acompaño desde la idea hasta la puesta en línea, con soluciones modernas, responsivas y seguras. ¡Haz crecer tu negocio con una página web hecha a tu medida!', 15000, '2025-06-24 08:19:12', 12, 21, 'Activo', 16, 'Carrera 7 #10-10'),
(15, 'Limpieza general', 'Ofrezco servicio de limpieza general para casas: aseo profundo, organización de espacios, lavado de baños, cocina y áreas comunes. Trabajo con dedicación, responsabilidad y atención a cada detalle para que tu hogar luzca impecable y acogedor. Ideal para limpiezas periódicas o puntuales. ¡Deja la limpieza en manos confiables y disfruta de tu tiempo libre!', 5000, '2025-06-24 08:23:35', 14, 17, 'Activo', 88, 'Carrera 8 #4-27'),
(16, 'Mantenimiento de Computadores', 'Brindo servicio de mantenimiento preventivo y correctivo para computadores de escritorio y portátiles. Realizo limpieza interna, optimización del sistema, eliminación de virus y respaldo de información para que tu equipo funcione rápido y sin problemas. Trabajo con responsabilidad y trato personalizado, ideal para hogares, oficinas o negocios. ¡Cuida tu computador y alarga su vida útil, contáctame!\r\n\r\nHORARIOS:\r\nLUNES - VIERNES\r\n9:00 am  - 17:00 pm\r\nSABADO\r\n10:00 am - 16:00 pm\r\nDOMINGO\r\nNo hay s', 11000, '2025-06-24 08:26:51', 13, 23, 'Activo', 20, 'calle 1a 1a-19');

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
(9, '1750770109-jardineria.jpg', 10),
(10, '1750770233-electricista.jpg', 11),
(11, 'OmegaStrikersGBA.gif', 1),
(12, 'iono.png', 1),
(13, '1750771152-web.jpg', 14),
(14, '1750771415-1750633578-aseo.png', 15),
(15, '1750771611-tecnico-imagen.png', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_usuario`
--

CREATE TABLE `servicio_usuario` (
  `id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `barrio_usuario` int(11) NOT NULL,
  `direccion_usuario` varchar(100) NOT NULL,
  `metodo_pago` varchar(60) NOT NULL,
  `estado` varchar(20) DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicio_usuario`
--

INSERT INTO `servicio_usuario` (`id`, `servicio_id`, `usuario_id`, `total`, `fecha`, `barrio_usuario`, `direccion_usuario`, `metodo_pago`, `estado`) VALUES
(13, 10, 12, 7000, '2025-06-24 08:04:41', 19, 'Carrera 18 #4-27', 'pago_directo', 'En Curso'),
(14, 10, 14, 7000, '2025-06-24 08:06:04', 40, 'calle 18a 16-10', 'pago_directo', 'En Curso'),
(15, 1, 14, 12000, '2025-06-24 08:06:26', 11, 'Carrera 18 #4-27', 'pago_directo', 'En Curso'),
(16, 1, 12, 12000, '2025-06-24 08:28:48', 15, 'Carrera 18 #4-27', 'tarjeta', 'Pagado');

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
(2, 'Diana Delgado Delgado', 'didi@gmail.com', '$2y$10$IvYoi06N6zqq8JpewsEXfO3rSPDHajA4YfesbLCghJD6DGbwbjUpu', '3007654321', 'proveedor', 'default-pfp.webp', '987654321', '2007-04-20', 'Activo', '2025-05-07 14:36:07'),
(12, 'Heung Min Son', 'nibyminson@gmail.com', '$2y$10$IvYoi06N6zqq8JpewsEXfO3rSPDHajA4YfesbLCghJD6DGbwbjUpu', '3024044590', 'admin', 'default-pfp.webp', '1010103030', '2005-07-11', 'Activo', '2025-06-24 12:52:49'),
(13, 'Diego Alejandro', 'bitardos8@gmail.com', '$2y$10$hSRlrAGJe7U/fQI1VwRPdO5mWDDYnPOE8WGPXv/s8A0ozoq/eZKjK', '3108948606', 'cliente', '', '1114109301', '2004-06-10', 'Activo', '2025-06-24 12:57:22'),
(14, 'Vanessa', 'vanessa@gmail.com', '$2y$10$8P0X/VA8PyehUxSyqIt0Q.hOw/UXIycIXNZfu6TfWu8BghSI4ekay', '3108948595', 'cliente', '', '1010102330', '1999-06-11', 'Activo', '2025-06-24 12:58:23');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `servicio_imagenes`
--
ALTER TABLE `servicio_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `servicio_usuario`
--
ALTER TABLE `servicio_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
