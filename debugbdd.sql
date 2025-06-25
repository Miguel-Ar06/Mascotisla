-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2025 a las 11:40:05
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
-- Base de datos: `debugbdd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `id_miembro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animales`
--

CREATE TABLE `animales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `especie` varchar(150) NOT NULL,
  `raza` varchar(100) NOT NULL,
  `sexo` varchar(100) NOT NULL,
  `fecha_de_nacimiento` date DEFAULT NULL,
  `id_caso` int(11) NOT NULL,
  `id_condicion` int(11) NOT NULL,
  `cedula_colaborador` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casos`
--

CREATE TABLE `casos` (
  `id` int(11) NOT NULL,
  `ubicacion` varchar(252) NOT NULL,
  `fecha_de_apertura` date NOT NULL,
  `fecha_de_cierre` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_municipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaboradores`
--

CREATE TABLE `colaboradores` (
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condiciones`
--

CREATE TABLE `condiciones` (
  `id` int(11) NOT NULL,
  `condicion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL,
  `calle` varchar(200) NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `id_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `estado` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_animales`
--

CREATE TABLE `estados_animales` (
  `id` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `link_imagen` text NOT NULL,
  `id_animal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

CREATE TABLE `miembros` (
  `id` int(11) NOT NULL,
  `constrasena` varchar(40) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `fecha_de_ingreso` date NOT NULL,
  `id_direccion` int(11) NOT NULL,
  `cedula_colaborador` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `numeros_telefonicos`
--

CREATE TABLE `numeros_telefonicos` (
  `id` int(11) NOT NULL,
  `numero_telefono` varchar(30) NOT NULL,
  `cedula_colaborador` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `papeles`
--

CREATE TABLE `papeles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `papeles_colaboradores`
--

CREATE TABLE `papeles_colaboradores` (
  `id` int(11) NOT NULL,
  `id_papel` int(11) NOT NULL,
  `cedula_colaborador` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros_miembros_animales`
--

CREATE TABLE `registros_miembros_animales` (
  `id` int(11) NOT NULL,
  `id_miembro` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros_miembros_casos`
--

CREATE TABLE `registros_miembros_casos` (
  `id` int(11) NOT NULL,
  `id_miembro` int(11) NOT NULL,
  `id_caso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes_casos_colaboradores`
--

CREATE TABLE `reportes_casos_colaboradores` (
  `id` int(11) NOT NULL,
  `cedula_colaborador` varchar(20) NOT NULL,
  `id_caso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_miembro` (`id_miembro`);

--
-- Indices de la tabla `animales`
--
ALTER TABLE `animales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_animal_caso` (`id_caso`),
  ADD KEY `fk_animal_condicion` (`id_condicion`),
  ADD KEY `fk_animal_colaborador` (`cedula_colaborador`);

--
-- Indices de la tabla `casos`
--
ALTER TABLE `casos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ciudadMunicipio` (`id_municipio`);

--
-- Indices de la tabla `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `condiciones`
--
ALTER TABLE `condiciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `condicion` (`condicion`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_direccionCiudad` (`id_ciudad`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estado` (`estado`);

--
-- Indices de la tabla `estados_animales`
--
ALTER TABLE `estados_animales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estado_animal_animal` (`id_animal`),
  ADD KEY `fk_estado_animal_estado` (`id_estado`);

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `link_imagen` (`link_imagen`) USING HASH,
  ADD KEY `fk_foto_animal` (`id_animal`);

--
-- Indices de la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_miembroDireccion` (`id_direccion`),
  ADD KEY `fk_miembroColaborador` (`cedula_colaborador`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `numeros_telefonicos`
--
ALTER TABLE `numeros_telefonicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_telefono` (`numero_telefono`),
  ADD KEY `fk_telefonos_colaborador` (`cedula_colaborador`);

--
-- Indices de la tabla `papeles`
--
ALTER TABLE `papeles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `papeles_colaboradores`
--
ALTER TABLE `papeles_colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_papel_colaborador_colaborador` (`cedula_colaborador`),
  ADD KEY `fk_papel_colaborador_papel` (`id_papel`);

--
-- Indices de la tabla `registros_miembros_animales`
--
ALTER TABLE `registros_miembros_animales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_registro_miembro_animal_miembro` (`id_miembro`),
  ADD KEY `fk_registro_miembro_animal_animal` (`id_animal`);

--
-- Indices de la tabla `registros_miembros_casos`
--
ALTER TABLE `registros_miembros_casos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_registro_miembro_caso_miembro` (`id_miembro`),
  ADD KEY `fk_registro_miembro_caso_caso` (`id_caso`);

--
-- Indices de la tabla `reportes_casos_colaboradores`
--
ALTER TABLE `reportes_casos_colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reporte_colaborador_colaborador` (`cedula_colaborador`),
  ADD KEY `fk_reporte_colaborador_caso` (`id_caso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `animales`
--
ALTER TABLE `animales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `casos`
--
ALTER TABLE `casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `condiciones`
--
ALTER TABLE `condiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estados_animales`
--
ALTER TABLE `estados_animales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `numeros_telefonicos`
--
ALTER TABLE `numeros_telefonicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `papeles`
--
ALTER TABLE `papeles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `papeles_colaboradores`
--
ALTER TABLE `papeles_colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registros_miembros_animales`
--
ALTER TABLE `registros_miembros_animales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registros_miembros_casos`
--
ALTER TABLE `registros_miembros_casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportes_casos_colaboradores`
--
ALTER TABLE `reportes_casos_colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `fk_miembro_admin` FOREIGN KEY (`id_miembro`) REFERENCES `miembros` (`id`);

--
-- Filtros para la tabla `animales`
--
ALTER TABLE `animales`
  ADD CONSTRAINT `fk_animal_caso` FOREIGN KEY (`id_caso`) REFERENCES `casos` (`id`),
  ADD CONSTRAINT `fk_animal_colaborador` FOREIGN KEY (`cedula_colaborador`) REFERENCES `colaboradores` (`cedula`),
  ADD CONSTRAINT `fk_animal_condicion` FOREIGN KEY (`id_condicion`) REFERENCES `condiciones` (`id`);

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `fk_ciudadMunicipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`);

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `fk_direccionCiudad` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id`);

--
-- Filtros para la tabla `estados_animales`
--
ALTER TABLE `estados_animales`
  ADD CONSTRAINT `fk_estado_animal_animal` FOREIGN KEY (`id_animal`) REFERENCES `animales` (`id`),
  ADD CONSTRAINT `fk_estado_animal_estado` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`);

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fk_foto_animal` FOREIGN KEY (`id_animal`) REFERENCES `animales` (`id`);

--
-- Filtros para la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD CONSTRAINT `fk_miembroColaborador` FOREIGN KEY (`cedula_colaborador`) REFERENCES `colaboradores` (`cedula`),
  ADD CONSTRAINT `fk_miembroDireccion` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones` (`id`);

--
-- Filtros para la tabla `numeros_telefonicos`
--
ALTER TABLE `numeros_telefonicos`
  ADD CONSTRAINT `fk_telefonos_colaborador` FOREIGN KEY (`cedula_colaborador`) REFERENCES `colaboradores` (`cedula`);

--
-- Filtros para la tabla `papeles_colaboradores`
--
ALTER TABLE `papeles_colaboradores`
  ADD CONSTRAINT `fk_papel_colaborador_colaborador` FOREIGN KEY (`cedula_colaborador`) REFERENCES `colaboradores` (`cedula`),
  ADD CONSTRAINT `fk_papel_colaborador_papel` FOREIGN KEY (`id_papel`) REFERENCES `papeles` (`id`);

--
-- Filtros para la tabla `registros_miembros_animales`
--
ALTER TABLE `registros_miembros_animales`
  ADD CONSTRAINT `fk_registro_miembro_animal_animal` FOREIGN KEY (`id_animal`) REFERENCES `animales` (`id`),
  ADD CONSTRAINT `fk_registro_miembro_animal_miembro` FOREIGN KEY (`id_miembro`) REFERENCES `animales` (`id`);

--
-- Filtros para la tabla `registros_miembros_casos`
--
ALTER TABLE `registros_miembros_casos`
  ADD CONSTRAINT `fk_registro_miembro_caso_caso` FOREIGN KEY (`id_caso`) REFERENCES `casos` (`id`),
  ADD CONSTRAINT `fk_registro_miembro_caso_miembro` FOREIGN KEY (`id_miembro`) REFERENCES `miembros` (`id`);

--
-- Filtros para la tabla `reportes_casos_colaboradores`
--
ALTER TABLE `reportes_casos_colaboradores`
  ADD CONSTRAINT `fk_reporte_colaborador_caso` FOREIGN KEY (`id_caso`) REFERENCES `casos` (`id`),
  ADD CONSTRAINT `fk_reporte_colaborador_colaborador` FOREIGN KEY (`cedula_colaborador`) REFERENCES `colaboradores` (`cedula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
