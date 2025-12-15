-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2025 at 01:53 PM
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
(28, 'Administración'),
(3, 'Arte y Literatura'),
(18, 'Astronomía'),
(13, 'Biología'),
(2, 'Ciencia'),
(11, 'Cine y TV'),
(31, 'Cocina'),
(29, 'Contabilidad'),
(30, 'Costura'),
(12, 'Cultura General'),
(5, 'Deportes'),
(15, 'Economía'),
(24, 'Educación'),
(6, 'Entretenimiento'),
(19, 'Filosofía'),
(16, 'Física'),
(4, 'Geografía'),
(26, 'Halloween'),
(1, 'Historia'),
(8, 'Matemáticas'),
(9, 'Música'),
(10, 'Naturaleza'),
(27, 'Navidad'),
(22, 'Política'),
(20, 'Psicología'),
(17, 'Química'),
(23, 'Religión'),
(25, 'SENA'),
(21, 'Sociología'),
(7, 'Tecnología'),
(14, 'Videojuegos');

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
(1, '3064749', 'santiago', 300000),
(2, '3064749', 'Angel', 300000),
(3, '474849', 'natalia mayor', 200000),
(6, '4564654', 'michael', 100000);

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

--
-- Dumping data for table `tbl_preguntas`
--

INSERT INTO `tbl_preguntas` (`ID_pregunta`, `enunciado_pregunta`, `opcion1_pregunta`, `opcion2_pregunta`, `opcion3_pregunta`, `opcion4_pregunta`, `correcta_pregunta`, `TBL_categorias_ID_categoria`, `TBL_dificultades_ID_dificultad`) VALUES
(1, '¿En qué año cayó el Muro de Berlín?', '1991', '1989', '1985', '1995', '1989', 1, 1),
(2, '¿Qué civilización construyó las pirámides de Guiza?', 'Romana', 'Azteca', 'Egipcia', 'Mesopotámica', 'Egipcia', 1, 1),
(3, '¿Quién fue el primer presidente de los Estados Unidos?', 'Thomas Jefferson', 'George Washington', 'Abraham Lincoln', 'John Adams', 'George Washington', 1, 1),
(4, '¿En qué siglo se descubrió América?', 'Siglo XVII', 'Siglo XIV', 'Siglo XVI', 'Siglo XV', 'Siglo XV', 1, 1),
(5, '¿Qué conflicto es conocido como la Gran Guerra?', 'Guerra Fría', 'Primera Guerra Mundial', 'Guerra Civil Española', 'Segunda Guerra Mundial', 'Primera Guerra Mundial', 1, 1),
(6, '¿Cuál fue el primer metal usado por el ser humano?', 'Hierro', 'Oro', 'Cobre', 'Bronce', 'Cobre', 1, 1),
(7, '¿Qué emperador romano legalizó el cristianismo?', 'Constantino I', 'Nerón', 'Augusto', 'Trajano', 'Constantino I', 1, 1),
(8, '¿Qué invento se le atribuye a Thomas Edison?', 'El teléfono', 'La imprenta', 'La máquina de vapor', 'La bombilla', 'La bombilla', 1, 1),
(9, '¿Quién fue el líder de la Alemania nazi?', 'Joseph Stalin', 'Benito Mussolini', 'Adolf Hitler', 'Winston Churchill', 'Adolf Hitler', 1, 1),
(10, '¿Qué evento histórico ocurrió en 1492?', 'Revolución Francesa', 'Descubrimiento de América', 'Invención de la imprenta', 'Caída de Constantinopla', 'Descubrimiento de América', 1, 1),
(11, '¿Cuál fue el nombre original de la ciudad de Estambul?', 'Bizancio', 'Alejandría', 'Cartago', 'Persépolis', 'Bizancio', 1, 2),
(12, '¿Qué personaje histórico redactó las 95 Tesis?', 'Juan Calvino', 'Martín Lutero', 'Enrique VIII', 'Erasmo de Rotterdam', 'Martín Lutero', 1, 2),
(13, '¿Qué batalla marcó el fin del Imperio Napoleónico?', 'Batalla de Austerlitz', 'Batalla de Trafalgar', 'Batalla de Waterloo', 'Batalla de Leipzig', 'Batalla de Waterloo', 1, 2),
(14, '¿Cuál era el nombre de la ruta comercial que conectaba Oriente con Occidente?', 'Ruta del Incienso', 'Ruta de la Seda', 'Ruta de la Sal', 'Vía Apia', 'Ruta de la Seda', 1, 2),
(15, '¿Quién fue el primer Canciller de Alemania unificada en 1871?', 'Kaiser Guillermo I', 'Otto von Bismarck', 'Helmuth von Moltke', 'Adolf Hitler', 'Otto von Bismarck', 1, 2),
(16, '¿Qué famoso filósofo griego fue maestro de Alejandro Magno?', 'Sócrates', 'Platón', 'Aristóteles', 'Heráclito', 'Aristóteles', 1, 2),
(17, '¿Qué tratado puso fin oficialmente a la Primera Guerra Mundial?', 'Tratado de Versalles', 'Pacto de Múnich', 'Tratado de Trianón', 'Tratado de Brest-Litovsk', 'Tratado de Versalles', 1, 3),
(18, '¿En qué año se firmó la Carta Magna en Inglaterra?', '1066', '1215', '1453', '1588', '1215', 1, 3),
(19, '¿Qué dinastía china ordenó la construcción de la Gran Muralla?', 'Han', 'Qin', 'Ming', 'Tang', 'Qin', 1, 3),
(20, '¿Qué evento es considerado el detonante de la Guerra de Secesión de EE. UU.?', 'La Batalla de Gettysburg', 'La elección de Lincoln', 'El ataque a Fort Sumter', 'La Proclamación de Emancipación', 'El ataque a Fort Sumter', 1, 3),
(21, '¿Cuál es el gas más abundante en la atmósfera terrestre?', 'Oxígeno', 'Nitrógeno', 'Dióxido de carbono', 'Argón', 'Nitrógeno', 2, 1),
(22, '¿Cuál es el planeta más grande de nuestro sistema solar?', 'Tierra', 'Marte', 'Júpiter', 'Saturno', 'Júpiter', 2, 1),
(23, '¿Qué unidad se utiliza para medir la corriente eléctrica?', 'Voltio', 'Ohmio', 'Vatio', 'Amperio', 'Amperio', 2, 1),
(24, '¿Cuál es la fórmula química del agua?', 'CO2', 'O2', 'H2O', 'NaCl', 'H2O', 2, 1),
(25, '¿Qué parte de la célula produce energía?', 'Núcleo', 'Mitocondria', 'Ribosoma', 'Membrana', 'Mitocondria', 2, 1),
(26, '¿Qué tipo de energía produce el Sol?', 'Geotérmica', 'Nuclear', 'Eólica', 'Hidráulica', 'Nuclear', 2, 1),
(27, '¿Qué fuerza mantiene a los planetas en órbita alrededor del Sol?', 'Fuerza centrífuga', 'Electromagnetismo', 'Gravedad', 'Fricción', 'Gravedad', 2, 1),
(28, '¿Cuál es el elemento químico con el símbolo \"Fe\"?', 'Flúor', 'Fósforo', 'Fierro (Hierro)', 'Francio', 'Fierro (Hierro)', 2, 1),
(29, '¿Qué es un ecosistema?', 'Una comunidad de plantas', 'Una comunidad de animales', 'Un conjunto de organismos vivos y su entorno físico', 'Un área desértica', 'Un conjunto de organismos vivos y su entorno físico', 2, 1),
(30, '¿Qué rama de la ciencia estudia los seres vivos?', 'Física', 'Química', 'Biología', 'Astronomía', 'Biología', 2, 1),
(31, '¿Cuál es el nombre del hueso más largo del cuerpo humano?', 'Peroné', 'Fémur', 'Tibia', 'Húmero', 'Fémur', 2, 2),
(32, '¿Quién postuló la Teoría de la Relatividad?', 'Isaac Newton', 'Albert Einstein', 'Galileo Galilei', 'Niels Bohr', 'Albert Einstein', 2, 2),
(33, '¿Qué significa la palabra \"pH\" en química?', 'Potencial Hidrógeno', 'Poder Calórico', 'Presión Hídrica', 'Peso de la Hebra', 'Potencial Hidrógeno', 2, 2),
(34, '¿Qué gas liberan las plantas durante la fotosíntesis?', 'Dióxido de carbono', 'Oxígeno', 'Vapor de agua', 'Nitrógeno', 'Oxígeno', 2, 2),
(35, '¿Qué capa de la atmósfera protege a la Tierra de la radiación ultravioleta?', 'Troposfera', 'Estratosfera', 'Ionosfera', 'Mesosfera', 'Estratosfera', 2, 2),
(36, '¿Cuál es la partícula subatómica que tiene carga negativa?', 'Protón', 'Neutrón', 'Electrón', 'Positrón', 'Electrón', 2, 2),
(37, '¿Qué ley de Newton establece que la fuerza es igual a la masa por la aceleración (F=ma)?', 'Primera Ley', 'Segunda Ley', 'Tercera Ley', 'Ley de la Gravitación Universal', 'Segunda Ley', 2, 3),
(38, '¿Cuál es el proceso por el cual las bacterias se dividen para reproducirse?', 'Mitosis', 'Meiosis', 'Bipartición', 'Gemación', 'Bipartición', 2, 3),
(39, '¿Qué científico desarrolló la nomenclatura binomial para clasificar organismos?', 'Charles Darwin', 'Gregor Mendel', 'Carl Linnaeus', 'Louis Pasteur', 'Carl Linnaeus', 2, 3),
(40, '¿Cómo se llama la estrella más cercana a nuestro sistema solar (aparte del Sol)?', 'Sirio', 'Alpha Centauri', 'Próxima Centauri', 'Vega', 'Próxima Centauri', 2, 3),
(41, '¿Quién pintó la Mona Lisa?', 'Vincent van Gogh', 'Leonardo da Vinci', 'Pablo Picasso', 'Claude Monet', 'Leonardo da Vinci', 3, 1),
(42, '¿De qué nacionalidad era el escritor Gabriel García Márquez?', 'Chilena', 'Argentina', 'Española', 'Colombiana', 'Colombiana', 3, 1),
(43, '¿Qué obra de Shakespeare incluye a los personajes Romeo y Julieta?', 'Hamlet', 'Macbeth', 'Otelo', 'Romeo y Julieta', 'Romeo y Julieta', 3, 1),
(44, '¿Qué famoso edificio romano se conoce por su forma circular y su cúpula abierta (óculo)?', 'Coliseo', 'Panteón', 'Foro Romano', 'Acueducto', 'Panteón', 3, 1),
(45, '¿Quién escribió \"Don Quijote de la Mancha\"?', 'Lope de Vega', 'Miguel de Cervantes', 'Calderón de la Barca', 'Tirso de Molina', 'Miguel de Cervantes', 3, 1),
(46, '¿Cuál es el nombre del famoso detective creado por Arthur Conan Doyle?', 'Hércules Poirot', 'Sherlock Holmes', 'Miss Marple', 'Phileas Fogg', 'Sherlock Holmes', 3, 1),
(47, '¿Qué color predomina en el periodo azul de Pablo Picasso?', 'Rojo', 'Verde', 'Azul', 'Amarillo', 'Azul', 3, 1),
(48, '¿Qué instrumento musical es a menudo representado junto al dios Apolo en la mitología griega?', 'Flauta', 'Arpa', 'Lira', 'Trompeta', 'Lira', 3, 1),
(49, '¿Qué escritora británica creó el personaje de Jane Eyre?', 'Jane Austen', 'Emily Brontë', 'Charlotte Brontë', 'Mary Shelley', 'Charlotte Brontë', 3, 1),
(50, '¿Cuál es la escultura más famosa de Miguel Ángel, que representa al pastor bíblico?', 'La Piedad', 'El Pensador', 'El David', 'El Discóbolo', 'El David', 3, 1),
(51, '¿Qué movimiento artístico se caracteriza por sueños y el subconsciente, con artistas como Dalí?', 'Impresionismo', 'Cubismo', 'Surrealismo', 'Expresionismo', 'Surrealismo', 3, 2),
(52, '¿Quién es el autor de la novela \"Cien años de soledad\"?', 'Mario Vargas Llosa', 'Jorge Luis Borges', 'Isabel Allende', 'Gabriel García Márquez', 'Gabriel García Márquez', 3, 2),
(53, '¿Cuál es el nombre de la famosa pintura de Edvard Munch que muestra una figura angustiada?', 'El Beso', 'La Noche Estrellada', 'El Grito', 'Guernica', 'El Grito', 3, 2),
(54, '¿En qué ciudad se encuentra el Museo del Prado?', 'Barcelona', 'París', 'Madrid', 'Roma', 'Madrid', 3, 2),
(55, '¿Qué poeta romano es conocido por escribir la \"Eneida\"?', 'Horacio', 'Ovidio', 'Virgilio', 'Catulo', 'Virgilio', 3, 2),
(56, '¿Quién es considerado el padre del Renacimiento italiano?', 'Giotto', 'Donatello', 'Brunelleschi', 'Masaccio', 'Giotto', 3, 2),
(57, '¿Quién escribió el \"Ulises\", considerada una de las obras más importantes de la literatura modernista?', 'Virginia Woolf', 'James Joyce', 'T.S. Eliot', 'Marcel Proust', 'James Joyce', 3, 3),
(58, '¿Qué filósofo fue el autor de la obra \"Así habló Zaratustra\"?', 'Sartre', 'Nietzsche', 'Heidegger', 'Camus', 'Nietzsche', 3, 3),
(59, '¿Cuál es la técnica de pintura que utiliza pigmentos disueltos en agua y aplicados sobre yeso húmedo?', 'Óleo', 'Temple', 'Fresco', 'Acuarela', 'Fresco', 3, 3),
(60, '¿Cuál es el seudónimo del poeta chileno Neftalí Reyes Basoalto?', 'Vicente Huidobro', 'Pablo Neruda', 'Gabriela Mistral', 'Nicanor Parra', 'Pablo Neruda', 3, 3),
(61, '¿Cuál es el río más largo del mundo?', 'Mississippi', 'Nilo', 'Amazonas', 'Yangtsé', 'Amazonas', 4, 1),
(62, '¿Cuál es el continente más grande del mundo?', 'África', 'América', 'Europa', 'Asia', 'Asia', 4, 1),
(63, '¿Qué país es famoso por su forma de bota?', 'Francia', 'Grecia', 'Italia', 'España', 'Italia', 4, 1),
(64, '¿Qué océano separa a África de América?', 'Pacífico', 'Índico', 'Atlántico', 'Ártico', 'Atlántico', 4, 1),
(65, '¿Cuál es la capital de Australia?', 'Sídney', 'Melbourne', 'Canberra', 'Brisbane', 'Canberra', 4, 1),
(66, '¿Qué cordillera atraviesa América del Sur?', 'Alpes', 'Rocosas', 'Andes', 'Himalaya', 'Andes', 4, 1),
(67, '¿Cuál es el estado de la materia predominante en el interior de la Tierra?', 'Líquido', 'Sólido', 'Gaseoso', 'Plasma', 'Sólido', 4, 1),
(68, '¿Cuál es el país más poblado del mundo?', 'India', 'China', 'Estados Unidos', 'Indonesia', 'India', 4, 1),
(69, '¿Qué estrecho separa Europa de África?', 'Estrecho de Dover', 'Estrecho de Gibraltar', 'Estrecho de Bering', 'Estrecho de Magallanes', 'Estrecho de Gibraltar', 4, 1),
(70, '¿Qué es un volcán inactivo que no ha entrado en erupción en miles de años?', 'Activo', 'Dormido', 'Extinto', 'Durmiente', 'Extinto', 4, 1),
(71, '¿Cuál es el desierto más grande del mundo (caliente)?', 'Gobi', 'Kalahari', 'Sahara', 'Atacama', 'Sahara', 4, 2),
(72, '¿Qué país tiene la mayor cantidad de husos horarios?', 'Rusia', 'China', 'Canadá', 'Francia', 'Francia', 4, 2),
(73, '¿Qué nombre recibe la capa de la Tierra que se encuentra justo debajo de la corteza?', 'Núcleo interno', 'Núcleo externo', 'Manto', 'Litosfera', 'Manto', 4, 2),
(74, '¿Cuál es el lago de agua dulce más grande del mundo por volumen?', 'Lago Superior', 'Mar Caspio', 'Lago Baikal', 'Lago Victoria', 'Lago Baikal', 4, 2),
(75, '¿En qué país se encuentra la ciudad de Marrakech?', 'Egipto', 'Túnez', 'Marruecos', 'Argelia', 'Marruecos', 4, 2),
(76, '¿Qué isla caribeña comparte su territorio con Haití?', 'Cuba', 'Jamaica', 'Puerto Rico', 'República Dominicana', 'República Dominicana', 4, 2),
(77, '¿Cuál es el punto más bajo de la superficie terrestre continental?', 'El Mar Muerto', 'Fosa de las Marianas', 'Valle de la Muerte', 'Lago Baikal', 'El Mar Muerto', 4, 3),
(78, '¿Cuál es el sistema montañoso donde se encuentra el Monte Everest?', 'Alpes', 'Karakórum', 'Himalaya', 'Andes', 'Himalaya', 4, 3),
(79, '¿Qué país es el único que limita con la Bahía de Hudson y el Océano Ártico, Atlántico y Pacífico?', 'Estados Unidos', 'Canadá', 'Rusia', 'Groenlandia', 'Canadá', 4, 3),
(80, '¿Qué tipo de formación geográfica es un atolón?', 'Volcán submarino', 'Isla de origen coralino', 'Glaciar costero', 'Cabo rocoso', 'Isla de origen coralino', 4, 3),
(81, '¿Qué país ha ganado más Copas Mundiales de la FIFA hasta la fecha?', 'Alemania', 'Argentina', 'Brasil', 'Italia', 'Brasil', 5, 1),
(82, '¿Cuántos jugadores hay en un equipo de baloncesto en la cancha?', '6', '5', '7', '4', '5', 5, 1),
(83, '¿En qué deporte se utiliza la palabra \"ace\"?', 'Baloncesto', 'Natación', 'Tenis', 'Golf', 'Tenis', 5, 1),
(84, '¿Qué color de tarjeta utiliza el árbitro para expulsar a un jugador en fútbol?', 'Amarilla', 'Verde', 'Roja', 'Azul', 'Roja', 5, 1),
(85, '¿En qué deporte se utiliza la expresión \"Home Run\"?', 'Fútbol', 'Tenis', 'Béisbol', 'Voleibol', 'Béisbol', 5, 1),
(86, '¿Quién es conocido como \"El Rey\" del fútbol?', 'Pelé', 'Maradona', 'Messi', 'Cristiano Ronaldo', 'Pelé', 5, 1),
(87, '¿Cuál es la distancia de una maratón clásica en kilómetros?', '21 km', '35 km', '42.195 km', '50 km', '42.195 km', 5, 1),
(88, '¿En qué ciudad se celebraron los primeros Juegos Olímpicos de la Edad Moderna?', 'Atenas', 'Roma', 'Londres', 'París', 'Atenas', 5, 1),
(89, '¿Cuántos hoyos se juegan típicamente en una ronda de golf?', '12', '18', '9', '24', '18', 5, 1),
(90, '¿Qué deporte utiliza un disco o \"puck\"?', 'Hockey sobre hielo', 'Curling', 'Bandy', 'Polo', 'Hockey sobre hielo', 5, 1),
(91, '¿Quién es el máximo ganador de títulos de Grand Slam en la historia del tenis masculino?', 'Rafael Nadal', 'Roger Federer', 'Novak Djokovic', 'Pete Sampras', 'Novak Djokovic', 5, 2),
(92, '¿Cada cuántos años se celebran los Juegos Olímpicos de Verano?', '2 años', '3 años', '4 años', '5 años', '4 años', 5, 2),
(93, '¿En qué deporte destaca Michael Phelps?', 'Atletismo', 'Gimnasia', 'Natación', 'Ciclismo', 'Natación', 5, 2),
(94, '¿Cuál es el nombre del estadio principal del equipo de fútbol FC Barcelona?', 'Santiago Bernabéu', 'Wembley', 'Camp Nou', 'San Siro', 'Camp Nou', 5, 2),
(95, '¿Cuántos puntos vale un tiro libre en baloncesto?', '3 puntos', '2 puntos', '1 punto', '0 puntos', '1 punto', 5, 2),
(96, '¿Qué país inventó el Taekwondo?', 'China', 'Japón', 'Corea', 'Tailandia', 'Corea', 5, 2),
(97, '¿Qué ciclista ha ganado más Tour de Francia en la historia (registros oficiales)?', 'Eddy Merckx', 'Bernard Hinault', 'Miguel Indurain', 'Jacques Anquetil', 'Eddy Merckx', 5, 3),
(98, '¿En qué país se originó el deporte del Cricket?', 'India', 'Australia', 'Inglaterra', 'Sudáfrica', 'Inglaterra', 5, 3),
(99, '¿Cuál era el apodo de Muhammad Ali en sus inicios?', 'Iron Mike', 'Smokin Joe', 'Cassius Clay', 'Sugar Ray', 'Cassius Clay', 5, 3),
(100, '¿Cuál es la distancia de la prueba de natación más larga en piscina olímpica?', '400m', '800m', '1500m', '5000m', '1500m', 5, 3),
(101, '¿Qué actor interpretó a Jack Dawson en la película Titanic?', 'Brad Pitt', 'Tom Cruise', 'Leonardo DiCaprio', 'Johnny Depp', 'Leonardo DiCaprio', 6, 1),
(102, '¿Qué personaje de Disney es conocido por tener un compañero verde llamado Shrek?', 'Mickey Mouse', 'Fiona', 'Burro', 'Gato con Botas', 'Burro', 6, 1),
(103, '¿Qué banda de rock británica fue liderada por Freddie Mercury?', 'The Beatles', 'Led Zeppelin', 'Queen', 'Pink Floyd', 'Queen', 6, 1),
(104, '¿Cuál es el nombre de la famosa escuela de magia de Harry Potter?', 'Hogwarts', 'Durmstrang', 'Beauxbatons', 'Academia de Magia', 'Hogwarts', 6, 1),
(105, '¿En qué ciudad se ambienta la serie de televisión \"Friends\"?', 'Los Ángeles', 'Londres', 'Nueva York', 'Chicago', 'Nueva York', 6, 1),
(106, '¿Qué película ganó el premio a Mejor Película en los Oscar de 2020?', 'Parásitos', '1917', 'Joker', 'Érase una vez en Hollywood', 'Parásitos', 6, 1),
(107, '¿Qué animal famoso vive en una piña debajo del mar?', 'Pez Globo', 'Calamardo', 'Bob Esponja', 'Patricio Estrella', 'Bob Esponja', 6, 1),
(108, '¿Quién es el cantante principal de la banda U2?', 'Bono', 'Sting', 'Axl Rose', 'Mick Jagger', 'Bono', 6, 1),
(109, '¿Cuál es la película más taquillera de todos los tiempos (ajustada a la inflación)?', 'Avatar', 'Titanic', 'Lo que el viento se llevó', 'Avengers: Endgame', 'Lo que el viento se llevó', 6, 1),
(110, '¿Qué plataforma de streaming es conocida por su logo rojo y su sonido \"Tudum\"?', 'HBO Max', 'Amazon Prime', 'Disney+', 'Netflix', 'Netflix', 6, 1),
(111, '¿Qué director de cine es famoso por películas como \"Pulp Fiction\" y \"Kill Bill\"?', 'Steven Spielberg', 'Martin Scorsese', 'Quentin Tarantino', 'Christopher Nolan', 'Quentin Tarantino', 6, 2),
(112, '¿Qué banda popularizó el baile conocido como \"Macarena\"?', 'Los del Río', 'Gipsy Kings', 'Ricky Martin', 'Chayanne', 'Los del Río', 6, 2),
(113, '¿Quién interpreta al superhéroe \"Wonder Woman\" en el Universo Extendido de DC?', 'Scarlett Johansson', 'Emma Stone', 'Gal Gadot', 'Margot Robbie', 'Gal Gadot', 6, 2),
(114, '¿Qué serie de televisión de HBO está ambientada en un mundo de fantasía con dragones y casas nobles?', 'The Witcher', 'Vikingos', 'Juego de Tronos', 'Westworld', 'Juego de Tronos', 6, 2),
(115, '¿Cuál fue el primer largometraje de Disney completamente animado?', 'Bambi', 'Pinocho', 'Fantasía', 'Blancanieves y los siete enanitos', 'Blancanieves y los siete enanitos', 6, 2),
(116, '¿Cuál es el nombre del cementerio ficticio de mascotas donde los muertos vuelven a la vida, de Stephen King?', 'Cementerio de mascotas', 'La Milla Verde', 'El Resplandor', 'It', 'Cementerio de mascotas', 6, 2),
(117, '¿Qué director de cine es el único en haber ganado tres veces el Oscar a Mejor Director?', 'Billy Wilder', 'Clint Eastwood', 'John Ford', 'William Wyler', 'John Ford', 6, 3),
(118, '¿Qué actriz es la única en ganar cuatro premios Oscar en categorías de actuación?', 'Meryl Streep', 'Katharine Hepburn', 'Ingrid Bergman', 'Bette Davis', 'Katharine Hepburn', 6, 3),
(119, '¿Qué banda de rock progresivo creó el álbum conceptual \"The Dark Side of the Moon\"?', 'Led Zeppelin', 'Genesis', 'Pink Floyd', 'Yes', 'Pink Floyd', 6, 3),
(120, '¿Qué musical de Broadway está basado en la vida del Padre de la Patria de EE. UU., Alexander Hamilton?', 'Rent', 'Wicked', 'Hamilton', 'El Rey León', 'Hamilton', 6, 3),
(121, '¿Qué significa la sigla \"CPU\"?', 'Control de Procesamiento Unitario', 'Unidad Central de Procesamiento', 'Calculadora Personal Unificada', 'Circuito de Potencia Unitaria', 'Unidad Central de Procesamiento', 7, 1),
(122, '¿Qué empresa creó el sistema operativo Windows?', 'Apple', 'Google', 'Microsoft', 'IBM', 'Microsoft', 7, 1),
(123, '¿Quién es considerado uno de los fundadores de Apple?', 'Bill Gates', 'Jeff Bezos', 'Steve Jobs', 'Mark Zuckerberg', 'Steve Jobs', 7, 1),
(124, '¿Qué significa la sigla \"WWW\" en una dirección web?', 'World Wide Web', 'Web World Wide', 'Web White World', 'Wireless Web Work', 'World Wide Web', 7, 1),
(125, '¿Qué componente de la computadora se utiliza para almacenar datos a largo plazo?', 'RAM', 'CPU', 'SSD/HDD', 'Tarjeta Gráfica', 'SSD/HDD', 7, 1),
(126, '¿Qué lenguaje de programación se utiliza a menudo para crear páginas web interactivas (cliente)?', 'Java', 'Python', 'JavaScript', 'C++', 'JavaScript', 7, 1),
(127, '¿Qué red social se caracteriza por tener el logo de un pájaro azul?', 'Instagram', 'TikTok', 'Twitter (X)', 'Facebook', 'Twitter (X)', 7, 1),
(128, '¿Qué tipo de dispositivo es un \"router\"?', 'Periférico de entrada', 'Dispositivo de red', 'Unidad de almacenamiento', 'Software antivirus', 'Dispositivo de red', 7, 1),
(129, '¿Cuál es la moneda digital descentralizada más conocida, creada en 2009?', 'Ethereum', 'Ripple', 'Bitcoin', 'Litecoin', 'Bitcoin', 7, 1),
(130, '¿Qué significa la sigla \"Wi-Fi\"?', 'Wireless Fidelity', 'Web File', 'Wide-Fi', 'World Fiber', 'Wireless Fidelity', 7, 1),
(131, '¿Qué científico es famoso por desarrollar el primer compilador y el lenguaje COBOL?', 'Alan Turing', 'Grace Hopper', 'Ada Lovelace', 'Bill Gates', 'Grace Hopper', 7, 2),
(132, '¿Cuál es el nombre del sistema operativo de código abierto basado en Linux, utilizado en móviles?', 'iOS', 'Android', 'Windows Mobile', 'Symbian', 'Android', 7, 2),
(133, '¿Qué tipo de ataque informático busca sobrecargar un servidor con peticiones falsas?', 'Phishing', 'Malware', 'DoS (Denegación de Servicio)', 'Ransomware', 'DoS (Denegación de Servicio)', 7, 2),
(134, '¿Qué estándar inalámbrico de corto alcance utiliza ondas de radio para conectar dispositivos (Ej. audífonos)?', 'NFC', 'Bluetooth', 'Wi-Fi', '5G', 'Bluetooth', 7, 2),
(135, '¿Qué término se usa para describir el código fuente que está disponible para cualquier persona?', 'Código cerrado', 'Código propietario', 'Código binario', 'Código abierto', 'Código abierto', 7, 2),
(136, '¿Cuál es la unidad de medida de frecuencia del procesador?', 'Byte', 'Hertz (Hz)', 'Voltio', 'Ohmio', 'Hertz (Hz)', 7, 2),
(137, '¿Cuál es el lenguaje de programación conocido por su sintaxis concisa y su tipado dinámico, famoso en Data Science?', 'Java', 'C#', 'Python', 'Go', 'Python', 7, 3),
(138, '¿Qué principio define que la complejidad de los circuitos integrados se duplicará cada dos años aproximadamente?', 'Ley de Ohm', 'Ley de Moore', 'Ley de la Termodinámica', 'Ley de Fitts', 'Ley de Moore', 7, 3),
(139, '¿Qué método criptográfico utiliza dos claves distintas (pública y privada) para el cifrado y descifrado?', 'Cifrado simétrico', 'Cifrado de César', 'Cifrado asimétrico (o clave pública)', 'Hash', 'Cifrado asimétrico (o clave pública)', 7, 3),
(140, '¿Cuál fue el primer microprocesador comercialmente disponible, lanzado por Intel en 1971?', 'Intel 8080', 'Intel 4004', 'Intel 8008', 'Intel Pentium', 'Intel 4004', 7, 3),
(141, '¿Cuántos lados tiene un triángulo?', '2', '3', '4', '5', '3', 8, 1),
(142, '¿Cómo se llama el resultado de una multiplicación?', 'Suma', 'Resta', 'Producto', 'Cociente', 'Producto', 8, 1),
(143, '¿Cuál es el valor aproximado de Pi ($pi$)?', '3.14', '2.71', '1.618', '3.00', '3.14', 8, 1),
(144, '¿Qué tipo de ángulo mide exactamente 90 grados?', 'Agudo', 'Obtuso', 'Recto', 'Llano', 'Recto', 8, 1),
(145, '¿Qué operación matemática es la inversa de la suma?', 'Multiplicación', 'División', 'Resta', 'Potenciación', 'Resta', 8, 1),
(146, '¿Cómo se llama una fracción donde el numerador es más pequeño que el denominador?', 'Impropia', 'Mixta', 'Propia', 'Unitaria', 'Propia', 8, 1),
(147, '¿Cuántos milímetros hay en un centímetro?', '10', '100', '1000', '1', '10', 8, 1),
(148, '¿Qué forma geométrica tiene cuatro lados iguales y cuatro ángulos rectos?', 'Rectángulo', 'Trapecio', 'Rombo', 'Cuadrado', 'Cuadrado', 8, 1),
(149, '¿Cómo se llama la línea que divide un círculo en dos mitades iguales y pasa por el centro?', 'Radio', 'Tangente', 'Cuerda', 'Diámetro', 'Diámetro', 8, 1),
(150, '¿Qué número se considera el elemento neutro de la multiplicación?', '0', '1', '10', '2', '1', 8, 1),
(151, 'En un triángulo rectángulo, ¿cómo se llama el lado opuesto al ángulo recto?', 'Cateto', 'Vértice', 'Hipotenusa', 'Altura', 'Hipotenusa', 8, 2),
(152, '¿Qué tipo de progresión se caracteriza por tener una razón constante entre términos consecutivos?', 'Aritmética', 'Geométrica', 'Armónica', 'Fibonacci', 'Geométrica', 8, 2),
(153, '¿Cuál es el nombre del gráfico que representa datos mediante barras de diferente altura?', 'Gráfico circular', 'Diagrama de dispersión', 'Histograma', 'Diagrama de caja', 'Histograma', 8, 2),
(154, '¿Qué tipo de número tiene solo dos divisores: 1 y sí mismo?', 'Compuesto', 'Par', 'Racional', 'Primo', 'Primo', 8, 2),
(155, '¿Quién es conocido por ser el padre de la Geometría?', 'Arquímedes', 'Pitágoras', 'Euclides', 'Tales de Mileto', 'Euclides', 8, 2),
(156, 'Si $f(x) = 2x + 3$, ¿cuál es el valor de $f(2)$?', '5', '7', '9', '10', '7', 8, 2),
(157, '¿Qué teorema relaciona la suma de los cuadrados de los catetos con el cuadrado de la hipotenusa?', 'Teorema de Tales', 'Teorema de Pitágoras', 'Teorema de Fermat', 'Teorema del Seno', 'Teorema de Pitágoras', 8, 3),
(158, '¿Cuál es el nombre que recibe la rama de las matemáticas que estudia la probabilidad y la incertidumbre?', 'Geometría', 'Álgebra', 'Cálculo', 'Estadística', 'Estadística', 8, 3),
(159, '¿Cuál es el nombre del número irracional cuyo valor es aproximadamente 1.618 (La Proporción Áurea)?', 'Pi', 'Epsilon', 'Phi ($phi$)', 'Gamma', 'Phi ($phi$)', 8, 3),
(160, '¿Qué matemático inventó el cálculo infinitesimal, simultáneamente con Isaac Newton?', 'René Descartes', 'Gottfried Leibniz', 'Blaise Pascal', 'Carl Friedrich Gauss', 'Gottfried Leibniz', 8, 3),
(161, '¿Qué instrumento musical tiene 88 teclas?', 'Órgano', 'Acordeón', 'Piano', 'Clavicémbalo', 'Piano', 9, 1),
(162, '¿Qué banda popularizó la canción \"Bohemian Rhapsody\"?', 'The Beatles', 'Queen', 'Led Zeppelin', 'The Rolling Stones', 'Queen', 9, 1),
(163, '¿Qué cantante es conocida como \"La Reina del Pop\"?', 'Madonna', 'Lady Gaga', 'Britney Spears', 'Beyoncé', 'Madonna', 9, 1),
(164, '¿Qué nota musical viene después de Do?', 'Mi', 'Fa', 'Re', 'Sol', 'Re', 9, 1),
(165, '¿Cuál es el nombre del famoso músico y compositor de música clásica que se quedó sordo?', 'Mozart', 'Beethoven', 'Bach', 'Chopin', 'Beethoven', 9, 1),
(166, '¿Qué género musical tiene sus raíces en Nueva Orleans, Estados Unidos?', 'Rock and Roll', 'Jazz', 'Blues', 'Country', 'Jazz', 9, 1),
(167, '¿Cómo se llama la pieza musical escrita para ser cantada sin acompañamiento instrumental?', 'Sinfonía', 'A capella', 'Concierto', 'Ópera', 'A capella', 9, 1),
(168, '¿Qué significa la indicación \"Presto\" en una partitura?', 'Lento', 'Moderado', 'Rápido', 'Muy lento', 'Rápido', 9, 1),
(169, '¿Qué artista es famoso por su baile llamado el \"Moonwalk\"?', 'Elvis Presley', 'James Brown', 'Michael Jackson', 'Prince', 'Michael Jackson', 9, 1),
(170, '¿Qué instrumento utiliza una caja de resonancia y cuerdas pulsadas?', 'Trompeta', 'Violín', 'Flauta', 'Guitarra', 'Guitarra', 9, 1),
(171, '¿Qué compositor escribió \"El Cascanueces\"?', 'Tchaikovsky', 'Stravinsky', 'Ravel', 'Debussy', 'Tchaikovsky', 9, 2),
(172, '¿En qué año se lanzó el álbum \"Sgt. Pepper\'s Lonely Hearts Club Band\" de The Beatles?', '1965', '1967', '1970', '1969', '1967', 9, 2),
(173, '¿Cuál es el nombre del instrumento de viento-metal más grave?', 'Trompeta', 'Trombón', 'Tuba', 'Corno francés', 'Tuba', 9, 2),
(174, '¿Qué estilo musical surgió en Jamaica en los años 60, popularizado por Bob Marley?', 'Ska', 'Reggae', 'Calypso', 'Dub', 'Reggae', 9, 2),
(175, '¿Quién compuso la ópera \"Las bodas de Fígaro\"?', 'Rossini', 'Verdi', 'Mozart', 'Puccini', 'Mozart', 9, 2),
(176, '¿Qué cantante mexicana es famosa por sus atuendos de mariachi y sus canciones de despecho, como \"Rata de dos patas\"?', 'Paulina Rubio', 'Thalía', 'Chavela Vargas', 'Paquita la del Barrio', 'Paquita la del Barrio', 9, 2),
(177, '¿Qué músico y compositor barroco es conocido por escribir \"Las Cuatro Estaciones\"?', 'Handel', 'Vivaldi', 'Bach', 'Pachelbel', 'Vivaldi', 9, 3),
(178, '¿Cuál es el género musical originario de Chicago y Nueva York a finales de los 80, caracterizado por sus loops y ritmos repetitivos?', 'Techno', 'House', 'Trance', 'Drum and Bass', 'House', 9, 3),
(179, '¿Qué es un trino en música?', 'Un acorde de tres notas', 'Una repetición rápida de dos notas adyacentes', 'Una nota muy larga', 'Un cambio de tonalidad', 'Una repetición rápida de dos notas adyacentes', 9, 3),
(180, '¿Quién fue el pionero del \"Be Bop\" en el saxofón, junto a Dizzy Gillespie?', 'Miles Davis', 'John Coltrane', 'Charlie Parker', 'Thelonious Monk', 'Charlie Parker', 9, 3),
(181, '¿Qué animal es el mamífero terrestre más grande?', 'Elefante Africano', 'Rinoceronte', 'Jirafa', 'Hipopótamo', 'Elefante Africano', 10, 1),
(182, '¿Cuál es el proceso por el cual las plantas crean su alimento usando la luz solar?', 'Respiración', 'Polinización', 'Fotosíntesis', 'Transpiración', 'Fotosíntesis', 10, 1),
(183, '¿De qué están compuestas principalmente las nubes?', 'Polvo y arena', 'Gases de nitrógeno', 'Cristales de hielo y gotas de agua', 'Dióxido de carbono', 'Cristales de hielo y gotas de agua', 10, 1),
(184, '¿Qué reptiles tienen caparazón?', 'Cocodrilos', 'Serpientes', 'Lagartos', 'Tortugas', 'Tortugas', 10, 1),
(185, '¿Qué fenómeno natural se mide con la escala de Richter?', 'Huracanes', 'Erupciones volcánicas', 'Tornados', 'Terremotos', 'Terremotos', 10, 1),
(186, '¿Qué tipo de organismo es el champiñón (seta)?', 'Planta', 'Animal', 'Hongo', 'Bacteria', 'Hongo', 10, 1),
(187, '¿Cuál es la vida en estado larvario de una rana?', 'Renacuajo', 'Sapo', 'Cabra', 'Tritón', 'Renacuajo', 10, 1),
(188, '¿Qué gas necesitan los humanos para respirar?', 'Metano', 'Dióxido de carbono', 'Nitrógeno', 'Oxígeno', 'Oxígeno', 10, 1),
(189, '¿Cuál es el nombre de la masa de tierra rodeada completamente por agua?', 'Península', 'Estrecho', 'Istmo', 'Isla', 'Isla', 10, 1),
(190, '¿De qué se alimenta un animal herbívoro?', 'Carne', 'Insectos', 'Plantas', 'Todo tipo de alimento', 'Plantas', 10, 1),
(191, '¿Cuál es el depredador más grande del planeta?', 'Tigre siberiano', 'Oso polar', 'Ballena azul', 'Tiburón blanco', 'Ballena azul', 10, 2),
(192, '¿Cómo se llama la mezcla de magma, ceniza y gases liberada por un volcán?', 'Lava', 'Piroclasto', 'Piedra pómez', 'Fumarola', 'Lava', 10, 2),
(193, '¿Qué animal utiliza la ecolocalización para navegar y cazar?', 'Pez gato', 'Murciélago', 'Búho', 'Serpiente', 'Murciélago', 10, 2),
(194, '¿Qué tipo de clima es el predominante en la zona ecuatorial?', 'Templado', 'Polar', 'Tropical', 'Desértico', 'Tropical', 10, 2),
(195, '¿Qué parte de la flor se convierte en fruto?', 'El estambre', 'El pistilo', 'El sépalo', 'El ovario', 'El ovario', 10, 2),
(196, '¿Cuál es el único mamífero que pone huevos?', 'El ornitorrinco', 'La nutria', 'El murciélago', 'El delfín', 'El ornitorrinco', 10, 2),
(197, '¿Cuál es el nombre del proceso por el cual el agua se convierte de gas a líquido?', 'Evaporación', 'Sublimación', 'Condensación', 'Fusión', 'Condensación', 10, 3),
(198, '¿Qué tipo de roca se forma a partir del enfriamiento y solidificación del magma?', 'Sedimentaria', 'Metamórfica', 'Ígnea', 'Arenisca', 'Ígnea', 10, 3),
(199, '¿Qué científico es famoso por su trabajo en la clasificación de las especies y el concepto de evolución por selección natural?', 'Gregor Mendel', 'Louis Pasteur', 'Charles Darwin', 'Carl Linnaeus', 'Charles Darwin', 10, 3),
(200, '¿Qué nombre recibe el nivel trófico que incluye a los animales que solo se alimentan de productores (plantas)?', 'Consumidores terciarios', 'Descomponedores', 'Consumidores primarios', 'Productores', 'Consumidores primarios', 10, 3),
(201, '¿Cuál es el nombre del robot en Star Wars que es de color dorado?', 'BB-8', 'R2-D2', 'C-3PO', 'Chewbacca', 'C-3PO', 11, 1),
(202, '¿Qué serie de televisión se centra en la vida de una familia amarilla con tres hijos, Homer, Marge, Bart, Lisa y Maggie?', 'South Park', 'Padre de Familia', 'Futurama', 'Los Simpson', 'Los Simpson', 11, 1),
(203, '¿Quién es el actor que interpretó a Iron Man en el Universo Cinematográfico de Marvel?', 'Chris Evans', 'Chris Hemsworth', 'Robert Downey Jr.', 'Mark Ruffalo', 'Robert Downey Jr.', 11, 1),
(204, '¿Cuál es el nombre del estudio de animación responsable de Toy Story, Buscando a Nemo y Up?', 'Dreamworks', 'Disney', 'Pixar', 'Studio Ghibli', 'Pixar', 11, 1),
(205, '¿Qué actor interpretó al agente 007, James Bond, en la película \"Casino Royale\"?', 'Sean Connery', 'Pierce Brosnan', 'Daniel Craig', 'Roger Moore', 'Daniel Craig', 11, 1),
(206, '¿Qué serie de televisión está ambientada en un hospital y se centra en el Dr. House?', 'Grey\'s Anatomy', 'ER', 'Scrubs', 'Dr. House', 'Dr. House', 11, 1),
(207, '¿De qué país es el director de cine Guillermo del Toro?', 'España', 'Argentina', 'México', 'Colombia', 'México', 11, 1),
(208, '¿Qué famoso director dirigió la película \"E.T., el extraterrestre\"?', 'George Lucas', 'Steven Spielberg', 'James Cameron', 'Alfred Hitchcock', 'Steven Spielberg', 11, 1),
(209, '¿Qué animal marino es el protagonista de la película \"Buscando a Nemo\"?', 'Tiburón', 'Delfín', 'Pez Payaso', 'Ballena', 'Pez Payaso', 11, 1),
(210, '¿Qué famoso personaje de la TV vive en una piña debajo del mar?', 'Pez Globo', 'Calamardo', 'Bob Esponja', 'Patricio Estrella', 'Bob Esponja', 11, 1),
(211, '¿Qué director de cine es famoso por utilizar el efecto \"zoom rápido\" y narrativas complejas (Ej. Tiempos Violentos)?', 'Woody Allen', 'Stanley Kubrick', 'Quentin Tarantino', 'Federico Fellini', 'Quentin Tarantino', 11, 2),
(212, '¿Qué actor de origen canadiense protagonizó la serie \"The Office\" (versión EE. UU.) como Michael Scott?', 'John Krasinski', 'Rainn Wilson', 'Steve Carell', 'Ed Helms', 'Steve Carell', 11, 2),
(213, '¿Qué película de Christopher Nolan está ambientada en el mundo de los sueños?', 'Interestelar', 'Memento', 'El Origen (Inception)', 'Dunkerque', 'El Origen (Inception)', 11, 2),
(214, '¿Qué icónica banda sonora fue compuesta por Ennio Morricone y es asociada a los \"Spaghetti Westerns\"?', 'Star Wars', 'El Padrino', 'El Bueno, el Malo y el Feo', 'Psicosis', 'El Bueno, el Malo y el Feo', 11, 2),
(215, '¿Cuál es el nombre del estudio de animación fundado por Hayao Miyazaki y Isao Takahata?', 'Ghibli', 'Aardman', 'Laika', 'Toei Animation', 'Ghibli', 11, 2),
(216, '¿Cuál fue la primera serie de televisión de la historia en ser emitida a color en su totalidad?', 'I Love Lucy', 'El show de Larry King', 'Bonanza', 'M*A*S*H', 'Bonanza', 11, 2),
(217, '¿Quién dirigió la película de ciencia ficción \"2001: Una odisea del espacio\"?', 'Ridley Scott', 'Stanley Kubrick', 'Andrei Tarkovsky', 'Fritz Lang', 'Stanley Kubrick', 11, 3),
(218, '¿Qué actriz ganó un Oscar por interpretar a una de las hijas de la Familia Corleone en \"El Padrino: Parte III\"?', 'Diane Keaton', 'Sofía Coppola', 'Talia Shire', 'Al Pacino', 'Sofía Coppola', 11, 3),
(219, '¿Qué director francés es considerado el pionero de la \"Nouvelle Vague\" (Nueva Ola)?', 'Louis Malle', 'François Truffaut', 'Jean-Luc Godard', 'Éric Rohmer', 'Jean-Luc Godard', 11, 3),
(220, '¿Cuál es el nombre del icónico personaje de la serie \"Breaking Bad\" que se convierte en fabricante de drogas?', 'Jesse Pinkman', 'Gus Fring', 'Walter White', 'Saul Goodman', 'Walter White', 11, 3),
(221, '¿Cuántos días tiene un año bisiesto?', '365', '366', '360', '367', '366', 12, 1),
(222, '¿Qué animal marino es el más inteligente, conocido por su capacidad de comunicación y solución de problemas?', 'Tiburón', 'Delfín', 'Ballena', 'Pulpo', 'Delfín', 12, 1),
(223, '¿Qué país es el único que limita con Portugal?', 'Francia', 'Marruecos', 'España', 'Italia', 'España', 12, 1),
(224, '¿Cuál es el nombre del primer hombre que pisó la Luna?', 'Buzz Aldrin', 'Yuri Gagarin', 'Neil Armstrong', 'Michael Collins', 'Neil Armstrong', 12, 1),
(225, '¿Cuál es el nombre del famoso reloj británico conocido por su gran campana?', 'Big Ben', 'Little John', 'Tower Clock', 'Westminster Clock', 'Big Ben', 12, 1),
(226, '¿Qué sustancia segregan las abejas para producir la miel?', 'Néctar', 'Polen', 'Cera', 'Jalea Real', 'Néctar', 12, 1),
(227, '¿Cuál es el nombre del personaje de cuento que se come a la abuela y a Caperucita Roja?', 'Lobo Feroz', 'Oso Pardo', 'Zorro Astuto', 'Dragón', 'Lobo Feroz', 12, 1),
(228, '¿Cuántos anillos hay en el símbolo de los Juegos Olímpicos?', '4', '5', '6', '7', '5', 12, 1),
(229, '¿De qué color son las cajas negras de los aviones?', 'Negro', 'Rojo', 'Naranja', 'Amarillo', 'Naranja', 12, 1),
(230, '¿Qué famoso inventor desarrolló la teoría de la relatividad?', 'Nikola Tesla', 'Isaac Newton', 'Albert Einstein', 'Thomas Edison', 'Albert Einstein', 12, 1),
(231, '¿Qué emperador romano fue el sucesor de Julio César y el primero en ser llamado Augusto?', 'Nerón', 'Calígula', 'Octavio', 'Tiberio', 'Octavio', 12, 2),
(232, '¿Cuál es el idioma oficial de Brasil?', 'Español', 'Inglés', 'Portugués', 'Francés', 'Portugués', 12, 2),
(233, '¿Qué famoso monumento se encuentra en la ciudad de Agra, India?', 'Muralla China', 'Machu Picchu', 'Taj Mahal', 'Torre de Pisa', 'Taj Mahal', 12, 2),
(234, '¿Qué rey inglés fue obligado a firmar la Carta Magna en 1215?', 'Ricardo Corazón de León', 'Juan sin Tierra', 'Eduardo I', 'Enrique VIII', 'Juan sin Tierra', 12, 2),
(235, '¿Qué famoso científico introdujo el concepto de la \"duda metódica\"?', 'Aristóteles', 'Platón', 'Descartes', 'Sócrates', 'Descartes', 12, 2),
(236, '¿Cuál es el nombre del premio de matemáticas considerado equivalente al Premio Nobel?', 'Medalla Fields', 'Premio Turing', 'Premio Abel', 'Medalla Gauss', 'Premio Abel', 12, 2),
(237, '¿Cuál es el nombre del tratado que puso fin a la Guerra de los Treinta Años en 1648?', 'Paz de Utrecht', 'Tratado de Tordesillas', 'Paz de Westfalia', 'Paz de Augsburgo', 'Paz de Westfalia', 12, 3),
(238, '¿Cuál es el nombre del poeta que escribió la obra \"La Divina Comedia\"?', 'Boccaccio', 'Dante Alighieri', 'Petrarca', 'Homero', 'Dante Alighieri', 12, 3),
(239, '¿Qué filósofo es conocido por su concepto del \"Imperativo Categórico\"?', 'Hegel', 'Nietzsche', 'Kant', 'Rousseau', 'Kant', 12, 3),
(240, '¿Cuál es el nombre del primer país del mundo en otorgar el voto a las mujeres a nivel nacional?', 'Nueva Zelanda', 'Finlandia', 'Australia', 'Islandia', 'Nueva Zelanda', 12, 3),
(241, '¿Qué órgano del cuerpo humano bombea la sangre?', 'Pulmón', 'Estómago', 'Corazón', 'Hígado', 'Corazón', 13, 1),
(242, '¿Cómo se llama la unidad básica de la herencia genética?', 'Proteína', 'Cromosoma', 'Gen', 'Ácido', 'Gen', 13, 1),
(243, '¿Qué tipo de célula no tiene núcleo definido?', 'Eucariota', 'Tejido', 'Procariota', 'Pluricelular', 'Procariota', 13, 1),
(244, '¿Qué científicos descubrieron la estructura de doble hélice del ADN?', 'Darwin y Wallace', 'Mendel y Morgan', 'Watson y Crick', 'Pasteur y Koch', 'Watson y Crick', 13, 1),
(245, '¿Cuál es el proceso por el que una planta pierde agua a través de sus hojas?', 'Absorción', 'Transpiración', 'Osmosis', 'Respiración', 'Transpiración', 13, 1),
(246, '¿Qué seudópodos (brazos falsos) utiliza la ameba para moverse y alimentarse?', 'Flagelos', 'Cilios', 'Tentáculos', 'Seudópodos', 'Seudópodos', 13, 1),
(247, '¿Qué parte de la célula vegetal es responsable de la fotosíntesis?', 'Mitocondria', 'Núcleo', 'Cloroplasto', 'Pared celular', 'Cloroplasto', 13, 1),
(248, '¿Qué se necesita para que las plantas florezcan y den fruto (aparte de agua y luz)?', 'Polen', 'Aire', 'Vitaminas', 'Humedad', 'Polen', 13, 1),
(249, '¿Cuál es el hueso que protege el cerebro?', 'Vertebra', 'Rótula', 'Craneo', 'Costilla', 'Craneo', 13, 1),
(250, '¿Qué es un ecosistema?', 'Una colonia de insectos', 'Un grupo de plantas', 'Una comunidad de organismos y su ambiente', 'Un bioma terrestre', 'Una comunidad de organismos y su ambiente', 13, 1),
(251, '¿Cómo se llama la fase de la división celular donde el material genético se replica?', 'Metafase', 'Anafase', 'Interfase', 'Telofase', 'Interfase', 13, 2),
(252, '¿Qué tipo de vasos sanguíneos llevan la sangre **desde** el corazón hacia el resto del cuerpo?', 'Venas', 'Capilares', 'Arterias', 'Vénulas', 'Arterias', 13, 2),
(253, '¿Qué hormona es esencial para regular los niveles de azúcar en la sangre?', 'Adrenalina', 'Estrógeno', 'Insulina', 'Testosterona', 'Insulina', 13, 2),
(254, '¿Qué nombre recibe la pigmentación de la piel que nos protege del sol?', 'Colágeno', 'Melanina', 'Queratina', 'Hemoglobina', 'Melanina', 13, 2),
(255, '¿Qué científico desarrolló la primera vacuna contra la viruela?', 'Louis Pasteur', 'Robert Koch', 'Edward Jenner', 'Alexander Fleming', 'Edward Jenner', 13, 2),
(256, '¿Qué estructura conecta el músculo con el hueso?', 'Ligamento', 'Cartílago', 'Tendón', 'Articulación', 'Tendón', 13, 2),
(257, '¿Qué proceso celular es el inverso de la fotosíntesis, liberando energía de la glucosa?', 'Glucólisis', 'Ciclo de Krebs', 'Respiración celular', 'Fermentación', 'Respiración celular', 13, 3),
(258, '¿Cómo se llama la enzima que sintetiza ADN a partir de una plantilla de ARN?', 'ADN polimerasa', 'ARN polimerasa', 'Transcriptasa inversa', 'Ribonucleasa', 'Transcriptasa inversa', 13, 3),
(259, '¿Qué es un plásmido en el contexto de la genética bacteriana?', 'Un tipo de virus', 'Un cromosoma adicional', 'Un ADN extracromosómico circular', 'Una proteína de membrana', 'Un ADN extracromosómico circular', 13, 3),
(260, '¿Cuál es la función principal de la mielina en el sistema nervioso?', 'Producir neurotransmisores', 'Acelerar la transmisión del impulso nervioso', 'Mantener la estructura de la neurona', 'Almacenar energía', 'Acelerar la transmisión del impulso nervioso', 13, 3),
(261, '¿Cuál es el nombre del fontanero de Nintendo que rescata a la Princesa Peach?', 'Luigi', 'Wario', 'Mario', 'Toad', 'Mario', 14, 1),
(262, '¿En qué popular juego Battle Royale se utiliza el bus de batalla para iniciar la partida?', 'PUBG', 'Call of Duty', 'Apex Legends', 'Fortnite', 'Fortnite', 14, 1),
(263, '¿Qué personaje de SEGA es un erizo azul supersónico?', 'Tails', 'Knuckles', 'Sonic', 'Shadow', 'Sonic', 14, 1),
(264, '¿De qué juego es el icónico personaje \"Master Chief\"?', 'Halo', 'Gears of War', 'Destiny', 'Doom', 'Halo', 14, 1),
(265, '¿Cuál es el nombre del mundo cúbico donde los jugadores pueden construir y explorar libremente?', 'Terraria', 'Roblox', 'Minecraft', 'The Sims', 'Minecraft', 14, 1),
(266, '¿Qué consola de videojuegos fue lanzada por Sony en 1994?', 'Nintendo 64', 'Xbox', 'PlayStation', 'Sega Saturn', 'PlayStation', 14, 1),
(267, '¿Qué juego de Nintendo cuenta con personajes como Link y la Princesa Zelda?', 'Metroid', 'Super Mario', 'The Legend of Zelda', 'Pokémon', 'The Legend of Zelda', 14, 1),
(268, '¿Qué personaje femenino de lucha es famoso por sus trenzas y sus movimientos de \"Giro del Tifón\"?', 'Chun-Li', 'Cammy', 'Sakura', 'Kitana', 'Chun-Li', 14, 1),
(269, '¿Qué compañía es la creadora de la serie de juegos \"Grand Theft Auto\" (GTA)?', 'Activision', 'Ubisoft', 'Rockstar Games', 'EA Sports', 'Rockstar Games', 14, 1),
(270, '¿Qué tipo de juego es \"The Sims\"?', 'Juego de disparos', 'Simulación de vida', 'Aventura gráfica', 'Estrategia en tiempo real', 'Simulación de vida', 14, 1),
(271, '¿Qué juego popularizó el género de estrategia en tiempo real (RTS) y fue desarrollado por Blizzard?', 'StarCraft', 'Age of Empires', 'Command & Conquer', 'Warcraft', 'StarCraft', 14, 2),
(272, '¿Cuál es el nombre del caballero principal de la saga \"Dark Souls\"?', 'Geralt', 'Nier', 'Artorias', 'Solaire', 'Solaire', 14, 2),
(273, '¿En qué franquicia de juegos aparece el personaje \"Kratos\"?', 'God of War', 'Devil May Cry', 'Assassin\'s Creed', 'Tomb Raider', 'God of War', 14, 2),
(274, '¿Qué género de videojuegos se centra en la toma de decisiones con consecuencias narrativas (Ej. The Walking Dead)?', 'RPG', 'Visual Novel', 'Aventura Gráfica', 'Juego de Telltale (Aventura narrativa)', 'Juego de Telltale (Aventura narrativa)', 14, 2),
(275, '¿Qué juego de los 90 tenía un famoso código de trucos: \"Arriba, Arriba, Abajo, Abajo, Izquierda, Derecha...\"?', 'Mortal Kombat', 'Doom', 'Contra', 'Street Fighter II', 'Contra', 14, 2),
(276, '¿Qué título de la serie Final Fantasy se considera a menudo como uno de los mejores RPG de todos los tiempos?', 'Final Fantasy VI', 'Final Fantasy VII', 'Final Fantasy X', 'Final Fantasy IV', 'Final Fantasy VII', 14, 2),
(277, '¿Qué juego introdujo el concepto de \"Metroidvania\" con exploración no lineal y mejoras de habilidades?', 'Castlevania: Symphony of the Night', 'Super Metroid', 'Hollow Knight', 'Ori and the Blind Forest', 'Super Metroid', 14, 3),
(278, '¿Qué personaje es el protagonista principal de la saga \"Metal Gear Solid\"?', 'Raiden', 'Big Boss', 'Solid Snake', 'Naked Snake', 'Solid Snake', 14, 3),
(279, '¿Cuál es el nombre de la compañía japonesa que desarrolló el juego \"Pac-Man\"?', 'Konami', 'Capcom', 'Namco', 'Taito', 'Namco', 14, 3),
(280, '¿Qué juego de 2017 ganó el premio a Juego del Año y fue criticado por su sistema de cajas de botín (loot boxes)?', 'Cuphead', 'PlayerUnknown\'s Battlegrounds', 'The Legend of Zelda: Breath of the Wild', 'Star Wars Battlefront II', 'Star Wars Battlefront II', 14, 3),
(281, '¿Qué nombre recibe el dinero que un gobierno pide prestado?', 'Inflación', 'Deuda pública', 'PIB', 'Reserva', 'Deuda pública', 15, 1),
(282, '¿Qué índice mide la variación de precios de una cesta de bienes y servicios (inflación)?', 'PIB', 'IPC', 'Tipo de cambio', 'Renta per cápita', 'IPC', 15, 1),
(283, '¿Qué sector de la economía se dedica a la extracción de recursos naturales (Ej: agricultura, minería)?', 'Secundario', 'Terciario', 'Primario', 'Cuaternario', 'Primario', 15, 1),
(284, '¿Qué es un activo que se utiliza como medio de intercambio y unidad de cuenta?', 'Bonos', 'Acciones', 'Dinero', 'Derivados', 'Dinero', 15, 1),
(285, '¿Quién es el dueño de una empresa que cotiza en bolsa?', 'El CEO', 'Los directivos', 'Los accionistas', 'El gobierno', 'Los accionistas', 15, 1),
(286, '¿Qué término describe un aumento generalizado y sostenido de los precios?', 'Deflación', 'Recesión', 'Estancamiento', 'Inflación', 'Inflación', 15, 1),
(287, '¿Qué organismo es responsable de emitir la moneda y controlar la política monetaria de un país?', 'Ministerio de Economía', 'Banco Central', 'Bolsa de Valores', 'Banco Comercial', 'Banco Central', 15, 1),
(288, '¿Qué es un monopolio?', 'Muchos vendedores, un comprador', 'Muchos compradores, un vendedor', 'Pocos vendedores, pocos compradores', 'Muchos vendedores, muchos compradores', 'Muchos compradores, un vendedor', 15, 1),
(289, '¿Qué significa \"PIB\"?', 'Producción Interna Bruta', 'Producto Interior Básico', 'Producto Interno Bruto', 'Poder de Intercambio Bursátil', 'Producto Interno Bruto', 15, 1),
(290, '¿Qué es una divisa?', 'Un tipo de bono', 'Una moneda extranjera', 'Una acción de bajo valor', 'Un impuesto', 'Una moneda extranjera', 15, 1),
(291, '¿Qué economista es considerado el padre del capitalismo y autor de \"La riqueza de las naciones\"?', 'John Maynard Keynes', 'Karl Marx', 'Adam Smith', 'Milton Friedman', 'Adam Smith', 15, 2),
(292, '¿Qué política gubernamental se utiliza para estabilizar la economía mediante el gasto público y los impuestos?', 'Política monetaria', 'Política fiscal', 'Política exterior', 'Política comercial', 'Política fiscal', 15, 2),
(293, '¿Qué ley económica establece que al subir el precio, la cantidad demandada baja (en la mayoría de los bienes)?', 'Ley de la Oferta', 'Ley de los Rendimientos Decrecientes', 'Ley de la Demanda', 'Ley de Engel', 'Ley de la Demanda', 15, 2),
(294, '¿Qué nombre recibe una caída significativa de la actividad económica que dura más de unos pocos meses?', 'Depresión', 'Estanflación', 'Recesión', 'Boom', 'Recesión', 15, 2),
(295, '¿Qué es un arancel?', 'Un subsidio al productor', 'Un impuesto a las exportaciones', 'Un impuesto a las importaciones', 'Una deducción fiscal', 'Un impuesto a las importaciones', 15, 2),
(296, '¿Cómo se llama la diferencia entre el valor de las exportaciones y el de las importaciones de un país?', 'Balanza de pagos', 'Balanza comercial', 'Balanza de servicios', 'Balanza de capitales', 'Balanza comercial', 15, 2),
(297, '¿Qué concepto económico describe el costo de la mejor alternativa no elegida (lo que se renuncia)?', 'Costo variable', 'Frontera de Posibilidades de Producción', 'Costo de oportunidad', 'Utilidad marginal', 'Costo de oportunidad', 15, 3),
(298, '¿Qué pensador económico introdujo la teoría del \"laissez-faire\" (dejar hacer) en el siglo XVIII?', 'David Ricardo', 'Thomas Malthus', 'Adam Smith', 'François Quesnay', 'François Quesnay', 15, 3),
(299, '¿Qué nombre recibe el tipo de desempleo que existe incluso en una economía sana, debido a las transiciones laborales normales?', 'Desempleo estructural', 'Desempleo cíclico', 'Desempleo friccional', 'Desempleo tecnológico', 'Desempleo friccional', 15, 3),
(300, '¿Qué ocurre cuando la demanda de un bien es perfectamente inelástica?', 'La curva de demanda es horizontal', 'La curva de demanda es vertical', 'La elasticidad es infinita', 'La cantidad demandada se duplica', 'La curva de demanda es vertical', 15, 3),
(301, '¿Cuál es la unidad de medida estándar de la fuerza en el Sistema Internacional (SI)?', 'Vatio', 'Julio', 'Newton', 'Pascal', 'Newton', 16, 1),
(302, '¿Qué ley de Newton establece que todo cuerpo permanece en reposo o en movimiento uniforme a menos que una fuerza actúe sobre él?', 'Segunda Ley', 'Tercera Ley', 'Ley de la Inercia (Primera Ley)', 'Ley de la Gravitación', 'Ley de la Inercia (Primera Ley)', 16, 1),
(303, '¿Qué tipo de energía posee un objeto debido a su movimiento?', 'Potencial', 'Térmica', 'Eléctrica', 'Cinética', 'Cinética', 16, 1),
(304, '¿Cuál es el nombre del punto en el que el agua hierve a nivel del mar (en grados Celsius)?', '0°C', '50°C', '100°C', '212°C', '100°C', 16, 1),
(305, '¿Qué fenómeno físico explica por qué un lápiz parece doblado cuando se introduce en agua?', 'Reflexión', 'Difracción', 'Refracción', 'Polarización', 'Refracción', 16, 1),
(306, '¿Qué nombre recibe la conversión de un sólido directamente a gas sin pasar por líquido (Ej: hielo seco)?', 'Fusión', 'Evaporación', 'Sublimación', 'Condensación', 'Sublimación', 16, 1),
(307, '¿Qué mide un amperímetro?', 'Voltaje', 'Resistencia', 'Corriente eléctrica', 'Potencia', 'Corriente eléctrica', 16, 1),
(308, '¿Qué unidad de medida se utiliza para la presión?', 'Newton', 'Julio', 'Pascal', 'Vatio', 'Pascal', 16, 1),
(309, '¿Qué propiedad de la luz se utiliza para crear colores en un prisma o un arcoíris?', 'Refracción', 'Dispersión', 'Reflexión', 'Absorción', 'Dispersión', 16, 1),
(310, '¿Cuál es la fórmula para calcular la velocidad (V)?', 'Distancia / Tiempo', 'Fuerza x Masa', 'Masa / Volumen', 'Trabajo / Tiempo', 'Distancia / Tiempo', 16, 1),
(311, '¿Qué principio explica por qué un objeto flota en un fluido?', 'Principio de Pascal', 'Ley de Boyle', 'Principio de Arquímedes', 'Ley de Torricelli', 'Principio de Arquímedes', 16, 2),
(312, '¿Qué tipo de onda es el sonido?', 'Electromagnética', 'Transversal', 'Estacionaria', 'Longitudinal', 'Longitudinal', 16, 2),
(313, 'Según la fórmula $E=mc^2$, ¿qué representa la variable $c$?', 'La carga eléctrica', 'La constante de Planck', 'La velocidad del sonido', 'La velocidad de la luz', 'La velocidad de la luz', 16, 2),
(314, '¿Qué científico es conocido por la Ley de la Gravitación Universal?', 'Galileo Galilei', 'Albert Einstein', 'Isaac Newton', 'Johannes Kepler', 'Isaac Newton', 16, 2),
(315, '¿Qué nombre recibe la parte más pequeña de un elemento que aún conserva sus propiedades químicas?', 'Molécula', 'Protón', 'Neutrón', 'Átomo', 'Átomo', 16, 2);
INSERT INTO `tbl_preguntas` (`ID_pregunta`, `enunciado_pregunta`, `opcion1_pregunta`, `opcion2_pregunta`, `opcion3_pregunta`, `opcion4_pregunta`, `correcta_pregunta`, `TBL_categorias_ID_categoria`, `TBL_dificultades_ID_dificultad`) VALUES
(316, '¿Qué proceso se utiliza en las centrales nucleares para generar energía (división de un núcleo pesado)?', 'Fusión nuclear', 'Decaimiento radiactivo', 'Fisión nuclear', 'Reacción química', 'Fisión nuclear', 16, 2),
(317, '¿Qué nombre recibe la fuerza de atracción entre dos masas?', 'Fuerza electromagnética', 'Fuerza fuerte', 'Gravedad', 'Fuerza débil', 'Gravedad', 16, 3),
(318, '¿Cuál es el valor aproximado de la constante de Planck ($h$)?', '$6.626 	imes 10^{-34} J cdot s$', '$9.8 m/s^2$', '$3.0 	imes 10^8 m/s$', '$6.022 	imes 10^{23} mol^{-1}$', '$6.626 	imes 10^{-34} J cdot s$', 16, 3),
(319, '¿Qué fenómeno cuántico ocurre cuando una partícula puede existir en múltiples estados a la vez?', 'Entrelazamiento', 'Superposición', 'Principio de incertidumbre', 'Dualidad onda-partícula', 'Superposición', 16, 3),
(320, '¿Qué nombre recibe la temperatura más baja posible, donde el movimiento molecular cesa (0 Kelvin)?', 'Punto de fusión', 'Punto crítico', 'Cero absoluto', 'Punto de ebullición', 'Cero absoluto', 16, 3),
(321, '¿Cuál es la fórmula química del dióxido de carbono?', 'O2', 'H2O', 'NaCl', 'CO2', 'CO2', 17, 1),
(322, '¿Qué carga eléctrica tiene un protón?', 'Negativa', 'Neutra', 'Positiva', 'Variable', 'Positiva', 17, 1),
(323, '¿Qué elemento químico tiene el símbolo \"O\"?', 'Oro', 'Osmio', 'Oxígeno', 'Potasio', 'Oxígeno', 17, 1),
(324, '¿Qué tipo de enlace químico se forma por la transferencia de electrones entre átomos (Ej. NaCl)?', 'Covalente', 'Metálico', 'Iónico', 'Puente de hidrógeno', 'Iónico', 17, 1),
(325, '¿Qué nombre recibe la mezcla homogénea de dos o más sustancias?', 'Coloide', 'Suspensión', 'Elemento', 'Solución', 'Solución', 17, 1),
(326, '¿Cuál es el nombre del gas noble más ligero?', 'Neón', 'Argón', 'Helio', 'Kriptón', 'Helio', 17, 1),
(327, '¿Qué valor de pH es neutro?', '0', '7', '14', '5', '7', 17, 1),
(328, '¿Qué propiedad describe la capacidad de un metal de ser martillado sin romperse?', 'Ductilidad', 'Maleabilidad', 'Fragilidad', 'Tenacidad', 'Maleabilidad', 17, 1),
(329, '¿Qué ley establece que la materia no se crea ni se destruye, solo se transforma?', 'Ley de la Conservación de la Energía', 'Ley de Boyle', 'Ley de la Conservación de la Masa', 'Ley de las Proporciones Definidas', 'Ley de la Conservación de la Masa', 17, 1),
(330, '¿Cuál es la abreviatura de la tabla periódica que representa al Oro?', 'Au', 'Ag', 'Fe', 'Cu', 'Au', 17, 1),
(331, '¿Cuál es el proceso químico por el que un metal reacciona con el oxígeno en presencia de agua (Ej. el hierro)?', 'Reducción', 'Oxidación', 'Neutralización', 'Electrólisis', 'Oxidación', 17, 2),
(332, '¿Cuál es el nombre del número de partículas (átomos o moléculas) en un mol de sustancia (Aproximadamente $6.022 	imes 10^{23}$)?', 'Número atómico', 'Número de Avogadro', 'Constante de Faraday', 'Masa atómica', 'Número de Avogadro', 17, 2),
(333, '¿Qué tipo de hidrocarburo se caracteriza por tener al menos un triple enlace carbono-carbono?', 'Alcano', 'Alqueno', 'Alquino', 'Aromático', 'Alquino', 17, 2),
(334, '¿Qué nombre recibe el proceso de ruptura de moléculas grandes en moléculas más pequeñas usando agua?', 'Condensación', 'Hidrólisis', 'Polimerización', 'Oxidación', 'Hidrólisis', 17, 2),
(335, '¿Qué propiedad es la tendencia de un átomo a atraer electrones hacia sí mismo en un enlace químico?', 'Afinidad electrónica', 'Potencial de ionización', 'Electronegatividad', 'Radio atómico', 'Electronegatividad', 17, 2),
(336, '¿Cuál es el componente principal de la atmósfera terrestre que es inerte y se utiliza como gas de relleno en bombillas?', 'Oxígeno', 'Argón', 'Nitrógeno', 'Dióxido de carbono', 'Nitrógeno', 17, 2),
(337, '¿Qué científico organizó la tabla periódica basándose en la masa atómica y predijo la existencia de elementos no descubiertos?', 'John Dalton', 'Ernest Rutherford', 'Dmitri Mendeléyev', 'Niels Bohr', 'Dmitri Mendeléyev', 17, 3),
(338, '¿Qué nombre recibe la energía mínima necesaria para que ocurra una reacción química?', 'Energía de formación', 'Entalpía', 'Energía de activación', 'Energía libre de Gibbs', 'Energía de activación', 17, 3),
(339, '¿Qué tipo de hibridación tiene el carbono en una molécula de metano ($	ext{CH}_4$)?', 'sp', 'sp2', 'sp3', 'dsp2', 'sp3', 17, 3),
(340, '¿Qué es un catalizador?', 'Una sustancia que se consume en la reacción', 'Una sustancia que aumenta la energía de activación', 'Una sustancia que acelera la reacción sin consumirse', 'Una sustancia que solo se encuentra en el equilibrio', 'Una sustancia que acelera la reacción sin consumirse', 17, 3),
(341, '¿Qué nombre recibe nuestra galaxia?', 'Andrómeda', 'Triángulo', 'Vía Láctea', 'Elíptica', 'Vía Láctea', 18, 1),
(342, '¿Qué planeta es conocido por sus anillos prominentes?', 'Júpiter', 'Urano', 'Neptuno', 'Saturno', 'Saturno', 18, 1),
(343, '¿Cuál es la estrella más cercana a la Tierra (además del Sol)?', 'Sirio', 'Alpha Centauri', 'Próxima Centauri', 'Vega', 'Próxima Centauri', 18, 1),
(344, '¿Qué cuerpo celeste orbita la Tierra y provoca las mareas?', 'Sol', 'Marte', 'Luna', 'Venus', 'Luna', 18, 1),
(345, '¿Qué objeto astronómico es tan denso que ni siquiera la luz puede escapar de su gravedad?', 'Estrella de neutrones', 'Púlsar', 'Agujero negro', 'Enana blanca', 'Agujero negro', 18, 1),
(346, '¿Qué proceso produce energía dentro del Sol?', 'Fisión nuclear', 'Combustión', 'Fusión nuclear', 'Decaimiento radiactivo', 'Fusión nuclear', 18, 1),
(347, '¿Qué planeta es el más cercano al Sol?', 'Tierra', 'Venus', 'Mercurio', 'Marte', 'Mercurio', 18, 1),
(348, '¿Qué tipo de cuerpo celeste es Plutón?', 'Planeta', 'Satélite', 'Planeta enano', 'Asteroide', 'Planeta enano', 18, 1),
(349, '¿Cuál es el nombre del telescopio espacial lanzado en 1990 que revolucionó la astronomía?', 'Kepler', 'James Webb', 'Chandra', 'Hubble', 'Hubble', 18, 1),
(350, '¿Qué nombre recibe la unidad de distancia equivalente a la distancia media entre la Tierra y el Sol?', 'Año Luz', 'Pársec', 'Unidad Astronómica (UA)', 'Kilómetro', 'Unidad Astronómica (UA)', 18, 1),
(351, '¿Qué científico propuso el modelo heliocéntrico, donde el Sol está en el centro del sistema?', 'Ptolomeo', 'Galileo Galilei', 'Nicolás Copérnico', 'Johannes Kepler', 'Nicolás Copérnico', 18, 2),
(352, '¿Qué son los quasares?', 'Agujeros negros pequeños', 'Estrellas moribundas', 'Núcleos galácticos activos y muy luminosos', 'Cometas gigantes', 'Núcleos galácticos activos y muy luminosos', 18, 2),
(353, '¿Qué son las \"auroras boreales\"?', 'Fenómenos climáticos', 'Luminiscencia causada por el choque de partículas solares con la atmósfera', 'Reflejos de la Luna', 'Nubes de gas y polvo', 'Luminiscencia causada por el choque de partículas solares con la atmósfera', 18, 2),
(354, '¿Cuál es el nombre del conjunto de cuatro lunas principales de Júpiter descubiertas por Galileo?', 'Lunas interiores', 'Lunas de Saturno', 'Lunas Galileanas', 'Anillos jovianos', 'Lunas Galileanas', 18, 2),
(355, '¿Qué nombre recibe el cuerpo celeste compuesto de hielo y roca que desarrolla una cola al acercarse al Sol?', 'Asteroide', 'Meteorito', 'Cometa', 'Planetoide', 'Cometa', 18, 2),
(356, '¿Qué astrónomo formuló las tres leyes fundamentales del movimiento planetario?', 'Isaac Newton', 'Galileo Galilei', 'Johannes Kepler', 'Tycho Brahe', 'Johannes Kepler', 18, 2),
(357, '¿Qué teoría astronómica explica el origen del universo como una gran explosión hace miles de millones de años?', 'Teoría del Estado Estacionario', 'Teoría de la Inflación', 'Teoría del Big Bang', 'Teoría Pulsante', 'Teoría del Big Bang', 18, 3),
(358, '¿Qué nombre recibe la radiación de fondo de microondas que es una evidencia clave del Big Bang?', 'Radiación cósmica', 'Ruido blanco', 'CMB (Cosmic Microwave Background)', 'Radiación de Hawking', 'CMB (Cosmic Microwave Background)', 18, 3),
(359, '¿Qué concepto describe la expansión acelerada del universo?', 'Materia oscura', 'Energía oscura', 'Constante cosmológica', 'Límite de Chandrasekhar', 'Energía oscura', 18, 3),
(360, '¿Qué tipo de supernova ocurre cuando una enana blanca excede el límite de masa de Chandrasekhar?', 'Supernova de tipo II', 'Supernova de tipo Ib', 'Supernova de tipo Ia', 'Hipernova', 'Supernova de tipo Ia', 18, 3),
(361, '¿Quién dijo la famosa frase \"Solo sé que no sé nada\"?', 'Platón', 'Aristóteles', 'Sócrates', 'Epicuro', 'Sócrates', 19, 1),
(362, '¿Qué rama de la filosofía estudia el conocimiento (su naturaleza, origen y límites)?', 'Ética', 'Metafísica', 'Epistemología', 'Estética', 'Epistemología', 19, 1),
(363, '¿Quién es el autor de la obra \"La República\" y la alegoría de la caverna?', 'Aristóteles', 'Diógenes', 'Platón', 'Zenón', 'Platón', 19, 1),
(364, '¿Qué filósofo francés es famoso por la frase \"Pienso, luego existo\" (Cogito ergo sum)?', 'Voltaire', 'Rousseau', 'Descartes', 'Pascal', 'Descartes', 19, 1),
(365, '¿Qué escuela filosófica antigua promovía la imperturbabilidad del alma (ataraxia) como objetivo principal?', 'Epicureísmo', 'Cinismo', 'Estoicismo', 'Escepticismo', 'Estoicismo', 19, 1),
(366, '¿Qué concepto representa la \"vida examinada\" o \"vida buena\" según la filosofía griega?', 'Felicidad', 'Placer', 'Eudaimonia', 'Apetito', 'Eudaimonia', 19, 1),
(367, '¿Qué campo de la filosofía se pregunta sobre la moral, el bien y el mal?', 'Lógica', 'Estética', 'Ética', 'Ontología', 'Ética', 19, 1),
(368, '¿Qué filósofo fue maestro de Alejandro Magno?', 'Sócrates', 'Platón', 'Aristóteles', 'Pitágoras', 'Aristóteles', 19, 1),
(369, '¿Quién es considerado el padre de la filosofía occidental?', 'Tales de Mileto', 'Anaximandro', 'Heráclito', 'Parménides', 'Tales de Mileto', 19, 1),
(370, '¿Qué período histórico en Europa se asocia con el auge de la razón y el pensamiento crítico (Ej. Kant, Voltaire)?', 'Renacimiento', 'Edad Media', 'Ilustración', 'Romanticismo', 'Ilustración', 19, 1),
(371, '¿Qué movimiento filosófico postula que la existencia precede a la esencia?', 'Positivismo', 'Marxismo', 'Existencialismo', 'Empirismo', 'Existencialismo', 19, 2),
(372, '¿Quién escribió la obra \"Crítica de la razón pura\"?', 'Hegel', 'Nietzsche', 'Schopenhauer', 'Immanuel Kant', 'Immanuel Kant', 19, 2),
(373, '¿Qué filósofo desarrolló la idea del \"Superhombre\" (Übermensch) y la voluntad de poder?', 'Heidegger', 'Sartre', 'Nietzsche', 'Foucault', 'Nietzsche', 19, 2),
(374, '¿Qué nombre recibe la doctrina que afirma que todo conocimiento se basa en la experiencia sensible?', 'Racionalismo', 'Idealismo', 'Empirismo', 'Realismo', 'Empirismo', 19, 2),
(375, '¿Qué concepto de Marx describe la separación del trabajador respecto al producto de su trabajo y la sociedad?', 'Lucha de clases', 'Plusvalía', 'Materialismo dialéctico', 'Alienación', 'Alienación', 19, 2),
(376, '¿Quién es considerado el principal representante del Utilitarismo, que busca la mayor felicidad para el mayor número de personas?', 'John Locke', 'John Stuart Mill', 'Jeremy Bentham', 'David Hume', 'John Stuart Mill', 19, 2),
(377, '¿Qué filósofo introdujo el concepto de \"la voluntad de poder\" como fuerza impulsora fundamental?', 'Arthur Schopenhauer', 'Friedrich Nietzsche', 'Søren Kierkegaard', 'Baruch Spinoza', 'Friedrich Nietzsche', 19, 3),
(378, '¿Qué autor desarrolló la teoría del \"Estado de Naturaleza\" en la que la vida es \"solitaria, pobre, desagradable, brutal y corta\"?', 'John Locke', 'Jean-Jacques Rousseau', 'Thomas Hobbes', 'Montesquieu', 'Thomas Hobbes', 19, 3),
(379, '¿Qué rama de la lógica estudia las formas válidas de inferencia y demostración?', 'Lógica modal', 'Lógica aristotélica', 'Lógica formal', 'Lógica dialéctica', 'Lógica formal', 19, 3),
(380, '¿Qué escuela filosófica de la Antigüedad se centraba en la necesidad de vivir de acuerdo con la naturaleza y la razón (Ej. Epicteto y Séneca)?', 'Cinismo', 'Escepticismo', 'Neoplatonismo', 'Estoicismo', 'Estoicismo', 19, 3),
(381, '¿Quién es considerado el padre del Psicoanálisis?', 'Carl Jung', 'B.F. Skinner', 'Sigmund Freud', 'Ivan Pavlov', 'Sigmund Freud', 20, 1),
(382, '¿Qué tipo de condicionamiento se centra en la asociación de un estímulo neutro con uno significativo (Ej. perro de Pavlov)?', 'Condicionamiento operante', 'Condicionamiento clásico', 'Aprendizaje social', 'Habituación', 'Condicionamiento clásico', 20, 1),
(383, '¿Qué nombre recibe la parte de la mente que, según Freud, actúa como nuestra conciencia moral y ética?', 'Ello (Id)', 'Yo (Ego)', 'Superyó (Superego)', 'Inconsciente', 'Superyó (Superego)', 20, 1),
(384, '¿Qué es la \"percepción\"?', 'La memoria de un evento', 'El procesamiento e interpretación de la información sensorial', 'Una emoción intensa', 'Un tipo de pensamiento', 'El procesamiento e interpretación de la información sensorial', 20, 1),
(385, '¿Qué psicólogo humanista es famoso por su jerarquía de necesidades (la pirámide)?', 'Carl Rogers', 'Abraham Maslow', 'Erik Erikson', 'Jean Piaget', 'Abraham Maslow', 20, 1),
(386, '¿Qué se entiende por \"ansiedad\"?', 'Un estado de felicidad', 'Una respuesta emocional a la amenaza o el peligro percibido', 'Un estado de sueño profundo', 'Una forma de memoria', 'Una respuesta emocional a la amenaza o el peligro percibido', 20, 1),
(387, '¿Qué parte del sistema nervioso es responsable de la respuesta de \"lucha o huida\"?', 'Sistema nervioso central', 'Sistema parasimpático', 'Sistema somático', 'Sistema simpático', 'Sistema simpático', 20, 1),
(388, '¿Qué término utiliza Piaget para describir el proceso de incorporar nueva información a los esquemas mentales existentes?', 'Acomodación', 'Equilibrio', 'Asimilación', 'Adaptación', 'Asimilación', 20, 1),
(389, '¿Qué tipo de memoria tiene una capacidad ilimitada y retiene información a largo plazo?', 'Memoria de trabajo', 'Memoria sensorial', 'Memoria a largo plazo', 'Memoria a corto plazo', 'Memoria a largo plazo', 20, 1),
(390, '¿Qué es un reflejo condicionado?', 'Una respuesta innata', 'Una respuesta aprendida a un estímulo previamente neutro', 'Una reacción voluntaria', 'Una alteración de la conciencia', 'Una respuesta aprendida a un estímulo previamente neutro', 20, 1),
(391, '¿Qué tipo de refuerzo se aplica al retirar un estímulo aversivo después de una respuesta deseada (Ej. quitar el ruido)?', 'Refuerzo positivo', 'Castigo positivo', 'Refuerzo negativo', 'Castigo negativo', 'Refuerzo negativo', 20, 2),
(392, '¿Qué psicólogo infantil es conocido por su teoría de las etapas del desarrollo cognitivo (sensorio-motriz, preoperacional, etc.)?', 'Vygotsky', 'Erikson', 'Kohlberg', 'Jean Piaget', 'Jean Piaget', 20, 2),
(393, '¿Qué nombre recibe la tendencia a atribuir el comportamiento de los demás a causas internas (personalidad) y subestimar las externas (situación)?', 'Sesgo de confirmación', 'Efecto halo', 'Error fundamental de atribución', 'Disonancia cognitiva', 'Error fundamental de atribución', 20, 2),
(394, '¿Qué teoría psicológica sostiene que todo comportamiento es el resultado de la interacción entre genes y ambiente?', 'Funcionalismo', 'Dualismo', 'Determinismo biológico', 'Interaccionismo', 'Interaccionismo', 20, 2),
(395, '¿Qué es la disonancia cognitiva?', 'Un conflicto entre el Ello y el Superyó', 'El sentimiento de incomodidad por tener creencias o acciones contradictorias', 'Una forma de amnesia', 'Una distorsión perceptiva', 'El sentimiento de incomodidad por tener creencias o acciones contradictorias', 20, 2),
(396, '¿Quién introdujo el concepto de \"inconsciente colectivo\" y los arquetipos?', 'Sigmund Freud', 'Alfred Adler', 'Carl Jung', 'Jacques Lacan', 'Carl Jung', 20, 2),
(397, '¿Qué experimento de la psicología social demostró la obediencia a la autoridad, a pesar de causar daño a otros?', 'El experimento de la prisión de Stanford', 'El experimento de la muñeca Bobo', 'El experimento de Milgram', 'El experimento de la habitación China', 'El experimento de Milgram', 20, 3),
(398, '¿Qué nombre recibe la teoría de Vygotsky sobre la diferencia entre lo que un niño puede hacer solo y lo que puede hacer con ayuda?', 'Andamiaje', 'Zona de Desarrollo Próximo (ZDP)', 'Aprendizaje por descubrimiento', 'Período crítico', 'Zona de Desarrollo Próximo (ZDP)', 20, 3),
(399, '¿Qué tipo de alucinación es la más común en la Esquizofrenia?', 'Visual', 'Olfativa', 'Táctil', 'Auditiva', 'Auditiva', 20, 3),
(400, '¿Qué es un heurístico en el contexto de la toma de decisiones?', 'Un razonamiento lógico formal', 'Una regla mental simple o atajo para simplificar la toma de decisiones', 'Una distorsión de la memoria', 'Un prejuicio social', 'Una regla mental simple o atajo para simplificar la toma de decisiones', 20, 3),
(401, '¿Qué nombre recibe el conjunto de reglas y expectativas que guían el comportamiento de las personas en la sociedad?', 'Cultura', 'Estatus', 'Normas sociales', 'Anomia', 'Normas sociales', 21, 1),
(402, '¿Qué ciencia social estudia la sociedad humana, el comportamiento social y las estructuras sociales?', 'Antropología', 'Psicología', 'Sociología', 'Economía', 'Sociología', 21, 1),
(403, '¿Quién es considerado uno de los fundadores de la sociología, conocido por su estudio del suicidio?', 'Max Weber', 'Karl Marx', 'Émile Durkheim', 'Auguste Comte', 'Émile Durkheim', 21, 1),
(404, '¿Qué término describe un patrón de comportamiento socialmente reconocido y recurrente (Ej. el matrimonio)?', 'Grupo social', 'Función', 'Institución social', 'Clase', 'Institución social', 21, 1),
(405, '¿Qué es un \"rol social\"?', 'Un grupo de amigos', 'Un conflicto de valores', 'Un conjunto de expectativas asociadas a una posición social', 'Una protesta', 'Un conjunto de expectativas asociadas a una posición social', 21, 1),
(406, '¿Cómo se llama el proceso por el cual los individuos aprenden las normas, valores y costumbres de su cultura?', 'Asimilación', 'Adaptación', 'Socialización', 'Aislamiento', 'Socialización', 21, 1),
(407, '¿Qué nombre recibe un gran grupo de personas que comparten un territorio, una cultura y una identidad común?', 'Comunidad', 'Familia', 'Sociedad', 'Nación', 'Sociedad', 21, 1),
(408, '¿Qué es un \"estereotipo\"?', 'Un juicio individual', 'Una generalización simplificada y fija sobre un grupo de personas', 'Un tipo de norma legal', 'Un cambio cultural', 'Una generalización simplificada y fija sobre un grupo de personas', 21, 1),
(409, '¿Qué concepto se refiere a la posición o prestigio social de un individuo en la sociedad?', 'Poder', 'Estatus', 'Rol', 'Capital', 'Estatus', 21, 1),
(410, '¿Qué son los \"valores sociales\"?', 'Las leyes de un país', 'Las creencias fundamentales compartidas sobre lo que es deseable o bueno', 'Las estadísticas demográficas', 'Los rituales religiosos', 'Las creencias fundamentales compartidas sobre lo que es deseable o bueno', 21, 1),
(411, '¿Qué sociólogo es famoso por desarrollar la teoría del \"Materialismo Histórico\" y la lucha de clases?', 'Max Weber', 'Émile Durkheim', 'Karl Marx', 'Talcott Parsons', 'Karl Marx', 21, 2),
(412, '¿Qué término usó Max Weber para describir la tendencia de las sociedades modernas a priorizar la eficiencia, el cálculo y el control?', 'Anomia', 'Acción social', 'Burocracia', 'Racionalización', 'Racionalización', 21, 2),
(413, '¿Qué es la \"movilidad social\" ascendente?', 'El cambio de residencia', 'El cambio de un rol social a otro', 'El movimiento hacia un estatus superior en la jerarquía social', 'El abandono de la cultura', 'El movimiento hacia un estatus superior en la jerarquía social', 21, 2),
(414, '¿Qué nombre recibe el sentimiento de falta de normas o de desconexión con los valores de la sociedad, estudiado por Durkheim?', 'Alienación', 'Anomia', 'Cohesión', 'Conflicto', 'Anomia', 21, 2),
(415, '¿Cuál es la diferencia principal entre un \"grupo primario\" (Ej. familia) y un \"grupo secundario\" (Ej. una empresa)?', 'El tamaño', 'El nivel de intimidad y lazos emocionales', 'La edad de sus miembros', 'El propósito legal', 'El nivel de intimidad y lazos emocionales', 21, 2),
(416, '¿Qué concepto describe la idea de que la verdad y la moralidad son relativas a la cultura o al contexto social?', 'Etnocentrismo', 'Universalismo', 'Relativismo cultural', 'Funcionalismo', 'Relativismo cultural', 21, 2),
(417, '¿Qué teórico sociológico introdujo la noción de la \"jaula de hierro\" para describir las consecuencias de la racionalización y la burocracia?', 'Karl Marx', 'Georg Simmel', 'Max Weber', 'Michel Foucault', 'Max Weber', 21, 3),
(418, '¿Qué escuela sociológica (asociada a Durkheim) concibe a la sociedad como un sistema complejo cuyas partes trabajan juntas para promover la solidaridad y la estabilidad?', 'Teoría del Conflicto', 'Interaccionismo Simbólico', 'Funcionalismo', 'Teoría Crítica', 'Funcionalismo', 21, 3),
(419, '¿Qué concepto de Goffman describe los esfuerzos de un individuo para crear impresiones específicas en la mente de los demás, como en un teatro?', 'Dramaturgia', 'Etiquetamiento', 'Interacción ritual', 'Normalización', 'Dramaturgia', 21, 3),
(420, '¿Qué nombre recibe el estudio de la forma en que las personas construyen la realidad a través de la interacción social?', 'Fenomenología', 'Etnometodología', 'Estructuralismo', 'Postestructuralismo', 'Etnometodología', 21, 3),
(421, '¿Qué documento fundamental establece los derechos y deberes de los ciudadanos y la estructura de un Estado?', 'Código Civil', 'Ley Ordinaria', 'Constitución', 'Estatuto', 'Constitución', 22, 1),
(422, '¿Qué sistema de gobierno se caracteriza por el poder del pueblo, ejercido directa o indirectamente a través de representantes?', 'Monarquía', 'Oligarquía', 'Democracia', 'Dictadura', 'Democracia', 22, 1),
(423, '¿Cuál de los tres poderes del Estado es responsable de interpretar y aplicar las leyes?', 'Poder Legislativo', 'Poder Ejecutivo', 'Poder Judicial', 'Poder Electoral', 'Poder Judicial', 22, 1),
(424, '¿Qué nombre recibe la persona que ocupa la más alta representación del Poder Ejecutivo en una república?', 'Primer Ministro', 'Alcalde', 'Presidente', 'Gobernador', 'Presidente', 22, 1),
(425, '¿Qué ideología política promueve la libertad individual, la propiedad privada y la limitación del poder estatal?', 'Socialismo', 'Comunismo', 'Liberalismo', 'Anarquismo', 'Liberalismo', 22, 1),
(426, '¿Qué órgano del Estado es responsable de crear, modificar o derogar las leyes?', 'Ejecutivo', 'Judicial', 'Legislativo', 'Militar', 'Legislativo', 22, 1),
(427, '¿Qué concepto describe la división de un gobierno en ramas separadas, cada una con poderes distintos (Ej: EE. UU.)?', 'Federalismo', 'Unitarismo', 'Separación de poderes', 'Soberanía', 'Separación de poderes', 22, 1),
(428, '¿Qué es un \"referéndum\"?', 'Una votación en el parlamento', 'Una consulta popular donde se somete a voto una ley o decisión', 'Una elección de representantes', 'Una declaración de guerra', 'Una consulta popular donde se somete a voto una ley o decisión', 22, 1),
(429, '¿Qué nombre recibe el conjunto de instituciones que ejercen el poder político y administrativo sobre un territorio definido?', 'Nación', 'Sociedad', 'Estado', 'Gobierno', 'Estado', 22, 1),
(430, '¿Qué es un \"derecho humano\"?', 'Una ley local', 'Un privilegio otorgado por un rey', 'Un derecho inherente a todo ser humano, sin distinción', 'Una obligación militar', 'Un derecho inherente a todo ser humano, sin distinción', 22, 1),
(431, '¿Qué ideología política busca la igualdad social, la eliminación de la propiedad privada y la colectivización de los medios de producción?', 'Capitalismo', 'Fascismo', 'Comunismo', 'Conservadurismo', 'Comunismo', 22, 2),
(432, '¿Qué autor clásico escribió la obra \"El Príncipe\", analizando cómo se obtiene y se mantiene el poder político?', 'Platón', 'Maquiavelo', 'Aristóteles', 'Hobbes', 'Maquiavelo', 22, 2),
(433, '¿Qué nombre recibe el sistema en el que el jefe de Estado (Ej. Rey) hereda su cargo, aunque sus poderes estén limitados por una constitución?', 'República', 'Tiranía', 'Monarquía absoluta', 'Monarquía constitucional', 'Monarquía constitucional', 22, 2),
(434, '¿Qué concepto se refiere al derecho de un Estado a ejercer autoridad soberana sobre su territorio sin interferencia externa?', 'Legitimidad', 'Autonomía', 'Soberanía', 'Jurisdicción', 'Soberanía', 22, 2),
(435, '¿Qué institución internacional se dedica a la promoción de la paz, la seguridad y la cooperación mundial?', 'OTAN', 'Unión Europea', 'Naciones Unidas (ONU)', 'Cruz Roja', 'Naciones Unidas (ONU)', 22, 2),
(436, '¿Qué tipo de elección ocurre cuando ningún candidato obtiene la mayoría absoluta de votos en la primera vuelta y se realiza una segunda?', 'Elección primaria', 'Votación indirecta', 'Balotaje (Segunda Vuelta)', 'Elección parlamentaria', 'Balotaje (Segunda Vuelta)', 22, 2),
(437, '¿Qué teórico político desarrolló la idea del \"Contrato Social\" en su obra homónima, argumentando que la soberanía reside en la voluntad general?', 'John Locke', 'Thomas Hobbes', 'Jean-Jacques Rousseau', 'Montesquieu', 'Jean-Jacques Rousseau', 22, 3),
(438, '¿Qué nombre recibe la teoría económica y política que sostiene que el Estado debe tener un control limitado sobre la economía para garantizar la libertad de mercado?', 'Mercantilismo', 'Neoliberalismo', 'Keynesianismo', 'Anarcocapitalismo', 'Neoliberalismo', 22, 3),
(439, '¿Qué tipo de sistema electoral se caracteriza por dividir los escaños de un cuerpo legislativo en proporción a los votos obtenidos por cada partido?', 'Sistema mayoritario', 'Sistema de voto único transferible', 'Sistema de representación proporcional', 'Sistema de lista cerrada', 'Sistema de representación proporcional', 22, 3),
(440, '¿Qué nombre recibe la limitación legal al poder del gobierno que garantiza que el Estado opere bajo leyes escritas y públicas?', 'Estado de excepción', 'Estado de derecho', 'Totalitarismo', 'República Federal', 'Estado de derecho', 22, 3),
(441, '¿Cuál es el libro sagrado del cristianismo?', 'El Corán', 'El Talmud', 'La Torá', 'La Biblia', 'La Biblia', 23, 1),
(442, '¿En qué ciudad nació Jesucristo?', 'Jerusalén', 'Nazaret', 'Belén', 'Roma', 'Belén', 23, 1),
(443, '¿Quién es el profeta principal y fundador del Islam?', 'Moisés', 'Abraham', 'Mahoma', 'Buda', 'Mahoma', 23, 1),
(444, '¿Qué religión mundial tiene como símbolo el Dharma Chakra o Rueda del Dharma?', 'Cristianismo', 'Judaísmo', 'Hinduismo', 'Budismo', 'Budismo', 23, 1),
(445, '¿Qué nombre recibe el texto fundamental de la fe islámica?', 'La Torá', 'El Evangelio', 'El Corán', 'El Bhagavad Gita', 'El Corán', 23, 1),
(446, '¿Qué religión tiene al Éufrates, al Tigris y al Nilo como ríos sagrados?', 'Budismo', 'Hinduismo', 'Judaísmo', 'Zoroastrismo', 'Hinduismo', 23, 1),
(447, '¿Cuál es el nombre del lugar de culto principal para los musulmanes?', 'Templo', 'Sinagoga', 'Iglesia', 'Mezquita', 'Mezquita', 23, 1),
(448, '¿Qué celebración judía conmemora el éxodo de los hebreos de la esclavitud en Egipto?', 'Hanukkah', 'Yom Kippur', 'Pascua (Pesaj)', 'Rosh Hashaná', 'Pascua (Pesaj)', 23, 1),
(449, '¿Qué profeta bíblico guió a los israelitas fuera de Egipto a través del Mar Rojo?', 'Abraham', 'David', 'Moisés', 'Noé', 'Moisés', 23, 1),
(450, '¿Qué término se usa en el budismo para referirse al estado de liberación del sufrimiento y del ciclo de reencarnación?', 'Karma', 'Dharma', 'Nirvana', 'Moksha', 'Nirvana', 23, 1),
(451, '¿Qué doctrina cristiana establece que Dios existe como tres personas distintas: Padre, Hijo y Espíritu Santo?', 'Monoteísmo', 'Binitarismo', 'La Trinidad', 'Politeísmo', 'La Trinidad', 23, 2),
(452, '¿Cuál es el nombre del primer patriarca y figura central tanto en el judaísmo, el cristianismo como el islam?', 'Jacob', 'Isaac', 'Abraham', 'Noé', 'Abraham', 23, 2),
(453, '¿Qué ciudad es considerada sagrada por las tres religiones abrahámicas (Judaísmo, Cristianismo e Islam)?', 'El Cairo', 'Roma', 'La Meca', 'Jerusalén', 'Jerusalén', 23, 2),
(454, '¿Qué son los \"Vedas\"?', 'Los libros sagrados del hinduismo', 'Las enseñanzas de Confucio', 'Los libros de la Cábala', 'Las epístolas de San Pablo', 'Los libros sagrados del hinduismo', 23, 2),
(455, '¿Qué figura histórica es conocida por iniciar la Reforma Protestante en el siglo XVI?', 'Juan Calvino', 'Martín Lutero', 'Tomás de Aquino', 'Enrique VIII', 'Martín Lutero', 23, 2),
(456, '¿Qué nombre recibe la ley religiosa del islam, basada en el Corán y los hadices (enseñanzas de Mahoma)?', 'Torá', 'Sharia', 'Talmud', 'Sunna', 'Sharia', 23, 2),
(457, '¿Qué nombre recibe la creencia en que Dios es el universo y el universo es Dios?', 'Ateísmo', 'Agnosticismo', 'Panteísmo', 'Deísmo', 'Panteísmo', 23, 3),
(458, '¿Qué nombre recibe la rama del judaísmo conocida por seguir una interpretación estricta de la ley y las tradiciones?', 'Judaísmo reformista', 'Judaísmo conservador', 'Judaísmo ortodoxo', 'Judaísmo reconstruccionista', 'Judaísmo ortodoxo', 23, 3),
(459, '¿Qué son los \"Hadices\" en el contexto islámico?', 'Los cinco pilares del islam', 'Los comentarios del Corán', 'Los dichos y acciones del profeta Mahoma', 'Las leyes financieras islámicas', 'Los dichos y acciones del profeta Mahoma', 23, 3),
(460, '¿Qué concilio ecuménico de la Iglesia Católica definió la infalibilidad papal como un dogma de fe?', 'Concilio de Trento', 'Concilio Vaticano II', 'Concilio de Nicea', 'Concilio Vaticano I', 'Concilio Vaticano I', 23, 3),
(461, '¿Cómo se llama la etapa escolar después de la primaria?', 'Preescolar', 'Universidad', 'Secundaria', 'Posgrado', 'Secundaria', 24, 1),
(462, '¿Qué método de enseñanza se basa en permitir que los niños aprendan a través de la exploración y el juego autodirigido?', 'Conductismo', 'Instrucción directa', 'Método Montessori', 'Memorización', 'Método Montessori', 24, 1),
(463, '¿Qué es un \"currículo\" educativo?', 'El edificio de la escuela', 'El horario de clases', 'El plan de estudios que define objetivos y contenidos', 'El reglamento estudiantil', 'El plan de estudios que define objetivos y contenidos', 24, 1),
(464, '¿Qué es el \"alfabetismo\"?', 'Saber escribir a máquina', 'La capacidad de leer y escribir', 'Conocer idiomas', 'Tener un título universitario', 'La capacidad de leer y escribir', 24, 1),
(465, '¿Qué es un \"diploma\"?', 'Una nota baja', 'Un certificado de asistencia', 'Un documento que acredita la finalización de un curso o estudios', 'Una tarjeta de biblioteca', 'Un documento que acredita la finalización de un curso o estudios', 24, 1),
(466, '¿Qué término describe el aprendizaje realizado fuera de las instituciones educativas formales?', 'Educación obligatoria', 'Educación formal', 'Educación informal', 'Educación superior', 'Educación informal', 24, 1),
(467, '¿Qué se evalúa en el \"rendimiento académico\"?', 'La asistencia a clases', 'La conducta del estudiante', 'El nivel de conocimiento y habilidades adquiridos', 'La edad del estudiante', 'El nivel de conocimiento y habilidades adquiridos', 24, 1),
(468, '¿Cuál es la función principal de la \"escuela\" como institución social?', 'Proporcionar comida', 'Proveer entretenimiento', 'Socializar y transmitir conocimientos culturales', 'Realizar deportes', 'Socializar y transmitir conocimientos culturales', 24, 1),
(469, '¿Qué es la \"tasa de deserción escolar\"?', 'El número de profesores', 'El porcentaje de estudiantes que abandonan sus estudios antes de finalizarlos', 'La cantidad de libros', 'La calificación promedio', 'El porcentaje de estudiantes que abandonan sus estudios antes de finalizarlos', 24, 1),
(470, '¿Qué profesional es experto en el diseño de planes de estudio y teorías de aprendizaje?', 'Psicólogo', 'Pedagogo', 'Filósofo', 'Historiador', 'Pedagogo', 24, 1),
(471, '¿Qué teoría de aprendizaje (Ej. Skinner) se centra en el estudio de las conductas observables y el uso de refuerzos/castigos?', 'Constructivismo', 'Conductismo', 'Psicoanálisis', 'Humanismo', 'Conductismo', 24, 2),
(472, '¿Qué pedagogo brasileño es famoso por su concepto de \"educación liberadora\" y la \"pedagogía del oprimido\"?', 'Jean Piaget', 'Paulo Freire', 'John Dewey', 'María Montessori', 'Paulo Freire', 24, 2),
(473, '¿Qué significa que un sistema educativo sea \"inclusivo\"?', 'Que solo acepte estudiantes con altas notas', 'Que incorpore tecnología moderna', 'Que atienda las necesidades de todos los estudiantes, incluyendo discapacidades y diferencias', 'Que solo enseñe materias científicas', 'Que atienda las necesidades de todos los estudiantes, incluyendo discapacidades y diferencias', 24, 2),
(474, '¿Qué término utiliza Vygotsky para describir la brecha entre lo que un estudiante puede hacer solo y lo que puede hacer con ayuda de un mentor?', 'Andamiaje', 'Aprendizaje significativo', 'Zona de Desarrollo Próximo (ZDP)', 'Condicionamiento', 'Zona de Desarrollo Próximo (ZDP)', 24, 2),
(475, '¿Qué es una \"competencia\" en el contexto educativo moderno?', 'Una calificación numérica', 'El tiempo que se tarda en completar una tarea', 'La capacidad de aplicar conocimientos, habilidades y actitudes para resolver problemas reales', 'La cantidad de información memorizada', 'La capacidad de aplicar conocimientos, habilidades y actitudes para resolver problemas reales', 24, 2),
(476, '¿Qué organismo internacional administra las pruebas PISA para medir el rendimiento educativo global?', 'UNESCO', 'UNICEF', 'OCDE', 'Banco Mundial', 'OCDE', 24, 2),
(477, '¿Qué filósofo y pedagogo estadounidense es conocido por promover la \"educación progresista\" y el aprendizaje a través de la experiencia?', 'Jean-Jacques Rousseau', 'Immanuel Kant', 'John Dewey', 'Sócrates', 'John Dewey', 24, 3),
(478, '¿Qué enfoque educativo se centra en el estudiante como constructor activo de su propio conocimiento a partir de su experiencia previa?', 'Transmisionismo', 'Conductismo', 'Constructivismo', 'Innatismo', 'Constructivismo', 24, 3),
(479, '¿Qué nombre recibe la rama de la filosofía que estudia la naturaleza y los fines de la educación?', 'Ontología', 'Axiología', 'Metafísica', 'Filosofía de la Educación', 'Filosofía de la Educación', 24, 3),
(480, '¿Cuál es el nombre del concepto de Pierre Bourdieu que describe las habilidades, conocimientos y credenciales que confieren estatus social?', 'Capital económico', 'Capital simbólico', 'Capital social', 'Capital cultural', 'Capital cultural', 24, 3),
(481, '¿Qué significa la sigla SENA?', 'Servicio Especial Nacional de Artesanos', 'Sistema Nacional de Aprendizaje', 'Servicio Nacional de Aprendizaje', 'Sector de Negocios y Administración', 'Servicio Nacional de Aprendizaje', 25, 1),
(482, '¿Es la formación impartida por el SENA en Colombia gratuita?', 'Solo para estudiantes de bajos recursos', 'Sí, en todos sus programas', 'No, es muy costosa', 'Solo para empresas', 'Sí, en todos sus programas', 25, 1),
(483, '¿A qué tipo de población busca principalmente capacitar el SENA?', 'Solo a profesionales universitarios', 'Trabajadores, jóvenes y desempleados', 'Solo a empresarios', 'Solo a estudiantes de primaria', 'Trabajadores, jóvenes y desempleados', 25, 1),
(484, '¿Cuál es el lema del SENA?', 'Más conocimiento, más poder', 'Luchamos por el futuro', 'Formación de Calidad para el Trabajo', 'Conocimiento y Sabiduría', 'Formación de Calidad para el Trabajo', 25, 1),
(485, '¿Qué tipo de formación ofrece el SENA?', 'Solo cursos de inglés', 'Formación técnica, tecnológica y complementaria', 'Solo posgrados', 'Solo bachillerato', 'Formación técnica, tecnológica y complementaria', 25, 1),
(486, '¿Cuál es el nombre de la plataforma virtual donde el SENA ofrece cursos en línea?', 'Moodle', 'Sofia Plus', 'SENA Digital', 'Territorium', 'Sofia Plus', 25, 1),
(487, '¿Qué color es predominante en el logo oficial del SENA?', 'Rojo', 'Azul', 'Verde', 'Amarillo', 'Verde', 25, 1),
(488, '¿Qué busca el SENA en el desarrollo social y técnico de los trabajadores colombianos?', 'Inversión', 'Gasto', 'Ahorro', 'Beneficio', 'Inversión', 25, 1),
(489, '¿Qué figura representa la industria en el escudo del SENA?', 'Una rueda dentada', 'Un libro', 'Una hoja de palma', 'Un martillo', 'Una rueda dentada', 25, 1),
(490, '¿Qué se entiende por \"Contrato de Aprendizaje\" en el SENA?', 'Un contrato laboral normal', 'Un tipo de apoyo económico para los instructores', 'Un contrato especial que permite al aprendiz recibir apoyo económico en la etapa práctica', 'Un acuerdo solo entre empresas', 'Un contrato especial que permite al aprendiz recibir apoyo económico en la etapa práctica', 25, 1),
(491, '¿En qué año fue fundado el SENA?', '1945', '1957', '1968', '1980', '1957', 25, 2),
(492, '¿Cuál es el nombre del fundador del SENA?', 'Alfonso López Pumarejo', 'Alberto Lleras Camargo', 'Rodolfo Martínez Tono', 'Gustavo Rojas Pinilla', 'Rodolfo Martínez Tono', 25, 2),
(493, '¿Qué tipo de centro de formación es el CTA, ubicado en Cartago, Valle del Cauca, según su nombre oficial?', 'Centro de Servicios y Gestión Empresarial', 'Centro de Diseño e Innovación Tecnológica', 'Centro Tecnológico del Agua', 'Centro Agroindustrial', 'Centro Tecnológico del Agua', 25, 2),
(494, '¿Qué nombre recibe la persona que guía el proceso de aprendizaje en el SENA?', 'Profesor', 'Maestro', 'Instructor', 'Mentor', 'Instructor', 25, 2),
(495, '¿Qué es un \"Tecnólogo\" en el SENA?', 'Un título universitario de 5 años', 'Un nivel de formación de 3 a 4 semestres', 'Un nivel de formación de solo 6 meses', 'Un título de posgrado', 'Un nivel de formación de 3 a 4 semestres', 25, 2),
(496, '¿Qué ley creó oficialmente al Servicio Nacional de Aprendizaje (SENA)?', 'Ley 119 de 1994', 'Decreto Ley 164 de 1957', 'Ley 30 de 1992', 'Ley 100 de 1993', 'Decreto Ley 164 de 1957', 25, 2),
(497, '¿A qué ministerio está adscrito el SENA?', 'Ministerio de Hacienda', 'Ministerio de Educación Nacional', 'Ministerio del Trabajo', 'Ministerio de Comercio', 'Ministerio del Trabajo', 25, 3),
(498, '¿Qué sector de la economía financia principalmente el funcionamiento del SENA?', 'Impuestos a la renta', 'Aportes parafiscales de los empleadores', 'Ventas de productos del SENA', 'Donaciones internacionales', 'Aportes parafiscales de los empleadores', 25, 3),
(499, '¿Quién era el presidente de Colombia al momento de la fundación del SENA en 1957?', 'Gustavo Rojas Pinilla', 'Alberto Lleras Camargo', 'Junta Militar de Gobierno', 'Gabriel Turbay Abunader', 'Junta Militar de Gobierno', 25, 3),
(500, '¿Cuál es el propósito principal del sistema de \"Normalización de Competencias Laborales\" del SENA?', 'Certificar los productos colombianos', 'Establecer estándares de calidad en la formación para el trabajo', 'Definir el salario mínimo', 'Evaluar a los instructores', 'Establecer estándares de calidad en la formación para el trabajo', 25, 3),
(501, '¿En qué día se celebra Halloween cada año?', '25 de diciembre', '31 de octubre', '14 de febrero', '1 de noviembre', '31 de octubre', 26, 1),
(502, '¿Cuál es la frase más común que dicen los niños al pedir dulces en Halloween?', 'Regalo o castigo', 'Dame un dulce', 'Truco o trato', '¡Feliz día!', 'Truco o trato', 26, 1),
(503, '¿Qué vegetal se talla tradicionalmente para hacer un \"Jack-o\'-lantern\"?', 'Pepino', 'Calabaza', 'Zanahoria', 'Pimiento', 'Calabaza', 26, 1),
(504, '¿Qué disfraz es una criatura mitológica que chupa la sangre de las personas?', 'Mago', 'Momia', 'Vampiro', 'Bruja', 'Vampiro', 26, 1),
(505, '¿Qué animal se asocia a menudo con las brujas y la mala suerte?', 'Perro', 'Gato negro', 'Conejo', 'Pez', 'Gato negro', 26, 1),
(506, '¿Qué es un \"fantasma\"?', 'Una criatura peluda', 'El espíritu de una persona muerta', 'Un tipo de insecto', 'Un ser de otro planeta', 'El espíritu de una persona muerta', 26, 1),
(507, '¿Qué festividad cristiana se celebra el día inmediatamente después de Halloween (1 de noviembre)?', 'Navidad', 'Día de Todos los Santos', 'Pascua', 'Día de la Independencia', 'Día de Todos los Santos', 26, 1),
(508, '¿Qué dulce es una tradición popular en Halloween por su forma y colores (amarillo, naranja y blanco)?', 'Chicle', 'Caramelo de maíz (Candy Corn)', 'Chocolate en barra', 'Gomita de oso', 'Caramelo de maíz (Candy Corn)', 26, 1),
(509, '¿Qué color se asocia tradicionalmente con la noche, el misterio y la muerte en Halloween?', 'Rosa', 'Blanco', 'Negro', 'Rojo', 'Negro', 26, 1),
(510, '¿Qué personaje de ficción es conocido por llevar vendas blancas y revivir después de la muerte?', 'Vampiro', 'Hombre lobo', 'Momia', 'Esqueleto', 'Momia', 26, 1),
(511, '¿Cuál es el nombre original celta de la festividad de la que desciende Halloween?', 'Beltane', 'Samhain', 'Lughnasadh', 'Yule', 'Samhain', 26, 2),
(512, '¿Qué significa la palabra \"Halloween\" etimológicamente?', 'Noche de brujas', 'Festival de otoño', 'Víspera de Todos los Santos', 'Noche de los espíritus', 'Víspera de Todos los Santos', 26, 2),
(513, '¿En qué país surgió principalmente la tradición de tallar calabazas (Jack-o\'-lantern)?', 'Alemania', 'Irlanda', 'Estados Unidos', 'Italia', 'Irlanda', 26, 2),
(514, '¿Qué nombre recibe el miedo irracional a los murciélagos?', 'Aracnofobia', 'Pteronofobia', 'Quiropterofobia', 'Nictofobia', 'Quiropterofobia', 26, 2),
(515, '¿Qué figura literaria y cinematográfica se basa en el Conde Vlad Tepes de Valaquia (Rumania)?', 'Hombre Lobo', 'Frankenstein', 'Drácula', 'La Llorona', 'Drácula', 26, 2),
(516, '¿Qué famoso mago y escapista murió en Halloween de 1926?', 'Houdini', 'Copperfield', 'Blaine', 'Penn & Teller', 'Houdini', 26, 2),
(517, 'Originalmente, ¿qué vegetal se tallaba en Irlanda antes de que se popularizara la calabaza en América?', 'Nabo', 'Patata', 'Remolacha', 'Coliflor', 'Nabo', 26, 3),
(518, '¿Qué festividad mexicana se celebra casi al mismo tiempo que Halloween y tiene un enfoque en honrar a los difuntos?', 'Cinco de Mayo', 'La Guelaguetza', 'Día de Muertos', 'Nochebuena', 'Día de Muertos', 26, 3),
(519, '¿Qué fenómeno astronómico se produce a veces en Halloween, aunque es poco común?', 'Eclipse solar', 'Lluvia de estrellas', 'Luna Azul', 'Súper Luna', 'Luna Azul', 26, 3),
(520, '¿Cuál es el término en latín para \"Víspera de Todos los Santos\" (del que deriva \"Halloween\")?', 'Omnes Sancti', 'Toussaint', 'All Hallow’s Eve', 'Vigilia Omnium Sanctorum', 'Vigilia Omnium Sanctorum', 26, 3),
(521, '¿En qué día se celebra la Navidad?', '1 de enero', '24 de diciembre', '25 de diciembre', '31 de octubre', '25 de diciembre', 27, 1),
(522, '¿Qué personaje legendario reparte regalos a los niños en Nochebuena?', 'El Conejo de Pascua', 'El Duende', 'Santa Claus / Papá Noel', 'El Hada de los Dientes', 'Santa Claus / Papá Noel', 27, 1),
(523, '¿Qué tipo de árbol se decora tradicionalmente para la Navidad?', 'Roble', 'Pino o abeto', 'Palmera', 'Manzano', 'Pino o abeto', 27, 1),
(524, '¿Qué tres regalos trajeron los Reyes Magos al Niño Jesús?', 'Pan, vino y aceite', 'Oro, incienso y mirra', 'Plata, cobre y hierro', 'Miel, leche y lana', 'Oro, incienso y mirra', 27, 1),
(525, '¿Qué animal tira tradicionalmente del trineo de Santa Claus?', 'Caballos', 'Perros', 'Renos', 'Osos', 'Renos', 27, 1),
(526, '¿Cómo se llama el muñeco de nieve más famoso de una canción navideña popular?', 'Frosty', 'Buddy', 'Rudolph', 'Kris', 'Frosty', 27, 1),
(527, '¿Cuál es el nombre de la planta navideña con hojas rojas y verdes que se usa para decorar?', 'Muérdago', 'Rosa', 'Flor de Pascua (Poinsettia)', 'Acebo', 'Flor de Pascua (Poinsettia)', 27, 1),
(528, '¿Cuál es la melodía que se canta en la época de Navidad?', 'Himnos nacionales', 'Villancicos', 'Canciones pop', 'Marchas militares', 'Villancicos', 27, 1),
(529, '¿Qué elemento se coloca en la punta del árbol de Navidad?', 'Una estrella o ángel', 'Una guirnalda', 'Un nido de pájaros', 'Un regalo', 'Una estrella o ángel', 27, 1),
(530, '¿Qué figura es la protagonista principal del nacimiento o pesebre navideño?', 'Los Reyes Magos', 'Jesús, María y José', 'El pastor', 'El ángel', 'Jesús, María y José', 27, 1),
(531, '¿Qué significado tienen las luces en el árbol de Navidad?', 'La riqueza de la familia', 'El calor de la casa', 'La luz de Cristo o la estrella de Belén', 'Los sueños', 'La luz de Cristo o la estrella de Belén', 27, 2),
(532, '¿Qué nombre recibe el pastel navideño tradicional de origen británico que a menudo contiene frutas secas y alcohol?', 'Panettone', 'Fruitcake', 'Yule Log', 'Turrón', 'Fruitcake', 27, 2),
(533, '¿En qué país se originó la tradición del árbol de Navidad, tal como la conocemos hoy?', 'Italia', 'Alemania', 'Inglaterra', 'Francia', 'Alemania', 27, 2),
(534, '¿Qué es el \"Adviento\"?', 'El día de Navidad', 'El período de cuatro semanas antes de Navidad', 'La celebración del fin de año', 'Una fiesta pagana', 'El período de cuatro semanas antes de Navidad', 27, 2),
(535, '¿Qué apóstol es el autor del evangelio que narra el nacimiento de Jesús en Belén?', 'Mateo', 'Marcos', 'Lucas', 'Juan', 'Lucas', 27, 2),
(536, '¿En qué país se celebra la tradición del \"Día de las Velitas\" (7 de diciembre)?', 'México', 'España', 'Colombia', 'Argentina', 'Colombia', 27, 2),
(537, '¿Qué nombre recibe el personaje folclórico en los países alpinos que acompaña a San Nicolás y castiga a los niños malos?', 'Yule Cat', 'Krampus', 'Befana', 'Joulupukki', 'Krampus', 27, 3),
(538, '¿Quién escribió el famoso cuento de Navidad \"Cuento de Navidad\" (A Christmas Carol)?', 'Jane Austen', 'Charles Dickens', 'Mark Twain', 'Edgar Allan Poe', 'Charles Dickens', 27, 3),
(539, '¿Qué nombre recibe el plato tradicional colombiano de Navidad, hecho a base de maíz con carne?', 'Natilla', 'Buñuelo', 'Ajiaco', 'Tamal', 'Tamal', 27, 3),
(540, '¿Qué significado tiene el muérdago en la tradición navideña (además de los besos)?', 'Prosperidad', 'Protección contra el mal', 'Amor eterno', 'Fertilidad', 'Protección contra el mal', 27, 3),
(541, '¿Cuáles son las cuatro funciones básicas del proceso administrativo?', 'Vender, comprar, producir y entregar', 'Planificar, organizar, dirigir y controlar', 'Contratar, despedir, capacitar y pagar', 'Diseñar, construir, probar y lanzar', 'Planificar, organizar, dirigir y controlar', 28, 1),
(542, '¿Qué es una \"misión\" en una empresa?', 'El objetivo final de lucro', 'La razón de ser o propósito actual de la empresa', 'El plan a corto plazo', 'La lista de empleados', 'La razón de ser o propósito actual de la empresa', 28, 1),
(543, '¿Qué función administrativa se encarga de definir los objetivos y los caminos para alcanzarlos?', 'Organización', 'Dirección', 'Control', 'Planificación', 'Planificación', 28, 1),
(544, '¿Qué nombre recibe la representación gráfica de la estructura formal de una organización?', 'Flujograma', 'Diagrama de Gantt', 'Organigrama', 'Presupuesto', 'Organigrama', 28, 1),
(545, '¿Qué es un \"recurso humano\"?', 'El dinero disponible', 'La maquinaria de producción', 'El personal o empleados de una organización', 'Los bienes inmuebles', 'El personal o empleados de una organización', 28, 1),
(546, '¿Qué término se usa para describir el proceso de toma de decisiones en grupo?', 'Individualismo', 'Liderazgo', 'Sinergia', 'Gestión', 'Liderazgo', 28, 1),
(547, '¿Qué es un \"presupuesto\"?', 'Un informe de ventas', 'Un plan financiero para un período determinado', 'Una queja de un cliente', 'Un manual de procedimientos', 'Un plan financiero para un período determinado', 28, 1),
(548, '¿Qué nombre recibe el máximo responsable de una empresa (CEO)?', 'Jefe de ventas', 'Director general (Gerente)', 'Contador', 'Técnico de soporte', 'Director general (Gerente)', 28, 1),
(549, '¿Qué tipo de líder basa su autoridad en el conocimiento y la información más que en su posición formal?', 'Líder autocrático', 'Líder democrático', 'Líder experto', 'Líder carismático', 'Líder experto', 28, 1),
(550, '¿Qué significa \"DOFA\" o \"FODA\" en planificación estratégica?', 'Demandas, Opciones, Finanzas, Acciones', 'Debilidades, Oportunidades, Fortalezas, Amenazas', 'Documentos, Operaciones, Formatos, Archivos', 'Decisiones, Objetivos, Funciones, Autoridad', 'Debilidades, Oportunidades, Fortalezas, Amenazas', 28, 1),
(551, '¿Quién es considerado el padre de la Administración Científica, conocido por su énfasis en la eficiencia y los estudios de tiempo y movimiento?', 'Henri Fayol', 'Max Weber', 'Frederick Winslow Taylor', 'Peter Drucker', 'Frederick Winslow Taylor', 28, 2),
(552, '¿Qué enfoque de la administración (Ej. Elton Mayo) se centró en la importancia de los factores sociales y psicológicos en el trabajo?', 'Teoría de la burocracia', 'Escuela clásica', 'Enfoque de las relaciones humanas', 'Teoría Z', 'Enfoque de las relaciones humanas', 28, 2),
(553, '¿Qué nombre recibe el proceso de delegar autoridad de un nivel superior a uno inferior en la jerarquía?', 'Centralización', 'Departamentalización', 'Descentralización', 'Coordinación', 'Descentralización', 28, 2),
(554, '¿Qué se entiende por \"benchmarking\"?', 'Un sistema de incentivos salariales', 'Un método para evaluar y comparar los procesos de una empresa con los de los líderes del sector', 'Un tipo de contabilidad', 'La creación de un nuevo producto', 'Un método para evaluar y comparar los procesos de una empresa con los de los líderes del sector', 28, 2),
(555, '¿Cuál es la diferencia entre \"eficacia\" y \"eficiencia\"?', 'La eficacia es a largo plazo', 'La eficiencia es a corto plazo', 'La eficacia es hacer lo correcto y la eficiencia es hacerlo bien (con el mínimo de recursos)', 'Son sinónimos', 'La eficacia es hacer lo correcto y la eficiencia es hacerlo bien (con el mínimo de recursos)', 28, 2),
(556, '¿Qué teoría de motivación (Ej. Maslow) propone que las necesidades humanas se organizan en una jerarquía de cinco niveles?', 'Teoría X y Y', 'Teoría bifactorial', 'Teoría de las necesidades adquiridas', 'Jerarquía de necesidades', 'Jerarquía de necesidades', 28, 2),
(557, '¿Qué teórico administrativo definió los 14 principios de la administración, incluyendo la unidad de mando y la jerarquía?', 'Frederick W. Taylor', 'Henri Fayol', 'Peter Drucker', 'Chester Barnard', 'Henri Fayol', 28, 3),
(558, '¿Qué enfoque de gestión se centra en la mejora continua de la calidad de productos y procesos (Ej. Deming)?', 'Reingeniería', 'Gestión por objetivos (GPO)', 'Calidad Total (TQM)', 'Outsourcing', 'Calidad Total (TQM)', 28, 3),
(559, '¿Qué es la \"visión\" organizacional?', 'El estado actual de las ventas', 'La forma en que la organización se ve a sí misma en el futuro (a largo plazo)', 'El código de vestimenta', 'La política de vacaciones', 'La forma en que la organización se ve a sí misma en el futuro (a largo plazo)', 28, 3);
INSERT INTO `tbl_preguntas` (`ID_pregunta`, `enunciado_pregunta`, `opcion1_pregunta`, `opcion2_pregunta`, `opcion3_pregunta`, `opcion4_pregunta`, `correcta_pregunta`, `TBL_categorias_ID_categoria`, `TBL_dificultades_ID_dificultad`) VALUES
(560, '¿Qué nombre recibe la estructura organizacional donde los empleados reportan a dos gerentes (uno funcional y uno de proyecto)?', 'Estructura lineal', 'Estructura divisional', 'Estructura matricial', 'Estructura plana', 'Estructura matricial', 28, 3),
(561, '¿Cuál es la ecuación contable fundamental?', 'Ingresos - Egresos = Utilidad', 'Activo + Pasivo = Patrimonio', 'Activo = Pasivo + Patrimonio', 'Ventas = Costos + Ganancia', 'Activo = Pasivo + Patrimonio', 29, 1),
(562, '¿Qué nombre recibe el recurso que la empresa posee y que genera beneficios futuros (Ej. efectivo, edificios)?', 'Pasivo', 'Gasto', 'Patrimonio', 'Activo', 'Activo', 29, 1),
(563, '¿Qué nombre recibe la deuda u obligación financiera de la empresa con terceros?', 'Ingreso', 'Activo', 'Pasivo', 'Capital', 'Pasivo', 29, 1),
(564, '¿Qué informe contable muestra los ingresos, costos y gastos de una empresa en un período (resultado de la operación)?', 'Balance General', 'Flujo de Caja', 'Estado de Resultados', 'Informe de Ventas', 'Estado de Resultados', 29, 1),
(565, '¿Cuál es la base de la contabilidad moderna (que cada transacción afecta a por lo menos dos cuentas)?', 'Principio de continuidad', 'Partida Doble', 'Principio de materialidad', 'Base de efectivo', 'Partida Doble', 29, 1),
(566, '¿Qué documento se utiliza para registrar cronológicamente todas las transacciones de una empresa?', 'Balance de comprobación', 'Libro Mayor', 'Libro Diario', 'Inventario', 'Libro Diario', 29, 1),
(567, '¿Qué se entiende por \"depreciación\"?', 'Aumento del valor de un activo', 'Registro del desgaste de un activo fijo a lo largo del tiempo', 'Pago de una deuda', 'Cobro de una factura', 'Registro del desgaste de un activo fijo a lo largo del tiempo', 29, 1),
(568, '¿Qué nombre reciben los beneficios que una empresa obtiene después de cubrir todos sus costos y gastos?', 'Pérdida', 'Utilidad / Ganancia', 'Activo', 'Pasivo', 'Utilidad / Ganancia', 29, 1),
(569, '¿Qué cuenta representa las obligaciones de la empresa con sus proveedores?', 'Cuentas por cobrar', 'Cuentas por pagar', 'Caja', 'Inventario', 'Cuentas por pagar', 29, 1),
(570, '¿Qué principio contable establece que las transacciones deben registrarse a su costo original (monetario)?', 'Principio de revelación completa', 'Principio de uniformidad', 'Principio de costo histórico', 'Principio de devengo', 'Principio de costo histórico', 29, 1),
(571, '¿Qué estado financiero muestra la posición financiera de una empresa en un momento específico (fotografía financiera)?', 'Estado de Resultados', 'Estado de Cambios en el Patrimonio', 'Balance General', 'Flujo de Caja', 'Balance General', 29, 2),
(572, '¿Qué se entiende por \"capital social\"?', 'Las deudas a largo plazo', 'El aporte inicial de los dueños o socios de la empresa', 'Las utilidades retenidas', 'Los activos fijos', 'El aporte inicial de los dueños o socios de la empresa', 29, 2),
(573, '¿Cuál es el nombre del conjunto de reglas que rigen la preparación y presentación de la información financiera a nivel internacional?', 'GAAP', 'NIIF (IFRS)', 'Normas ISO', 'PIB', 'NIIF (IFRS)', 29, 2),
(574, '¿Qué es un \"asiento de ajuste\"?', 'Un registro de un error', 'Una corrección de un ingreso', 'Una entrada al final del período para reconocer ingresos o gastos que no se han registrado (Ej. Depreciación)', 'Una venta a crédito', 'Una entrada al final del período para reconocer ingresos o gastos que no se han registrado (Ej. Depreciación)', 29, 2),
(575, '¿Qué ratio financiero mide la capacidad de una empresa para cubrir sus deudas a corto plazo (Activo Corriente / Pasivo Corriente)?', 'Rentabilidad', 'Endeudamiento', 'Liquidez (Ratio Corriente)', 'Actividad', 'Liquidez (Ratio Corriente)', 29, 2),
(576, '¿Qué tipo de costo varía en proporción directa al volumen de producción (Ej. materias primas)?', 'Costo fijo', 'Costo indirecto', 'Costo variable', 'Costo de oportunidad', 'Costo variable', 29, 2),
(577, '¿Qué principio contable establece que los ingresos deben registrarse cuando se ganan y los gastos cuando se incurren, independientemente de cuándo se reciba o pague el efectivo?', 'Principio de entidad', 'Principio de costo histórico', 'Principio de devengo (Acumulación)', 'Principio de negocio en marcha', 'Principio de devengo (Acumulación)', 29, 3),
(578, '¿Qué nombre recibe el método de valoración de inventarios que asume que la última mercancía comprada es la primera en venderse?', 'PEPS (FIFO)', 'UEPS (LIFO)', 'Costo promedio', 'Identificación específica', 'UEPS (LIFO)', 29, 3),
(579, '¿Cuál es el nombre del impuesto que se aplica al consumo en la mayoría de los países, gravando el valor añadido en cada etapa de la producción?', 'Impuesto sobre la Renta', 'Impuesto Predial', 'Impuesto al Valor Agregado (IVA)', 'Impuesto al Patrimonio', 'Impuesto al Valor Agregado (IVA)', 29, 3),
(580, '¿Qué se considera \"Goodwill\" o \"Crédito Mercantil\" en contabilidad?', 'El valor de los inventarios', 'Un activo intangible que representa el valor de la reputación o marca de una empresa sobre sus activos netos tangibles', 'Un pasivo a largo plazo', 'Un tipo de acción preferente', 'Un activo intangible que representa el valor de la reputación o marca de una empresa sobre sus activos netos tangibles', 29, 3),
(581, '¿Qué herramienta se utiliza para medir el cuerpo y el largo de la tela?', 'Regla de metal', 'Cinta métrica', 'Escuadra', 'Transportador', 'Cinta métrica', 30, 1),
(582, '¿Qué herramienta se usa para cortar la tela antes de coser?', 'Cuchillo', 'Tijeras de papel', 'Tijeras de sastre', 'Cutter', 'Tijeras de sastre', 30, 1),
(583, '¿Qué elemento es esencial para unir dos piezas de tela temporalmente antes de coserlas?', 'Pegamento', 'Alfileres', 'Grapas', 'Tiza', 'Alfileres', 30, 1),
(584, '¿Qué nombre recibe el borde de la tela que está tejido o acabado para evitar que se deshilache?', 'Centro', 'Sisa', 'Bies', 'Orillo', 'Orillo', 30, 1),
(585, '¿Qué parte de la máquina de coser sostiene la canilla y regula la tensión del hilo inferior?', 'Prensatelas', 'Aguja', 'Bobina', 'Canillero (Caja de bobina)', 'Canillero (Caja de bobina)', 30, 1),
(586, '¿Qué se hace para asegurar los extremos de una costura y evitar que se deshaga?', 'Cortar el hilo', 'Rematar (hacer un nudo o retroceder la costura)', 'Planchar', 'Bordar', 'Rematar (hacer un nudo o retroceder la costura)', 30, 1),
(587, '¿Qué tipo de puntada es la más común y básica para unir dos piezas de tela en línea recta?', 'Zigzag', 'Overlock', 'Puntada recta', 'Puntada invisible', 'Puntada recta', 30, 1),
(588, '¿Qué nombre recibe el hilo que se usa en la parte superior de la máquina de coser y viene de un carrete grande?', 'Hilo inferior', 'Hilo de bobina', 'Hilo de canilla', 'Hilo superior', 'Hilo superior', 30, 1),
(589, '¿Qué nombre recibe el pequeño instrumento que se usa para deshacer las costuras incorrectas?', 'Aguja', 'Dedal', 'Descosedor (Abre-ojales)', 'Ganchillo', 'Descosedor (Abre-ojales)', 30, 1),
(590, '¿Qué es un patrón en costura?', 'Una tela de color sólido', 'Un molde de papel para cortar las piezas de la prenda', 'Un tipo de aguja', 'El nombre de un hilo', 'Un molde de papel para cortar las piezas de la prenda', 30, 1),
(591, '¿Qué función tiene el \"dedal\"?', 'Sostener la tela', 'Proteger el dedo al coser a mano y empujar la aguja', 'Medir la distancia entre puntadas', 'Guardar los alfileres', 'Proteger el dedo al coser a mano y empujar la aguja', 30, 2),
(592, '¿Qué tela está hecha de fibras entrelazadas que se pueden deshilachar fácilmente y se teje en un telar?', 'Punto (knit)', 'Fieltro', 'Tela plana (tejido de calada)', 'Cuero', 'Tela plana (tejido de calada)', 30, 2),
(593, '¿Qué tipo de costura se utiliza para unir dos piezas de tela y luego cortar y rematar el exceso de margen para prevenir el deshilachado?', 'Costura francesa', 'Costura abierta', 'Costura inglesa', 'Costura solapada', 'Costura francesa', 30, 2),
(594, '¿Qué nombre recibe la máquina que cose y remata los bordes de la tela simultáneamente?', 'Máquina recta industrial', 'Máquina overlock (remalladora)', 'Máquina de bordar', 'Máquina de acolchar', 'Máquina overlock (remalladora)', 30, 2),
(595, '¿Qué se marca en la tela con \"piquetes\" (pequeños cortes o muescas)?', 'Los bolsillos', 'Los puntos de unión o alineación de las piezas', 'El centro de la tela', 'El largo del ruedo', 'Los puntos de unión o alineación de las piezas', 30, 2),
(596, '¿Qué es el \"borde sesgado\" (o bies)?', 'Una línea horizontal', 'Una línea que sigue el sentido del hilo', 'Una línea que se corta en un ángulo de 45 grados respecto al orillo', 'Una línea vertical', 'Una línea que se corta en un ángulo de 45 grados respecto al orillo', 30, 2),
(597, '¿Qué se conoce como \"patrón de línea A\" en el diseño de moda?', 'Un patrón recto y ajustado', 'Un patrón que es ajustado en la parte superior y se ensancha gradualmente hacia el bajo', 'Un patrón con cuello alto', 'Un patrón sin mangas', 'Un patrón que es ajustado en la parte superior y se ensancha gradualmente hacia el bajo', 30, 3),
(598, '¿Qué nombre recibe el método de corte que consiste en disponer todas las piezas del patrón sobre la tela antes de cortar para optimizar el uso del material?', 'Tizado', 'Marcado', 'Tendido', 'Entretelado', 'Tendido', 30, 3),
(599, '¿Cuál es la función principal de la \"entretela\" o \"interfaz\" en la costura?', 'Decorar la prenda', 'Dar cuerpo y estabilidad a áreas específicas (Ej. cuellos y puños)', 'Hacer la prenda más suave', 'Impedir el deshilachado', 'Dar cuerpo y estabilidad a áreas específicas (Ej. cuellos y puños)', 30, 3),
(600, '¿Qué hilo es típicamente más grueso y resistente, utilizado para costuras decorativas o para coser materiales pesados como el cuero?', 'Hilo de seda', 'Hilo de poliéster', 'Hilo de coser normal', 'Hilo de torzal', 'Hilo de torzal', 30, 3),
(601, '¿Qué utensilio se utiliza para batir huevos o cremas vigorosamente?', 'Cuchara', 'Espátula', 'Batidor de varillas (Globo)', 'Cucharón', 'Batidor de varillas (Globo)', 31, 1),
(602, '¿Qué se añade a la masa para que el pan o un pastel crezca?', 'Azúcar', 'Sal', 'Levadura (o polvo de hornear)', 'Agua', 'Levadura (o polvo de hornear)', 31, 1),
(603, '¿Qué técnica de cocción implica cocinar los alimentos sumergidos en grasa muy caliente?', 'Hervir', 'Asar', 'Freír', 'Hornear', 'Freír', 31, 1),
(604, '¿Qué se utiliza para saber la temperatura interna de un pavo o un trozo de carne?', 'Termómetro de cocina', 'Cronómetro', 'Báscula', 'Tenedor', 'Termómetro de cocina', 31, 1),
(605, '¿Qué nombre recibe la acción de cortar verduras en tiras muy finas (Ej. cebolla)?', 'Picar', 'Rebanar', 'Juliana', 'Majar', 'Juliana', 31, 1),
(606, '¿Qué tipo de cuchillo es el más versátil y se utiliza para la mayoría de tareas en la cocina?', 'Cuchillo de pan', 'Cuchillo de chef (Cebollero)', 'Cuchillo de sierra', 'Cuchillo de pescado', 'Cuchillo de chef (Cebollero)', 31, 1),
(607, '¿Qué se hace para \"sellar\" la carne antes de asarla o guisarla?', 'Congelarla', 'Cubrirla con especias', 'Dorar la superficie rápidamente a fuego alto', 'Hervirla', 'Dorar la superficie rápidamente a fuego alto', 31, 1),
(608, '¿Qué nombre recibe el líquido resultante de cocer lentamente huesos, verduras o carnes para obtener sabor concentrado?', 'Agua con sal', 'Caldo o fondo', 'Jugo de frutas', 'Leche', 'Caldo o fondo', 31, 1),
(609, '¿Qué especia es la que proviene de la corteza de un árbol y se usa frecuentemente en postres y bebidas calientes?', 'Pimienta', 'Azafrán', 'Vainilla', 'Canela', 'Canela', 31, 1),
(610, '¿Qué se utiliza para saber el peso exacto de los ingredientes en una receta?', 'Taza medidora', 'Balanza (Báscula) de cocina', 'Jarra medidora', 'Cuchara sopera', 'Balanza (Báscula) de cocina', 31, 1),
(611, '¿Qué significa \"blanquear\" en cocina?', 'Hervir un alimento brevemente y luego enfriarlo rápidamente', 'Agregar leche a un caldo', 'Cocinar sin sal', 'Freír hasta que esté pálido', 'Hervir un alimento brevemente y luego enfriarlo rápidamente', 31, 2),
(612, '¿Qué proceso químico produce burbujas de gas en la masa de pan, haciendo que suba?', 'Caramelización', 'Fermentación', 'Emulsión', 'Oxidación', 'Fermentación', 31, 2),
(613, '¿Qué se utiliza para espesar una salsa mediante la mezcla de mantequilla y harina a partes iguales?', 'Glaseado', 'Beurre manié', 'Roux', 'Gelatina', 'Roux', 31, 2),
(614, '¿Qué nombre recibe el método de cocinar a fuego lento y prolongado, utilizando una pequeña cantidad de líquido en un recipiente cerrado?', 'Saltear', 'Gratinar', 'Estofar (Braising)', 'Vapor', 'Estofar (Braising)', 31, 2),
(615, '¿Qué salsa clásica se prepara emulsionando yemas de huevo con mantequilla clarificada y jugo de limón?', 'Salsa bechamel', 'Salsa de tomate', 'Salsa holandesa', 'Salsa pesto', 'Salsa holandesa', 31, 2),
(616, '¿Cuál es la temperatura de seguridad recomendada para la cocción de la carne de ave (pollo, pavo)?', '$60^circ C$', '$74^circ C$', '$85^circ C$', '$100^circ C$', '$74^circ C$', 31, 2),
(617, '¿Qué es un \"fondo oscuro\" o \"caldo oscuro\"?', 'Un caldo hecho con pescado', 'Un caldo hecho con huesos asados previamente para darle color', 'Un caldo hecho solo con vegetales', 'Un caldo con mucho vino tinto', 'Un caldo hecho con huesos asados previamente para darle color', 31, 3),
(618, '¿Qué nombre recibe el método de cocción por calor seco donde la fuente de calor viene de arriba (Ej. para gratinar quesos)?', 'Escalfar', 'Pochar', 'Grillar', 'Salamandra (Broil)', 'Salamandra (Broil)', 31, 3),
(619, '¿Qué tipo de masa clásica de repostería es ligera y hueca, utilizada para hacer profiteroles o eclairs?', 'Masa quebrada', 'Masa hojaldre', 'Masa choux', 'Masa filo', 'Masa choux', 31, 3),
(620, '¿Qué nombre recibe la técnica de frotar una grasa sólida (mantequilla fría) con harina para crear una textura escamosa (Ej. en tartas)?', 'Amasar', 'Cremar', 'Sablar (Rubbing-in)', 'Macerar', 'Sablar (Rubbing-in)', 31, 3),
(621, '¿Qué tipo de contracción muscular implica que el músculo se alarga mientras está bajo tensión (Ej. bajar lentamente una pesa)?', 'Isométrica', 'Isotónica', 'Excéntrica', 'Concéntrica', 'Excéntrica', 14, 1),
(622, '¿Qué es el \"VO2 máximo\"?', 'El volumen máximo de oxígeno que el cuerpo puede consumir por minuto', 'La frecuencia cardíaca máxima', 'La fuerza muscular máxima', 'El número de repeticiones máximas', 'El volumen máximo de oxígeno que el cuerpo puede consumir por minuto', 14, 1),
(623, '¿Qué nombre recibe el proceso de aumentar progresivamente la carga de entrenamiento para obtener mejoras continuas?', 'Principio de especificidad', 'Principio de reversibilidad', 'Principio de sobrecarga progresiva', 'Principio de individualización', 'Principio de sobrecarga progresiva', 14, 1),
(624, '¿Qué nutriente es la principal fuente de energía rápida durante ejercicios de alta intensidad?', 'Proteínas', 'Grasas', 'Vitaminas', 'Carbohidratos', 'Carbohidratos', 14, 1),
(625, '¿Qué articulación conecta el fémur con la pelvis y es una de las más estables del cuerpo?', 'Rodilla', 'Codo', 'Hombro', 'Cadera', 'Cadera', 14, 1),
(626, '¿Qué nombre recibe la adaptación fisiológica que permite al corazón bombear más sangre por latido (Aumento del Volumen Sistólico)?', 'Hipertensión', 'Bradicardia', 'Hipertrofia cardíaca patológica', 'Hipertrofia cardíaca fisiológica', 'Hipertrofia cardíaca fisiológica', 14, 2),
(627, '¿Qué zona del entrenamiento cardiovascular se recomienda para mejorar la resistencia aeróbica de base (generalmente 60-70% de la FCM)?', 'Zona Roja', 'Zona 1 (Recuperación)', 'Zona 3 (Umbral aeróbico)', 'Zona 5 (Máximo esfuerzo)', 'Zona 3 (Umbral aeróbico)', 14, 2),
(628, '¿Qué músculo principal es el responsable de la extensión del codo (Ej. en un press de banca)?', 'Bíceps braquial', 'Deltoides anterior', 'Pectoral mayor', 'Tríceps braquial', 'Tríceps braquial', 14, 2),
(629, '¿Qué técnica de entrenamiento se caracteriza por alternar periodos cortos y muy intensos de ejercicio con periodos de descanso o baja intensidad?', 'Entrenamiento de fuerza máxima', 'Entrenamiento de resistencia aeróbica continua', 'Entrenamiento Intervalico de Alta Intensidad (HIIT)', 'Entrenamiento isométrico', 'Entrenamiento Intervalico de Alta Intensidad (HIIT)', 14, 2),
(630, '¿Qué se busca evaluar con la prueba de \"1 Repetición Máxima\" (1RM)?', 'Resistencia aeróbica', 'Potencia muscular', 'Fuerza máxima', 'Velocidad de reacción', 'Fuerza máxima', 14, 2),
(631, '¿Qué tipo de palanca biomecánica tiene el fulcro (articulación) entre la fuerza aplicada (músculo) y la resistencia (peso)?', 'Palanca de primer género', 'Palanca de segundo género', 'Palanca de tercer género', 'Palanca de cuarto género', 'Palanca de primer género', 14, 2),
(632, '¿Qué hormona anabólica promueve la síntesis de proteínas y el crecimiento muscular después del ejercicio de fuerza?', 'Cortisol', 'Insulina', 'Testosterona', 'Adrenalina', 'Testosterona', 14, 2),
(633, '¿Qué fase del ciclo de periodización anual se enfoca en el desarrollo de capacidades físicas generales y una alta carga de trabajo?', 'Fase competitiva', 'Fase de transición', 'Fase específica', 'Fase preparatoria general', 'Fase preparatoria general', 14, 2),
(634, '¿Cuál es la función principal de los ligamentos en el sistema músculo-esquelético?', 'Unir músculo con músculo', 'Unir hueso con hueso', 'Unir músculo con hueso', 'Producir movimiento', 'Unir hueso con hueso', 14, 2),
(635, '¿Qué nombre recibe el sistema de energía que utiliza el fosfocreatina y es predominante en esfuerzos explosivos de menos de 10 segundos?', 'Sistema oxidativo', 'Glucólisis aeróbica', 'Sistema anaeróbico aláctico (ATP-PCr)', 'Glucólisis anaeróbica', 'Sistema anaeróbico aláctico (ATP-PCr)', 14, 2),
(636, '¿Qué herramienta se utiliza para medir el cuerpo y el largo de la tela?', 'Regla de metal', 'Cinta métrica', 'Escuadra', 'Transportador', 'Cinta métrica', 30, 1),
(637, '¿Qué herramienta se usa para cortar la tela antes de coser?', 'Cuchillo', 'Tijeras de papel', 'Tijeras de sastre', 'Cutter', 'Tijeras de sastre', 30, 1),
(638, '¿Qué elemento es esencial para unir dos piezas de tela temporalmente antes de coserlas?', 'Pegamento', 'Alfileres', 'Grapas', 'Tiza', 'Alfileres', 30, 1),
(639, '¿Qué nombre recibe el borde de la tela que está tejido o acabado para evitar que se deshilache?', 'Centro', 'Sisa', 'Bies', 'Orillo', 'Orillo', 30, 1),
(640, '¿Qué parte de la máquina de coser sostiene la canilla y regula la tensión del hilo inferior?', 'Prensatelas', 'Aguja', 'Bobina', 'Canillero (Caja de bobina)', 'Canillero (Caja de bobina)', 30, 1),
(641, '¿Qué se hace para asegurar los extremos de una costura y evitar que se deshaga?', 'Cortar el hilo', 'Rematar (hacer un nudo o retroceder la costura)', 'Planchar', 'Bordar', 'Rematar (hacer un nudo o retroceder la costura)', 30, 1),
(642, '¿Qué tipo de puntada es la más común y básica para unir dos piezas de tela en línea recta?', 'Zigzag', 'Overlock', 'Puntada recta', 'Puntada invisible', 'Puntada recta', 30, 1),
(643, '¿Qué nombre recibe el hilo que se usa en la parte superior de la máquina de coser y viene de un carrete grande?', 'Hilo inferior', 'Hilo de bobina', 'Hilo de canilla', 'Hilo superior', 'Hilo superior', 30, 1),
(644, '¿Qué nombre recibe el pequeño instrumento que se usa para deshacer las costuras incorrectas?', 'Aguja', 'Dedal', 'Descosedor (Abre-ojales)', 'Ganchillo', 'Descosedor (Abre-ojales)', 30, 1),
(645, '¿Qué es un patrón en costura?', 'Una tela de color sólido', 'Un molde de papel para cortar las piezas de la prenda', 'Un tipo de aguja', 'El nombre de un hilo', 'Un molde de papel para cortar las piezas de la prenda', 30, 1),
(646, '¿Qué función tiene el \"dedal\"?', 'Sostener la tela', 'Proteger el dedo al coser a mano y empujar la aguja', 'Medir la distancia entre puntadas', 'Guardar los alfileres', 'Proteger el dedo al coser a mano y empujar la aguja', 30, 2),
(647, '¿Qué tela está hecha de fibras entrelazadas que se pueden deshilachar fácilmente y se teje en un telar?', 'Punto (knit)', 'Fieltro', 'Tela plana (tejido de calada)', 'Cuero', 'Tela plana (tejido de calada)', 30, 2),
(648, '¿Qué tipo de costura se utiliza para unir dos piezas de tela y luego cortar y rematar el exceso de margen para prevenir el deshilachado?', 'Costura francesa', 'Costura abierta', 'Costura inglesa', 'Costura solapada', 'Costura francesa', 30, 2),
(649, '¿Qué nombre recibe la máquina que cose y remata los bordes de la tela simultáneamente?', 'Máquina recta industrial', 'Máquina overlock (remalladora)', 'Máquina de bordar', 'Máquina de acolchar', 'Máquina overlock (remalladora)', 30, 2),
(650, '¿Qué se marca en la tela con \"piquetes\" (pequeños cortes o muescas)?', 'Los bolsillos', 'Los puntos de unión o alineación de las piezas', 'El centro de la tela', 'El largo del ruedo', 'Los puntos de unión o alineación de las piezas', 30, 2),
(651, '¿Qué es el \"borde sesgado\" (o bies)?', 'Una línea horizontal', 'Una línea que sigue el sentido del hilo', 'Una línea que se corta en un ángulo de 45 grados respecto al orillo', 'Una línea vertical', 'Una línea que se corta en un ángulo de 45 grados respecto al orillo', 30, 2),
(652, '¿Qué se conoce como \"patrón de línea A\" en el diseño de moda?', 'Un patrón recto y ajustado', 'Un patrón que es ajustado en la parte superior y se ensancha gradualmente hacia el bajo', 'Un patrón con cuello alto', 'Un patrón sin mangas', 'Un patrón que es ajustado en la parte superior y se ensancha gradualmente hacia el bajo', 30, 3),
(653, '¿Qué nombre recibe el método de corte que consiste en disponer todas las piezas del patrón sobre la tela antes de cortar para optimizar el uso del material?', 'Tizado', 'Marcado', 'Tendido', 'Entretelado', 'Tendido', 30, 3),
(654, '¿Cuál es la función principal de la \"entretela\" o \"interfaz\" en la costura?', 'Decorar la prenda', 'Dar cuerpo y estabilidad a áreas específicas (Ej. cuellos y puños)', 'Hacer la prenda más suave', 'Impedir el deshilachado', 'Dar cuerpo y estabilidad a áreas específicas (Ej. cuellos y puños)', 30, 3),
(655, '¿Qué hilo es típicamente más grueso y resistente, utilizado para costuras decorativas o para coser materiales pesados como el cuero?', 'Hilo de seda', 'Hilo de poliéster', 'Hilo de coser normal', 'Hilo de torzal', 'Hilo de torzal', 30, 3),
(656, '¿Qué utensilio se utiliza para batir huevos o cremas vigorosamente?', 'Cuchara', 'Espátula', 'Batidor de varillas (Globo)', 'Cucharón', 'Batidor de varillas (Globo)', 31, 1),
(657, '¿Qué se añade a la masa para que el pan o un pastel crezca?', 'Azúcar', 'Sal', 'Levadura (o polvo de hornear)', 'Agua', 'Levadura (o polvo de hornear)', 31, 1),
(658, '¿Qué técnica de cocción implica cocinar los alimentos sumergidos en grasa muy caliente?', 'Hervir', 'Asar', 'Freír', 'Hornear', 'Freír', 31, 1),
(659, '¿Qué se utiliza para saber la temperatura interna de un pavo o un trozo de carne?', 'Termómetro de cocina', 'Cronómetro', 'Báscula', 'Tenedor', 'Termómetro de cocina', 31, 1),
(660, '¿Qué nombre recibe la acción de cortar verduras en tiras muy finas (Ej. cebolla)?', 'Picar', 'Rebanar', 'Juliana', 'Majar', 'Juliana', 31, 1),
(661, '¿Qué tipo de cuchillo es el más versátil y se utiliza para la mayoría de tareas en la cocina?', 'Cuchillo de pan', 'Cuchillo de chef (Cebollero)', 'Cuchillo de sierra', 'Cuchillo de pescado', 'Cuchillo de chef (Cebollero)', 31, 1),
(662, '¿Qué se hace para \"sellar\" la carne antes de asarla o guisarla?', 'Congelarla', 'Cubrirla con especias', 'Dorar la superficie rápidamente a fuego alto', 'Hervirla', 'Dorar la superficie rápidamente a fuego alto', 31, 1),
(663, '¿Qué nombre recibe el líquido resultante de cocer lentamente huesos, verduras o carnes para obtener sabor concentrado?', 'Agua con sal', 'Caldo o fondo', 'Jugo de frutas', 'Leche', 'Caldo o fondo', 31, 1),
(664, '¿Qué especia es la que proviene de la corteza de un árbol y se usa frecuentemente en postres y bebidas calientes?', 'Pimienta', 'Azafrán', 'Vainilla', 'Canela', 'Canela', 31, 1),
(665, '¿Qué se utiliza para saber el peso exacto de los ingredientes en una receta?', 'Taza medidora', 'Balanza (Báscula) de cocina', 'Jarra medidora', 'Cuchara sopera', 'Balanza (Báscula) de cocina', 31, 1),
(666, '¿Qué significa \"blanquear\" en cocina?', 'Hervir un alimento brevemente y luego enfriarlo rápidamente', 'Agregar leche a un caldo', 'Cocinar sin sal', 'Freír hasta que esté pálido', 'Hervir un alimento brevemente y luego enfriarlo rápidamente', 31, 2),
(667, '¿Qué proceso químico produce burbujas de gas en la masa de pan, haciendo que suba?', 'Caramelización', 'Fermentación', 'Emulsión', 'Oxidación', 'Fermentación', 31, 2),
(668, '¿Qué se utiliza para espesar una salsa mediante la mezcla de mantequilla y harina a partes iguales?', 'Glaseado', 'Beurre manié', 'Roux', 'Gelatina', 'Roux', 31, 2),
(669, '¿Qué nombre recibe el método de cocinar a fuego lento y prolongado, utilizando una pequeña cantidad de líquido en un recipiente cerrado?', 'Saltear', 'Gratinar', 'Estofar (Braising)', 'Vapor', 'Estofar (Braising)', 31, 2),
(670, '¿Qué salsa clásica se prepara emulsionando yemas de huevo con mantequilla clarificada y jugo de limón?', 'Salsa bechamel', 'Salsa de tomate', 'Salsa holandesa', 'Salsa pesto', 'Salsa holandesa', 31, 2),
(671, '¿Cuál es la temperatura de seguridad recomendada para la cocción de la carne de ave (pollo, pavo)?', '$60^circ C$', '$74^circ C$', '$85^circ C$', '$100^circ C$', '$74^circ C$', 31, 2),
(672, '¿Qué es un \"fondo oscuro\" o \"caldo oscuro\"?', 'Un caldo hecho con pescado', 'Un caldo hecho con huesos asados previamente para darle color', 'Un caldo hecho solo con vegetales', 'Un caldo con mucho vino tinto', 'Un caldo hecho con huesos asados previamente para darle color', 31, 3),
(673, '¿Qué nombre recibe el método de cocción por calor seco donde la fuente de calor viene de arriba (Ej. para gratinar quesos)?', 'Escalfar', 'Pochar', 'Grillar', 'Salamandra (Broil)', 'Salamandra (Broil)', 31, 3),
(674, '¿Qué tipo de masa clásica de repostería es ligera y hueca, utilizada para hacer profiteroles o eclairs?', 'Masa quebrada', 'Masa hojaldre', 'Masa choux', 'Masa filo', 'Masa choux', 31, 3),
(675, '¿Qué nombre recibe la técnica de frotar una grasa sólida (mantequilla fría) con harina para crear una textura escamosa (Ej. en tartas)?', 'Amasar', 'Cremar', 'Sablar (Rubbing-in)', 'Macerar', 'Sablar (Rubbing-in)', 31, 3);

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
  MODIFY `ID_administrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_categorias`
--
ALTER TABLE `tbl_categorias`
  MODIFY `ID_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_codigoacesso`
--
ALTER TABLE `tbl_codigoacesso`
  MODIFY `ID_codigoAcesso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `ID_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_preguntas`
--
ALTER TABLE `tbl_preguntas`
  MODIFY `ID_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=676;

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
