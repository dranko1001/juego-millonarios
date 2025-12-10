-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2025 at 02:02 PM
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

--
-- Dumping data for table `tbl_administradores`
--

INSERT INTO `tbl_administradores` (`ID_administrador`, `usuario_administrador`, `password_administrador`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categorias`
--

CREATE TABLE `tbl_categorias` (
  `ID_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_categorias`
--

INSERT INTO `tbl_categorias` (`ID_categoria`, `nombre_categoria`) VALUES
(5, '\''),
(6, '\'=\''),
(3, 'Arte y Literatura'),
(14, 'Biología'),
(2, 'Ciencia'),
(11, 'Cine y TV'),
(12, 'Cultura General'),
(8, 'Deportes'),
(16, 'Economía'),
(7, 'Geografía'),
(1, 'Historia'),
(13, 'Matemáticas'),
(9, 'Música'),
(4, 'pizza'),
(10, 'Tecnología'),
(15, 'Videojuegos');

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

--
-- Dumping data for table `tbl_codigoacesso`
--

INSERT INTO `tbl_codigoacesso` (`ID_codigoAcesso`, `codigo_codigoAcesso`, `validar_codigoAcesso`, `fecha_codigoAcesso`) VALUES
(1, '520902', 1, '2025-12-05');

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

--
-- Dumping data for table `tbl_dificultades`
--

INSERT INTO `tbl_dificultades` (`ID_dificultad`, `nombre_dificultad`) VALUES
(3, 'Dificil'),
(1, 'Facil'),
(2, 'Medio');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jugadores`
--

CREATE TABLE `tbl_jugadores` (
  `ID_jugador` int(11) NOT NULL,
  `ficha_jugador` varchar(100) NOT NULL,
  `usuario_jugador` varchar(200) NOT NULL,
  `puntaje_jugador` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_jugadores`
--

INSERT INTO `tbl_jugadores` (`ID_jugador`, `ficha_jugador`, `usuario_jugador`, `puntaje_jugador`) VALUES
(1, '3064749', 'frank', 150000),
(2, '3064749', '123', 0),
(3, 'FJ001', 'juanito', 15432),
(4, 'FJ002', 'maria22', 982311),
(5, 'FJ003', 'pepitoPro', 44211),
(6, 'FJ004', 'linaGamer', 723881),
(7, 'FJ005', 'andresX', 118932),
(8, 'FJ006', 'caroPlay', 551299),
(9, 'FJ007', 'tomas777', 39912),
(10, 'FJ008', 'valenQ', 880122),
(11, 'FJ009', 'sebasDev', 223901),
(12, 'FJ010', 'lucasLOL', 712389),
(13, 'FJ011', 'nataliaX', 50122),
(14, 'FJ012', 'julianPro', 932882),
(15, 'FJ013', 'samuelOps', 324556),
(16, 'FJ014', 'mateoKing', 785441),
(17, 'FJ015', 'danielaGG', 99231),
(18, 'FJ016', 'felipeXD', 634829),
(19, 'FJ017', 'sofiaTop', 128331),
(20, 'FJ018', 'davidUltra', 889119),
(21, 'FJ019', 'camilaStar', 455902),
(22, 'FJ020', 'estebanGO', 734551),
(23, '78515', 'blasito', 0),
(24, '11111', 'carlos', 0),
(25, '454545', 'aaaaa', 0),
(26, '155', 'frank', 0),
(27, '99999', 'drank', 0),
(28, '47777', 'cucurro', 0),
(29, '99999', 'lauraaa', 0),
(30, '666666', 'eso', 300000),
(31, '33333', 'assdsad', 100000),
(32, '454545', 'puntaje inserto?', 200000),
(33, '88888', 'karla', 100000),
(34, '455555555555', 'aaaaaaaaaaa', 100000),
(35, '74411', 'adxxxxxx', 0),
(36, '99999', 'frank', 0),
(37, '3064749', 'xddd', 150000),
(38, '11111', 'xdddddddddd', 0),
(39, '11111', 'frank', 0),
(40, '454545', '123', 175000),
(41, '454545', 'sd', 0),
(42, '3064749', 'aaaaa', 0),
(43, '48545845', 'camilo', 0),
(44, '454545', 'frank', 100000);

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
-- Table structure for table `tbl_logs_debug`
--

CREATE TABLE `tbl_logs_debug` (
  `id` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `tipo` varchar(50) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `id_jugador` int(11) DEFAULT NULL,
  `puntaje` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_logs_debug`
--

INSERT INTO `tbl_logs_debug` (`id`, `fecha`, `tipo`, `mensaje`, `id_jugador`, `puntaje`) VALUES
(1, '2025-12-08 23:44:32', 'INICIO', 'Validando respuesta - Pregunta: 13', 30, NULL),
(2, '2025-12-08 23:44:32', 'CORRECTA', 'Respuesta correcta | Dificultad: 2 | Ganado: $150,000 | Total: $150,000', 30, 150000),
(3, '2025-12-08 23:44:32', 'ACTUALIZAR_PUNTAJE', 'ID: 30 | Puntaje: 150000 | Filas afectadas: 1', 30, 150000),
(4, '2025-12-08 23:44:32', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 30, 150000),
(5, '2025-12-08 23:44:32', 'FIN', 'Redirigiendo a resultado.php', 30, 150000),
(6, '2025-12-08 23:44:46', 'INICIO', 'Validando respuesta - Pregunta: 8', 30, NULL),
(7, '2025-12-08 23:44:46', 'CORRECTA', 'Respuesta correcta | Dificultad: 2 | Ganado: $150,000 | Total: $300,000', 30, 300000),
(8, '2025-12-08 23:44:46', 'ACTUALIZAR_PUNTAJE', 'ID: 30 | Puntaje: 300000 | Filas afectadas: 1', 30, 300000),
(9, '2025-12-08 23:44:46', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 30, 300000),
(10, '2025-12-08 23:44:46', 'FIN', 'Redirigiendo a resultado.php', 30, 300000),
(11, '2025-12-08 23:44:50', 'INICIO', 'Validando respuesta - Pregunta: 5', 30, NULL),
(12, '2025-12-08 23:44:50', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $300,000', 30, 300000),
(13, '2025-12-08 23:44:50', 'ANTES_GUARDAR', 'BD actual: $300,000 | A guardar: $300,000', 30, 300000),
(14, '2025-12-08 23:44:50', 'ACTUALIZAR_PUNTAJE', 'ID: 30 | Puntaje: 300000 | Filas afectadas: 0', 30, 300000),
(15, '2025-12-08 23:44:50', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $300,000', 30, 300000),
(16, '2025-12-08 23:44:51', 'FIN', 'Redirigiendo a resultado.php', 30, 300000),
(17, '2025-12-08 23:46:09', 'INICIO', 'Validando respuesta - Pregunta: 7', 31, NULL),
(18, '2025-12-08 23:46:09', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 31, 100000),
(19, '2025-12-08 23:46:09', 'ACTUALIZAR_PUNTAJE', 'ID: 31 | Puntaje: 100000 | Filas afectadas: 1', 31, 100000),
(20, '2025-12-08 23:46:09', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 31, 100000),
(21, '2025-12-08 23:46:09', 'FIN', 'Redirigiendo a resultado.php', 31, 100000),
(22, '2025-12-08 23:53:46', 'INICIO', 'Validando respuesta - Pregunta: 1', 32, NULL),
(23, '2025-12-08 23:53:46', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $200,000', 32, 200000),
(24, '2025-12-08 23:53:46', 'ACTUALIZAR_PUNTAJE', 'ID: 32 | Puntaje: 200000 | Filas afectadas: 1', 32, 200000),
(25, '2025-12-08 23:53:47', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 32, 200000),
(26, '2025-12-08 23:53:47', 'FIN', 'Redirigiendo a resultado.php', 32, 200000),
(27, '2025-12-08 23:53:53', 'INICIO', 'Validando respuesta - Pregunta: 9', 32, NULL),
(28, '2025-12-08 23:53:53', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $200,000', 32, 200000),
(29, '2025-12-08 23:53:53', 'ANTES_GUARDAR', 'BD actual: $200,000 | A guardar: $200,000', 32, 200000),
(30, '2025-12-08 23:53:53', 'ACTUALIZAR_PUNTAJE', 'ID: 32 | Puntaje: 200000 | Filas afectadas: 0', 32, 200000),
(31, '2025-12-08 23:53:53', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $200,000', 32, 200000),
(32, '2025-12-08 23:53:53', 'FIN', 'Redirigiendo a resultado.php', 32, 200000),
(33, '2025-12-08 23:58:53', 'INICIO', 'Validando respuesta - Pregunta: 8', 1, NULL),
(34, '2025-12-08 23:58:53', 'CORRECTA', 'Respuesta correcta | Dificultad: 2 | Ganado: $150,000 | Total: $150,000', 1, 150000),
(35, '2025-12-08 23:58:53', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 150000 | Filas afectadas: 1', 1, 150000),
(36, '2025-12-08 23:58:53', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 1, 150000),
(37, '2025-12-08 23:58:53', 'FIN', 'Redirigiendo a resultado.php', 1, 150000),
(38, '2025-12-08 23:59:04', 'INICIO', 'Validando respuesta - Pregunta: 14', 1, NULL),
(39, '2025-12-08 23:59:04', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $250,000', 1, 250000),
(40, '2025-12-08 23:59:04', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 250000 | Filas afectadas: 1', 1, 250000),
(41, '2025-12-08 23:59:04', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 1, 250000),
(42, '2025-12-08 23:59:04', 'FIN', 'Redirigiendo a resultado.php', 1, 250000),
(43, '2025-12-09 00:12:45', 'INICIO', 'Validando respuesta - Pregunta: 6', 1, NULL),
(44, '2025-12-09 00:12:45', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $250,000', 1, 250000),
(45, '2025-12-09 00:12:45', 'ANTES_GUARDAR', 'BD actual: $250,000 | A guardar: $250,000', 1, 250000),
(46, '2025-12-09 00:12:45', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 250000 | Filas afectadas: 0', 1, 250000),
(47, '2025-12-09 00:12:45', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $250,000', 1, 250000),
(48, '2025-12-09 00:12:45', 'FIN', 'Redirigiendo a resultado.php', 1, 250000),
(49, '2025-12-09 00:25:34', 'INICIO', 'Validando respuesta - Pregunta: 7', 33, NULL),
(50, '2025-12-09 00:25:34', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 33, 100000),
(51, '2025-12-09 00:25:34', 'ACTUALIZAR_PUNTAJE', 'ID: 33 | Puntaje: 100000 | Filas afectadas: 1', 33, 100000),
(52, '2025-12-09 00:25:34', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 33, 100000),
(53, '2025-12-09 00:25:34', 'FIN', 'Redirigiendo a resultado.php', 33, 100000),
(54, '2025-12-09 00:31:42', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 33, 100000),
(55, '2025-12-09 00:31:42', 'ACTUALIZAR_PUNTAJE', 'ID: 33 | Puntaje: 100000 | Filas afectadas: 0', 33, 100000),
(56, '2025-12-09 00:33:14', 'TIEMPO_AGOTADO', 'Tiempo agotado - Transcurrido: 214s | Límite: 120s', 33, 100000),
(57, '2025-12-09 00:33:14', 'ACTUALIZAR_PUNTAJE', 'ID: 33 | Puntaje: 100000 | Filas afectadas: 0', 33, 100000),
(58, '2025-12-09 00:33:21', 'TIEMPO_AGOTADO', 'Tiempo agotado - Transcurrido: 221s | Límite: 120s', 33, 100000),
(59, '2025-12-09 00:33:21', 'ACTUALIZAR_PUNTAJE', 'ID: 33 | Puntaje: 100000 | Filas afectadas: 0', 33, 100000),
(60, '2025-12-09 00:33:32', 'ACTUALIZAR_PUNTAJE', 'ID: 33 | Puntaje: 100000 | Filas afectadas: 0', 33, 100000),
(61, '2025-12-09 00:35:36', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 33, 0),
(62, '2025-12-09 00:36:40', 'TIEMPO_AGOTADO', 'Tiempo agotado - Transcurrido: 188s | Límite: 120s', 33, 0),
(63, '2025-12-09 00:37:02', 'INICIO', 'Validando respuesta - Pregunta: 1', 34, NULL),
(64, '2025-12-09 00:37:02', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 34, 100000),
(65, '2025-12-09 00:37:02', 'ACTUALIZAR_PUNTAJE', 'ID: 34 | Puntaje: 100000 | Filas afectadas: 1', 34, 100000),
(66, '2025-12-09 00:37:02', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 34, 100000),
(67, '2025-12-09 00:37:02', 'FIN', 'Redirigiendo a resultado.php', 34, 100000),
(68, '2025-12-09 23:25:23', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 1, 0),
(69, '2025-12-09 23:29:42', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 37, 0),
(70, '2025-12-09 23:32:18', 'INICIO', 'Validando respuesta - Pregunta: 2', 37, NULL),
(71, '2025-12-09 23:32:18', 'CORRECTA', 'Respuesta correcta | Dificultad: 2 | Ganado: $150,000 | Total: $150,000', 37, 150000),
(72, '2025-12-09 23:32:18', 'ACTUALIZAR_PUNTAJE', 'ID: 37 | Puntaje: 150000 | Filas afectadas: 1', 37, 150000),
(73, '2025-12-09 23:32:18', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 37, 150000),
(74, '2025-12-09 23:32:18', 'FIN', 'Redirigiendo a resultado.php', 37, 150000),
(75, '2025-12-09 23:34:22', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 37, 150000),
(76, '2025-12-09 23:34:22', 'ACTUALIZAR_PUNTAJE', 'ID: 37 | Puntaje: 150000 | Filas afectadas: 0', 37, 150000),
(77, '2025-12-09 23:55:31', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 38, 0),
(78, '2025-12-09 23:55:31', 'REDIRECCION', 'Redirigiendo a resultado.php con tiempo agotado', 38, 0),
(79, '2025-12-09 23:55:53', 'TIEMPO_AGOTADO', 'Tiempo agotado - Transcurrido: 312s | Límite: 120s', 38, 0),
(80, '2025-12-10 00:04:04', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 39, 0),
(81, '2025-12-10 00:04:04', 'REDIRECCION', 'Redirigiendo a resultado.php con tiempo agotado', 39, 0),
(82, '2025-12-10 00:15:40', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 40, 0),
(83, '2025-12-10 00:15:40', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 0 | Filas afectadas: 0', 40, 0),
(84, '2025-12-10 00:15:40', 'PUNTAJE_GUARDADO', 'Puntaje guardado: $0', 40, 0),
(85, '2025-12-10 00:15:40', 'REDIRECCION', 'Redirigiendo a resultado.php con tiempo agotado', 40, 0),
(86, '2025-12-10 00:16:38', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 0 | Filas afectadas: 0', 40, 0),
(87, '2025-12-10 00:18:27', 'INICIO', 'Validando respuesta - Pregunta: 6', 40, NULL),
(88, '2025-12-10 00:18:27', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 40, 0),
(89, '2025-12-10 00:18:27', 'ANTES_GUARDAR', 'BD actual: $0 | A guardar: $0', 40, 0),
(90, '2025-12-10 00:18:27', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 0 | Filas afectadas: 0', 40, 0),
(91, '2025-12-10 00:18:27', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $0', 40, 0),
(92, '2025-12-10 00:18:27', 'FIN', 'Redirigiendo a resultado.php', 40, 0),
(93, '2025-12-10 00:18:31', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 0 | Filas afectadas: 0', 40, 0),
(94, '2025-12-10 00:18:46', 'INICIO', 'Validando respuesta - Pregunta: 6', 40, NULL),
(95, '2025-12-10 00:18:46', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 40, 100000),
(96, '2025-12-10 00:18:47', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 100000 | Filas afectadas: 1', 40, 100000),
(97, '2025-12-10 00:18:47', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 40, 100000),
(98, '2025-12-10 00:18:47', 'FIN', 'Redirigiendo a resultado.php', 40, 100000),
(99, '2025-12-10 00:18:49', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 100000 | Filas afectadas: 0', 40, 100000),
(100, '2025-12-10 00:19:51', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 100000 | Filas afectadas: 0', 40, 100000),
(101, '2025-12-10 00:26:43', 'ACTUALIZAR_PUNTAJE', 'ID: 41 | Puntaje: 0 | Filas afectadas: 0', 41, 0),
(102, '2025-12-10 00:26:46', 'ACTUALIZAR_PUNTAJE', 'ID: 41 | Puntaje: 0 | Filas afectadas: 0', 41, 0),
(103, '2025-12-10 00:30:31', 'ACTUALIZAR_PUNTAJE', 'ID: 42 | Puntaje: 0 | Filas afectadas: 0', 42, 0),
(104, '2025-12-10 00:30:34', 'ACTUALIZAR_PUNTAJE', 'ID: 42 | Puntaje: 0 | Filas afectadas: 0', 42, 0),
(105, '2025-12-10 00:31:22', 'ACTUALIZAR_PUNTAJE', 'ID: 42 | Puntaje: 0 | Filas afectadas: 0', 42, 0),
(106, '2025-12-10 00:33:46', 'ACTUALIZAR_PUNTAJE', 'ID: 42 | Puntaje: 0 | Filas afectadas: 0', 42, 0),
(107, '2025-12-10 00:33:49', 'INICIO', 'Validando respuesta - Pregunta: 6', 42, NULL),
(108, '2025-12-10 00:33:49', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 42, 100000),
(109, '2025-12-10 00:33:49', 'ACTUALIZAR_PUNTAJE', 'ID: 42 | Puntaje: 100000 | Filas afectadas: 1', 42, 100000),
(110, '2025-12-10 00:33:49', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 42, 100000),
(111, '2025-12-10 00:33:49', 'FIN', 'Redirigiendo a resultado.php', 42, 100000),
(112, '2025-12-10 00:33:50', 'ACTUALIZAR_PUNTAJE', 'ID: 42 | Puntaje: 100000 | Filas afectadas: 0', 42, 100000),
(113, '2025-12-10 00:33:53', 'ACTUALIZAR_PUNTAJE', 'ID: 42 | Puntaje: 100000 | Filas afectadas: 0', 42, 100000),
(114, '2025-12-10 00:34:00', 'INICIO', 'Validando respuesta - Pregunta: 12', 42, NULL),
(115, '2025-12-10 00:34:00', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 42, 0),
(116, '2025-12-10 00:34:00', 'ANTES_GUARDAR', 'BD actual: $100,000 | A guardar: $0', 42, 100000),
(117, '2025-12-10 00:34:01', 'ACTUALIZAR_PUNTAJE', 'ID: 42 | Puntaje: 0 | Filas afectadas: 1', 42, 0),
(118, '2025-12-10 00:34:01', 'DESPUES_GUARDAR', 'Resultado: ÉXITO ✓ | BD ahora: $0', 42, 0),
(119, '2025-12-10 00:34:01', 'FIN', 'Redirigiendo a resultado.php', 42, 0),
(120, '2025-12-10 00:34:05', 'ACTUALIZAR_PUNTAJE', 'ID: 42 | Puntaje: 0 | Filas afectadas: 0', 42, 0),
(121, '2025-12-10 11:54:29', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 1, 0),
(122, '2025-12-10 11:54:30', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 1', 1, 0),
(123, '2025-12-10 11:54:30', 'PUNTAJE_GUARDADO', 'Puntaje guardado: $0', 1, 0),
(124, '2025-12-10 11:54:30', 'REDIRECCION', 'Redirigiendo a resultado.php - Variables verificadas', 1, 0),
(125, '2025-12-10 11:54:48', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 0', 1, 0),
(126, '2025-12-10 11:55:24', 'INICIO', 'Validando respuesta - Pregunta: 12', 1, NULL),
(127, '2025-12-10 11:55:24', 'CORRECTA', 'Respuesta correcta | Dificultad: 2 | Ganado: $150,000 | Total: $150,000', 1, 150000),
(128, '2025-12-10 11:55:24', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 150000 | Filas afectadas: 1', 1, 150000),
(129, '2025-12-10 11:55:24', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 1, 150000),
(130, '2025-12-10 11:55:24', 'FIN', 'Redirigiendo a resultado.php', 1, 150000),
(131, '2025-12-10 11:58:32', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 1, 150000),
(132, '2025-12-10 11:58:32', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 150000 | Filas afectadas: 0', 1, 150000),
(133, '2025-12-10 11:58:32', 'PUNTAJE_GUARDADO', 'Puntaje guardado: $150,000', 1, 150000),
(134, '2025-12-10 11:58:32', 'REDIRECCION', 'Redirigiendo a resultado.php - Variables verificadas', 1, 150000),
(135, '2025-12-10 12:41:35', 'INICIO', 'Validando respuesta - Pregunta: 7', 44, NULL),
(136, '2025-12-10 12:41:35', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 44, 100000),
(137, '2025-12-10 12:41:35', 'ACTUALIZAR_PUNTAJE', 'ID: 44 | Puntaje: 100000 | Filas afectadas: 1', 44, 100000),
(138, '2025-12-10 12:41:35', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 44, 100000),
(139, '2025-12-10 12:41:35', 'FIN', 'Redirigiendo a resultado.php', 44, 100000),
(140, '2025-12-10 12:41:57', 'INICIO', 'Validando respuesta - Pregunta: 13', 44, NULL),
(141, '2025-12-10 12:41:57', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $100,000', 44, 100000),
(142, '2025-12-10 12:41:57', 'ANTES_GUARDAR', 'BD actual: $100,000 | A guardar: $100,000', 44, 100000),
(143, '2025-12-10 12:41:57', 'ACTUALIZAR_PUNTAJE', 'ID: 44 | Puntaje: 100000 | Filas afectadas: 0', 44, 100000),
(144, '2025-12-10 12:41:57', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $100,000', 44, 100000),
(145, '2025-12-10 12:41:57', 'FIN', 'Redirigiendo a resultado.php', 44, 100000),
(146, '2025-12-10 12:42:00', 'ACTUALIZAR_PUNTAJE', 'ID: 44 | Puntaje: 100000 | Filas afectadas: 0', 44, 100000),
(147, '2025-12-10 12:53:12', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 40, 0),
(148, '2025-12-10 12:53:12', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 0 | Filas afectadas: 1', 40, 0),
(149, '2025-12-10 12:53:12', 'PUNTAJE_GUARDADO', 'Puntaje guardado: $0', 40, 0),
(150, '2025-12-10 12:53:12', 'REDIRECCION', 'Redirigiendo a resultado.php - Variables verificadas', 40, 0),
(151, '2025-12-10 12:54:00', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 0 | Filas afectadas: 0', 40, 0),
(152, '2025-12-10 12:54:18', 'INICIO', 'Validando respuesta - Pregunta: 9', 40, NULL),
(153, '2025-12-10 12:54:18', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 40, 0),
(154, '2025-12-10 12:54:18', 'ANTES_GUARDAR', 'BD actual: $0 | A guardar: $0', 40, 0),
(155, '2025-12-10 12:54:18', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 0 | Filas afectadas: 0', 40, 0),
(156, '2025-12-10 12:54:18', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $0', 40, 0),
(157, '2025-12-10 12:54:18', 'FIN', 'Redirigiendo a resultado.php', 40, 0),
(158, '2025-12-10 12:54:20', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 0 | Filas afectadas: 0', 40, 0),
(159, '2025-12-10 12:54:29', 'INICIO', 'Validando respuesta - Pregunta: 3', 40, NULL),
(160, '2025-12-10 12:54:29', 'CORRECTA', 'Respuesta correcta | Dificultad: 3 | Ganado: $175,000 | Total: $175,000', 40, 175000),
(161, '2025-12-10 12:54:29', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 175000 | Filas afectadas: 1', 40, 175000),
(162, '2025-12-10 12:54:29', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 40, 175000),
(163, '2025-12-10 12:54:29', 'FIN', 'Redirigiendo a resultado.php', 40, 175000),
(164, '2025-12-10 12:54:39', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 175000 | Filas afectadas: 0', 40, 175000);

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

--
-- Dumping data for table `tbl_preguntas`
--

INSERT INTO `tbl_preguntas` (`ID_pregunta`, `enunciado_pregunta`, `opcion1_pregunta`, `opcion2_pregunta`, `opcion3_pregunta`, `opcion4_pregunta`, `correcta_pregunta`, `TBL_categorias_ID_categoria`, `TBL_dificultades_ID_dificultad`) VALUES
(1, '¿Cuál es el planeta más grande de nuestro Sistema Solar?', 'Júpiter', 'Saturno', 'Marte', 'Tierra', 'Júpiter', 1, 1),
(2, '¿Qué gas es el más abundante en la atmósfera terrestre?', 'Oxígeno', 'Nitrógeno', 'Dióxido de Carbono', 'Argón', 'Nitrógeno', 1, 2),
(3, '¿Quién escribió la obra \"Cien años de soledad\"?', 'Mario Vargas Llosa', 'Gabriel García Márquez', 'Pablo Neruda', 'Jorge Luis Borges', 'Gabriel García Márquez', 1, 3),
(4, '¿quien escribio it?', 'xddsad', 'xdddsadsad', 'stephen king', 'sdsafasd', '3', 1, 2),
(5, '¿Cuál es el río más largo del mundo?', 'Nilo', 'Amazonas', 'Yangtsé', 'Misisipi', 'Amazonas', 4, 1),
(6, '¿En qué deporte se utiliza un disco en lugar de una pelota?', 'Fútbol', 'Tenis', 'Hockey sobre hielo', 'Rugby', 'Hockey sobre hielo', 5, 1),
(7, '¿Quién es conocido como el \"Rey del Pop\"?', 'Prince', 'Michael Jackson', 'Elvis Presley', 'Freddie Mercury', 'Michael Jackson', 6, 1),
(8, '¿En qué año se lanzó el primer iPhone?', '2005', '2007', '2009', '2010', '2007', 7, 2),
(9, '¿Quién dirigió la película \"Titanic\"?', 'James Cameron', 'Steven Spielberg', 'Ridley Scott', 'Tim Burton', 'James Cameron', 8, 1),
(10, '¿Cuál es el país más grande del mundo?', 'China', 'Canadá', 'Rusia', 'Estados Unidos', 'Rusia', 9, 1),
(11, '¿Cuál es el valor de π aproximado?', '2.14', '3.14', '4.14', '3.41', '3.14', 10, 1),
(12, '¿Qué parte del cuerpo humano produce insulina?', 'Riñones', 'Páncreas', 'Hígado', 'Bazo', 'Páncreas', 11, 2),
(13, '¿Cuál fue la primera consola de videojuegos de Nintendo?', 'GameCube', 'NES', 'SNES', 'Game Boy', 'NES', 12, 2),
(14, '¿Cómo se llama la moneda oficial de Japón?', 'Yuan', 'Won', 'Yen', 'Baht', 'Yen', 13, 1);

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
-- Indexes for table `tbl_logs_debug`
--
ALTER TABLE `tbl_logs_debug`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `ID_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `ID_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_codigoacesso`
--
ALTER TABLE `tbl_codigoacesso`
  MODIFY `ID_codigoAcesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_comodines`
--
ALTER TABLE `tbl_comodines`
  MODIFY `ID_comodines` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_dificultades`
--
ALTER TABLE `tbl_dificultades`
  MODIFY `ID_dificultad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_jugadores`
--
ALTER TABLE `tbl_jugadores`
  MODIFY `ID_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_logs_debug`
--
ALTER TABLE `tbl_logs_debug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `tbl_preguntas`
--
ALTER TABLE `tbl_preguntas`
  MODIFY `ID_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
