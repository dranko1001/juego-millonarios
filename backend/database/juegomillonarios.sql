-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2025 at 01:20 AM
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
(1, 'admin', '$2y$10$Mtgnw50skf9RwGo2iSdWV.VgQJMgDV9F2JpF6sk/oVYfuDnd.K2Ei'),
(2, 'lola', '$2y$10$D9LiDI9vLIbHcPjkT54RnebL9AAmUhzzfj.OTUIvEFXx.IAZWZbom');

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
(1, '520902', 1, '2025-12-05'),
(5, '123456', 1, '2025-12-12');

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
(1, '3064749', 'frank', 200000),
(2, '3064749', '123', 0),
(3, 'FJ001', 'juanito', 15432),
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
(44, '454545', 'frank', 100000),
(45, '45645', 'frank', 150000),
(46, '4545454', 'frank', 150000),
(47, '777777777', 'quasimodo', 200000),
(48, '3064749', 'asas', 0),
(49, '454654', 'frank', 0),
(50, '3216504', 'daniela alzate', 600000),
(51, '1212152', 'bladimir silva', 1125000),
(52, '3064749', 'angel', 400000),
(53, '54654', 'dsd', 0),
(54, '4542556', 'walter', 100000),
(55, '47474747', 'lucelly', 1125000);

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
(164, '2025-12-10 12:54:39', 'ACTUALIZAR_PUNTAJE', 'ID: 40 | Puntaje: 175000 | Filas afectadas: 0', 40, 175000),
(165, '2025-12-10 16:02:02', 'INICIO', 'Validando respuesta - Pregunta: 2', 45, NULL),
(166, '2025-12-10 16:02:02', 'CORRECTA', 'Respuesta correcta | Dificultad: 2 | Ganado: $150,000 | Total: $150,000', 45, 150000),
(167, '2025-12-10 16:02:02', 'ACTUALIZAR_PUNTAJE', 'ID: 45 | Puntaje: 150000 | Filas afectadas: 1', 45, 150000),
(168, '2025-12-10 16:02:02', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 45, 150000),
(169, '2025-12-10 16:02:02', 'FIN', 'Redirigiendo a resultado.php', 45, 150000),
(170, '2025-12-10 16:02:23', 'INICIO', 'Validando respuesta - Pregunta: 9', 45, NULL),
(171, '2025-12-10 16:02:23', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $150,000', 45, 150000),
(172, '2025-12-10 16:02:23', 'ANTES_GUARDAR', 'BD actual: $150,000 | A guardar: $150,000', 45, 150000),
(173, '2025-12-10 16:02:23', 'ACTUALIZAR_PUNTAJE', 'ID: 45 | Puntaje: 150000 | Filas afectadas: 0', 45, 150000),
(174, '2025-12-10 16:02:23', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $150,000', 45, 150000),
(175, '2025-12-10 16:02:23', 'FIN', 'Redirigiendo a resultado.php', 45, 150000),
(176, '2025-12-10 16:10:01', 'INICIO', 'Validando respuesta - Pregunta: 9', 46, NULL),
(177, '2025-12-10 16:10:01', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 46, 100000),
(178, '2025-12-10 16:10:01', 'ACTUALIZAR_PUNTAJE', 'ID: 46 | Puntaje: 100000 | Filas afectadas: 1', 46, 100000),
(179, '2025-12-10 16:10:01', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 46, 100000),
(180, '2025-12-10 16:10:01', 'FIN', 'Redirigiendo a resultado.php', 46, 100000),
(181, '2025-12-10 16:10:09', 'ACTUALIZAR_PUNTAJE', 'ID: 46 | Puntaje: 100000 | Filas afectadas: 0', 46, 100000),
(182, '2025-12-10 16:10:31', 'INICIO', 'Validando respuesta - Pregunta: 12', 46, NULL),
(183, '2025-12-10 16:10:31', 'CORRECTA', 'Respuesta correcta | Dificultad: 2 | Ganado: $150,000 | Total: $150,000', 46, 150000),
(184, '2025-12-10 16:10:32', 'ACTUALIZAR_PUNTAJE', 'ID: 46 | Puntaje: 150000 | Filas afectadas: 1', 46, 150000),
(185, '2025-12-10 16:10:32', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 46, 150000),
(186, '2025-12-10 16:10:32', 'FIN', 'Redirigiendo a resultado.php', 46, 150000),
(187, '2025-12-10 16:10:38', 'ACTUALIZAR_PUNTAJE', 'ID: 46 | Puntaje: 150000 | Filas afectadas: 0', 46, 150000),
(188, '2025-12-11 02:25:46', 'INICIO', 'Validando respuesta - Pregunta: 66', 1, NULL),
(189, '2025-12-11 02:25:46', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 1, 0),
(190, '2025-12-11 02:25:46', 'ANTES_GUARDAR', 'BD actual: $150,000 | A guardar: $0', 1, 150000),
(191, '2025-12-11 02:25:46', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 1', 1, 0),
(192, '2025-12-11 02:25:46', 'DESPUES_GUARDAR', 'Resultado: ÉXITO ✓ | BD ahora: $0', 1, 0),
(193, '2025-12-11 02:25:46', 'FIN', 'Redirigiendo a resultado.php', 1, 0),
(194, '2025-12-11 02:27:49', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 1, 0),
(195, '2025-12-11 02:27:49', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 0', 1, 0),
(196, '2025-12-11 02:27:49', 'PUNTAJE_GUARDADO', 'Puntaje guardado: $0', 1, 0),
(197, '2025-12-11 02:27:49', 'REDIRECCION', 'Redirigiendo a resultado.php - Variables verificadas', 1, 0),
(198, '2025-12-11 02:35:49', 'INICIO', 'Validando respuesta - Pregunta: 82', 1, NULL),
(199, '2025-12-11 02:35:50', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 1, 100000),
(200, '2025-12-11 02:35:50', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 100000 | Filas afectadas: 1', 1, 100000),
(201, '2025-12-11 02:35:50', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 1, 100000),
(202, '2025-12-11 02:35:50', 'FIN', 'Redirigiendo a resultado.php', 1, 100000),
(203, '2025-12-11 02:40:00', 'INICIO', 'Validando respuesta - Pregunta: 78', 1, NULL),
(204, '2025-12-11 02:40:00', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $100,000', 1, 100000),
(205, '2025-12-11 02:40:00', 'ANTES_GUARDAR', 'BD actual: $100,000 | A guardar: $100,000', 1, 100000),
(206, '2025-12-11 02:40:00', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 100000 | Filas afectadas: 0', 1, 100000),
(207, '2025-12-11 02:40:00', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $100,000', 1, 100000),
(208, '2025-12-11 02:40:01', 'FIN', 'Redirigiendo a resultado.php', 1, 100000),
(209, '2025-12-11 02:40:03', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 100000 | Filas afectadas: 0', 1, 100000),
(210, '2025-12-11 11:11:38', 'INICIO', 'Validando respuesta - Pregunta: 66', 47, NULL),
(211, '2025-12-11 11:11:38', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 47, 0),
(212, '2025-12-11 11:11:38', 'ANTES_GUARDAR', 'BD actual: $0 | A guardar: $0', 47, 0),
(213, '2025-12-11 11:11:38', 'ACTUALIZAR_PUNTAJE', 'ID: 47 | Puntaje: 0 | Filas afectadas: 0', 47, 0),
(214, '2025-12-11 11:11:38', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $0', 47, 0),
(215, '2025-12-11 11:11:38', 'FIN', 'Redirigiendo a resultado.php', 47, 0),
(216, '2025-12-11 11:11:41', 'ACTUALIZAR_PUNTAJE', 'ID: 47 | Puntaje: 0 | Filas afectadas: 0', 47, 0),
(217, '2025-12-11 11:11:55', 'INICIO', 'Validando respuesta - Pregunta: 67', 47, NULL),
(218, '2025-12-11 11:11:55', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 47, 100000),
(219, '2025-12-11 11:11:55', 'ACTUALIZAR_PUNTAJE', 'ID: 47 | Puntaje: 100000 | Filas afectadas: 1', 47, 100000),
(220, '2025-12-11 11:11:55', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 47, 100000),
(221, '2025-12-11 11:11:55', 'FIN', 'Redirigiendo a resultado.php', 47, 100000),
(222, '2025-12-11 11:12:07', 'INICIO', 'Validando respuesta - Pregunta: 71', 47, NULL),
(223, '2025-12-11 11:12:07', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $200,000', 47, 200000),
(224, '2025-12-11 11:12:07', 'ACTUALIZAR_PUNTAJE', 'ID: 47 | Puntaje: 200000 | Filas afectadas: 1', 47, 200000),
(225, '2025-12-11 11:12:07', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 47, 200000),
(226, '2025-12-11 11:12:07', 'FIN', 'Redirigiendo a resultado.php', 47, 200000),
(227, '2025-12-11 11:13:31', 'INICIO', 'Validando respuesta - Pregunta: 10', 47, NULL),
(228, '2025-12-11 11:13:31', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $200,000', 47, 200000),
(229, '2025-12-11 11:13:31', 'ANTES_GUARDAR', 'BD actual: $200,000 | A guardar: $200,000', 47, 200000),
(230, '2025-12-11 11:13:31', 'ACTUALIZAR_PUNTAJE', 'ID: 47 | Puntaje: 200000 | Filas afectadas: 0', 47, 200000),
(231, '2025-12-11 11:13:31', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $200,000', 47, 200000),
(232, '2025-12-11 11:13:31', 'FIN', 'Redirigiendo a resultado.php', 47, 200000),
(233, '2025-12-11 12:17:41', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 1, 0),
(234, '2025-12-11 12:17:41', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 1', 1, 0),
(235, '2025-12-11 12:17:41', 'PUNTAJE_GUARDADO', 'Puntaje guardado: $0', 1, 0),
(236, '2025-12-11 12:17:41', 'REDIRECCION', 'Redirigiendo a resultado.php - Variables verificadas', 1, 0),
(237, '2025-12-11 12:25:23', 'INICIO', 'Validando respuesta - Pregunta: 66', 1, NULL),
(238, '2025-12-11 12:25:23', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 1, 0),
(239, '2025-12-11 12:25:23', 'ANTES_GUARDAR', 'BD actual: $0 | A guardar: $0', 1, 0),
(240, '2025-12-11 12:25:23', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 0', 1, 0),
(241, '2025-12-11 12:25:23', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $0', 1, 0),
(242, '2025-12-11 12:25:23', 'FIN', 'Redirigiendo a resultado.php', 1, 0),
(243, '2025-12-11 12:25:26', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 0', 1, 0),
(244, '2025-12-11 12:29:09', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 1, 0),
(245, '2025-12-11 12:29:09', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 0', 1, 0),
(246, '2025-12-11 12:29:09', 'PUNTAJE_GUARDADO', 'Puntaje guardado: $0', 1, 0),
(247, '2025-12-11 12:29:09', 'REDIRECCION', 'Redirigiendo a resultado.php - Variables verificadas', 1, 0),
(248, '2025-12-11 12:29:12', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 0', 1, 0),
(249, '2025-12-11 12:29:30', 'INICIO', 'Validando respuesta - Pregunta: 75', 1, NULL),
(250, '2025-12-11 12:29:31', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 1, 0),
(251, '2025-12-11 12:29:31', 'ANTES_GUARDAR', 'BD actual: $0 | A guardar: $0', 1, 0),
(252, '2025-12-11 12:29:31', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 0', 1, 0),
(253, '2025-12-11 12:29:31', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $0', 1, 0),
(254, '2025-12-11 12:29:31', 'FIN', 'Redirigiendo a resultado.php', 1, 0),
(255, '2025-12-11 12:29:32', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 0', 1, 0),
(256, '2025-12-11 12:29:35', 'INICIO', 'Validando respuesta - Pregunta: 74', 1, NULL),
(257, '2025-12-11 12:29:35', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 1, 0),
(258, '2025-12-11 12:29:35', 'ANTES_GUARDAR', 'BD actual: $0 | A guardar: $0', 1, 0),
(259, '2025-12-11 12:29:35', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 0', 1, 0),
(260, '2025-12-11 12:29:35', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $0', 1, 0),
(261, '2025-12-11 12:29:35', 'FIN', 'Redirigiendo a resultado.php', 1, 0),
(262, '2025-12-11 12:32:45', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 0', 1, 0),
(263, '2025-12-11 14:05:22', 'INICIO', 'Validando respuesta - Pregunta: 9', 50, NULL),
(264, '2025-12-11 14:05:22', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 50, 0),
(265, '2025-12-11 14:05:22', 'ANTES_GUARDAR', 'BD actual: $0 | A guardar: $0', 50, 0),
(266, '2025-12-11 14:05:22', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 0 | Filas afectadas: 0', 50, 0),
(267, '2025-12-11 14:05:22', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $0', 50, 0),
(268, '2025-12-11 14:05:22', 'FIN', 'Redirigiendo a resultado.php', 50, 0),
(269, '2025-12-11 14:05:46', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 0 | Filas afectadas: 0', 50, 0),
(270, '2025-12-11 14:06:22', 'INICIO', 'Validando respuesta - Pregunta: 75', 50, NULL),
(271, '2025-12-11 14:06:22', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 50, 0),
(272, '2025-12-11 14:06:22', 'ANTES_GUARDAR', 'BD actual: $0 | A guardar: $0', 50, 0),
(273, '2025-12-11 14:06:22', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 0 | Filas afectadas: 0', 50, 0),
(274, '2025-12-11 14:06:22', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $0', 50, 0),
(275, '2025-12-11 14:06:22', 'FIN', 'Redirigiendo a resultado.php', 50, 0),
(276, '2025-12-11 14:06:51', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 0 | Filas afectadas: 0', 50, 0),
(277, '2025-12-11 14:07:11', 'INICIO', 'Validando respuesta - Pregunta: 86', 50, NULL),
(278, '2025-12-11 14:07:11', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 50, 100000),
(279, '2025-12-11 14:07:11', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 100000 | Filas afectadas: 1', 50, 100000),
(280, '2025-12-11 14:07:11', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 100000),
(281, '2025-12-11 14:07:11', 'FIN', 'Redirigiendo a resultado.php', 50, 100000),
(282, '2025-12-11 14:07:23', 'INICIO', 'Validando respuesta - Pregunta: 84', 50, NULL),
(283, '2025-12-11 14:07:23', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $200,000', 50, 200000),
(284, '2025-12-11 14:07:23', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 200000 | Filas afectadas: 1', 50, 200000),
(285, '2025-12-11 14:07:23', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 200000),
(286, '2025-12-11 14:07:23', 'FIN', 'Redirigiendo a resultado.php', 50, 200000),
(287, '2025-12-11 14:08:13', 'INICIO', 'Validando respuesta - Pregunta: 82', 50, NULL),
(288, '2025-12-11 14:08:13', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $300,000', 50, 300000),
(289, '2025-12-11 14:08:13', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 300000 | Filas afectadas: 1', 50, 300000),
(290, '2025-12-11 14:08:13', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 300000),
(291, '2025-12-11 14:08:13', 'FIN', 'Redirigiendo a resultado.php', 50, 300000),
(292, '2025-12-11 14:09:25', 'INICIO', 'Validando respuesta - Pregunta: 68', 50, NULL),
(293, '2025-12-11 14:09:25', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $300,000', 50, 300000),
(294, '2025-12-11 14:09:25', 'ANTES_GUARDAR', 'BD actual: $300,000 | A guardar: $300,000', 50, 300000),
(295, '2025-12-11 14:09:25', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 300000 | Filas afectadas: 0', 50, 300000),
(296, '2025-12-11 14:09:25', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $300,000', 50, 300000),
(297, '2025-12-11 14:09:25', 'FIN', 'Redirigiendo a resultado.php', 50, 300000),
(298, '2025-12-11 14:10:22', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 300000 | Filas afectadas: 0', 50, 300000),
(299, '2025-12-11 14:10:55', 'INICIO', 'Validando respuesta - Pregunta: 71', 50, NULL),
(300, '2025-12-11 14:10:55', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 50, 100000),
(301, '2025-12-11 14:10:55', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 100000 | Filas afectadas: 1', 50, 100000),
(302, '2025-12-11 14:10:55', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 100000),
(303, '2025-12-11 14:10:55', 'FIN', 'Redirigiendo a resultado.php', 50, 100000),
(304, '2025-12-11 14:12:32', 'INICIO', 'Validando respuesta - Pregunta: 14', 50, NULL),
(305, '2025-12-11 14:12:32', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $200,000', 50, 200000),
(306, '2025-12-11 14:12:32', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 200000 | Filas afectadas: 1', 50, 200000),
(307, '2025-12-11 14:12:32', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 200000),
(308, '2025-12-11 14:12:32', 'FIN', 'Redirigiendo a resultado.php', 50, 200000),
(309, '2025-12-11 14:12:42', 'INICIO', 'Validando respuesta - Pregunta: 5', 50, NULL),
(310, '2025-12-11 14:12:42', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $300,000', 50, 300000),
(311, '2025-12-11 14:12:42', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 300000 | Filas afectadas: 1', 50, 300000),
(312, '2025-12-11 14:12:42', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 300000),
(313, '2025-12-11 14:12:42', 'FIN', 'Redirigiendo a resultado.php', 50, 300000),
(314, '2025-12-11 14:13:02', 'INICIO', 'Validando respuesta - Pregunta: 80', 50, NULL),
(315, '2025-12-11 14:13:02', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $400,000', 50, 400000),
(316, '2025-12-11 14:13:02', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 400000 | Filas afectadas: 1', 50, 400000),
(317, '2025-12-11 14:13:02', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 400000),
(318, '2025-12-11 14:13:02', 'FIN', 'Redirigiendo a resultado.php', 50, 400000),
(319, '2025-12-11 14:13:16', 'INICIO', 'Validando respuesta - Pregunta: 84', 50, NULL),
(320, '2025-12-11 14:13:16', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $500,000', 50, 500000),
(321, '2025-12-11 14:13:16', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 500000 | Filas afectadas: 1', 50, 500000),
(322, '2025-12-11 14:13:16', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 500000),
(323, '2025-12-11 14:13:16', 'FIN', 'Redirigiendo a resultado.php', 50, 500000),
(324, '2025-12-11 14:15:20', 'TIEMPO_AGOTADO', 'Tiempo agotado - Transcurrido: 121s | Límite: 120s', 50, 500000),
(325, '2025-12-11 14:15:20', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 500000 | Filas afectadas: 0', 50, 500000),
(326, '2025-12-11 14:15:35', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 500000 | Filas afectadas: 0', 50, 500000),
(327, '2025-12-11 14:15:41', 'INICIO', 'Validando respuesta - Pregunta: 84', 50, NULL),
(328, '2025-12-11 14:15:41', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 50, 100000),
(329, '2025-12-11 14:15:41', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 100000 | Filas afectadas: 1', 50, 100000),
(330, '2025-12-11 14:15:41', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 100000),
(331, '2025-12-11 14:15:41', 'FIN', 'Redirigiendo a resultado.php', 50, 100000),
(332, '2025-12-11 14:16:06', 'INICIO', 'Validando respuesta - Pregunta: 71', 50, NULL),
(333, '2025-12-11 14:16:07', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $200,000', 50, 200000),
(334, '2025-12-11 14:16:07', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 200000 | Filas afectadas: 1', 50, 200000),
(335, '2025-12-11 14:16:07', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 200000),
(336, '2025-12-11 14:16:07', 'FIN', 'Redirigiendo a resultado.php', 50, 200000),
(337, '2025-12-11 14:16:36', 'INICIO', 'Validando respuesta - Pregunta: 86', 50, NULL),
(338, '2025-12-11 14:16:36', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $300,000', 50, 300000),
(339, '2025-12-11 14:16:36', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 300000 | Filas afectadas: 1', 50, 300000),
(340, '2025-12-11 14:16:36', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 300000),
(341, '2025-12-11 14:16:36', 'FIN', 'Redirigiendo a resultado.php', 50, 300000),
(342, '2025-12-11 14:16:43', 'INICIO', 'Validando respuesta - Pregunta: 65', 50, NULL),
(343, '2025-12-11 14:16:43', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $400,000', 50, 400000),
(344, '2025-12-11 14:16:43', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 400000 | Filas afectadas: 1', 50, 400000),
(345, '2025-12-11 14:16:43', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 400000),
(346, '2025-12-11 14:16:43', 'FIN', 'Redirigiendo a resultado.php', 50, 400000),
(347, '2025-12-11 14:16:57', 'INICIO', 'Validando respuesta - Pregunta: 66', 50, NULL),
(348, '2025-12-11 14:16:57', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $500,000', 50, 500000),
(349, '2025-12-11 14:16:57', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 500000 | Filas afectadas: 1', 50, 500000),
(350, '2025-12-11 14:16:57', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 500000),
(351, '2025-12-11 14:16:57', 'FIN', 'Redirigiendo a resultado.php', 50, 500000),
(352, '2025-12-11 14:17:08', 'INICIO', 'Validando respuesta - Pregunta: 78', 50, NULL),
(353, '2025-12-11 14:17:08', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $500,000', 50, 500000),
(354, '2025-12-11 14:17:08', 'ANTES_GUARDAR', 'BD actual: $500,000 | A guardar: $500,000', 50, 500000),
(355, '2025-12-11 14:17:08', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 500000 | Filas afectadas: 0', 50, 500000),
(356, '2025-12-11 14:17:08', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $500,000', 50, 500000),
(357, '2025-12-11 14:17:08', 'FIN', 'Redirigiendo a resultado.php', 50, 500000),
(358, '2025-12-11 14:17:12', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 500000 | Filas afectadas: 0', 50, 500000),
(359, '2025-12-11 14:17:29', 'INICIO', 'Validando respuesta - Pregunta: 69', 50, NULL),
(360, '2025-12-11 14:17:29', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 50, 0),
(361, '2025-12-11 14:17:29', 'ANTES_GUARDAR', 'BD actual: $500,000 | A guardar: $0', 50, 500000),
(362, '2025-12-11 14:17:29', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 0 | Filas afectadas: 1', 50, 0),
(363, '2025-12-11 14:17:29', 'DESPUES_GUARDAR', 'Resultado: ÉXITO ✓ | BD ahora: $0', 50, 0),
(364, '2025-12-11 14:17:29', 'FIN', 'Redirigiendo a resultado.php', 50, 0),
(365, '2025-12-11 14:17:32', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 0 | Filas afectadas: 0', 50, 0),
(366, '2025-12-11 14:17:39', 'INICIO', 'Validando respuesta - Pregunta: 9', 50, NULL),
(367, '2025-12-11 14:17:39', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 50, 0),
(368, '2025-12-11 14:17:39', 'ANTES_GUARDAR', 'BD actual: $0 | A guardar: $0', 50, 0),
(369, '2025-12-11 14:17:39', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 0 | Filas afectadas: 0', 50, 0),
(370, '2025-12-11 14:17:39', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $0', 50, 0),
(371, '2025-12-11 14:17:39', 'FIN', 'Redirigiendo a resultado.php', 50, 0),
(372, '2025-12-11 14:17:43', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 0 | Filas afectadas: 0', 50, 0),
(373, '2025-12-11 14:17:56', 'INICIO', 'Validando respuesta - Pregunta: 10', 50, NULL),
(374, '2025-12-11 14:17:56', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 50, 100000),
(375, '2025-12-11 14:17:56', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 100000 | Filas afectadas: 1', 50, 100000),
(376, '2025-12-11 14:17:56', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 100000),
(377, '2025-12-11 14:17:56', 'FIN', 'Redirigiendo a resultado.php', 50, 100000),
(378, '2025-12-11 14:18:10', 'INICIO', 'Validando respuesta - Pregunta: 79', 50, NULL),
(379, '2025-12-11 14:18:10', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $200,000', 50, 200000),
(380, '2025-12-11 14:18:10', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 200000 | Filas afectadas: 1', 50, 200000),
(381, '2025-12-11 14:18:10', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 200000),
(382, '2025-12-11 14:18:10', 'FIN', 'Redirigiendo a resultado.php', 50, 200000),
(383, '2025-12-11 14:18:16', 'INICIO', 'Validando respuesta - Pregunta: 82', 50, NULL),
(384, '2025-12-11 14:18:16', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $300,000', 50, 300000),
(385, '2025-12-11 14:18:16', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 300000 | Filas afectadas: 1', 50, 300000),
(386, '2025-12-11 14:18:16', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 300000),
(387, '2025-12-11 14:18:17', 'FIN', 'Redirigiendo a resultado.php', 50, 300000),
(388, '2025-12-11 14:18:30', 'INICIO', 'Validando respuesta - Pregunta: 75', 50, NULL),
(389, '2025-12-11 14:18:30', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $300,000', 50, 300000),
(390, '2025-12-11 14:18:30', 'ANTES_GUARDAR', 'BD actual: $300,000 | A guardar: $300,000', 50, 300000),
(391, '2025-12-11 14:18:30', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 300000 | Filas afectadas: 0', 50, 300000),
(392, '2025-12-11 14:18:30', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $300,000', 50, 300000),
(393, '2025-12-11 14:18:30', 'FIN', 'Redirigiendo a resultado.php', 50, 300000),
(394, '2025-12-11 14:18:32', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 300000 | Filas afectadas: 0', 50, 300000),
(395, '2025-12-11 14:18:37', 'INICIO', 'Validando respuesta - Pregunta: 84', 50, NULL),
(396, '2025-12-11 14:18:37', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 50, 100000),
(397, '2025-12-11 14:18:37', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 100000 | Filas afectadas: 1', 50, 100000),
(398, '2025-12-11 14:18:37', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 100000),
(399, '2025-12-11 14:18:37', 'FIN', 'Redirigiendo a resultado.php', 50, 100000),
(400, '2025-12-11 14:18:48', 'INICIO', 'Validando respuesta - Pregunta: 86', 50, NULL),
(401, '2025-12-11 14:18:48', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $200,000', 50, 200000),
(402, '2025-12-11 14:18:48', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 200000 | Filas afectadas: 1', 50, 200000),
(403, '2025-12-11 14:18:48', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 200000),
(404, '2025-12-11 14:18:48', 'FIN', 'Redirigiendo a resultado.php', 50, 200000),
(405, '2025-12-11 14:18:54', 'INICIO', 'Validando respuesta - Pregunta: 82', 50, NULL),
(406, '2025-12-11 14:18:54', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $300,000', 50, 300000),
(407, '2025-12-11 14:18:54', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 300000 | Filas afectadas: 1', 50, 300000),
(408, '2025-12-11 14:18:54', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 300000),
(409, '2025-12-11 14:18:54', 'FIN', 'Redirigiendo a resultado.php', 50, 300000),
(410, '2025-12-11 14:19:02', 'INICIO', 'Validando respuesta - Pregunta: 79', 50, NULL),
(411, '2025-12-11 14:19:02', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $400,000', 50, 400000),
(412, '2025-12-11 14:19:02', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 400000 | Filas afectadas: 1', 50, 400000),
(413, '2025-12-11 14:19:02', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 400000),
(414, '2025-12-11 14:19:02', 'FIN', 'Redirigiendo a resultado.php', 50, 400000),
(415, '2025-12-11 14:19:10', 'INICIO', 'Validando respuesta - Pregunta: 11', 50, NULL),
(416, '2025-12-11 14:19:10', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $500,000', 50, 500000),
(417, '2025-12-11 14:19:10', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 500000 | Filas afectadas: 1', 50, 500000),
(418, '2025-12-11 14:19:10', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 500000),
(419, '2025-12-11 14:19:10', 'FIN', 'Redirigiendo a resultado.php', 50, 500000),
(420, '2025-12-11 14:19:17', 'INICIO', 'Validando respuesta - Pregunta: 5', 50, NULL),
(421, '2025-12-11 14:19:17', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $600,000', 50, 600000),
(422, '2025-12-11 14:19:17', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 600000 | Filas afectadas: 1', 50, 600000),
(423, '2025-12-11 14:19:17', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 50, 600000),
(424, '2025-12-11 14:19:17', 'FIN', 'Redirigiendo a resultado.php', 50, 600000),
(425, '2025-12-11 14:19:26', 'INICIO', 'Validando respuesta - Pregunta: 2', 50, NULL),
(426, '2025-12-11 14:19:26', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $600,000', 50, 600000),
(427, '2025-12-11 14:19:26', 'ANTES_GUARDAR', 'BD actual: $600,000 | A guardar: $600,000', 50, 600000),
(428, '2025-12-11 14:19:26', 'ACTUALIZAR_PUNTAJE', 'ID: 50 | Puntaje: 600000 | Filas afectadas: 0', 50, 600000),
(429, '2025-12-11 14:19:26', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $600,000', 50, 600000),
(430, '2025-12-11 14:19:26', 'FIN', 'Redirigiendo a resultado.php', 50, 600000),
(431, '2025-12-11 14:23:32', 'INICIO', 'Validando respuesta - Pregunta: 71', 51, NULL),
(432, '2025-12-11 14:23:32', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 51, 100000),
(433, '2025-12-11 14:23:32', 'ACTUALIZAR_PUNTAJE', 'ID: 51 | Puntaje: 100000 | Filas afectadas: 1', 51, 100000),
(434, '2025-12-11 14:23:32', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 51, 100000),
(435, '2025-12-11 14:23:32', 'FIN', 'Redirigiendo a resultado.php', 51, 100000),
(436, '2025-12-11 14:23:51', 'INICIO', 'Validando respuesta - Pregunta: 10', 51, NULL),
(437, '2025-12-11 14:23:51', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $200,000', 51, 200000),
(438, '2025-12-11 14:23:51', 'ACTUALIZAR_PUNTAJE', 'ID: 51 | Puntaje: 200000 | Filas afectadas: 1', 51, 200000),
(439, '2025-12-11 14:23:51', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 51, 200000),
(440, '2025-12-11 14:23:51', 'FIN', 'Redirigiendo a resultado.php', 51, 200000),
(441, '2025-12-11 14:24:01', 'INICIO', 'Validando respuesta - Pregunta: 65', 51, NULL),
(442, '2025-12-11 14:24:01', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $300,000', 51, 300000),
(443, '2025-12-11 14:24:01', 'ACTUALIZAR_PUNTAJE', 'ID: 51 | Puntaje: 300000 | Filas afectadas: 1', 51, 300000),
(444, '2025-12-11 14:24:01', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 51, 300000),
(445, '2025-12-11 14:24:01', 'FIN', 'Redirigiendo a resultado.php', 51, 300000),
(446, '2025-12-11 14:24:14', 'INICIO', 'Validando respuesta - Pregunta: 11', 51, NULL),
(447, '2025-12-11 14:24:14', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $400,000', 51, 400000),
(448, '2025-12-11 14:24:15', 'ACTUALIZAR_PUNTAJE', 'ID: 51 | Puntaje: 400000 | Filas afectadas: 1', 51, 400000),
(449, '2025-12-11 14:24:15', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 51, 400000),
(450, '2025-12-11 14:24:15', 'FIN', 'Redirigiendo a resultado.php', 51, 400000),
(451, '2025-12-11 14:24:26', 'INICIO', 'Validando respuesta - Pregunta: 13', 51, NULL),
(452, '2025-12-11 14:24:26', 'CORRECTA', 'Respuesta correcta | Dificultad: 2 | Ganado: $150,000 | Total: $550,000', 51, 550000),
(453, '2025-12-11 14:24:26', 'ACTUALIZAR_PUNTAJE', 'ID: 51 | Puntaje: 550000 | Filas afectadas: 1', 51, 550000),
(454, '2025-12-11 14:24:26', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 51, 550000),
(455, '2025-12-11 14:24:26', 'FIN', 'Redirigiendo a resultado.php', 51, 550000),
(456, '2025-12-11 14:24:35', 'INICIO', 'Validando respuesta - Pregunta: 70', 51, NULL),
(457, '2025-12-11 14:24:35', 'CORRECTA', 'Respuesta correcta | Dificultad: 2 | Ganado: $150,000 | Total: $700,000', 51, 700000),
(458, '2025-12-11 14:24:35', 'ACTUALIZAR_PUNTAJE', 'ID: 51 | Puntaje: 700000 | Filas afectadas: 1', 51, 700000),
(459, '2025-12-11 14:24:35', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 51, 700000),
(460, '2025-12-11 14:24:35', 'FIN', 'Redirigiendo a resultado.php', 51, 700000),
(461, '2025-12-11 14:24:47', 'INICIO', 'Validando respuesta - Pregunta: 66', 51, NULL),
(462, '2025-12-11 14:24:47', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $800,000', 51, 800000),
(463, '2025-12-11 14:24:47', 'ACTUALIZAR_PUNTAJE', 'ID: 51 | Puntaje: 800000 | Filas afectadas: 1', 51, 800000),
(464, '2025-12-11 14:24:47', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 51, 800000),
(465, '2025-12-11 14:24:47', 'FIN', 'Redirigiendo a resultado.php', 51, 800000),
(466, '2025-12-11 14:24:56', 'INICIO', 'Validando respuesta - Pregunta: 3', 51, NULL),
(467, '2025-12-11 14:24:56', 'CORRECTA', 'Respuesta correcta | Dificultad: 3 | Ganado: $175,000 | Total: $975,000', 51, 975000),
(468, '2025-12-11 14:24:56', 'ACTUALIZAR_PUNTAJE', 'ID: 51 | Puntaje: 975000 | Filas afectadas: 1', 51, 975000),
(469, '2025-12-11 14:24:56', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 51, 975000),
(470, '2025-12-11 14:24:56', 'FIN', 'Redirigiendo a resultado.php', 51, 975000),
(471, '2025-12-11 14:25:08', 'INICIO', 'Validando respuesta - Pregunta: 85', 51, NULL),
(472, '2025-12-11 14:25:08', 'CORRECTA', 'Respuesta correcta | Dificultad: 2 | Ganado: $150,000 | Total: $1,125,000', 51, 1125000),
(473, '2025-12-11 14:25:08', 'ACTUALIZAR_PUNTAJE', 'ID: 51 | Puntaje: 1125000 | Filas afectadas: 1', 51, 1125000),
(474, '2025-12-11 14:25:08', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 51, 1125000),
(475, '2025-12-11 14:25:08', 'FIN', 'Redirigiendo a resultado.php', 51, 1125000),
(476, '2025-12-11 18:30:07', 'TIEMPO_AGOTADO_AUTO', 'Redirección automática por tiempo agotado', 1, 0),
(477, '2025-12-11 18:30:07', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 0', 1, 0),
(478, '2025-12-11 18:30:07', 'PUNTAJE_GUARDADO', 'Puntaje guardado: $0', 1, 0),
(479, '2025-12-11 18:30:07', 'REDIRECCION', 'Redirigiendo a resultado.php - Variables verificadas', 1, 0),
(480, '2025-12-11 18:46:02', 'INICIO', 'Validando respuesta - Pregunta: 224', 1, NULL),
(481, '2025-12-11 18:46:02', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 1, 100000),
(482, '2025-12-11 18:46:02', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 100000 | Filas afectadas: 1', 1, 100000),
(483, '2025-12-11 18:46:02', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 1, 100000),
(484, '2025-12-11 18:46:02', 'FIN', 'Redirigiendo a resultado.php', 1, 100000),
(485, '2025-12-11 18:51:41', 'INICIO', 'Validando respuesta - Pregunta: 38', 52, NULL),
(486, '2025-12-11 18:51:41', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 52, 100000),
(487, '2025-12-11 18:51:41', 'ACTUALIZAR_PUNTAJE', 'ID: 52 | Puntaje: 100000 | Filas afectadas: 1', 52, 100000),
(488, '2025-12-11 18:51:41', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 52, 100000),
(489, '2025-12-11 18:51:41', 'FIN', 'Redirigiendo a resultado.php', 52, 100000),
(490, '2025-12-11 18:53:09', 'INICIO', 'Validando respuesta - Pregunta: 23', 52, NULL),
(491, '2025-12-11 18:53:09', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $200,000', 52, 200000),
(492, '2025-12-11 18:53:09', 'ACTUALIZAR_PUNTAJE', 'ID: 52 | Puntaje: 200000 | Filas afectadas: 1', 52, 200000),
(493, '2025-12-11 18:53:09', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 52, 200000),
(494, '2025-12-11 18:53:09', 'FIN', 'Redirigiendo a resultado.php', 52, 200000),
(495, '2025-12-11 18:54:05', 'INICIO', 'Validando respuesta - Pregunta: 20', 52, NULL),
(496, '2025-12-11 18:54:05', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $300,000', 52, 300000),
(497, '2025-12-11 18:54:05', 'ACTUALIZAR_PUNTAJE', 'ID: 52 | Puntaje: 300000 | Filas afectadas: 1', 52, 300000),
(498, '2025-12-11 18:54:05', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 52, 300000),
(499, '2025-12-11 18:54:05', 'FIN', 'Redirigiendo a resultado.php', 52, 300000),
(500, '2025-12-11 18:54:20', 'INICIO', 'Validando respuesta - Pregunta: 5', 52, NULL);
INSERT INTO `tbl_logs_debug` (`id`, `fecha`, `tipo`, `mensaje`, `id_jugador`, `puntaje`) VALUES
(501, '2025-12-11 18:54:21', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $400,000', 52, 400000),
(502, '2025-12-11 18:54:21', 'ACTUALIZAR_PUNTAJE', 'ID: 52 | Puntaje: 400000 | Filas afectadas: 1', 52, 400000),
(503, '2025-12-11 18:54:21', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 52, 400000),
(504, '2025-12-11 18:54:21', 'FIN', 'Redirigiendo a resultado.php', 52, 400000),
(505, '2025-12-11 18:54:29', 'INICIO', 'Validando respuesta - Pregunta: 24', 52, NULL),
(506, '2025-12-11 18:54:29', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $400,000', 52, 400000),
(507, '2025-12-11 18:54:29', 'ANTES_GUARDAR', 'BD actual: $400,000 | A guardar: $400,000', 52, 400000),
(508, '2025-12-11 18:54:29', 'ACTUALIZAR_PUNTAJE', 'ID: 52 | Puntaje: 400000 | Filas afectadas: 0', 52, 400000),
(509, '2025-12-11 18:54:29', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $400,000', 52, 400000),
(510, '2025-12-11 18:54:29', 'FIN', 'Redirigiendo a resultado.php', 52, 400000),
(511, '2025-12-11 19:02:16', 'INICIO', 'Validando respuesta - Pregunta: 119', 1, NULL),
(512, '2025-12-11 19:02:16', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 1, 100000),
(513, '2025-12-11 19:02:16', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 100000 | Filas afectadas: 0', 1, 100000),
(514, '2025-12-11 19:02:16', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: FALLÓ', 1, 100000),
(515, '2025-12-11 19:02:16', 'FIN', 'Redirigiendo a resultado.php', 1, 100000),
(516, '2025-12-11 19:02:44', 'INICIO', 'Validando respuesta - Pregunta: 199', 1, NULL),
(517, '2025-12-11 19:02:44', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $200,000', 1, 200000),
(518, '2025-12-11 19:02:44', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 200000 | Filas afectadas: 1', 1, 200000),
(519, '2025-12-11 19:02:44', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 1, 200000),
(520, '2025-12-11 19:02:44', 'FIN', 'Redirigiendo a resultado.php', 1, 200000),
(521, '2025-12-11 19:03:14', 'INICIO', 'Validando respuesta - Pregunta: 50', 1, NULL),
(522, '2025-12-11 19:03:14', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $300,000', 1, 300000),
(523, '2025-12-11 19:03:14', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 300000 | Filas afectadas: 1', 1, 300000),
(524, '2025-12-11 19:03:14', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 1, 300000),
(525, '2025-12-11 19:03:14', 'FIN', 'Redirigiendo a resultado.php', 1, 300000),
(526, '2025-12-11 19:03:23', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 300000 | Filas afectadas: 0', 1, 300000),
(527, '2025-12-12 01:30:01', 'INICIO', 'Validando respuesta - Pregunta: 5', 1, NULL),
(528, '2025-12-12 01:30:01', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 1, 100000),
(529, '2025-12-12 01:30:01', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 100000 | Filas afectadas: 1', 1, 100000),
(530, '2025-12-12 01:30:01', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 1, 100000),
(531, '2025-12-12 01:30:01', 'FIN', 'Redirigiendo a resultado.php', 1, 100000),
(532, '2025-12-12 01:30:03', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 100000 | Filas afectadas: 0', 1, 100000),
(533, '2025-12-12 01:49:11', 'INICIO', 'Validando respuesta - Pregunta: 5', 1, NULL),
(534, '2025-12-12 01:49:11', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 1, 100000),
(535, '2025-12-12 01:49:11', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 100000 | Filas afectadas: 0', 1, 100000),
(536, '2025-12-12 01:49:11', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: FALLÓ', 1, 100000),
(537, '2025-12-12 01:49:11', 'FIN', 'Redirigiendo a resultado.php', 1, 100000),
(538, '2025-12-12 01:49:13', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 100000 | Filas afectadas: 0', 1, 100000),
(539, '2025-12-12 11:26:48', 'INICIO', 'Validando respuesta - Pregunta: 61', 1, NULL),
(540, '2025-12-12 11:26:48', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 1, 100000),
(541, '2025-12-12 11:26:48', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 100000 | Filas afectadas: 0', 1, 100000),
(542, '2025-12-12 11:26:49', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: FALLÓ', 1, 100000),
(543, '2025-12-12 11:26:49', 'FIN', 'Redirigiendo a resultado.php', 1, 100000),
(544, '2025-12-12 11:27:08', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 100000 | Filas afectadas: 0', 1, 100000),
(545, '2025-12-12 11:32:16', 'INICIO', 'Validando respuesta - Pregunta: 38', 54, NULL),
(546, '2025-12-12 11:32:16', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 54, 100000),
(547, '2025-12-12 11:32:16', 'ACTUALIZAR_PUNTAJE', 'ID: 54 | Puntaje: 100000 | Filas afectadas: 1', 54, 100000),
(548, '2025-12-12 11:32:16', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 54, 100000),
(549, '2025-12-12 11:32:16', 'FIN', 'Redirigiendo a resultado.php', 54, 100000),
(550, '2025-12-12 11:32:27', 'ACTUALIZAR_PUNTAJE', 'ID: 54 | Puntaje: 100000 | Filas afectadas: 0', 54, 100000),
(551, '2025-12-12 17:51:14', 'INICIO', 'Validando respuesta - Pregunta: 23', 55, NULL),
(552, '2025-12-12 17:51:14', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 55, 100000),
(553, '2025-12-12 17:51:14', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 100000 | Filas afectadas: 1', 55, 100000),
(554, '2025-12-12 17:51:14', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 55, 100000),
(555, '2025-12-12 17:51:14', 'FIN', 'Redirigiendo a resultado.php', 55, 100000),
(556, '2025-12-12 17:51:58', 'INICIO', 'Validando respuesta - Pregunta: 86', 55, NULL),
(557, '2025-12-12 17:51:58', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $100,000', 55, 100000),
(558, '2025-12-12 17:51:58', 'ANTES_GUARDAR', 'BD actual: $100,000 | A guardar: $100,000', 55, 100000),
(559, '2025-12-12 17:51:58', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 100000 | Filas afectadas: 0', 55, 100000),
(560, '2025-12-12 17:51:58', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $100,000', 55, 100000),
(561, '2025-12-12 17:51:58', 'FIN', 'Redirigiendo a resultado.php', 55, 100000),
(562, '2025-12-12 17:52:36', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 100000 | Filas afectadas: 0', 55, 100000),
(563, '2025-12-12 17:53:06', 'INICIO', 'Validando respuesta - Pregunta: 143', 55, NULL),
(564, '2025-12-12 17:53:06', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 55, 100000),
(565, '2025-12-12 17:53:06', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 100000 | Filas afectadas: 0', 55, 100000),
(566, '2025-12-12 17:53:06', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: FALLÓ', 55, 100000),
(567, '2025-12-12 17:53:06', 'FIN', 'Redirigiendo a resultado.php', 55, 100000),
(568, '2025-12-12 17:55:03', 'INICIO', 'Validando respuesta - Pregunta: 14', 55, NULL),
(569, '2025-12-12 17:55:03', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $200,000', 55, 200000),
(570, '2025-12-12 17:55:03', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 200000 | Filas afectadas: 1', 55, 200000),
(571, '2025-12-12 17:55:03', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 55, 200000),
(572, '2025-12-12 17:55:03', 'FIN', 'Redirigiendo a resultado.php', 55, 200000),
(573, '2025-12-12 17:55:32', 'INICIO', 'Validando respuesta - Pregunta: 207', 55, NULL),
(574, '2025-12-12 17:55:32', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $300,000', 55, 300000),
(575, '2025-12-12 17:55:32', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 300000 | Filas afectadas: 1', 55, 300000),
(576, '2025-12-12 17:55:32', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 55, 300000),
(577, '2025-12-12 17:55:32', 'FIN', 'Redirigiendo a resultado.php', 55, 300000),
(578, '2025-12-12 17:56:27', 'INICIO', 'Validando respuesta - Pregunta: 97', 55, NULL),
(579, '2025-12-12 17:56:27', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $400,000', 55, 400000),
(580, '2025-12-12 17:56:27', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 400000 | Filas afectadas: 1', 55, 400000),
(581, '2025-12-12 17:56:27', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 55, 400000),
(582, '2025-12-12 17:56:27', 'FIN', 'Redirigiendo a resultado.php', 55, 400000),
(583, '2025-12-12 17:56:43', 'INICIO', 'Validando respuesta - Pregunta: 12', 55, NULL),
(584, '2025-12-12 17:56:43', 'CORRECTA', 'Respuesta correcta | Dificultad: 2 | Ganado: $150,000 | Total: $550,000', 55, 550000),
(585, '2025-12-12 17:56:43', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 550000 | Filas afectadas: 1', 55, 550000),
(586, '2025-12-12 17:56:43', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 55, 550000),
(587, '2025-12-12 17:56:43', 'FIN', 'Redirigiendo a resultado.php', 55, 550000),
(588, '2025-12-12 17:57:11', 'INICIO', 'Validando respuesta - Pregunta: 82', 55, NULL),
(589, '2025-12-12 17:57:11', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $650,000', 55, 650000),
(590, '2025-12-12 17:57:11', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 650000 | Filas afectadas: 1', 55, 650000),
(591, '2025-12-12 17:57:11', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 55, 650000),
(592, '2025-12-12 17:57:11', 'FIN', 'Redirigiendo a resultado.php', 55, 650000),
(593, '2025-12-12 17:57:27', 'INICIO', 'Validando respuesta - Pregunta: 49', 55, NULL),
(594, '2025-12-12 17:57:27', 'CORRECTA', 'Respuesta correcta | Dificultad: 3 | Ganado: $175,000 | Total: $825,000', 55, 825000),
(595, '2025-12-12 17:57:27', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 825000 | Filas afectadas: 1', 55, 825000),
(596, '2025-12-12 17:57:27', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 55, 825000),
(597, '2025-12-12 17:57:27', 'FIN', 'Redirigiendo a resultado.php', 55, 825000),
(598, '2025-12-12 17:57:50', 'INICIO', 'Validando respuesta - Pregunta: 145', 55, NULL),
(599, '2025-12-12 17:57:50', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $925,000', 55, 925000),
(600, '2025-12-12 17:57:50', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 925000 | Filas afectadas: 1', 55, 925000),
(601, '2025-12-12 17:57:50', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 55, 925000),
(602, '2025-12-12 17:57:50', 'FIN', 'Redirigiendo a resultado.php', 55, 925000),
(603, '2025-12-12 17:58:13', 'INICIO', 'Validando respuesta - Pregunta: 84', 55, NULL),
(604, '2025-12-12 17:58:13', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $1,025,000', 55, 1025000),
(605, '2025-12-12 17:58:13', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 1025000 | Filas afectadas: 1', 55, 1025000),
(606, '2025-12-12 17:58:13', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 55, 1025000),
(607, '2025-12-12 17:58:13', 'FIN', 'Redirigiendo a resultado.php', 55, 1025000),
(608, '2025-12-12 17:58:31', 'INICIO', 'Validando respuesta - Pregunta: 224', 55, NULL),
(609, '2025-12-12 17:58:31', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $1,125,000', 55, 1125000),
(610, '2025-12-12 17:58:31', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 1125000 | Filas afectadas: 1', 55, 1125000),
(611, '2025-12-12 17:58:31', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 55, 1125000),
(612, '2025-12-12 17:58:31', 'FIN', 'Redirigiendo a resultado.php', 55, 1125000),
(613, '2025-12-12 17:59:42', 'INICIO', 'Validando respuesta - Pregunta: 94', 55, NULL),
(614, '2025-12-12 17:59:42', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $1,125,000', 55, 1125000),
(615, '2025-12-12 17:59:42', 'ANTES_GUARDAR', 'BD actual: $1,125,000 | A guardar: $1,125,000', 55, 1125000),
(616, '2025-12-12 17:59:42', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 1125000 | Filas afectadas: 0', 55, 1125000),
(617, '2025-12-12 17:59:42', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $1,125,000', 55, 1125000),
(618, '2025-12-12 17:59:42', 'FIN', 'Redirigiendo a resultado.php', 55, 1125000),
(619, '2025-12-12 18:00:00', 'ACTUALIZAR_PUNTAJE', 'ID: 55 | Puntaje: 1125000 | Filas afectadas: 0', 55, 1125000),
(620, '2025-12-12 23:08:11', 'INICIO', 'Validando respuesta - Pregunta: 152', 1, NULL),
(621, '2025-12-12 23:08:11', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $0', 1, 0),
(622, '2025-12-12 23:08:11', 'ANTES_GUARDAR', 'BD actual: $100,000 | A guardar: $0', 1, 100000),
(623, '2025-12-12 23:08:11', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 1', 1, 0),
(624, '2025-12-12 23:08:11', 'DESPUES_GUARDAR', 'Resultado: ÉXITO ✓ | BD ahora: $0', 1, 0),
(625, '2025-12-12 23:08:11', 'FIN', 'Redirigiendo a resultado.php', 1, 0),
(626, '2025-12-12 23:08:15', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 0 | Filas afectadas: 0', 1, 0),
(627, '2025-12-12 23:08:21', 'INICIO', 'Validando respuesta - Pregunta: 18', 1, NULL),
(628, '2025-12-12 23:08:21', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $100,000', 1, 100000),
(629, '2025-12-12 23:08:21', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 100000 | Filas afectadas: 1', 1, 100000),
(630, '2025-12-12 23:08:21', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 1, 100000),
(631, '2025-12-12 23:08:21', 'FIN', 'Redirigiendo a resultado.php', 1, 100000),
(632, '2025-12-12 23:10:21', 'INICIO', 'Validando respuesta - Pregunta: 176', 1, NULL),
(633, '2025-12-12 23:10:21', 'CORRECTA', 'Respuesta correcta | Dificultad: 1 | Ganado: $100,000 | Total: $200,000', 1, 200000),
(634, '2025-12-12 23:10:21', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 200000 | Filas afectadas: 1', 1, 200000),
(635, '2025-12-12 23:10:21', 'GUARDAR_CORRECTA', 'Guardado después de correcta - Resultado: ÉXITO', 1, 200000),
(636, '2025-12-12 23:10:21', 'FIN', 'Redirigiendo a resultado.php', 1, 200000),
(637, '2025-12-12 23:11:35', 'INICIO', 'Validando respuesta - Pregunta: 50', 1, NULL),
(638, '2025-12-12 23:11:35', 'INCORRECTA', 'Respuesta incorrecta | Puntaje final: $200,000', 1, 200000),
(639, '2025-12-12 23:11:36', 'ANTES_GUARDAR', 'BD actual: $200,000 | A guardar: $200,000', 1, 200000),
(640, '2025-12-12 23:11:36', 'ACTUALIZAR_PUNTAJE', 'ID: 1 | Puntaje: 200000 | Filas afectadas: 0', 1, 200000),
(641, '2025-12-12 23:11:36', 'DESPUES_GUARDAR', 'Resultado: FALLÓ ✗ | BD ahora: $200,000', 1, 200000),
(642, '2025-12-12 23:11:36', 'FIN', 'Redirigiendo a resultado.php', 1, 200000);

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
  MODIFY `ID_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `ID_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_codigoacesso`
--
ALTER TABLE `tbl_codigoacesso`
  MODIFY `ID_codigoAcesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `ID_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_logs_debug`
--
ALTER TABLE `tbl_logs_debug`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=643;

--
-- AUTO_INCREMENT for table `tbl_preguntas`
--
ALTER TABLE `tbl_preguntas`
  MODIFY `ID_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

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
