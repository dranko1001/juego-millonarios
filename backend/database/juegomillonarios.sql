-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2025 at 01:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `juegomillonarios`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_administradores`
--

CREATE TABLE `tbl_administradores` (
  `ID_administrador` int(11) NOT NULL,
  `usuario_administrador` varchar(200) NOT NULL,
  `password_administrador` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categorias`
--

CREATE TABLE `tbl_categorias` (
  `ID_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_codigoacesso`
--

CREATE TABLE `tbl_codigoacesso` (
  `ID_codigoAcesso` int(11) NOT NULL,
  `codigo_codigoAcesso` varchar(45) NOT NULL,
  `validar_codigoAcesso` tinyint(4) NOT NULL,
  `fecha_codigoAcesso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comodines`
--

CREATE TABLE `tbl_comodines` (
  `ID_comodines` int(11) NOT NULL,
  `nombre_comodines` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dificultades`
--

CREATE TABLE `tbl_dificultades` (
  `ID_dificultad` int(11) NOT NULL,
  `nombre_dificultad` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jugadores`
--

CREATE TABLE `tbl_jugadores` (
  `ID_jugador` int(11) NOT NULL,
  `ficha_jugador` varchar(100) NOT NULL,
  `usuario_jugador` bigint(20) NOT NULL,
  `puntaje_jugador` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jugadores_has_tbl_codigoacesso`
--

CREATE TABLE `tbl_jugadores_has_tbl_codigoacesso` (
  `TBL_jugadores_ID_jugador` int(11) NOT NULL,
  `TBL_codigoAcesso_ID_codigoAcesso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_preguntas`
--

CREATE TABLE `tbl_preguntas` (
  `ID_pregunta` int(11) NOT NULL,
  `enunciado_pregunta` varchar(300) NOT NULL,
  `opcion1_pregunta` varchar(300) NOT NULL,
  `opcion2_pregunta` varchar(300) NOT NULL,
  `opcion3_pregunta` varchar(300) NOT NULL,
  `opcion4_pregunta` varchar(300) NOT NULL,
  `correcta_pregunta` varchar(300) NOT NULL,
  `TBL_categorias_ID_categoria` int(11) NOT NULL,
  `TBL_dificultades_ID_dificultad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tema`
--

CREATE TABLE `tbl_tema` (
  `ID_tema` int(11) NOT NULL,
  `nombre_tema` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_administradores`
--
ALTER TABLE `tbl_administradores`
  ADD PRIMARY KEY (`ID_administrador`),
  ADD UNIQUE KEY `usuario_administrador_UNIQUE` (`usuario_administrador`);

--
-- Indexes for table `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  ADD PRIMARY KEY (`ID_categoria`),
  ADD UNIQUE KEY `nombre_categoria_UNIQUE` (`nombre_categoria`);

--
-- Indexes for table `tbl_codigoacesso`
--
ALTER TABLE `tbl_codigoacesso`
  ADD PRIMARY KEY (`ID_codigoAcesso`);

--
-- Indexes for table `tbl_comodines`
--
ALTER TABLE `tbl_comodines`
  ADD PRIMARY KEY (`ID_comodines`);

--
-- Indexes for table `tbl_dificultades`
--
ALTER TABLE `tbl_dificultades`
  ADD PRIMARY KEY (`ID_dificultad`),
  ADD UNIQUE KEY `nombre_dificultad_UNIQUE` (`nombre_dificultad`);

--
-- Indexes for table `tbl_jugadores`
--
ALTER TABLE `tbl_jugadores`
  ADD PRIMARY KEY (`ID_jugador`),
  ADD UNIQUE KEY `ID_jugadores_UNIQUE` (`ID_jugador`);

--
-- Indexes for table `tbl_jugadores_has_tbl_codigoacesso`
--
ALTER TABLE `tbl_jugadores_has_tbl_codigoacesso`
  ADD PRIMARY KEY (`TBL_jugadores_ID_jugador`,`TBL_codigoAcesso_ID_codigoAcesso`),
  ADD KEY `fk_TBL_jugadores_has_TBL_codigoAcesso_TBL_codigoAcesso1_idx` (`TBL_codigoAcesso_ID_codigoAcesso`),
  ADD KEY `fk_TBL_jugadores_has_TBL_codigoAcesso_TBL_jugadores1_idx` (`TBL_jugadores_ID_jugador`);

--
-- Indexes for table `tbl_preguntas`
--
ALTER TABLE `tbl_preguntas`
  ADD PRIMARY KEY (`ID_pregunta`,`TBL_categorias_ID_categoria`),
  ADD KEY `fk_TBL_preguntas_TBL_categorias1_idx` (`TBL_categorias_ID_categoria`),
  ADD KEY `fk_TBL_preguntas_TBL_dificultades1_idx` (`TBL_dificultades_ID_dificultad`);

--
-- Indexes for table `tbl_tema`
--
ALTER TABLE `tbl_tema`
  ADD PRIMARY KEY (`ID_tema`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_administradores`
--
ALTER TABLE `tbl_administradores`
  MODIFY `ID_administrador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `ID_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_codigoacesso`
--
ALTER TABLE `tbl_codigoacesso`
  MODIFY `ID_codigoAcesso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_comodines`
--
ALTER TABLE `tbl_comodines`
  MODIFY `ID_comodines` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_dificultades`
--
ALTER TABLE `tbl_dificultades`
  MODIFY `ID_dificultad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_jugadores`
--
ALTER TABLE `tbl_jugadores`
  MODIFY `ID_jugador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_preguntas`
--
ALTER TABLE `tbl_preguntas`
  MODIFY `ID_pregunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_jugadores_has_tbl_codigoacesso`
--
ALTER TABLE `tbl_jugadores_has_tbl_codigoacesso`
  ADD CONSTRAINT `fk_TBL_jugadores_has_TBL_codigoAcesso_TBL_codigoAcesso1` FOREIGN KEY (`TBL_codigoAcesso_ID_codigoAcesso`) REFERENCES `tbl_codigoacesso` (`ID_codigoAcesso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TBL_jugadores_has_TBL_codigoAcesso_TBL_jugadores1` FOREIGN KEY (`TBL_jugadores_ID_jugador`) REFERENCES `tbl_jugadores` (`ID_jugador`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_preguntas`
--
ALTER TABLE `tbl_preguntas`
  ADD CONSTRAINT `fk_TBL_preguntas_TBL_categorias1` FOREIGN KEY (`TBL_categorias_ID_categoria`) REFERENCES `tbl_categorias` (`ID_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TBL_preguntas_TBL_dificultades1` FOREIGN KEY (`TBL_dificultades_ID_dificultad`) REFERENCES `tbl_dificultades` (`ID_dificultad`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
