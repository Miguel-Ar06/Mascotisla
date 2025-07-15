-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2025 at 08:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mascotisla`
--

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `id_miembro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `animales`
--

CREATE TABLE `animales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `especie` varchar(150) NOT NULL,
  `raza` varchar(100) NOT NULL,
  `sexo` varchar(100) NOT NULL,
  `fecha_de_nacimiento` date DEFAULT NULL,
  `id_caso` int(11) DEFAULT NULL,
  `id_condicion` int(11) NOT NULL,
  `cedula_colaborador` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animales`
--

INSERT INTO `animales` (`id`, `nombre`, `especie`, `raza`, `sexo`, `fecha_de_nacimiento`, `id_caso`, `id_condicion`, `cedula_colaborador`) VALUES
(2, 'patroclo', 'Perro', 'Enfermo', 'Macho', '2025-07-14', NULL, 2, '31348551'),
(6, 'luna', 'Perro', 'Sano', 'Hembra', '2025-05-14', NULL, 1, '31348551'),
(13, 'tepo tepo', 'Perro', 'callejero', 'Macho', '2025-07-14', NULL, 3, '31348551'),
(17, 'oso', 'Perro', 'Golden retriever', 'Macho', '2023-12-13', NULL, 1, '31348551'),
(18, 'escopeta', 'Perro', 'callejero', 'Hembra', '2019-02-14', NULL, 1, '31348551'),
(19, 'adjetivo', 'Perro', 'callejero', 'Macho', '2025-07-01', NULL, 4, '31348551'),
(24, 'etcetera', 'Perro', 'callejero', 'Macho', '2023-11-09', NULL, 1, '31348551'),
(25, 'otorrinolaringologo', 'Perro', 'volteapipote', 'Macho', '2025-01-09', NULL, 1, '31348551');

-- --------------------------------------------------------

--
-- Table structure for table `casos`
--

CREATE TABLE `casos` (
  `id` int(11) NOT NULL,
  `ubicacion` varchar(252) NOT NULL,
  `fecha_de_apertura` date NOT NULL,
  `fecha_de_cierre` date DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ciudades`
--

CREATE TABLE `ciudades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_municipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ciudades`
--

INSERT INTO `ciudades` (`id`, `nombre`, `id_municipio`) VALUES
(1, 'san juan', 3),
(2, 'el valle', 4),
(3, 'boqueron', 3),
(4, 'dsfvsdf', 8);

-- --------------------------------------------------------

--
-- Table structure for table `colaboradores`
--

CREATE TABLE `colaboradores` (
  `cedula` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `detalles` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colaboradores`
--

INSERT INTO `colaboradores` (`cedula`, `nombre`, `apellido`, `detalles`) VALUES
('00000000', 'Falvio', 'Rosales', '(llevar Gafas)'),
('1234', 'Angel', 'Marin', ''),
('31348551', 'Miguel', 'Arismendi', 'No duerme'),
('98765678', 'Alejandro', 'Maldito', 'Colabora maldito flojo');

-- --------------------------------------------------------

--
-- Table structure for table `condiciones`
--

CREATE TABLE `condiciones` (
  `id` int(11) NOT NULL,
  `condicion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `condiciones`
--

INSERT INTO `condiciones` (`id`, `condicion`) VALUES
(2, 'Enfermo'),
(4, 'Grave'),
(3, 'Lesionado'),
(1, 'Sano');

-- --------------------------------------------------------

--
-- Table structure for table `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL,
  `calle` varchar(200) NOT NULL,
  `referencia` varchar(100) NOT NULL,
  `id_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `direcciones`
--

INSERT INTO `direcciones` (`id`, `calle`, `referencia`, `id_ciudad`) VALUES
(1, 'el castillo', 'frente a la tanquilla sin tapa', 1),
(2, 'nose', 'la cierra', 2),
(3, 'Guate e puerco', '', 3),
(4, 'el castillo', 'la cierra', 1),
(5, 'el castillo', '', 1),
(6, 'dfvsd', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `estados`
--

CREATE TABLE `estados` (
  `id` int(11) NOT NULL,
  `estado` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estados`
--

INSERT INTO `estados` (`id`, `estado`) VALUES
(1, 'Adoptado'),
(2, 'En adopción'),
(4, 'En recuperación'),
(7, 'Esterilizado'),
(5, 'Hospitalizado'),
(3, 'Perdido'),
(6, 'Refugiado'),
(8, 'Vacunado');

-- --------------------------------------------------------

--
-- Table structure for table `estados_animales`
--

CREATE TABLE `estados_animales` (
  `id` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estados_animales`
--

INSERT INTO `estados_animales` (`id`, `id_animal`, `id_estado`) VALUES
(2, 19, 4),
(3, 19, 5),
(31, 18, 1),
(41, 24, 1),
(42, 24, 4),
(43, 24, 7),
(44, 25, 2),
(45, 25, 7),
(46, 25, 8);

-- --------------------------------------------------------

--
-- Table structure for table `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `link_imagen` text NOT NULL,
  `id_animal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `miembros`
--

CREATE TABLE `miembros` (
  `id` int(11) NOT NULL,
  `constrasena` varchar(40) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `fecha_de_ingreso` date NOT NULL,
  `id_direccion` int(11) NOT NULL,
  `cedula_colaborador` varchar(20) NOT NULL,
  `es_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `miembros`
--

INSERT INTO `miembros` (`id`, `constrasena`, `correo`, `fecha_de_ingreso`, `id_direccion`, `cedula_colaborador`, `es_admin`) VALUES
(2, '12345678', 'correodegei@gmail.com', '2025-07-11', 2, '1234', 0),
(5, '00000000', 'marismendi.8551@unimar.edu.ve', '2025-07-13', 5, '31348551', 1);

-- --------------------------------------------------------

--
-- Table structure for table `municipios`
--

CREATE TABLE `municipios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `municipios`
--

INSERT INTO `municipios` (`id`, `nombre`) VALUES
(1, 'Antolín del Campo'),
(2, 'Arismendi'),
(3, 'Díaz'),
(4, 'García'),
(5, 'Gómez'),
(9, 'Macanao'),
(6, 'Maneiro'),
(7, 'Marcano'),
(8, 'Mariño'),
(10, 'Tubores'),
(11, 'Villalba');

-- --------------------------------------------------------

--
-- Table structure for table `notificaciones_admin`
--

CREATE TABLE `notificaciones_admin` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `leida` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notificaciones_admin`
--

INSERT INTO `notificaciones_admin` (`id`, `titulo`, `mensaje`, `fecha`, `leida`) VALUES
(0, 'Recuperación de contraseña', 'El usuario con correo/cédula \"31348551\" ha solicitado recuperar su contraseña desde el login.', '2025-07-13 02:23:08', 1),
(0, 'Recuperación de contraseña', 'El usuario con correo/cédula \"sman@gmail.com\" ha solicitado recuperar su contraseña desde el login.', '2025-07-13 02:25:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `numeros_telefonicos`
--

CREATE TABLE `numeros_telefonicos` (
  `id` int(11) NOT NULL,
  `numero_telefono` varchar(30) NOT NULL,
  `cedula_colaborador` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `numeros_telefonicos`
--

INSERT INTO `numeros_telefonicos` (`id`, `numero_telefono`, `cedula_colaborador`) VALUES
(6, '123456789', '1234'),
(14, '56745', '00000000'),
(15, '04166960017', '31348551'),
(16, '666666', '98765678');

-- --------------------------------------------------------

--
-- Table structure for table `papeles`
--

CREATE TABLE `papeles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `papeles`
--

INSERT INTO `papeles` (`id`, `nombre`) VALUES
(1, 'Adoptante'),
(7, 'Cuidador'),
(3, 'Donante'),
(6, 'Hogar Temporal'),
(5, 'Reportante'),
(2, 'Rescatista'),
(4, 'Veterinario');

-- --------------------------------------------------------

--
-- Table structure for table `papeles_colaboradores`
--

CREATE TABLE `papeles_colaboradores` (
  `id` int(11) NOT NULL,
  `id_papel` int(11) NOT NULL,
  `cedula_colaborador` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `papeles_colaboradores`
--

INSERT INTO `papeles_colaboradores` (`id`, `id_papel`, `cedula_colaborador`) VALUES
(34, 1, '31348551'),
(35, 5, '31348551'),
(36, 1, '00000000'),
(37, 6, '00000000'),
(38, 2, '00000000');

-- --------------------------------------------------------

--
-- Table structure for table `registros_miembros_animales`
--

CREATE TABLE `registros_miembros_animales` (
  `id` int(11) NOT NULL,
  `id_miembro` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registros_miembros_casos`
--

CREATE TABLE `registros_miembros_casos` (
  `id` int(11) NOT NULL,
  `id_miembro` int(11) NOT NULL,
  `id_caso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reportes_casos_colaboradores`
--

CREATE TABLE `reportes_casos_colaboradores` (
  `id` int(11) NOT NULL,
  `cedula_colaborador` varchar(20) NOT NULL,
  `id_caso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_miembro` (`id_miembro`);

--
-- Indexes for table `animales`
--
ALTER TABLE `animales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_animal_caso` (`id_caso`),
  ADD KEY `fk_animal_condicion` (`id_condicion`),
  ADD KEY `fk_animal_colaborador` (`cedula_colaborador`);

--
-- Indexes for table `casos`
--
ALTER TABLE `casos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ciudadMunicipio` (`id_municipio`);

--
-- Indexes for table `colaboradores`
--
ALTER TABLE `colaboradores`
  ADD PRIMARY KEY (`cedula`);

--
-- Indexes for table `condiciones`
--
ALTER TABLE `condiciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `condicion` (`condicion`);

--
-- Indexes for table `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_direccionCiudad` (`id_ciudad`);

--
-- Indexes for table `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estado` (`estado`);

--
-- Indexes for table `estados_animales`
--
ALTER TABLE `estados_animales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estado_animal_animal` (`id_animal`),
  ADD KEY `fk_estado_animal_estado` (`id_estado`);

--
-- Indexes for table `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `link_imagen` (`link_imagen`) USING HASH,
  ADD KEY `fk_foto_animal` (`id_animal`);

--
-- Indexes for table `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_miembroDireccion` (`id_direccion`),
  ADD KEY `fk_miembroColaborador` (`cedula_colaborador`);

--
-- Indexes for table `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `numeros_telefonicos`
--
ALTER TABLE `numeros_telefonicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero_telefono` (`numero_telefono`),
  ADD KEY `fk_telefonos_colaborador` (`cedula_colaborador`);

--
-- Indexes for table `papeles`
--
ALTER TABLE `papeles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indexes for table `papeles_colaboradores`
--
ALTER TABLE `papeles_colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_papel_colaborador_colaborador` (`cedula_colaborador`),
  ADD KEY `fk_papel_colaborador_papel` (`id_papel`);

--
-- Indexes for table `registros_miembros_animales`
--
ALTER TABLE `registros_miembros_animales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_registro_miembro_animal_miembro` (`id_miembro`),
  ADD KEY `fk_registro_miembro_animal_animal` (`id_animal`);

--
-- Indexes for table `registros_miembros_casos`
--
ALTER TABLE `registros_miembros_casos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_registro_miembro_caso_miembro` (`id_miembro`),
  ADD KEY `fk_registro_miembro_caso_caso` (`id_caso`);

--
-- Indexes for table `reportes_casos_colaboradores`
--
ALTER TABLE `reportes_casos_colaboradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reporte_colaborador_colaborador` (`cedula_colaborador`),
  ADD KEY `fk_reporte_colaborador_caso` (`id_caso`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `animales`
--
ALTER TABLE `animales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `casos`
--
ALTER TABLE `casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `condiciones`
--
ALTER TABLE `condiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `estados`
--
ALTER TABLE `estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `estados_animales`
--
ALTER TABLE `estados_animales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `numeros_telefonicos`
--
ALTER TABLE `numeros_telefonicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `papeles`
--
ALTER TABLE `papeles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `papeles_colaboradores`
--
ALTER TABLE `papeles_colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `registros_miembros_animales`
--
ALTER TABLE `registros_miembros_animales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `registros_miembros_casos`
--
ALTER TABLE `registros_miembros_casos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reportes_casos_colaboradores`
--
ALTER TABLE `reportes_casos_colaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administradores`
--
ALTER TABLE `administradores`
  ADD CONSTRAINT `fk_miembro_admin` FOREIGN KEY (`id_miembro`) REFERENCES `miembros` (`id`);

--
-- Constraints for table `animales`
--
ALTER TABLE `animales`
  ADD CONSTRAINT `fk_animal_caso` FOREIGN KEY (`id_caso`) REFERENCES `casos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_animal_colaborador` FOREIGN KEY (`cedula_colaborador`) REFERENCES `colaboradores` (`cedula`),
  ADD CONSTRAINT `fk_animal_condicion` FOREIGN KEY (`id_condicion`) REFERENCES `condiciones` (`id`);

--
-- Constraints for table `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `fk_ciudadMunicipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id`);

--
-- Constraints for table `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `fk_direccionCiudad` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id`);

--
-- Constraints for table `estados_animales`
--
ALTER TABLE `estados_animales`
  ADD CONSTRAINT `fk_estado_animal_animal` FOREIGN KEY (`id_animal`) REFERENCES `animales` (`id`),
  ADD CONSTRAINT `fk_estado_animal_estado` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`);

--
-- Constraints for table `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fk_foto_animal` FOREIGN KEY (`id_animal`) REFERENCES `animales` (`id`);

--
-- Constraints for table `miembros`
--
ALTER TABLE `miembros`
  ADD CONSTRAINT `fk_miembroColaborador` FOREIGN KEY (`cedula_colaborador`) REFERENCES `colaboradores` (`cedula`),
  ADD CONSTRAINT `fk_miembroDireccion` FOREIGN KEY (`id_direccion`) REFERENCES `direcciones` (`id`);

--
-- Constraints for table `numeros_telefonicos`
--
ALTER TABLE `numeros_telefonicos`
  ADD CONSTRAINT `fk_telefonos_colaborador` FOREIGN KEY (`cedula_colaborador`) REFERENCES `colaboradores` (`cedula`);

--
-- Constraints for table `papeles_colaboradores`
--
ALTER TABLE `papeles_colaboradores`
  ADD CONSTRAINT `fk_papel_colaborador_colaborador` FOREIGN KEY (`cedula_colaborador`) REFERENCES `colaboradores` (`cedula`),
  ADD CONSTRAINT `fk_papel_colaborador_papel` FOREIGN KEY (`id_papel`) REFERENCES `papeles` (`id`);

--
-- Constraints for table `registros_miembros_animales`
--
ALTER TABLE `registros_miembros_animales`
  ADD CONSTRAINT `fk_registro_miembro_animal_animal` FOREIGN KEY (`id_animal`) REFERENCES `animales` (`id`),
  ADD CONSTRAINT `fk_registro_miembro_animal_miembro` FOREIGN KEY (`id_miembro`) REFERENCES `animales` (`id`);

--
-- Constraints for table `registros_miembros_casos`
--
ALTER TABLE `registros_miembros_casos`
  ADD CONSTRAINT `fk_registro_miembro_caso_caso` FOREIGN KEY (`id_caso`) REFERENCES `casos` (`id`),
  ADD CONSTRAINT `fk_registro_miembro_caso_miembro` FOREIGN KEY (`id_miembro`) REFERENCES `miembros` (`id`);

--
-- Constraints for table `reportes_casos_colaboradores`
--
ALTER TABLE `reportes_casos_colaboradores`
  ADD CONSTRAINT `fk_reporte_colaborador_caso` FOREIGN KEY (`id_caso`) REFERENCES `casos` (`id`),
  ADD CONSTRAINT `fk_reporte_colaborador_colaborador` FOREIGN KEY (`cedula_colaborador`) REFERENCES `colaboradores` (`cedula`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
