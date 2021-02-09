-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 16-07-2018 a las 05:15:37
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `archinet`
--
CREATE DATABASE IF NOT EXISTS `archinet` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `archinet`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos`
--

DROP TABLE IF EXISTS `anexos`;
CREATE TABLE `anexos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `archivo_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

DROP TABLE IF EXISTS `archivos`;
CREATE TABLE `archivos` (
  `id` int(10) UNSIGNED NOT NULL,
  `ubicacion` varchar(250) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulos`
--

DROP TABLE IF EXISTS `capitulos`;
CREATE TABLE `capitulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `descripcion` text,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
CREATE TABLE `ciudades` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `departamento_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id`, `nombre`, `departamento_id`) VALUES
(1, 'EL ENCANTO', 1),
(2, 'LA CHORRERA', 1),
(3, 'LA PEDRERA', 1),
(4, 'LA VICTORIA', 1),
(5, 'LETICIA', 1),
(6, 'MIRITI', 1),
(7, 'PUERTO ALEGRIA', 1),
(8, 'PUERTO ARICA', 1),
(9, 'PUERTO NARIÑO', 1),
(10, 'PUERTO SANTANDER', 1),
(11, 'TURAPACA', 1),
(12, 'ABEJORRAL', 2),
(13, 'ABRIAQUI', 2),
(14, 'ALEJANDRIA', 2),
(15, 'AMAGA', 2),
(16, 'AMALFI', 2),
(17, 'ANDES', 2),
(18, 'ANGELOPOLIS', 2),
(19, 'ANGOSTURA', 2),
(20, 'ANORI', 2),
(21, 'ANTIOQUIA', 2),
(22, 'ANZA', 2),
(23, 'APARTADO', 2),
(24, 'ARBOLETES', 2),
(25, 'ARGELIA', 2),
(26, 'ARMENIA', 2),
(27, 'BARBOSA', 2),
(28, 'BELLO', 2),
(29, 'BELMIRA', 2),
(30, 'BETANIA', 2),
(31, 'BETULIA', 2),
(32, 'BOLIVAR', 2),
(33, 'BRICEÑO', 2),
(34, 'BURITICA', 2),
(35, 'CACERES', 2),
(36, 'CAICEDO', 2),
(37, 'CALDAS', 2),
(38, 'CAMPAMENTO', 2),
(39, 'CANASGORDAS', 2),
(40, 'CARACOLI', 2),
(41, 'CARAMANTA', 2),
(42, 'CAREPA', 2),
(43, 'CARMEN DE VIBORAL', 2),
(44, 'CAROLINA DEL PRINCIPE', 2),
(45, 'CAUCASIA', 2),
(46, 'CHIGORODO', 2),
(47, 'CISNEROS', 2),
(48, 'COCORNA', 2),
(49, 'CONCEPCION', 2),
(50, 'CONCORDIA', 2),
(51, 'COPACABANA', 2),
(52, 'DABEIBA', 2),
(53, 'DONMATIAS', 2),
(54, 'EBEJICO', 2),
(55, 'EL BAGRE', 2),
(56, 'EL PENOL', 2),
(57, 'EL RETIRO', 2),
(58, 'ENTRERRIOS', 2),
(59, 'ENVIGADO', 2),
(60, 'FREDONIA', 2),
(61, 'FRONTINO', 2),
(62, 'GIRALDO', 2),
(63, 'GIRARDOTA', 2),
(64, 'GOMEZ PLATA', 2),
(65, 'GRANADA', 2),
(66, 'GUADALUPE', 2),
(67, 'GUARNE', 2),
(68, 'GUATAQUE', 2),
(69, 'HELICONIA', 2),
(70, 'HISPANIA', 2),
(71, 'ITAGUI', 2),
(72, 'ITUANGO', 2),
(73, 'JARDIN', 2),
(74, 'JERICO', 2),
(75, 'LA CEJA', 2),
(76, 'LA ESTRELLA', 2),
(77, 'LA PINTADA', 2),
(78, 'LA UNION', 2),
(79, 'LIBORINA', 2),
(80, 'MACEO', 2),
(81, 'MARINILLA', 2),
(82, 'MEDELLIN', 2),
(83, 'MONTEBELLO', 2),
(84, 'MURINDO', 2),
(85, 'MUTATA', 2),
(86, 'NARINO', 2),
(87, 'NECHI', 2),
(88, 'NECOCLI', 2),
(89, 'OLAYA', 2),
(90, 'PEQUE', 2),
(91, 'PUEBLORRICO', 2),
(92, 'PUERTO BERRIO', 2),
(93, 'PUERTO NARE', 2),
(94, 'PUERTO TRIUNFO', 2),
(95, 'REMEDIOS', 2),
(96, 'RIONEGRO', 2),
(97, 'SABANALARGA', 2),
(98, 'SABANETA', 2),
(99, 'SALGAR', 2),
(100, 'SAN ANDRES DE CUERQUIA', 2),
(101, 'SAN CARLOS', 2),
(102, 'SAN FRANCISCO', 2),
(103, 'SAN JERONIMO', 2),
(104, 'SAN JOSE DE LA MONTAÑA', 2),
(105, 'SAN JUAN DE URABA', 2),
(106, 'SAN LUIS', 2),
(107, 'SAN PEDRO DE LOS MILAGROS', 2),
(108, 'SAN PEDRO DE URABA', 2),
(109, 'SAN RAFAEL', 2),
(110, 'SAN ROQUE', 2),
(111, 'SAN VICENTE', 2),
(112, 'SANTA BARBARA', 2),
(113, 'SANTA ROSA DE OSOS', 2),
(114, 'SANTO DOMINGO', 2),
(115, 'SANTUARIO', 2),
(116, 'SEGOVIA', 2),
(117, 'SONSON', 2),
(118, 'SOPETRAN', 2),
(119, 'TAMESIS', 2),
(120, 'TARAZA', 2),
(121, 'TARSO', 2),
(122, 'TITIRIBI', 2),
(123, 'TOLEDO', 2),
(124, 'TURBO', 2),
(125, 'URAMITA', 2),
(126, 'URRAO', 2),
(127, 'VALDIVIA', 2),
(128, 'VALPARAISO', 2),
(129, 'VEGACHI', 2),
(130, 'VENECIA', 2),
(131, 'VIGIA DEL FUERTE', 2),
(132, 'YALI', 2),
(133, 'YARUMAL', 2),
(134, 'YOLOMBO', 2),
(135, 'YONDO', 2),
(136, 'ZARAGOZA', 2),
(137, 'ARAUCA', 3),
(138, 'ARAUQUITA', 3),
(139, 'CRAVO NORTE', 3),
(140, 'FORTUL', 3),
(141, 'PUERTO RONDON', 3),
(142, 'SARAVENA', 3),
(143, 'TAME', 3),
(144, 'BARANOA', 4),
(145, 'BARRANQUILLA', 4),
(146, 'CAMPO DE LA CRUZ', 4),
(147, 'CANDELARIA', 4),
(148, 'GALAPA', 4),
(149, 'JUAN DE ACOSTA', 4),
(150, 'LURUACO', 4),
(151, 'MALAMBO', 4),
(152, 'MANATI', 4),
(153, 'PALMAR DE VARELA', 4),
(154, 'PIOJO', 4),
(155, 'POLO NUEVO', 4),
(156, 'PONEDERA', 4),
(157, 'PUERTO COLOMBIA', 4),
(158, 'REPELON', 4),
(159, 'SABANAGRANDE', 4),
(160, 'SABANALARGA', 4),
(161, 'SANTA LUCIA', 4),
(162, 'SANTO TOMAS', 4),
(163, 'SOLEDAD', 4),
(164, 'SUAN', 4),
(165, 'TUBARA', 4),
(166, 'USIACURI', 4),
(167, 'ACHI', 5),
(168, 'ALTOS DEL ROSARIO', 5),
(169, 'ARENAL', 5),
(170, 'ARJONA', 5),
(171, 'ARROYOHONDO', 5),
(172, 'BARRANCO DE LOBA', 5),
(173, 'BRAZUELO DE PAPAYAL', 5),
(174, 'CALAMAR', 5),
(175, 'CANTAGALLO', 5),
(176, 'CARTAGENA DE INDIAS', 5),
(177, 'CICUCO', 5),
(178, 'CLEMENCIA', 5),
(179, 'CORDOBA', 5),
(180, 'EL CARMEN DE BOLIVAR', 5),
(181, 'EL GUAMO', 5),
(182, 'EL PENION', 5),
(183, 'HATILLO DE LOBA', 5),
(184, 'MAGANGUE', 5),
(185, 'MAHATES', 5),
(186, 'MARGARITA', 5),
(187, 'MARIA LA BAJA', 5),
(188, 'MONTECRISTO', 5),
(189, 'MORALES', 5),
(190, 'MORALES', 5),
(191, 'NOROSI', 5),
(192, 'PINILLOS', 5),
(193, 'REGIDOR', 5),
(194, 'RIO VIEJO', 5),
(195, 'SAN CRISTOBAL', 5),
(196, 'SAN ESTANISLAO', 5),
(197, 'SAN FERNANDO', 5),
(198, 'SAN JACINTO', 5),
(199, 'SAN JACINTO DEL CAUCA', 5),
(200, 'SAN JUAN DE NEPOMUCENO', 5),
(201, 'SAN MARTIN DE LOBA', 5),
(202, 'SAN PABLO', 5),
(203, 'SAN PABLO NORTE', 5),
(204, 'SANTA CATALINA', 5),
(205, 'SANTA CRUZ DE MOMPOX', 5),
(206, 'SANTA ROSA', 5),
(207, 'SANTA ROSA DEL SUR', 5),
(208, 'SIMITI', 5),
(209, 'SOPLAVIENTO', 5),
(210, 'TALAIGUA NUEVO', 5),
(211, 'TUQUISIO', 5),
(212, 'TURBACO', 5),
(213, 'TURBANA', 5),
(214, 'VILLANUEVA', 5),
(215, 'ZAMBRANO', 5),
(216, 'AQUITANIA', 6),
(217, 'ARCABUCO', 6),
(218, 'BELÉN', 6),
(219, 'BERBEO', 6),
(220, 'BETÉITIVA', 6),
(221, 'BOAVITA', 6),
(222, 'BOYACÁ', 6),
(223, 'BRICEÑO', 6),
(224, 'BUENAVISTA', 6),
(225, 'BUSBANZÁ', 6),
(226, 'CALDAS', 6),
(227, 'CAMPO HERMOSO', 6),
(228, 'CERINZA', 6),
(229, 'CHINAVITA', 6),
(230, 'CHIQUINQUIRÁ', 6),
(231, 'CHÍQUIZA', 6),
(232, 'CHISCAS', 6),
(233, 'CHITA', 6),
(234, 'CHITARAQUE', 6),
(235, 'CHIVATÁ', 6),
(236, 'CIÉNEGA', 6),
(237, 'CÓMBITA', 6),
(238, 'COPER', 6),
(239, 'CORRALES', 6),
(240, 'COVARACHÍA', 6),
(241, 'CUBARA', 6),
(242, 'CUCAITA', 6),
(243, 'CUITIVA', 6),
(244, 'DUITAMA', 6),
(245, 'EL COCUY', 6),
(246, 'EL ESPINO', 6),
(247, 'FIRAVITOBA', 6),
(248, 'FLORESTA', 6),
(249, 'GACHANTIVÁ', 6),
(250, 'GÁMEZA', 6),
(251, 'GARAGOA', 6),
(252, 'GUACAMAYAS', 6),
(253, 'GÜICÁN', 6),
(254, 'IZA', 6),
(255, 'JENESANO', 6),
(256, 'JERICÓ', 6),
(257, 'LA UVITA', 6),
(258, 'LA VICTORIA', 6),
(259, 'LABRANZA GRANDE', 6),
(260, 'MACANAL', 6),
(261, 'MARIPÍ', 6),
(262, 'MIRAFLORES', 6),
(263, 'MONGUA', 6),
(264, 'MONGUÍ', 6),
(265, 'MONIQUIRÁ', 6),
(266, 'MOTAVITA', 6),
(267, 'MUZO', 6),
(268, 'NOBSA', 6),
(269, 'NUEVO COLÓN', 6),
(270, 'OICATÁ', 6),
(271, 'OTANCHE', 6),
(272, 'PACHAVITA', 6),
(273, 'PÁEZ', 6),
(274, 'PAIPA', 6),
(275, 'PAJARITO', 6),
(276, 'PANQUEBA', 6),
(277, 'PAUNA', 6),
(278, 'PAYA', 6),
(279, 'PAZ DE RÍO', 6),
(280, 'PESCA', 6),
(281, 'PISBA', 6),
(282, 'PUERTO BOYACA', 6),
(283, 'QUÍPAMA', 6),
(284, 'RAMIRIQUÍ', 6),
(285, 'RÁQUIRA', 6),
(286, 'RONDÓN', 6),
(287, 'SABOYÁ', 6),
(288, 'SÁCHICA', 6),
(289, 'SAMACÁ', 6),
(290, 'SAN EDUARDO', 6),
(291, 'SAN JOSÉ DE PARE', 6),
(292, 'SAN LUÍS DE GACENO', 6),
(293, 'SAN MATEO', 6),
(294, 'SAN MIGUEL DE SEMA', 6),
(295, 'SAN PABLO DE BORBUR', 6),
(296, 'SANTA MARÍA', 6),
(297, 'SANTA ROSA DE VITERBO', 6),
(298, 'SANTA SOFÍA', 6),
(299, 'SANTANA', 6),
(300, 'SATIVANORTE', 6),
(301, 'SATIVASUR', 6),
(302, 'SIACHOQUE', 6),
(303, 'SOATÁ', 6),
(304, 'SOCHA', 6),
(305, 'SOCOTÁ', 6),
(306, 'SOGAMOSO', 6),
(307, 'SORA', 6),
(308, 'SORACÁ', 6),
(309, 'SOTAQUIRÁ', 6),
(310, 'SUSACÓN', 6),
(311, 'SUTARMACHÁN', 6),
(312, 'TASCO', 6),
(313, 'TIBANÁ', 6),
(314, 'TIBASOSA', 6),
(315, 'TINJACÁ', 6),
(316, 'TIPACOQUE', 6),
(317, 'TOCA', 6),
(318, 'TOGÜÍ', 6),
(319, 'TÓPAGA', 6),
(320, 'TOTA', 6),
(321, 'TUNJA', 6),
(322, 'TUNUNGUÁ', 6),
(323, 'TURMEQUÉ', 6),
(324, 'TUTA', 6),
(325, 'TUTAZÁ', 6),
(326, 'UMBITA', 6),
(327, 'VENTA QUEMADA', 6),
(328, 'VILLA DE LEYVA', 6),
(329, 'VIRACACHÁ', 6),
(330, 'ZETAQUIRA', 6),
(331, 'AGUADAS', 7),
(332, 'ANSERMA', 7),
(333, 'ARANZAZU', 7),
(334, 'BELALCAZAR', 7),
(335, 'CHINCHINÁ', 7),
(336, 'FILADELFIA', 7),
(337, 'LA DORADA', 7),
(338, 'LA MERCED', 7),
(339, 'MANIZALES', 7),
(340, 'MANZANARES', 7),
(341, 'MARMATO', 7),
(342, 'MARQUETALIA', 7),
(343, 'MARULANDA', 7),
(344, 'NEIRA', 7),
(345, 'NORCASIA', 7),
(346, 'PACORA', 7),
(347, 'PALESTINA', 7),
(348, 'PENSILVANIA', 7),
(349, 'RIOSUCIO', 7),
(350, 'RISARALDA', 7),
(351, 'SALAMINA', 7),
(352, 'SAMANA', 7),
(353, 'SAN JOSE', 7),
(354, 'SUPÍA', 7),
(355, 'VICTORIA', 7),
(356, 'VILLAMARÍA', 7),
(357, 'VITERBO', 7),
(358, 'ALBANIA', 8),
(359, 'BELÉN ANDAQUIES', 8),
(360, 'CARTAGENA DEL CHAIRA', 8),
(361, 'CURILLO', 8),
(362, 'EL DONCELLO', 8),
(363, 'EL PAUJIL', 8),
(364, 'FLORENCIA', 8),
(365, 'LA MONTAÑITA', 8),
(366, 'MILÁN', 8),
(367, 'MORELIA', 8),
(368, 'PUERTO RICO', 8),
(369, 'SAN  VICENTE DEL CAGUAN', 8),
(370, 'SAN JOSÉ DE FRAGUA', 8),
(371, 'SOLANO', 8),
(372, 'SOLITA', 8),
(373, 'VALPARAÍSO', 8),
(374, 'AGUAZUL', 9),
(375, 'CHAMEZA', 9),
(376, 'HATO COROZAL', 9),
(377, 'LA SALINA', 9),
(378, 'MANÍ', 9),
(379, 'MONTERREY', 9),
(380, 'NUNCHIA', 9),
(381, 'OROCUE', 9),
(382, 'PAZ DE ARIPORO', 9),
(383, 'PORE', 9),
(384, 'RECETOR', 9),
(385, 'SABANA LARGA', 9),
(386, 'SACAMA', 9),
(387, 'SAN LUIS DE PALENQUE', 9),
(388, 'TAMARA', 9),
(389, 'TAURAMENA', 9),
(390, 'TRINIDAD', 9),
(391, 'VILLANUEVA', 9),
(392, 'YOPAL', 9),
(393, 'ALMAGUER', 10),
(394, 'ARGELIA', 10),
(395, 'BALBOA', 10),
(396, 'BOLÍVAR', 10),
(397, 'BUENOS AIRES', 10),
(398, 'CAJIBIO', 10),
(399, 'CALDONO', 10),
(400, 'CALOTO', 10),
(401, 'CORINTO', 10),
(402, 'EL TAMBO', 10),
(403, 'FLORENCIA', 10),
(404, 'GUAPI', 10),
(405, 'INZA', 10),
(406, 'JAMBALÓ', 10),
(407, 'LA SIERRA', 10),
(408, 'LA VEGA', 10),
(409, 'LÓPEZ', 10),
(410, 'MERCADERES', 10),
(411, 'MIRANDA', 10),
(412, 'MORALES', 10),
(413, 'PADILLA', 10),
(414, 'PÁEZ', 10),
(415, 'PATIA (EL BORDO)', 10),
(416, 'PIAMONTE', 10),
(417, 'PIENDAMO', 10),
(418, 'POPAYÁN', 10),
(419, 'PUERTO TEJADA', 10),
(420, 'PURACE', 10),
(421, 'ROSAS', 10),
(422, 'SAN SEBASTIÁN', 10),
(423, 'SANTA ROSA', 10),
(424, 'SANTANDER DE QUILICHAO', 10),
(425, 'SILVIA', 10),
(426, 'SOTARA', 10),
(427, 'SUÁREZ', 10),
(428, 'SUCRE', 10),
(429, 'TIMBÍO', 10),
(430, 'TIMBIQUÍ', 10),
(431, 'TORIBIO', 10),
(432, 'TOTORO', 10),
(433, 'VILLA RICA', 10),
(434, 'AGUACHICA', 11),
(435, 'AGUSTÍN CODAZZI', 11),
(436, 'ASTREA', 11),
(437, 'BECERRIL', 11),
(438, 'BOSCONIA', 11),
(439, 'CHIMICHAGUA', 11),
(440, 'CHIRIGUANÁ', 11),
(441, 'CURUMANÍ', 11),
(442, 'EL COPEY', 11),
(443, 'EL PASO', 11),
(444, 'GAMARRA', 11),
(445, 'GONZÁLEZ', 11),
(446, 'LA GLORIA', 11),
(447, 'LA JAGUA IBIRICO', 11),
(448, 'MANAURE BALCÓN DEL CESAR', 11),
(449, 'PAILITAS', 11),
(450, 'PELAYA', 11),
(451, 'PUEBLO BELLO', 11),
(452, 'RÍO DE ORO', 11),
(453, 'ROBLES (LA PAZ)', 11),
(454, 'SAN ALBERTO', 11),
(455, 'SAN DIEGO', 11),
(456, 'SAN MARTÍN', 11),
(457, 'TAMALAMEQUE', 11),
(458, 'VALLEDUPAR', 11),
(459, 'ACANDI', 12),
(460, 'ALTO BAUDO (PIE DE PATO)', 12),
(461, 'ATRATO', 12),
(462, 'BAGADO', 12),
(463, 'BAHIA SOLANO (MUTIS)', 12),
(464, 'BAJO BAUDO (PIZARRO)', 12),
(465, 'BOJAYA (BELLAVISTA)', 12),
(466, 'CANTON DE SAN PABLO', 12),
(467, 'CARMEN DEL DARIEN', 12),
(468, 'CERTEGUI', 12),
(469, 'CONDOTO', 12),
(470, 'EL CARMEN', 12),
(471, 'ISTMINA', 12),
(472, 'JURADO', 12),
(473, 'LITORAL DEL SAN JUAN', 12),
(474, 'LLORO', 12),
(475, 'MEDIO ATRATO', 12),
(476, 'MEDIO BAUDO (BOCA DE PEPE)', 12),
(477, 'MEDIO SAN JUAN', 12),
(478, 'NOVITA', 12),
(479, 'NUQUI', 12),
(480, 'QUIBDO', 12),
(481, 'RIO IRO', 12),
(482, 'RIO QUITO', 12),
(483, 'RIOSUCIO', 12),
(484, 'SAN JOSE DEL PALMAR', 12),
(485, 'SIPI', 12),
(486, 'TADO', 12),
(487, 'UNGUIA', 12),
(488, 'UNIÓN PANAMERICANA', 12),
(489, 'AYAPEL', 13),
(490, 'BUENAVISTA', 13),
(491, 'CANALETE', 13),
(492, 'CERETÉ', 13),
(493, 'CHIMA', 13),
(494, 'CHINÚ', 13),
(495, 'CIENAGA DE ORO', 13),
(496, 'COTORRA', 13),
(497, 'LA APARTADA', 13),
(498, 'LORICA', 13),
(499, 'LOS CÓRDOBAS', 13),
(500, 'MOMIL', 13),
(501, 'MONTELÍBANO', 13),
(502, 'MONTERÍA', 13),
(503, 'MOÑITOS', 13),
(504, 'PLANETA RICA', 13),
(505, 'PUEBLO NUEVO', 13),
(506, 'PUERTO ESCONDIDO', 13),
(507, 'PUERTO LIBERTADOR', 13),
(508, 'PURÍSIMA', 13),
(509, 'SAHAGÚN', 13),
(510, 'SAN ANDRÉS SOTAVENTO', 13),
(511, 'SAN ANTERO', 13),
(512, 'SAN BERNARDO VIENTO', 13),
(513, 'SAN CARLOS', 13),
(514, 'SAN PELAYO', 13),
(515, 'TIERRALTA', 13),
(516, 'VALENCIA', 13),
(517, 'AGUA DE DIOS', 14),
(518, 'ALBAN', 14),
(519, 'ANAPOIMA', 14),
(520, 'ANOLAIMA', 14),
(521, 'ARBELAEZ', 14),
(522, 'BELTRÁN', 14),
(523, 'BITUIMA', 14),
(524, 'BOGOTÁ DC', 14),
(525, 'BOJACÁ', 14),
(526, 'CABRERA', 14),
(527, 'CACHIPAY', 14),
(528, 'CAJICÁ', 14),
(529, 'CAPARRAPÍ', 14),
(530, 'CAQUEZA', 14),
(531, 'CARMEN DE CARUPA', 14),
(532, 'CHAGUANÍ', 14),
(533, 'CHIA', 14),
(534, 'CHIPAQUE', 14),
(535, 'CHOACHÍ', 14),
(536, 'CHOCONTÁ', 14),
(537, 'COGUA', 14),
(538, 'COTA', 14),
(539, 'CUCUNUBÁ', 14),
(540, 'EL COLEGIO', 14),
(541, 'EL PEÑÓN', 14),
(542, 'EL ROSAL1', 14),
(543, 'FACATATIVA', 14),
(544, 'FÓMEQUE', 14),
(545, 'FOSCA', 14),
(546, 'FUNZA', 14),
(547, 'FÚQUENE', 14),
(548, 'FUSAGASUGA', 14),
(549, 'GACHALÁ', 14),
(550, 'GACHANCIPÁ', 14),
(551, 'GACHETA', 14),
(552, 'GAMA', 14),
(553, 'GIRARDOT', 14),
(554, 'GRANADA2', 14),
(555, 'GUACHETÁ', 14),
(556, 'GUADUAS', 14),
(557, 'GUASCA', 14),
(558, 'GUATAQUÍ', 14),
(559, 'GUATAVITA', 14),
(560, 'GUAYABAL DE SIQUIMA', 14),
(561, 'GUAYABETAL', 14),
(562, 'GUTIÉRREZ', 14),
(563, 'JERUSALÉN', 14),
(564, 'JUNÍN', 14),
(565, 'LA CALERA', 14),
(566, 'LA MESA', 14),
(567, 'LA PALMA', 14),
(568, 'LA PEÑA', 14),
(569, 'LA VEGA', 14),
(570, 'LENGUAZAQUE', 14),
(571, 'MACHETÁ', 14),
(572, 'MADRID', 14),
(573, 'MANTA', 14),
(574, 'MEDINA', 14),
(575, 'MOSQUERA', 14),
(576, 'NARIÑO', 14),
(577, 'NEMOCÓN', 14),
(578, 'NILO', 14),
(579, 'NIMAIMA', 14),
(580, 'NOCAIMA', 14),
(581, 'OSPINA PÉREZ', 14),
(582, 'PACHO', 14),
(583, 'PAIME', 14),
(584, 'PANDI', 14),
(585, 'PARATEBUENO', 14),
(586, 'PASCA', 14),
(587, 'PUERTO SALGAR', 14),
(588, 'PULÍ', 14),
(589, 'QUEBRADANEGRA', 14),
(590, 'QUETAME', 14),
(591, 'QUIPILE', 14),
(592, 'RAFAEL REYES', 14),
(593, 'RICAURTE', 14),
(594, 'SAN  ANTONIO DEL  TEQUENDAMA', 14),
(595, 'SAN BERNARDO', 14),
(596, 'SAN CAYETANO', 14),
(597, 'SAN FRANCISCO', 14),
(598, 'SAN JUAN DE RIOSECO', 14),
(599, 'SASAIMA', 14),
(600, 'SESQUILÉ', 14),
(601, 'SIBATÉ', 14),
(602, 'SILVANIA', 14),
(603, 'SIMIJACA', 14),
(604, 'SOACHA', 14),
(605, 'SOPO', 14),
(606, 'SUBACHOQUE', 14),
(607, 'SUESCA', 14),
(608, 'SUPATÁ', 14),
(609, 'SUSA', 14),
(610, 'SUTATAUSA', 14),
(611, 'TABIO', 14),
(612, 'TAUSA', 14),
(613, 'TENA', 14),
(614, 'TENJO', 14),
(615, 'TIBACUY', 14),
(616, 'TIBIRITA', 14),
(617, 'TOCAIMA', 14),
(618, 'TOCANCIPÁ', 14),
(619, 'TOPAIPÍ', 14),
(620, 'UBALÁ', 14),
(621, 'UBAQUE', 14),
(622, 'UBATÉ', 14),
(623, 'UNE', 14),
(624, 'UTICA', 14),
(625, 'VERGARA', 14),
(626, 'VIANI', 14),
(627, 'VILLA GOMEZ', 14),
(628, 'VILLA PINZÓN', 14),
(629, 'VILLETA', 14),
(630, 'VIOTA', 14),
(631, 'YACOPÍ', 14),
(632, 'ZIPACÓN', 14),
(633, 'ZIPAQUIRÁ', 14),
(634, 'BARRANCO MINAS', 15),
(635, 'CACAHUAL', 15),
(636, 'INÍRIDA', 15),
(637, 'LA GUADALUPE', 15),
(638, 'MAPIRIPANA', 15),
(639, 'MORICHAL', 15),
(640, 'PANA PANA', 15),
(641, 'PUERTO COLOMBIA', 15),
(642, 'SAN FELIPE', 15),
(643, 'CALAMAR', 16),
(644, 'EL RETORNO', 16),
(645, 'MIRAFLOREZ', 16),
(646, 'SAN JOSÉ DEL GUAVIARE', 16),
(647, 'ACEVEDO', 17),
(648, 'AGRADO', 17),
(649, 'AIPE', 17),
(650, 'ALGECIRAS', 17),
(651, 'ALTAMIRA', 17),
(652, 'BARAYA', 17),
(653, 'CAMPO ALEGRE', 17),
(654, 'COLOMBIA', 17),
(655, 'ELIAS', 17),
(656, 'GARZÓN', 17),
(657, 'GIGANTE', 17),
(658, 'GUADALUPE', 17),
(659, 'HOBO', 17),
(660, 'IQUIRA', 17),
(661, 'ISNOS', 17),
(662, 'LA ARGENTINA', 17),
(663, 'LA PLATA', 17),
(664, 'NATAGA', 17),
(665, 'NEIVA', 17),
(666, 'OPORAPA', 17),
(667, 'PAICOL', 17),
(668, 'PALERMO', 17),
(669, 'PALESTINA', 17),
(670, 'PITAL', 17),
(671, 'PITALITO', 17),
(672, 'RIVERA', 17),
(673, 'SALADO BLANCO', 17),
(674, 'SAN AGUSTÍN', 17),
(675, 'SANTA MARIA', 17),
(676, 'SUAZA', 17),
(677, 'TARQUI', 17),
(678, 'TELLO', 17),
(679, 'TERUEL', 17),
(680, 'TESALIA', 17),
(681, 'TIMANA', 17),
(682, 'VILLAVIEJA', 17),
(683, 'YAGUARA', 17),
(684, 'ALBANIA', 18),
(685, 'BARRANCAS', 18),
(686, 'DIBULLA', 18),
(687, 'DISTRACCIÓN', 18),
(688, 'EL MOLINO', 18),
(689, 'FONSECA', 18),
(690, 'HATO NUEVO', 18),
(691, 'LA JAGUA DEL PILAR', 18),
(692, 'MAICAO', 18),
(693, 'MANAURE', 18),
(694, 'RIOHACHA', 18),
(695, 'SAN JUAN DEL CESAR', 18),
(696, 'URIBIA', 18),
(697, 'URUMITA', 18),
(698, 'VILLANUEVA', 18),
(699, 'ALGARROBO', 19),
(700, 'ARACATACA', 19),
(701, 'ARIGUANI', 19),
(702, 'CERRO SAN ANTONIO', 19),
(703, 'CHIVOLO', 19),
(704, 'CIENAGA', 19),
(705, 'CONCORDIA', 19),
(706, 'EL BANCO', 19),
(707, 'EL PIÑON', 19),
(708, 'EL RETEN', 19),
(709, 'FUNDACION', 19),
(710, 'GUAMAL', 19),
(711, 'NUEVA GRANADA', 19),
(712, 'PEDRAZA', 19),
(713, 'PIJIÑO DEL CARMEN', 19),
(714, 'PIVIJAY', 19),
(715, 'PLATO', 19),
(716, 'PUEBLO VIEJO', 19),
(717, 'REMOLINO', 19),
(718, 'SABANAS DE SAN ANGEL', 19),
(719, 'SALAMINA', 19),
(720, 'SAN SEBASTIAN DE BUENAVISTA', 19),
(721, 'SAN ZENON', 19),
(722, 'SANTA ANA', 19),
(723, 'SANTA BARBARA DE PINTO', 19),
(724, 'SANTA MARTA', 19),
(725, 'SITIONUEVO', 19),
(726, 'TENERIFE', 19),
(727, 'ZAPAYAN', 19),
(728, 'ZONA BANANERA', 19),
(729, 'ACACIAS', 20),
(730, 'BARRANCA DE UPIA', 20),
(731, 'CABUYARO', 20),
(732, 'CASTILLA LA NUEVA', 20),
(733, 'CUBARRAL', 20),
(734, 'CUMARAL', 20),
(735, 'EL CALVARIO', 20),
(736, 'EL CASTILLO', 20),
(737, 'EL DORADO', 20),
(738, 'FUENTE DE ORO', 20),
(739, 'GRANADA', 20),
(740, 'GUAMAL', 20),
(741, 'LA MACARENA', 20),
(742, 'LA URIBE', 20),
(743, 'LEJANÍAS', 20),
(744, 'MAPIRIPÁN', 20),
(745, 'MESETAS', 20),
(746, 'PUERTO CONCORDIA', 20),
(747, 'PUERTO GAITÁN', 20),
(748, 'PUERTO LLERAS', 20),
(749, 'PUERTO LÓPEZ', 20),
(750, 'PUERTO RICO', 20),
(751, 'RESTREPO', 20),
(752, 'SAN  JUAN DE ARAMA', 20),
(753, 'SAN CARLOS GUAROA', 20),
(754, 'SAN JUANITO', 20),
(755, 'SAN MARTÍN', 20),
(756, 'VILLAVICENCIO', 20),
(757, 'VISTA HERMOSA', 20),
(758, 'ALBAN', 21),
(759, 'ALDAÑA', 21),
(760, 'ANCUYA', 21),
(761, 'ARBOLEDA', 21),
(762, 'BARBACOAS', 21),
(763, 'BELEN', 21),
(764, 'BUESACO', 21),
(765, 'CHACHAGUI', 21),
(766, 'COLON (GENOVA)', 21),
(767, 'CONSACA', 21),
(768, 'CONTADERO', 21),
(769, 'CORDOBA', 21),
(770, 'CUASPUD', 21),
(771, 'CUMBAL', 21),
(772, 'CUMBITARA', 21),
(773, 'EL CHARCO', 21),
(774, 'EL PEÑOL', 21),
(775, 'EL ROSARIO', 21),
(776, 'EL TABLÓN', 21),
(777, 'EL TAMBO', 21),
(778, 'FUNES', 21),
(779, 'GUACHUCAL', 21),
(780, 'GUAITARILLA', 21),
(781, 'GUALMATAN', 21),
(782, 'ILES', 21),
(783, 'IMUES', 21),
(784, 'IPIALES', 21),
(785, 'LA CRUZ', 21),
(786, 'LA FLORIDA', 21),
(787, 'LA LLANADA', 21),
(788, 'LA TOLA', 21),
(789, 'LA UNION', 21),
(790, 'LEIVA', 21),
(791, 'LINARES', 21),
(792, 'LOS ANDES', 21),
(793, 'MAGUI', 21),
(794, 'MALLAMA', 21),
(795, 'MOSQUEZA', 21),
(796, 'NARIÑO', 21),
(797, 'OLAYA HERRERA', 21),
(798, 'OSPINA', 21),
(799, 'PASTO', 21),
(800, 'PIZARRO', 21),
(801, 'POLICARPA', 21),
(802, 'POTOSI', 21),
(803, 'PROVIDENCIA', 21),
(804, 'PUERRES', 21),
(805, 'PUPIALES', 21),
(806, 'RICAURTE', 21),
(807, 'ROBERTO PAYAN', 21),
(808, 'SAMANIEGO', 21),
(809, 'SAN BERNARDO', 21),
(810, 'SAN LORENZO', 21),
(811, 'SAN PABLO', 21),
(812, 'SAN PEDRO DE CARTAGO', 21),
(813, 'SANDONA', 21),
(814, 'SANTA BARBARA', 21),
(815, 'SANTACRUZ', 21),
(816, 'SAPUYES', 21),
(817, 'TAMINANGO', 21),
(818, 'TANGUA', 21),
(819, 'TUMACO', 21),
(820, 'TUQUERRES', 21),
(821, 'YACUANQUER', 21),
(822, 'ABREGO', 22),
(823, 'ARBOLEDAS', 22),
(824, 'BOCHALEMA', 22),
(825, 'BUCARASICA', 22),
(826, 'CÁCHIRA', 22),
(827, 'CÁCOTA', 22),
(828, 'CHINÁCOTA', 22),
(829, 'CHITAGÁ', 22),
(830, 'CONVENCIÓN', 22),
(831, 'CÚCUTA', 22),
(832, 'CUCUTILLA', 22),
(833, 'DURANIA', 22),
(834, 'EL CARMEN', 22),
(835, 'EL TARRA', 22),
(836, 'EL ZULIA', 22),
(837, 'GRAMALOTE', 22),
(838, 'HACARI', 22),
(839, 'HERRÁN', 22),
(840, 'LA ESPERANZA', 22),
(841, 'LA PLAYA', 22),
(842, 'LABATECA', 22),
(843, 'LOS PATIOS', 22),
(844, 'LOURDES', 22),
(845, 'MUTISCUA', 22),
(846, 'OCAÑA', 22),
(847, 'PAMPLONA', 22),
(848, 'PAMPLONITA', 22),
(849, 'PUERTO SANTANDER', 22),
(850, 'RAGONVALIA', 22),
(851, 'SALAZAR', 22),
(852, 'SAN CALIXTO', 22),
(853, 'SAN CAYETANO', 22),
(854, 'SANTIAGO', 22),
(855, 'SARDINATA', 22),
(856, 'SILOS', 22),
(857, 'TEORAMA', 22),
(858, 'TIBÚ', 22),
(859, 'TOLEDO', 22),
(860, 'VILLA CARO', 22),
(861, 'VILLA DEL ROSARIO', 22),
(862, 'COLÓN', 23),
(863, 'MOCOA', 23),
(864, 'ORITO', 23),
(865, 'PUERTO ASÍS', 23),
(866, 'PUERTO CAYCEDO', 23),
(867, 'PUERTO GUZMÁN', 23),
(868, 'PUERTO LEGUÍZAMO', 23),
(869, 'SAN FRANCISCO', 23),
(870, 'SAN MIGUEL', 23),
(871, 'SANTIAGO', 23),
(872, 'SIBUNDOY', 23),
(873, 'VALLE DEL GUAMUEZ', 23),
(874, 'VILLAGARZÓN', 23),
(875, 'ARMENIA', 24),
(876, 'BUENAVISTA', 24),
(877, 'CALARCÁ', 24),
(878, 'CIRCASIA', 24),
(879, 'CÓRDOBA', 24),
(880, 'FILANDIA', 24),
(881, 'GÉNOVA', 24),
(882, 'LA TEBAIDA', 24),
(883, 'MONTENEGRO', 24),
(884, 'PIJAO', 24),
(885, 'QUIMBAYA', 24),
(886, 'SALENTO', 24),
(887, 'APIA', 25),
(888, 'BALBOA', 25),
(889, 'BELÉN DE UMBRÍA', 25),
(890, 'DOS QUEBRADAS', 25),
(891, 'GUATICA', 25),
(892, 'LA CELIA', 25),
(893, 'LA VIRGINIA', 25),
(894, 'MARSELLA', 25),
(895, 'MISTRATO', 25),
(896, 'PEREIRA', 25),
(897, 'PUEBLO RICO', 25),
(898, 'QUINCHÍA', 25),
(899, 'SANTA ROSA DE CABAL', 25),
(900, 'SANTUARIO', 25),
(901, 'PROVIDENCIA', 26),
(902, 'SAN ANDRES', 26),
(903, 'SANTA CATALINA', 26),
(904, 'AGUADA', 27),
(905, 'ALBANIA', 27),
(906, 'ARATOCA', 27),
(907, 'BARBOSA', 27),
(908, 'BARICHARA', 27),
(909, 'BARRANCABERMEJA', 27),
(910, 'BETULIA', 27),
(911, 'BOLÍVAR', 27),
(912, 'BUCARAMANGA', 27),
(913, 'CABRERA', 27),
(914, 'CALIFORNIA', 27),
(915, 'CAPITANEJO', 27),
(916, 'CARCASI', 27),
(917, 'CEPITA', 27),
(918, 'CERRITO', 27),
(919, 'CHARALÁ', 27),
(920, 'CHARTA', 27),
(921, 'CHIMA', 27),
(922, 'CHIPATÁ', 27),
(923, 'CIMITARRA', 27),
(924, 'CONCEPCIÓN', 27),
(925, 'CONFINES', 27),
(926, 'CONTRATACIÓN', 27),
(927, 'COROMORO', 27),
(928, 'CURITÍ', 27),
(929, 'EL CARMEN', 27),
(930, 'EL GUACAMAYO', 27),
(931, 'EL PEÑÓN', 27),
(932, 'EL PLAYÓN', 27),
(933, 'ENCINO', 27),
(934, 'ENCISO', 27),
(935, 'FLORIÁN', 27),
(936, 'FLORIDABLANCA', 27),
(937, 'GALÁN', 27),
(938, 'GAMBITA', 27),
(939, 'GIRÓN', 27),
(940, 'GUACA', 27),
(941, 'GUADALUPE', 27),
(942, 'GUAPOTA', 27),
(943, 'GUAVATÁ', 27),
(944, 'GUEPSA', 27),
(945, 'HATO', 27),
(946, 'JESÚS MARIA', 27),
(947, 'JORDÁN', 27),
(948, 'LA BELLEZA', 27),
(949, 'LA PAZ', 27),
(950, 'LANDAZURI', 27),
(951, 'LEBRIJA', 27),
(952, 'LOS SANTOS', 27),
(953, 'MACARAVITA', 27),
(954, 'MÁLAGA', 27),
(955, 'MATANZA', 27),
(956, 'MOGOTES', 27),
(957, 'MOLAGAVITA', 27),
(958, 'OCAMONTE', 27),
(959, 'OIBA', 27),
(960, 'ONZAGA', 27),
(961, 'PALMAR', 27),
(962, 'PALMAS DEL SOCORRO', 27),
(963, 'PÁRAMO', 27),
(964, 'PIEDECUESTA', 27),
(965, 'PINCHOTE', 27),
(966, 'PUENTE NACIONAL', 27),
(967, 'PUERTO PARRA', 27),
(968, 'PUERTO WILCHES', 27),
(969, 'RIONEGRO', 27),
(970, 'SABANA DE TORRES', 27),
(971, 'SAN ANDRÉS', 27),
(972, 'SAN BENITO', 27),
(973, 'SAN GIL', 27),
(974, 'SAN JOAQUÍN', 27),
(975, 'SAN JOSÉ DE MIRANDA', 27),
(976, 'SAN MIGUEL', 27),
(977, 'SAN VICENTE DE CHUCURÍ', 27),
(978, 'SANTA BÁRBARA', 27),
(979, 'SANTA HELENA', 27),
(980, 'SIMACOTA', 27),
(981, 'SOCORRO', 27),
(982, 'SUAITA', 27),
(983, 'SUCRE', 27),
(984, 'SURATA', 27),
(985, 'TONA', 27),
(986, 'VALLE SAN JOSÉ', 27),
(987, 'VÉLEZ', 27),
(988, 'VETAS', 27),
(989, 'VILLANUEVA', 27),
(990, 'ZAPATOCA', 27),
(991, 'BUENAVISTA', 28),
(992, 'CAIMITO', 28),
(993, 'CHALÁN', 28),
(994, 'COLOSO', 28),
(995, 'COROZAL', 28),
(996, 'EL ROBLE', 28),
(997, 'GALERAS', 28),
(998, 'GUARANDA', 28),
(999, 'LA UNIÓN', 28),
(1000, 'LOS PALMITOS', 28),
(1001, 'MAJAGUAL', 28),
(1002, 'MORROA', 28),
(1003, 'OVEJAS', 28),
(1004, 'PALMITO', 28),
(1005, 'SAMPUES', 28),
(1006, 'SAN BENITO ABAD', 28),
(1007, 'SAN JUAN DE BETULIA', 28),
(1008, 'SAN MARCOS', 28),
(1009, 'SAN ONOFRE', 28),
(1010, 'SAN PEDRO', 28),
(1011, 'SINCÉ', 28),
(1012, 'SINCELEJO', 28),
(1013, 'SUCRE', 28),
(1014, 'TOLÚ', 28),
(1015, 'TOLUVIEJO', 28),
(1016, 'ALPUJARRA', 29),
(1017, 'ALVARADO', 29),
(1018, 'AMBALEMA', 29),
(1019, 'ANZOATEGUI', 29),
(1020, 'ARMERO (GUAYABAL)', 29),
(1021, 'ATACO', 29),
(1022, 'CAJAMARCA', 29),
(1023, 'CARMEN DE APICALÁ', 29),
(1024, 'CASABIANCA', 29),
(1025, 'CHAPARRAL', 29),
(1026, 'COELLO', 29),
(1027, 'COYAIMA', 29),
(1028, 'CUNDAY', 29),
(1029, 'DOLORES', 29),
(1030, 'ESPINAL', 29),
(1031, 'FALÁN', 29),
(1032, 'FLANDES', 29),
(1033, 'FRESNO', 29),
(1034, 'GUAMO', 29),
(1035, 'HERVEO', 29),
(1036, 'HONDA', 29),
(1037, 'IBAGUÉ', 29),
(1038, 'ICONONZO', 29),
(1039, 'LÉRIDA', 29),
(1040, 'LÍBANO', 29),
(1041, 'MARIQUITA', 29),
(1042, 'MELGAR', 29),
(1043, 'MURILLO', 29),
(1044, 'NATAGAIMA', 29),
(1045, 'ORTEGA', 29),
(1046, 'PALOCABILDO', 29),
(1047, 'PIEDRAS PLANADAS', 29),
(1048, 'PRADO', 29),
(1049, 'PURIFICACIÓN', 29),
(1050, 'RIOBLANCO', 29),
(1051, 'RONCESVALLES', 29),
(1052, 'ROVIRA', 29),
(1053, 'SALDAÑA', 29),
(1054, 'SAN ANTONIO', 29),
(1055, 'SAN LUIS', 29),
(1056, 'SANTA ISABEL', 29),
(1057, 'SUÁREZ', 29),
(1058, 'VALLE DE SAN JUAN', 29),
(1059, 'VENADILLO', 29),
(1060, 'VILLAHERMOSA', 29),
(1061, 'VILLARRICA', 29),
(1062, 'ALCALÁ', 30),
(1063, 'ANDALUCÍA', 30),
(1064, 'ANSERMA NUEVO', 30),
(1065, 'ARGELIA', 30),
(1066, 'BOLÍVAR', 30),
(1067, 'BUENAVENTURA', 30),
(1068, 'BUGA', 30),
(1069, 'BUGALAGRANDE', 30),
(1070, 'CAICEDONIA', 30),
(1071, 'CALI', 30),
(1072, 'CALIMA (DARIEN)', 30),
(1073, 'CANDELARIA', 30),
(1074, 'CARTAGO', 30),
(1075, 'DAGUA', 30),
(1076, 'EL AGUILA', 30),
(1077, 'EL CAIRO', 30),
(1078, 'EL CERRITO', 30),
(1079, 'EL DOVIO', 30),
(1080, 'FLORIDA', 30),
(1081, 'GINEBRA GUACARI', 30),
(1082, 'JAMUNDÍ', 30),
(1083, 'LA CUMBRE', 30),
(1084, 'LA UNIÓN', 30),
(1085, 'LA VICTORIA', 30),
(1086, 'OBANDO', 30),
(1087, 'PALMIRA', 30),
(1088, 'PRADERA', 30),
(1089, 'RESTREPO', 30),
(1090, 'RIO FRÍO', 30),
(1091, 'ROLDANILLO', 30),
(1092, 'SAN PEDRO', 30),
(1093, 'SEVILLA', 30),
(1094, 'TORO', 30),
(1095, 'TRUJILLO', 30),
(1096, 'TULÚA', 30),
(1097, 'ULLOA', 30),
(1098, 'VERSALLES', 30),
(1099, 'VIJES', 30),
(1100, 'YOTOCO', 30),
(1101, 'YUMBO', 30),
(1102, 'ZARZAL', 30),
(1103, 'CARURÚ', 31),
(1104, 'MITÚ', 31),
(1105, 'PACOA', 31),
(1106, 'PAPUNAUA', 31),
(1107, 'TARAIRA', 31),
(1108, 'YAVARATÉ', 31),
(1109, 'CUMARIBO', 32),
(1110, 'LA PRIMAVERA', 32),
(1111, 'PUERTO CARREÑO', 32),
(1112, 'SANTA ROSALIA', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos`
--

DROP TABLE IF EXISTS `correos`;
CREATE TABLE `correos` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` enum('programado','prioritario') NOT NULL DEFAULT 'prioritario',
  `fecha_programada` date DEFAULT NULL,
  `estado` enum('pendiente','enviado','cancelado') NOT NULL DEFAULT 'pendiente',
  `asunto` varchar(250) DEFAULT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `mensaje` text,
  `boton` enum('si','no') NOT NULL DEFAULT 'no',
  `texto_boton` varchar(50) DEFAULT NULL,
  `url_boton` text,
  `correos_destinatarios` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `correos`
--

INSERT INTO `correos` (`id`, `tipo`, `fecha_programada`, `estado`, `asunto`, `titulo`, `mensaje`, `boton`, `texto_boton`, `url_boton`, `correos_destinatarios`, `created_at`, `updated_at`) VALUES
(7, 'prioritario', NULL, 'pendiente', 'Nueva cuenta de usuario Archinet', 'Bienvenid@ a Archinet', '<p>Su cuenta de usuario con el rol de <strong>Operario de consulta</strong> ha sido creada con éxito en el sistema web de <a href=\"http://localhost:8000\">Archinet</a>.</p>\n\n<p>Para ingresar al sistema ingrese a este <a href=\"http://localhost:8000/create-password/jyFI0INGSf0JQeGyTEkLRutJCVhZy1ejcjGJxrVn/eyJpdiI6ImJjc1RVdFwvbXFmdjZvWGVReDFZTURBPT0iLCJ2YWx1ZSI6IlF4R2dBVWtkTjhRXC9oTE8zK2tcL29pZz09IiwibWFjIjoiMDIxNjliNTc4YmY4MTE3NTM4NDBlNmQzMzllNTYyN2I5NGMyZDFjNmI4ZTg1OGM0OTdlZTRhMzIxMDY0NTNkYyJ9\">link</a> y registre su contraseña de ingreso.</p>\n', 'no', NULL, NULL, NULL, '2018-07-09 02:24:48', '2018-07-09 02:24:48'),
(8, 'prioritario', NULL, 'pendiente', 'Nueva cuenta de usuario Archinet', 'Bienvenid@ a Archinet', '<p>Su cuenta de usuario con el rol de <strong>Operario de consulta</strong> ha sido creada con éxito en el sistema web de <a href=\"http://localhost:8000\">Archinet</a>.</p>\n\n<p>Para ingresar al sistema ingrese a este <a href=\"http://localhost:8000/create-password/UKRCQLJORimTQzUMDtdYLz7FYowbB7LGttR8Gt75/eyJpdiI6ImRINWJ5a2VzQ3RNVGFvOHJiT0JlbUE9PSIsInZhbHVlIjoidmlHWHh3MUFiMGZxblVHNUtXb3JmZz09IiwibWFjIjoiZDgxNjU4OWFkOGIwNWE3M2FiNzk1YzFiMmZmZjJkM2Y4ZWRjZGU2ZjE0YTQ0Nzc0OWM2MDFmODAxYjNhYzczMiJ9\">link</a> y registre su contraseña de ingreso.</p>\n', 'no', NULL, NULL, NULL, '2018-07-09 23:03:09', '2018-07-09 23:03:09'),
(9, 'prioritario', NULL, 'pendiente', 'Nueva cuenta de usuario Archinet', 'Bienvenid@ a Archinet', '<p>Su cuenta de usuario con el rol de <strong>Operario de consulta</strong> ha sido creada con éxito en el sistema web de <a href=\"http://localhost:8000\">Archinet</a>.</p>\n\n<p>Para ingresar al sistema ingrese a este <a href=\"http://localhost:8000/create-password/797EvoWVEP91rdoZ8sxDrthhceLEO4he3c9r639Q/eyJpdiI6IkFDQjdMY1wvSVpQaGFHVlwvMnhXY2FtZz09IiwidmFsdWUiOiJ4TUk3N1lMNDVYeDJOOSttdjc0Q1VnPT0iLCJtYWMiOiI1Y2M2Yzk0NGY4NzU1NjY3M2IyYTE5MTU4N2UwZjEwZDg2ZTI4YTNiN2Q1ZDg2OTAwOWQ2YmU1ZDcyYjdmZWZiIn0=\">link</a> y registre su contraseña de ingreso.</p>\n', 'no', NULL, NULL, NULL, '2018-07-13 01:34:48', '2018-07-13 01:34:48'),
(10, 'prioritario', NULL, 'pendiente', 'Nueva cuenta de usuario Archinet', 'Bienvenid@ a Archinet', '<p>Su cuenta de usuario con el rol de <strong>javier</strong> ha sido creada con éxito en el sistema web de <a href=\"http://localhost:8000\">Archinet</a>.</p>\n\n<p>Para ingresar al sistema ingrese a este <a href=\"http://localhost:8000/create-password/797EvoWVEP91rdoZ8sxDrthhceLEO4he3c9r639Q/eyJpdiI6ImZsUjBLWmZkNHBsNWgwdnhXYlJ5ZVE9PSIsInZhbHVlIjoiQ1d6ZUdtcUlxeEN3eVwvdTRoZHZyTkE9PSIsIm1hYyI6IjdkOWUzYmM1NzgxNzkxYzE5NmU3M2Q0M2IxYWNhNTJmZTE5YzdmY2I2YmViYzdlNzhhYzMxMTc3MzE0NTRjOWYifQ==\">link</a> y registre su contraseña de ingreso.</p>\n', 'no', NULL, NULL, NULL, '2018-07-13 01:36:54', '2018-07-13 01:36:54'),
(11, 'prioritario', NULL, 'pendiente', 'Nueva cuenta de usuario Archinet', 'Bienvenid@ a Archinet', '<p>Su cuenta de usuario con el rol de <strong>javier</strong> ha sido creada con éxito en el sistema web de <a href=\"http://localhost:8000\">Archinet</a>.</p>\n\n<p>Para ingresar al sistema ingrese a este <a href=\"http://localhost:8000/create-password/MC5b99ltA6ojIgJGnuvLS0VuWX8kArwRA5ULffnN/eyJpdiI6ImlYekN6SHpJcDZLZHppR2N4R3FoTGc9PSIsInZhbHVlIjoiNEdOc3JkWW5Jc3FLMTB0SkFWRzJUUT09IiwibWFjIjoiOTk1Y2Y5ZjU4YzhlMDFjM2U0NDdlOTU0YzNiZmQzODNmNDYwMzA0MjA0ODI1ZDIwNTZjNGEzNGJiZWY5MWJhMyJ9\">link</a> y registre su contraseña de ingreso.</p>\n', 'no', NULL, NULL, NULL, '2018-07-13 02:18:24', '2018-07-13 02:18:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos_users`
--

DROP TABLE IF EXISTS `correos_users`;
CREATE TABLE `correos_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `correo_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `correos_users`
--

INSERT INTO `correos_users` (`id`, `correo_id`, `user_id`) VALUES
(3, 11, 131);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
CREATE TABLE `departamentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `nombre`, `pais_id`) VALUES
(1, 'AMAZONAS', 1),
(2, 'ANTIOQUIA', 1),
(3, 'ARAUCA', 1),
(4, 'ATLÁNTICO', 1),
(5, 'BOLÍVAR', 1),
(6, 'BOYACÁ', 1),
(7, 'CALDAS', 1),
(8, 'CAQUETÁ', 1),
(9, 'CASANARE', 1),
(10, 'CAUCA', 1),
(11, 'CESAR', 1),
(12, 'CHOCÓ', 1),
(13, 'CÓRDOBA', 1),
(14, 'CUNDINAMARCA', 1),
(15, 'GUAINÍA', 1),
(16, 'GUAVIARE', 1),
(17, 'HUILA', 1),
(18, 'LA GUAJIRA', 1),
(19, 'MAGDALENA', 1),
(20, 'META', 1),
(21, 'NARIÑO', 1),
(22, 'NORTE DE SANTANDER', 1),
(23, 'PUTUMAYO', 1),
(24, 'QUINDÍO', 1),
(25, 'RISARALDA', 1),
(26, 'SAN ANDRÉS Y ROVIDENCIA', 1),
(27, 'SANTANDER', 1),
(28, 'SUCRE', 1),
(29, 'TOLIMA', 1),
(30, 'VALLE DEL CAUCA', 1),
(31, 'VAUPÉS', 1),
(32, 'VICHADA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

DROP TABLE IF EXISTS `documentos`;
CREATE TABLE `documentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `fecha_radicacion` date DEFAULT NULL,
  `user_creador_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `archivo_id` int(10) UNSIGNED NOT NULL,
  `tipo_documental_id` int(10) UNSIGNED NOT NULL,
  `documento_anexo_id` int(10) UNSIGNED DEFAULT NULL,
  `anexo_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funciones`
--

DROP TABLE IF EXISTS `funciones`;
CREATE TABLE `funciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `identificador` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `funciones`
--

INSERT INTO `funciones` (`id`, `nombre`, `identificador`, `created_at`, `updated_at`) VALUES
(3, 'Crear', 1, '2017-09-01 00:32:36', '2017-09-01 00:32:36'),
(4, 'Editar', 2, '2017-09-01 00:32:44', '2017-09-01 00:32:44'),
(5, 'Ver', 3, '2018-04-02 00:20:34', '2017-09-01 00:32:54'),
(6, 'Eliminar', 4, '2018-04-02 00:20:41', '2017-09-01 00:32:59'),
(7, 'uploads', 5, '2018-04-02 00:21:08', NULL),
(8, 'historial', 6, '2018-04-02 00:21:08', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo` enum('Inicio sesión','Cierre sesión','Crear','Editar','Eliminar','Otro') NOT NULL,
  `estado` enum('realizado','no realizado') NOT NULL,
  `clase` varchar(250) DEFAULT NULL,
  `tabla_relacionada` varchar(250) DEFAULT NULL,
  `tabla_relacionada_id` int(11) DEFAULT NULL,
  `descripcion` text,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `tipo`, `estado`, `clase`, `tabla_relacionada`, `tabla_relacionada_id`, `descripcion`, `user_id`, `created_at`, `updated_at`) VALUES
(138, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-13 15:09:32', '2018-06-13 15:09:32'),
(139, 'Editar', 'realizado', 'Archinet\\User', 'users', 40, 'Edición de un registro en la tabla users', 40, '2018-06-13 15:09:38', '2018-06-13 15:09:38'),
(140, 'Editar', 'realizado', 'Archinet\\User', 'users', 40, 'Edición de un registro en la tabla users', 40, '2018-06-13 15:09:38', '2018-06-13 15:09:38'),
(141, 'Cierre sesión', 'realizado', NULL, NULL, NULL, 'Cierre de sesión en el sistema', 40, '2018-06-13 15:09:39', '2018-06-13 15:09:39'),
(142, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-15 13:27:11', '2018-06-15 13:27:11'),
(143, 'Crear', 'realizado', 'Archinet\\Models\\Rol', 'roles', 16, 'Inserción de un registro en la tabla roles', 40, '2018-06-15 14:03:43', '2018-06-15 14:03:43'),
(144, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 16, 'Edición de un registro en la tabla roles', 40, '2018-06-15 14:03:43', '2018-06-15 14:03:43'),
(145, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 16, 'Edición de un registro en la tabla roles', 40, '2018-06-15 14:23:43', '2018-06-15 14:23:43'),
(146, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 16, 'Edición de un registro en la tabla roles', 40, '2018-06-15 14:23:43', '2018-06-15 14:23:43'),
(147, 'Crear', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Inserción de un registro en la tabla roles', 40, '2018-06-15 14:24:18', '2018-06-15 14:24:18'),
(148, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-06-15 14:24:18', '2018-06-15 14:24:18'),
(149, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-06-15 14:25:12', '2018-06-15 14:25:12'),
(150, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-06-15 14:25:12', '2018-06-15 14:25:12'),
(151, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-06-15 14:25:23', '2018-06-15 14:25:23'),
(152, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-06-15 14:25:23', '2018-06-15 14:25:23'),
(153, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-18 00:53:20', '2018-06-18 00:53:20'),
(154, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-20 17:20:21', '2018-06-20 17:20:21'),
(155, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-20 17:20:32', '2018-06-20 17:20:32'),
(156, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 00:59:51', '2018-06-21 00:59:51'),
(157, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 01:18:20', '2018-06-21 01:18:20'),
(158, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 01:29:53', '2018-06-21 01:29:53'),
(159, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 01:35:53', '2018-06-21 01:35:53'),
(160, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 01:55:49', '2018-06-21 01:55:49'),
(161, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 02:03:59', '2018-06-21 02:03:59'),
(162, 'Crear', 'realizado', 'Archinet\\User', 'users', 41, 'Inserción de un registro en la tabla users', 40, '2018-06-21 02:07:48', '2018-06-21 02:07:48'),
(163, 'Editar', 'realizado', 'Archinet\\User', 'users', 41, 'Edición de un registro en la tabla users', 40, '2018-06-21 02:07:48', '2018-06-21 02:07:48'),
(164, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 15, 'Edición de un registro en la tabla roles', 40, '2018-06-21 02:07:48', '2018-06-21 02:07:48'),
(165, 'Crear', 'realizado', 'Archinet\\Models\\Correo', 'correos', 1, 'Inserción de un registro en la tabla correos', 40, '2018-06-21 02:07:48', '2018-06-21 02:07:48'),
(166, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 1, 'Edición de un registro en la tabla correos', 40, '2018-06-21 02:07:48', '2018-06-21 02:07:48'),
(167, 'Editar', 'realizado', 'Archinet\\User', 'users', 41, 'Edición de un registro en la tabla users', 40, '2018-06-21 02:07:48', '2018-06-21 02:07:48'),
(168, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 02:32:22', '2018-06-21 02:32:22'),
(169, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 02:57:34', '2018-06-21 02:57:34'),
(170, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 03:05:32', '2018-06-21 03:05:32'),
(171, 'Crear', 'realizado', 'Archinet\\User', 'users', 42, 'Inserción de un registro en la tabla users', 40, '2018-06-21 03:13:13', '2018-06-21 03:13:13'),
(172, 'Editar', 'realizado', 'Archinet\\User', 'users', 42, 'Edición de un registro en la tabla users', 40, '2018-06-21 03:13:13', '2018-06-21 03:13:13'),
(173, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 15, 'Edición de un registro en la tabla roles', 40, '2018-06-21 03:13:13', '2018-06-21 03:13:13'),
(174, 'Crear', 'realizado', 'Archinet\\Models\\Correo', 'correos', 2, 'Inserción de un registro en la tabla correos', 40, '2018-06-21 03:13:13', '2018-06-21 03:13:13'),
(175, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 2, 'Edición de un registro en la tabla correos', 40, '2018-06-21 03:13:14', '2018-06-21 03:13:14'),
(176, 'Editar', 'realizado', 'Archinet\\User', 'users', 42, 'Edición de un registro en la tabla users', 40, '2018-06-21 03:13:14', '2018-06-21 03:13:14'),
(177, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 15:42:33', '2018-06-21 15:42:33'),
(178, 'Editar', 'realizado', 'Archinet\\User', 'users', 40, 'Edición de un registro en la tabla users', 40, '2018-06-21 15:42:40', '2018-06-21 15:42:40'),
(179, 'Editar', 'realizado', 'Archinet\\User', 'users', 40, 'Edición de un registro en la tabla users', 40, '2018-06-21 15:42:41', '2018-06-21 15:42:41'),
(180, 'Cierre sesión', 'realizado', NULL, NULL, NULL, 'Cierre de sesión en el sistema', 40, '2018-06-21 15:42:41', '2018-06-21 15:42:41'),
(181, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 15:43:48', '2018-06-21 15:43:48'),
(182, 'Crear', 'realizado', 'Archinet\\User', 'users', 43, 'Inserción de un registro en la tabla users', 40, '2018-06-21 15:44:24', '2018-06-21 15:44:24'),
(183, 'Editar', 'realizado', 'Archinet\\User', 'users', 43, 'Edición de un registro en la tabla users', 40, '2018-06-21 15:44:24', '2018-06-21 15:44:24'),
(184, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 15, 'Edición de un registro en la tabla roles', 40, '2018-06-21 15:44:25', '2018-06-21 15:44:25'),
(185, 'Crear', 'realizado', 'Archinet\\Models\\Correo', 'correos', 3, 'Inserción de un registro en la tabla correos', 40, '2018-06-21 15:44:25', '2018-06-21 15:44:25'),
(186, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 3, 'Edición de un registro en la tabla correos', 40, '2018-06-21 15:44:25', '2018-06-21 15:44:25'),
(187, 'Editar', 'realizado', 'Archinet\\User', 'users', 43, 'Edición de un registro en la tabla users', 40, '2018-06-21 15:44:25', '2018-06-21 15:44:25'),
(188, 'Editar', 'realizado', 'Archinet\\User', 'users', 40, 'Edición de un registro en la tabla users', 40, '2018-06-21 15:45:32', '2018-06-21 15:45:32'),
(189, 'Editar', 'realizado', 'Archinet\\User', 'users', 40, 'Edición de un registro en la tabla users', 40, '2018-06-21 15:45:32', '2018-06-21 15:45:32'),
(190, 'Cierre sesión', 'realizado', NULL, NULL, NULL, 'Cierre de sesión en el sistema', 40, '2018-06-21 15:45:32', '2018-06-21 15:45:32'),
(191, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 15:51:45', '2018-06-21 15:51:45'),
(192, 'Editar', 'realizado', 'Archinet\\User', 'users', 40, 'Edición de un registro en la tabla users', 40, '2018-06-21 15:53:53', '2018-06-21 15:53:53'),
(193, 'Editar', 'realizado', 'Archinet\\User', 'users', 40, 'Edición de un registro en la tabla users', 40, '2018-06-21 15:54:09', '2018-06-21 15:54:09'),
(194, 'Editar', 'realizado', 'Archinet\\User', 'users', 40, 'Edición de un registro en la tabla users', 40, '2018-06-21 15:54:10', '2018-06-21 15:54:10'),
(195, 'Editar', 'realizado', 'Archinet\\User', 'users', 40, 'Edición de un registro en la tabla users', 40, '2018-06-21 15:54:29', '2018-06-21 15:54:29'),
(196, 'Editar', 'realizado', 'Archinet\\User', 'users', 40, 'Edición de un registro en la tabla users', 40, '2018-06-21 15:54:30', '2018-06-21 15:54:30'),
(197, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 16:12:30', '2018-06-21 16:12:30'),
(199, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 16:21:58', '2018-06-21 16:21:58'),
(200, 'Crear', 'realizado', 'Archinet\\User', 'users', 44, 'Inserción de un registro en la tabla users', 40, '2018-06-21 16:23:46', '2018-06-21 16:23:46'),
(201, 'Editar', 'realizado', 'Archinet\\User', 'users', 44, 'Edición de un registro en la tabla users', 40, '2018-06-21 16:23:46', '2018-06-21 16:23:46'),
(202, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 15, 'Edición de un registro en la tabla roles', 40, '2018-06-21 16:23:46', '2018-06-21 16:23:46'),
(203, 'Crear', 'realizado', 'Archinet\\Models\\Correo', 'correos', 4, 'Inserción de un registro en la tabla correos', 40, '2018-06-21 16:23:47', '2018-06-21 16:23:47'),
(204, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 4, 'Edición de un registro en la tabla correos', 40, '2018-06-21 16:23:48', '2018-06-21 16:23:48'),
(205, 'Editar', 'realizado', 'Archinet\\User', 'users', 44, 'Edición de un registro en la tabla users', 40, '2018-06-21 16:23:48', '2018-06-21 16:23:48'),
(208, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 4, 'Edición de un registro en la tabla correos', NULL, '2018-06-21 16:25:08', '2018-06-21 16:25:08'),
(209, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 4, 'Edición de un registro en la tabla correos', NULL, '2018-06-21 16:25:08', '2018-06-21 16:25:08'),
(210, 'Editar', 'realizado', 'Archinet\\User', 'users', 44, 'Edición de un registro en la tabla users', NULL, '2018-06-21 16:25:27', '2018-06-21 16:25:27'),
(211, 'Editar', 'realizado', 'Archinet\\User', 'users', 44, 'Edición de un registro en la tabla users', NULL, '2018-06-21 16:27:49', '2018-06-21 16:27:49'),
(212, 'Editar', 'realizado', 'Archinet\\User', 'users', 44, 'Edición de un registro en la tabla users', NULL, '2018-06-21 16:27:49', '2018-06-21 16:27:49'),
(217, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 16:34:20', '2018-06-21 16:34:20'),
(218, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 17:01:30', '2018-06-21 17:01:30'),
(219, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 17:07:20', '2018-06-21 17:07:20'),
(220, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 21:04:22', '2018-06-21 21:04:22'),
(221, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 21:35:42', '2018-06-21 21:35:42'),
(222, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 21:42:06', '2018-06-21 21:42:06'),
(223, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 22:07:24', '2018-06-21 22:07:24'),
(224, 'Eliminar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 16, 'Eliminado de un registro en la tabla roles', 40, '2018-06-21 22:33:51', '2018-06-21 22:33:51'),
(225, 'Crear', 'realizado', 'Archinet\\Models\\Rol', 'roles', 18, 'Inserción de un registro en la tabla roles', 40, '2018-06-21 22:34:03', '2018-06-21 22:34:03'),
(226, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 18, 'Edición de un registro en la tabla roles', 40, '2018-06-21 22:34:03', '2018-06-21 22:34:03'),
(227, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 22:44:50', '2018-06-21 22:44:50'),
(228, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 23:03:29', '2018-06-21 23:03:29'),
(229, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 23:11:52', '2018-06-21 23:11:52'),
(230, 'Crear', 'realizado', 'Archinet\\User', 'users', 45, 'Inserción de un registro en la tabla users', 40, '2018-06-21 23:23:07', '2018-06-21 23:23:07'),
(231, 'Editar', 'realizado', 'Archinet\\User', 'users', 45, 'Edición de un registro en la tabla users', 40, '2018-06-21 23:23:07', '2018-06-21 23:23:07'),
(232, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 15, 'Edición de un registro en la tabla roles', 40, '2018-06-21 23:23:08', '2018-06-21 23:23:08'),
(233, 'Crear', 'realizado', 'Archinet\\Models\\Correo', 'correos', 5, 'Inserción de un registro en la tabla correos', 40, '2018-06-21 23:23:08', '2018-06-21 23:23:08'),
(234, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 5, 'Edición de un registro en la tabla correos', 40, '2018-06-21 23:23:08', '2018-06-21 23:23:08'),
(235, 'Editar', 'realizado', 'Archinet\\User', 'users', 45, 'Edición de un registro en la tabla users', 40, '2018-06-21 23:23:08', '2018-06-21 23:23:08'),
(236, 'Crear', 'realizado', 'Archinet\\User', 'users', 46, 'Inserción de un registro en la tabla users', 40, '2018-06-21 23:24:44', '2018-06-21 23:24:44'),
(237, 'Editar', 'realizado', 'Archinet\\User', 'users', 46, 'Edición de un registro en la tabla users', 40, '2018-06-21 23:24:44', '2018-06-21 23:24:44'),
(238, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 15, 'Edición de un registro en la tabla roles', 40, '2018-06-21 23:24:44', '2018-06-21 23:24:44'),
(239, 'Crear', 'realizado', 'Archinet\\Models\\Correo', 'correos', 6, 'Inserción de un registro en la tabla correos', 40, '2018-06-21 23:24:44', '2018-06-21 23:24:44'),
(240, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 6, 'Edición de un registro en la tabla correos', 40, '2018-06-21 23:24:44', '2018-06-21 23:24:44'),
(241, 'Editar', 'realizado', 'Archinet\\User', 'users', 46, 'Edición de un registro en la tabla users', 40, '2018-06-21 23:24:44', '2018-06-21 23:24:44'),
(242, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-06-21 23:37:35', '2018-06-21 23:37:35'),
(243, 'Editar', 'realizado', 'Archinet\\User', 'users', 46, 'Edición de un registro en la tabla users', 40, '2018-06-21 23:37:40', '2018-06-21 23:37:40'),
(244, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-06-21 23:37:41', '2018-06-21 23:37:41'),
(245, 'Editar', 'realizado', 'Archinet\\User', 'users', 46, 'Edición de un registro en la tabla users', 40, '2018-06-21 23:41:20', '2018-06-21 23:41:20'),
(246, 'Editar', 'realizado', 'Archinet\\User', 'users', 46, 'Edición de un registro en la tabla users', 40, '2018-06-21 23:41:20', '2018-06-21 23:41:20'),
(247, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-06-21 23:41:20', '2018-06-21 23:41:20'),
(248, 'Editar', 'realizado', 'Archinet\\User', 'users', 46, 'Edición de un registro en la tabla users', 40, '2018-06-21 23:47:02', '2018-06-21 23:47:02'),
(249, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 18, 'Edición de un registro en la tabla roles', 40, '2018-06-21 23:47:02', '2018-06-21 23:47:02'),
(250, 'Editar', 'realizado', 'Archinet\\User', 'users', 46, 'Edición de un registro en la tabla users', 40, '2018-06-21 23:49:54', '2018-06-21 23:49:54'),
(251, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 18, 'Edición de un registro en la tabla roles', 40, '2018-06-21 23:49:54', '2018-06-21 23:49:54'),
(252, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 02:24:10', '2018-07-09 02:24:10'),
(253, 'Crear', 'realizado', 'Archinet\\User', 'users', 47, 'Inserción de un registro en la tabla users', 40, '2018-07-09 02:24:48', '2018-07-09 02:24:48'),
(254, 'Editar', 'realizado', 'Archinet\\User', 'users', 47, 'Edición de un registro en la tabla users', 40, '2018-07-09 02:24:48', '2018-07-09 02:24:48'),
(255, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 15, 'Edición de un registro en la tabla roles', 40, '2018-07-09 02:24:48', '2018-07-09 02:24:48'),
(256, 'Crear', 'realizado', 'Archinet\\Models\\Correo', 'correos', 7, 'Inserción de un registro en la tabla correos', 40, '2018-07-09 02:24:48', '2018-07-09 02:24:48'),
(257, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 7, 'Edición de un registro en la tabla correos', 40, '2018-07-09 02:24:48', '2018-07-09 02:24:48'),
(258, 'Editar', 'realizado', 'Archinet\\User', 'users', 47, 'Edición de un registro en la tabla users', 40, '2018-07-09 02:24:48', '2018-07-09 02:24:48'),
(259, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 03:02:11', '2018-07-09 03:02:11'),
(260, 'Crear', 'realizado', 'Archinet\\User', 'users', 48, 'Inserción de un registro en la tabla users', 40, '2018-07-09 03:14:58', '2018-07-09 03:14:58'),
(261, 'Editar', 'realizado', 'Archinet\\User', 'users', 48, 'Edición de un registro en la tabla users', 40, '2018-07-09 03:14:58', '2018-07-09 03:14:58'),
(262, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 03:30:51', '2018-07-09 03:30:51'),
(263, 'Crear', 'realizado', 'Archinet\\User', 'users', 49, 'Inserción de un registro en la tabla users', 40, '2018-07-09 03:32:22', '2018-07-09 03:32:22'),
(264, 'Editar', 'realizado', 'Archinet\\User', 'users', 49, 'Edición de un registro en la tabla users', 40, '2018-07-09 03:32:22', '2018-07-09 03:32:22'),
(265, 'Crear', 'realizado', 'Archinet\\User', 'users', 50, 'Inserción de un registro en la tabla users', 40, '2018-07-09 03:37:17', '2018-07-09 03:37:17'),
(266, 'Editar', 'realizado', 'Archinet\\User', 'users', 50, 'Edición de un registro en la tabla users', 40, '2018-07-09 03:37:17', '2018-07-09 03:37:17'),
(267, 'Crear', 'realizado', 'Archinet\\User', 'users', 51, 'Inserción de un registro en la tabla users', 40, '2018-07-09 03:39:47', '2018-07-09 03:39:47'),
(268, 'Editar', 'realizado', 'Archinet\\User', 'users', 51, 'Edición de un registro en la tabla users', 40, '2018-07-09 03:39:47', '2018-07-09 03:39:47'),
(269, 'Crear', 'realizado', 'Archinet\\User', 'users', 52, 'Inserción de un registro en la tabla users', 40, '2018-07-09 03:51:59', '2018-07-09 03:51:59'),
(270, 'Editar', 'realizado', 'Archinet\\User', 'users', 52, 'Edición de un registro en la tabla users', 40, '2018-07-09 03:51:59', '2018-07-09 03:51:59'),
(271, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 04:36:27', '2018-07-09 04:36:27'),
(272, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 04:42:38', '2018-07-09 04:42:38'),
(273, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 05:06:47', '2018-07-09 05:06:47'),
(274, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 13:28:51', '2018-07-09 13:28:51'),
(275, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 13:44:49', '2018-07-09 13:44:49'),
(276, 'Crear', 'realizado', 'Archinet\\User', 'users', 53, 'Inserción de un registro en la tabla users', 40, '2018-07-09 13:51:18', '2018-07-09 13:51:18'),
(277, 'Editar', 'realizado', 'Archinet\\User', 'users', 53, 'Edición de un registro en la tabla users', 40, '2018-07-09 13:51:18', '2018-07-09 13:51:18'),
(278, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 14:02:09', '2018-07-09 14:02:09'),
(279, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 14:12:00', '2018-07-09 14:12:00'),
(280, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 14:18:11', '2018-07-09 14:18:11'),
(281, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 16:19:40', '2018-07-09 16:19:40'),
(282, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 16:40:29', '2018-07-09 16:40:29'),
(293, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 16:57:22', '2018-07-09 16:57:22'),
(294, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 17:38:00', '2018-07-09 17:38:00'),
(295, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 17:47:49', '2018-07-09 17:47:49'),
(296, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 19:01:19', '2018-07-09 19:01:19'),
(297, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 19:11:51', '2018-07-09 19:11:51'),
(298, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 19:28:56', '2018-07-09 19:28:56'),
(299, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 19:44:16', '2018-07-09 19:44:16'),
(300, 'Crear', 'realizado', 'Archinet\\User', 'users', 54, 'Inserción de un registro en la tabla users', 40, '2018-07-09 19:56:18', '2018-07-09 19:56:18'),
(301, 'Editar', 'realizado', 'Archinet\\User', 'users', 54, 'Edición de un registro en la tabla users', 40, '2018-07-09 19:56:18', '2018-07-09 19:56:18'),
(302, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 20:33:17', '2018-07-09 20:33:17'),
(303, 'Editar', 'realizado', 'Archinet\\User', 'users', 53, 'Edición de un registro en la tabla users', 40, '2018-07-09 20:40:38', '2018-07-09 20:40:38'),
(304, 'Editar', 'realizado', 'Archinet\\User', 'users', 53, 'Edición de un registro en la tabla users', 40, '2018-07-09 20:40:38', '2018-07-09 20:40:38'),
(305, 'Editar', 'realizado', 'Archinet\\User', 'users', 52, 'Edición de un registro en la tabla users', 40, '2018-07-09 20:41:13', '2018-07-09 20:41:13'),
(306, 'Editar', 'realizado', 'Archinet\\User', 'users', 52, 'Edición de un registro en la tabla users', 40, '2018-07-09 20:41:14', '2018-07-09 20:41:14'),
(307, 'Editar', 'realizado', 'Archinet\\User', 'users', 49, 'Edición de un registro en la tabla users', 40, '2018-07-09 20:43:14', '2018-07-09 20:43:14'),
(308, 'Editar', 'realizado', 'Archinet\\User', 'users', 49, 'Edición de un registro en la tabla users', 40, '2018-07-09 20:43:14', '2018-07-09 20:43:14'),
(309, 'Editar', 'realizado', 'Archinet\\User', 'users', 49, 'Edición de un registro en la tabla users', 40, '2018-07-09 20:45:08', '2018-07-09 20:45:08'),
(310, 'Editar', 'realizado', 'Archinet\\User', 'users', 49, 'Edición de un registro en la tabla users', 40, '2018-07-09 20:45:08', '2018-07-09 20:45:08'),
(311, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 21:26:06', '2018-07-09 21:26:06'),
(312, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 21:42:04', '2018-07-09 21:42:04'),
(313, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 21:49:43', '2018-07-09 21:49:43'),
(314, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 22:14:47', '2018-07-09 22:14:47'),
(315, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 22:27:35', '2018-07-09 22:27:35'),
(316, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 22:47:39', '2018-07-09 22:47:39'),
(317, 'Crear', 'realizado', 'Archinet\\User', 'users', 55, 'Inserción de un registro en la tabla users', 40, '2018-07-09 22:56:02', '2018-07-09 22:56:02'),
(318, 'Editar', 'realizado', 'Archinet\\User', 'users', 55, 'Edición de un registro en la tabla users', 40, '2018-07-09 22:56:02', '2018-07-09 22:56:02'),
(319, 'Editar', 'realizado', 'Archinet\\User', 'users', 53, 'Edición de un registro en la tabla users', 40, '2018-07-09 22:56:30', '2018-07-09 22:56:30'),
(320, 'Editar', 'realizado', 'Archinet\\User', 'users', 53, 'Edición de un registro en la tabla users', 40, '2018-07-09 22:56:30', '2018-07-09 22:56:30'),
(321, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 23:01:52', '2018-07-09 23:01:52'),
(322, 'Crear', 'realizado', 'Archinet\\User', 'users', 56, 'Inserción de un registro en la tabla users', 40, '2018-07-09 23:03:09', '2018-07-09 23:03:09'),
(323, 'Editar', 'realizado', 'Archinet\\User', 'users', 56, 'Edición de un registro en la tabla users', 40, '2018-07-09 23:03:09', '2018-07-09 23:03:09'),
(324, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 15, 'Edición de un registro en la tabla roles', 40, '2018-07-09 23:03:09', '2018-07-09 23:03:09'),
(325, 'Crear', 'realizado', 'Archinet\\Models\\Correo', 'correos', 8, 'Inserción de un registro en la tabla correos', 40, '2018-07-09 23:03:09', '2018-07-09 23:03:09'),
(326, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 8, 'Edición de un registro en la tabla correos', 40, '2018-07-09 23:03:09', '2018-07-09 23:03:09'),
(327, 'Editar', 'realizado', 'Archinet\\User', 'users', 56, 'Edición de un registro en la tabla users', 40, '2018-07-09 23:03:09', '2018-07-09 23:03:09'),
(328, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-09 23:15:22', '2018-07-09 23:15:22'),
(329, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-10 00:58:24', '2018-07-10 00:58:24'),
(330, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-11 12:36:11', '2018-07-11 12:36:11'),
(331, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-12 00:14:23', '2018-07-12 00:14:23'),
(332, 'Crear', 'realizado', 'Archinet\\User', 'users', 57, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:56', '2018-07-12 00:14:56'),
(333, 'Editar', 'realizado', 'Archinet\\User', 'users', 57, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:56', '2018-07-12 00:14:56'),
(334, 'Crear', 'realizado', 'Archinet\\User', 'users', 58, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:56', '2018-07-12 00:14:56'),
(335, 'Editar', 'realizado', 'Archinet\\User', 'users', 58, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:56', '2018-07-12 00:14:56'),
(336, 'Crear', 'realizado', 'Archinet\\User', 'users', 59, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:56', '2018-07-12 00:14:56'),
(337, 'Editar', 'realizado', 'Archinet\\User', 'users', 59, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:56', '2018-07-12 00:14:56'),
(338, 'Crear', 'realizado', 'Archinet\\User', 'users', 60, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:56', '2018-07-12 00:14:56'),
(339, 'Editar', 'realizado', 'Archinet\\User', 'users', 60, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:56', '2018-07-12 00:14:56'),
(340, 'Crear', 'realizado', 'Archinet\\User', 'users', 61, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(341, 'Editar', 'realizado', 'Archinet\\User', 'users', 61, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(342, 'Crear', 'realizado', 'Archinet\\User', 'users', 62, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(343, 'Editar', 'realizado', 'Archinet\\User', 'users', 62, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(344, 'Crear', 'realizado', 'Archinet\\User', 'users', 63, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(345, 'Editar', 'realizado', 'Archinet\\User', 'users', 63, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(346, 'Crear', 'realizado', 'Archinet\\User', 'users', 64, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(347, 'Editar', 'realizado', 'Archinet\\User', 'users', 64, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(348, 'Crear', 'realizado', 'Archinet\\User', 'users', 65, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(349, 'Editar', 'realizado', 'Archinet\\User', 'users', 65, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(350, 'Crear', 'realizado', 'Archinet\\User', 'users', 66, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(351, 'Editar', 'realizado', 'Archinet\\User', 'users', 66, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(352, 'Crear', 'realizado', 'Archinet\\User', 'users', 67, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(353, 'Editar', 'realizado', 'Archinet\\User', 'users', 67, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(354, 'Crear', 'realizado', 'Archinet\\User', 'users', 68, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(355, 'Editar', 'realizado', 'Archinet\\User', 'users', 68, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(356, 'Crear', 'realizado', 'Archinet\\User', 'users', 69, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:57', '2018-07-12 00:14:57'),
(357, 'Editar', 'realizado', 'Archinet\\User', 'users', 69, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(358, 'Crear', 'realizado', 'Archinet\\User', 'users', 70, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(359, 'Editar', 'realizado', 'Archinet\\User', 'users', 70, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(360, 'Crear', 'realizado', 'Archinet\\User', 'users', 71, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(361, 'Editar', 'realizado', 'Archinet\\User', 'users', 71, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(362, 'Crear', 'realizado', 'Archinet\\User', 'users', 72, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(363, 'Editar', 'realizado', 'Archinet\\User', 'users', 72, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(364, 'Crear', 'realizado', 'Archinet\\User', 'users', 73, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(365, 'Editar', 'realizado', 'Archinet\\User', 'users', 73, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(366, 'Crear', 'realizado', 'Archinet\\User', 'users', 74, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(367, 'Editar', 'realizado', 'Archinet\\User', 'users', 74, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(368, 'Crear', 'realizado', 'Archinet\\User', 'users', 75, 'Inserción de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(369, 'Editar', 'realizado', 'Archinet\\User', 'users', 75, 'Edición de un registro en la tabla users', 40, '2018-07-12 00:14:58', '2018-07-12 00:14:58'),
(370, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-12 00:25:10', '2018-07-12 00:25:10'),
(371, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-12 00:36:06', '2018-07-12 00:36:06'),
(372, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-12 00:58:32', '2018-07-12 00:58:32'),
(373, 'Crear', 'realizado', 'Archinet\\User', 'users', 76, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(374, 'Editar', 'realizado', 'Archinet\\User', 'users', 76, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(375, 'Crear', 'realizado', 'Archinet\\User', 'users', 77, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(376, 'Editar', 'realizado', 'Archinet\\User', 'users', 77, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(377, 'Crear', 'realizado', 'Archinet\\User', 'users', 78, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(378, 'Editar', 'realizado', 'Archinet\\User', 'users', 78, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(379, 'Crear', 'realizado', 'Archinet\\User', 'users', 79, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(380, 'Editar', 'realizado', 'Archinet\\User', 'users', 79, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(381, 'Crear', 'realizado', 'Archinet\\User', 'users', 80, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(382, 'Editar', 'realizado', 'Archinet\\User', 'users', 80, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(383, 'Crear', 'realizado', 'Archinet\\User', 'users', 81, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(384, 'Editar', 'realizado', 'Archinet\\User', 'users', 81, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(385, 'Crear', 'realizado', 'Archinet\\User', 'users', 82, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(386, 'Editar', 'realizado', 'Archinet\\User', 'users', 82, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:11', '2018-07-12 01:00:11'),
(387, 'Crear', 'realizado', 'Archinet\\User', 'users', 83, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(388, 'Editar', 'realizado', 'Archinet\\User', 'users', 83, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(389, 'Crear', 'realizado', 'Archinet\\User', 'users', 84, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(390, 'Editar', 'realizado', 'Archinet\\User', 'users', 84, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(391, 'Crear', 'realizado', 'Archinet\\User', 'users', 85, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(392, 'Editar', 'realizado', 'Archinet\\User', 'users', 85, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(393, 'Crear', 'realizado', 'Archinet\\User', 'users', 86, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(394, 'Editar', 'realizado', 'Archinet\\User', 'users', 86, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(395, 'Crear', 'realizado', 'Archinet\\User', 'users', 87, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(396, 'Editar', 'realizado', 'Archinet\\User', 'users', 87, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(397, 'Crear', 'realizado', 'Archinet\\User', 'users', 88, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(398, 'Editar', 'realizado', 'Archinet\\User', 'users', 88, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(399, 'Crear', 'realizado', 'Archinet\\User', 'users', 89, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(400, 'Editar', 'realizado', 'Archinet\\User', 'users', 89, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(401, 'Crear', 'realizado', 'Archinet\\User', 'users', 90, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(402, 'Editar', 'realizado', 'Archinet\\User', 'users', 90, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(403, 'Crear', 'realizado', 'Archinet\\User', 'users', 91, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(404, 'Editar', 'realizado', 'Archinet\\User', 'users', 91, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:12', '2018-07-12 01:00:12'),
(405, 'Crear', 'realizado', 'Archinet\\User', 'users', 92, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:13', '2018-07-12 01:00:13'),
(406, 'Editar', 'realizado', 'Archinet\\User', 'users', 92, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:13', '2018-07-12 01:00:13'),
(407, 'Crear', 'realizado', 'Archinet\\User', 'users', 93, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:13', '2018-07-12 01:00:13'),
(408, 'Editar', 'realizado', 'Archinet\\User', 'users', 93, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:13', '2018-07-12 01:00:13'),
(409, 'Crear', 'realizado', 'Archinet\\User', 'users', 94, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:00:13', '2018-07-12 01:00:13'),
(410, 'Editar', 'realizado', 'Archinet\\User', 'users', 94, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:00:13', '2018-07-12 01:00:13'),
(411, 'Crear', 'realizado', 'Archinet\\User', 'users', 95, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:18', '2018-07-12 01:01:18'),
(412, 'Editar', 'realizado', 'Archinet\\User', 'users', 95, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(413, 'Crear', 'realizado', 'Archinet\\User', 'users', 96, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(414, 'Editar', 'realizado', 'Archinet\\User', 'users', 96, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(415, 'Crear', 'realizado', 'Archinet\\User', 'users', 97, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(416, 'Editar', 'realizado', 'Archinet\\User', 'users', 97, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(417, 'Crear', 'realizado', 'Archinet\\User', 'users', 98, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(418, 'Editar', 'realizado', 'Archinet\\User', 'users', 98, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(419, 'Crear', 'realizado', 'Archinet\\User', 'users', 99, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(420, 'Editar', 'realizado', 'Archinet\\User', 'users', 99, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(421, 'Crear', 'realizado', 'Archinet\\User', 'users', 100, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(422, 'Editar', 'realizado', 'Archinet\\User', 'users', 100, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(423, 'Crear', 'realizado', 'Archinet\\User', 'users', 101, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(424, 'Editar', 'realizado', 'Archinet\\User', 'users', 101, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(425, 'Crear', 'realizado', 'Archinet\\User', 'users', 102, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(426, 'Editar', 'realizado', 'Archinet\\User', 'users', 102, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(427, 'Crear', 'realizado', 'Archinet\\User', 'users', 103, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(428, 'Editar', 'realizado', 'Archinet\\User', 'users', 103, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:19', '2018-07-12 01:01:19'),
(429, 'Crear', 'realizado', 'Archinet\\User', 'users', 104, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(430, 'Editar', 'realizado', 'Archinet\\User', 'users', 104, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(431, 'Crear', 'realizado', 'Archinet\\User', 'users', 105, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(432, 'Editar', 'realizado', 'Archinet\\User', 'users', 105, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(433, 'Crear', 'realizado', 'Archinet\\User', 'users', 106, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(434, 'Editar', 'realizado', 'Archinet\\User', 'users', 106, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(435, 'Crear', 'realizado', 'Archinet\\User', 'users', 107, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(436, 'Editar', 'realizado', 'Archinet\\User', 'users', 107, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(437, 'Crear', 'realizado', 'Archinet\\User', 'users', 108, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(438, 'Editar', 'realizado', 'Archinet\\User', 'users', 108, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(439, 'Crear', 'realizado', 'Archinet\\User', 'users', 109, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(440, 'Editar', 'realizado', 'Archinet\\User', 'users', 109, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(441, 'Crear', 'realizado', 'Archinet\\User', 'users', 110, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(442, 'Editar', 'realizado', 'Archinet\\User', 'users', 110, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(443, 'Crear', 'realizado', 'Archinet\\User', 'users', 111, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:20', '2018-07-12 01:01:20'),
(444, 'Editar', 'realizado', 'Archinet\\User', 'users', 111, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:21', '2018-07-12 01:01:21'),
(445, 'Crear', 'realizado', 'Archinet\\User', 'users', 112, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:21', '2018-07-12 01:01:21'),
(446, 'Editar', 'realizado', 'Archinet\\User', 'users', 112, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:21', '2018-07-12 01:01:21'),
(447, 'Crear', 'realizado', 'Archinet\\User', 'users', 113, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:01:21', '2018-07-12 01:01:21'),
(448, 'Editar', 'realizado', 'Archinet\\User', 'users', 113, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:01:21', '2018-07-12 01:01:21'),
(449, 'Crear', 'realizado', 'Archinet\\User', 'users', 115, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:06:55', '2018-07-12 01:06:55'),
(450, 'Editar', 'realizado', 'Archinet\\User', 'users', 115, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:06:55', '2018-07-12 01:06:55'),
(451, 'Crear', 'realizado', 'Archinet\\User', 'users', 116, 'Inserción de un registro en la tabla users', 40, '2018-07-12 01:06:55', '2018-07-12 01:06:55'),
(452, 'Editar', 'realizado', 'Archinet\\User', 'users', 116, 'Edición de un registro en la tabla users', 40, '2018-07-12 01:06:55', '2018-07-12 01:06:55'),
(453, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-12 02:01:21', '2018-07-12 02:01:21'),
(454, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-12 02:29:00', '2018-07-12 02:29:00'),
(455, 'Crear', 'realizado', 'Archinet\\User', 'users', 117, 'Inserción de un registro en la tabla users', 40, '2018-07-12 02:42:15', '2018-07-12 02:42:15'),
(456, 'Editar', 'realizado', 'Archinet\\User', 'users', 117, 'Edición de un registro en la tabla users', 40, '2018-07-12 02:42:15', '2018-07-12 02:42:15'),
(457, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-12 02:54:03', '2018-07-12 02:54:03'),
(458, 'Crear', 'realizado', 'Archinet\\User', 'users', 118, 'Inserción de un registro en la tabla users', 40, '2018-07-12 03:19:14', '2018-07-12 03:19:14'),
(459, 'Editar', 'realizado', 'Archinet\\User', 'users', 118, 'Edición de un registro en la tabla users', 40, '2018-07-12 03:19:14', '2018-07-12 03:19:14'),
(460, 'Crear', 'realizado', 'Archinet\\User', 'users', 119, 'Inserción de un registro en la tabla users', 40, '2018-07-12 03:20:33', '2018-07-12 03:20:33'),
(461, 'Editar', 'realizado', 'Archinet\\User', 'users', 119, 'Edición de un registro en la tabla users', 40, '2018-07-12 03:20:33', '2018-07-12 03:20:33'),
(462, 'Crear', 'realizado', 'Archinet\\User', 'users', 120, 'Inserción de un registro en la tabla users', 40, '2018-07-12 03:20:33', '2018-07-12 03:20:33'),
(463, 'Editar', 'realizado', 'Archinet\\User', 'users', 120, 'Edición de un registro en la tabla users', 40, '2018-07-12 03:20:33', '2018-07-12 03:20:33'),
(464, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-12 03:41:54', '2018-07-12 03:41:54'),
(465, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-12 03:48:22', '2018-07-12 03:48:22'),
(466, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-12 03:55:07', '2018-07-12 03:55:07'),
(467, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-12 04:13:15', '2018-07-12 04:13:15'),
(468, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-13 01:33:00', '2018-07-13 01:33:00'),
(469, 'Crear', 'realizado', 'Archinet\\User', 'users', 121, 'Inserción de un registro en la tabla users', 40, '2018-07-13 01:34:48', '2018-07-13 01:34:48'),
(470, 'Editar', 'realizado', 'Archinet\\User', 'users', 121, 'Edición de un registro en la tabla users', 40, '2018-07-13 01:34:48', '2018-07-13 01:34:48'),
(471, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 15, 'Edición de un registro en la tabla roles', 40, '2018-07-13 01:34:48', '2018-07-13 01:34:48'),
(472, 'Crear', 'realizado', 'Archinet\\Models\\Correo', 'correos', 9, 'Inserción de un registro en la tabla correos', 40, '2018-07-13 01:34:48', '2018-07-13 01:34:48'),
(473, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 9, 'Edición de un registro en la tabla correos', 40, '2018-07-13 01:34:48', '2018-07-13 01:34:48'),
(474, 'Editar', 'realizado', 'Archinet\\User', 'users', 121, 'Edición de un registro en la tabla users', 40, '2018-07-13 01:34:48', '2018-07-13 01:34:48'),
(475, 'Crear', 'realizado', 'Archinet\\Models\\Rol', 'roles', 19, 'Inserción de un registro en la tabla roles', 40, '2018-07-13 01:35:37', '2018-07-13 01:35:37'),
(476, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 19, 'Edición de un registro en la tabla roles', 40, '2018-07-13 01:35:37', '2018-07-13 01:35:37'),
(477, 'Crear', 'realizado', 'Archinet\\User', 'users', 122, 'Inserción de un registro en la tabla users', 40, '2018-07-13 01:36:54', '2018-07-13 01:36:54'),
(478, 'Editar', 'realizado', 'Archinet\\User', 'users', 122, 'Edición de un registro en la tabla users', 40, '2018-07-13 01:36:54', '2018-07-13 01:36:54'),
(479, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 19, 'Edición de un registro en la tabla roles', 40, '2018-07-13 01:36:54', '2018-07-13 01:36:54'),
(480, 'Crear', 'realizado', 'Archinet\\Models\\Correo', 'correos', 10, 'Inserción de un registro en la tabla correos', 40, '2018-07-13 01:36:54', '2018-07-13 01:36:54'),
(481, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 10, 'Edición de un registro en la tabla correos', 40, '2018-07-13 01:36:54', '2018-07-13 01:36:54'),
(482, 'Editar', 'realizado', 'Archinet\\User', 'users', 122, 'Edición de un registro en la tabla users', 40, '2018-07-13 01:36:54', '2018-07-13 01:36:54'),
(495, 'Crear', 'realizado', 'Archinet\\User', 'users', 129, 'Inserción de un registro en la tabla users', 40, '2018-07-13 01:58:20', '2018-07-13 01:58:20');
INSERT INTO `logs` (`id`, `tipo`, `estado`, `clase`, `tabla_relacionada`, `tabla_relacionada_id`, `descripcion`, `user_id`, `created_at`, `updated_at`) VALUES
(496, 'Editar', 'realizado', 'Archinet\\User', 'users', 129, 'Edición de un registro en la tabla users', 40, '2018-07-13 01:58:20', '2018-07-13 01:58:20'),
(497, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-13 01:58:20', '2018-07-13 01:58:20'),
(498, 'Crear', 'realizado', 'Archinet\\User', 'users', 130, 'Inserción de un registro en la tabla users', 40, '2018-07-13 02:02:17', '2018-07-13 02:02:17'),
(499, 'Editar', 'realizado', 'Archinet\\User', 'users', 130, 'Edición de un registro en la tabla users', 40, '2018-07-13 02:02:17', '2018-07-13 02:02:17'),
(500, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-13 02:02:17', '2018-07-13 02:02:17'),
(501, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-13 02:10:42', '2018-07-13 02:10:42'),
(502, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-13 02:17:09', '2018-07-13 02:17:09'),
(503, 'Crear', 'realizado', 'Archinet\\User', 'users', 131, 'Inserción de un registro en la tabla users', 40, '2018-07-13 02:18:24', '2018-07-13 02:18:24'),
(504, 'Editar', 'realizado', 'Archinet\\User', 'users', 131, 'Edición de un registro en la tabla users', 40, '2018-07-13 02:18:24', '2018-07-13 02:18:24'),
(505, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 19, 'Edición de un registro en la tabla roles', 40, '2018-07-13 02:18:24', '2018-07-13 02:18:24'),
(506, 'Crear', 'realizado', 'Archinet\\Models\\Correo', 'correos', 11, 'Inserción de un registro en la tabla correos', 40, '2018-07-13 02:18:24', '2018-07-13 02:18:24'),
(507, 'Editar', 'realizado', 'Archinet\\Models\\Correo', 'correos', 11, 'Edición de un registro en la tabla correos', 40, '2018-07-13 02:18:24', '2018-07-13 02:18:24'),
(508, 'Editar', 'realizado', 'Archinet\\User', 'users', 131, 'Edición de un registro en la tabla users', 40, '2018-07-13 02:18:24', '2018-07-13 02:18:24'),
(509, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-13 02:41:49', '2018-07-13 02:41:49'),
(510, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-13 02:57:03', '2018-07-13 02:57:03'),
(511, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-13 03:05:29', '2018-07-13 03:05:29'),
(512, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-13 03:32:08', '2018-07-13 03:32:08'),
(513, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-13 03:40:34', '2018-07-13 03:40:34'),
(514, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-14 22:51:54', '2018-07-14 22:51:54'),
(515, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-14 23:13:33', '2018-07-14 23:13:33'),
(516, 'Crear', 'realizado', 'Archinet\\User', 'users', 132, 'Inserción de un registro en la tabla users', 40, '2018-07-14 23:18:08', '2018-07-14 23:18:08'),
(517, 'Editar', 'realizado', 'Archinet\\User', 'users', 132, 'Edición de un registro en la tabla users', 40, '2018-07-14 23:18:08', '2018-07-14 23:18:08'),
(518, 'Crear', 'realizado', 'Archinet\\User', 'users', 133, 'Inserción de un registro en la tabla users', 40, '2018-07-14 23:20:30', '2018-07-14 23:20:30'),
(519, 'Editar', 'realizado', 'Archinet\\User', 'users', 133, 'Edición de un registro en la tabla users', 40, '2018-07-14 23:20:30', '2018-07-14 23:20:30'),
(520, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-14 23:20:30', '2018-07-14 23:20:30'),
(521, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-14 23:30:19', '2018-07-14 23:30:19'),
(522, 'Crear', 'realizado', 'Archinet\\User', 'users', 134, 'Inserción de un registro en la tabla users', 40, '2018-07-14 23:37:34', '2018-07-14 23:37:34'),
(523, 'Editar', 'realizado', 'Archinet\\User', 'users', 134, 'Edición de un registro en la tabla users', 40, '2018-07-14 23:37:34', '2018-07-14 23:37:34'),
(524, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-14 23:37:34', '2018-07-14 23:37:34'),
(525, 'Crear', 'realizado', 'Archinet\\User', 'users', 135, 'Inserción de un registro en la tabla users', 40, '2018-07-14 23:37:34', '2018-07-14 23:37:34'),
(526, 'Editar', 'realizado', 'Archinet\\User', 'users', 135, 'Edición de un registro en la tabla users', 40, '2018-07-14 23:37:34', '2018-07-14 23:37:34'),
(527, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-14 23:37:34', '2018-07-14 23:37:34'),
(528, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-14 23:53:34', '2018-07-14 23:53:34'),
(529, 'Crear', 'realizado', 'Archinet\\User', 'users', 136, 'Inserción de un registro en la tabla users', 40, '2018-07-15 00:08:33', '2018-07-15 00:08:33'),
(530, 'Editar', 'realizado', 'Archinet\\User', 'users', 136, 'Edición de un registro en la tabla users', 40, '2018-07-15 00:08:33', '2018-07-15 00:08:33'),
(531, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-15 00:08:33', '2018-07-15 00:08:33'),
(532, 'Crear', 'realizado', 'Archinet\\User', 'users', 137, 'Inserción de un registro en la tabla users', 40, '2018-07-15 00:10:50', '2018-07-15 00:10:50'),
(533, 'Editar', 'realizado', 'Archinet\\User', 'users', 137, 'Edición de un registro en la tabla users', 40, '2018-07-15 00:10:50', '2018-07-15 00:10:50'),
(534, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-15 00:10:50', '2018-07-15 00:10:50'),
(535, 'Crear', 'realizado', 'Archinet\\User', 'users', 138, 'Inserción de un registro en la tabla users', 40, '2018-07-15 00:11:46', '2018-07-15 00:11:46'),
(536, 'Editar', 'realizado', 'Archinet\\User', 'users', 138, 'Edición de un registro en la tabla users', 40, '2018-07-15 00:11:46', '2018-07-15 00:11:46'),
(537, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-15 00:11:46', '2018-07-15 00:11:46'),
(538, 'Crear', 'realizado', 'Archinet\\User', 'users', 139, 'Inserción de un registro en la tabla users', 40, '2018-07-15 00:12:17', '2018-07-15 00:12:17'),
(539, 'Editar', 'realizado', 'Archinet\\User', 'users', 139, 'Edición de un registro en la tabla users', 40, '2018-07-15 00:12:17', '2018-07-15 00:12:17'),
(540, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-15 00:12:17', '2018-07-15 00:12:17'),
(541, 'Crear', 'realizado', 'Archinet\\User', 'users', 140, 'Inserción de un registro en la tabla users', 40, '2018-07-15 00:12:45', '2018-07-15 00:12:45'),
(542, 'Editar', 'realizado', 'Archinet\\User', 'users', 140, 'Edición de un registro en la tabla users', 40, '2018-07-15 00:12:45', '2018-07-15 00:12:45'),
(543, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-15 00:12:45', '2018-07-15 00:12:45'),
(544, 'Crear', 'realizado', 'Archinet\\User', 'users', 141, 'Inserción de un registro en la tabla users', 40, '2018-07-15 00:13:59', '2018-07-15 00:13:59'),
(545, 'Editar', 'realizado', 'Archinet\\User', 'users', 141, 'Edición de un registro en la tabla users', 40, '2018-07-15 00:13:59', '2018-07-15 00:13:59'),
(546, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-15 00:13:59', '2018-07-15 00:13:59'),
(547, 'Crear', 'realizado', 'Archinet\\User', 'users', 142, 'Inserción de un registro en la tabla users', 40, '2018-07-15 00:14:00', '2018-07-15 00:14:00'),
(548, 'Editar', 'realizado', 'Archinet\\User', 'users', 142, 'Edición de un registro en la tabla users', 40, '2018-07-15 00:14:00', '2018-07-15 00:14:00'),
(549, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-15 00:14:00', '2018-07-15 00:14:00'),
(550, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-15 00:19:43', '2018-07-15 00:19:43'),
(551, 'Crear', 'realizado', 'Archinet\\User', 'users', 143, 'Inserción de un registro en la tabla users', 40, '2018-07-15 00:21:07', '2018-07-15 00:21:07'),
(552, 'Editar', 'realizado', 'Archinet\\User', 'users', 143, 'Edición de un registro en la tabla users', 40, '2018-07-15 00:21:07', '2018-07-15 00:21:07'),
(553, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-15 00:21:07', '2018-07-15 00:21:07'),
(554, 'Crear', 'realizado', 'Archinet\\User', 'users', 144, 'Inserción de un registro en la tabla users', 40, '2018-07-15 00:21:07', '2018-07-15 00:21:07'),
(555, 'Editar', 'realizado', 'Archinet\\User', 'users', 144, 'Edición de un registro en la tabla users', 40, '2018-07-15 00:21:07', '2018-07-15 00:21:07'),
(556, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-15 00:21:07', '2018-07-15 00:21:07'),
(557, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-15 00:36:39', '2018-07-15 00:36:39'),
(558, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-15 00:51:31', '2018-07-15 00:51:31'),
(559, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-15 00:58:16', '2018-07-15 00:58:16'),
(560, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-15 01:18:19', '2018-07-15 01:18:19'),
(561, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-15 01:28:43', '2018-07-15 01:28:43'),
(562, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-16 01:39:53', '2018-07-16 01:39:53'),
(563, 'Crear', 'realizado', 'Archinet\\User', 'users', 145, 'Inserción de un registro en la tabla users', 40, '2018-07-16 01:43:17', '2018-07-16 01:43:17'),
(564, 'Editar', 'realizado', 'Archinet\\User', 'users', 145, 'Edición de un registro en la tabla users', 40, '2018-07-16 01:43:17', '2018-07-16 01:43:17'),
(565, 'Editar', 'realizado', 'Archinet\\Models\\Rol', 'roles', 17, 'Edición de un registro en la tabla roles', 40, '2018-07-16 01:43:17', '2018-07-16 01:43:17'),
(566, 'Inicio sesión', 'realizado', NULL, NULL, NULL, 'Inicio de sesión en el sistema', 40, '2018-07-16 02:55:17', '2018-07-16 02:55:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_errors`
--

DROP TABLE IF EXISTS `logs_errors`;
CREATE TABLE `logs_errors` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` text NOT NULL,
  `log_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `identificador` int(11) NOT NULL,
  `etiqueta` varchar(150) NOT NULL,
  `url` varchar(150) NOT NULL,
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
  `agrupacion` varchar(100) DEFAULT NULL,
  `orden_menu` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `nombre`, `identificador`, `etiqueta`, `url`, `estado`, `agrupacion`, `orden_menu`, `created_at`, `updated_at`) VALUES
(1, 'Módulos y funciones', 1, 'Módulos y funciones', '/modulos-funciones', 'Activo', NULL, NULL, '2017-08-31 20:02:23', '2017-09-01 01:02:23'),
(2, 'Roles', 2, 'Roles', '/rol', 'Activo', NULL, NULL, '2017-09-01 01:04:57', '2017-09-01 01:04:57'),
(3, 'Usuarios', 3, 'Usuarios', '/usuario', 'Activo', NULL, NULL, '2017-09-01 01:05:19', '2017-09-01 01:05:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos_funciones`
--

DROP TABLE IF EXISTS `modulos_funciones`;
CREATE TABLE `modulos_funciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `modulo_id` int(10) UNSIGNED NOT NULL,
  `funcion_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulos_funciones`
--

INSERT INTO `modulos_funciones` (`id`, `modulo_id`, `funcion_id`) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 1, 5),
(4, 1, 6),
(5, 2, 3),
(6, 2, 4),
(7, 2, 5),
(8, 2, 6),
(9, 3, 3),
(10, 3, 4),
(11, 3, 5),
(12, 3, 6),
(13, 3, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `scopes` text CHARACTER SET utf8mb4,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text CHARACTER SET utf8mb4,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `secret` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `redirect` text CHARACTER SET utf8mb4 NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `access_token_id` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE `paises` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `codigo`, `nombre`) VALUES
(1, '57', 'Colombia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `superadministrador` enum('si','no') NOT NULL DEFAULT 'no',
  `funcionario` enum('si','no') NOT NULL DEFAULT 'no',
  `nombre` varchar(100) NOT NULL,
  `privilegios` text,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `superadministrador`, `funcionario`, `nombre`, `privilegios`, `user_id`, `created_at`, `updated_at`) VALUES
(12, 'si', '', 'Superadministrador', NULL, NULL, '2018-04-02 00:22:52', '2018-04-02 00:22:52'),
(15, 'no', 'no', 'Operario de consulta', '(3,1)_(3,2)_(3,3)_(3,4)_(3,5)', 40, '2018-05-29 21:33:07', '2018-05-29 21:32:36'),
(17, 'no', 'si', 'sas', '(1,2)', 40, '2018-07-13 01:51:02', '2018-06-15 14:25:23'),
(18, 'no', '', 'Prueeeeeba', '(1,1)_(1,3)', 40, '2018-06-21 22:34:02', '2018-06-21 22:34:02'),
(19, 'no', 'no', 'javier', '(1,1)_(1,2)_(1,3)', 40, '2018-07-13 01:35:37', '2018-07-13 01:35:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_users`
--

DROP TABLE IF EXISTS `roles_users`;
CREATE TABLE `roles_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `rol_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `estado` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles_users`
--

INSERT INTO `roles_users` (`id`, `rol_id`, `user_id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 12, 40, 'activo', '2018-04-30 17:10:54', '2018-04-30 17:10:54'),
(5, 17, 130, 'activo', '2018-07-13 02:02:17', NULL),
(6, 19, 131, 'activo', '2018-07-13 02:18:24', NULL),
(7, 17, 133, 'activo', '2018-07-14 23:20:30', NULL),
(8, 17, 134, 'activo', '2018-07-14 23:37:34', NULL),
(9, 17, 135, 'activo', '2018-07-14 23:37:34', NULL),
(10, 17, 136, 'activo', '2018-07-15 00:08:33', NULL),
(11, 17, 137, 'activo', '2018-07-15 00:10:50', NULL),
(12, 17, 138, 'activo', '2018-07-15 00:11:46', NULL),
(13, 17, 139, 'activo', '2018-07-15 00:12:17', NULL),
(14, 17, 140, 'activo', '2018-07-15 00:12:45', NULL),
(15, 17, 141, 'activo', '2018-07-15 00:13:59', NULL),
(16, 17, 142, 'activo', '2018-07-15 00:14:00', NULL),
(17, 17, 143, 'activo', '2018-07-15 00:21:07', NULL),
(18, 17, 144, 'activo', '2018-07-15 00:21:07', NULL),
(19, 17, 145, 'activo', '2018-07-16 01:43:17', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documentales`
--

DROP TABLE IF EXISTS `tipos_documentales`;
CREATE TABLE `tipos_documentales` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text,
  `capitulo_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

DROP TABLE IF EXISTS `ubicaciones`;
CREATE TABLE `ubicaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `carrera` varchar(20) DEFAULT NULL,
  `calle` varchar(20) DEFAULT NULL,
  `numero` varchar(20) NOT NULL,
  `barrio` varchar(255) NOT NULL,
  `especificaciones` varchar(255) DEFAULT NULL,
  `ciudad_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `tipo_identificacion` enum('cédula de ciudadanía','cédula de extranjería') CHARACTER SET utf8mb4 DEFAULT NULL,
  `identificacion` varchar(11) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nombres` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
  `apellidos` varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
  `celular` varchar(10) CHARACTER SET utf8mb4 DEFAULT NULL,
  `telefono_opcional` varchar(45) DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email_opcional` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `fecha_inicio_contrato` date DEFAULT NULL,
  `fecha_terminacion_contrato` date DEFAULT NULL,
  `fecha_nacimiento` varchar(45) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `estado` enum('activo','inactivo') CHARACTER SET utf8mb4 NOT NULL DEFAULT 'activo',
  `estado_civil` enum('Soltero','Casado') DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
  `token` text CHARACTER SET utf8mb4,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `tipo_identificacion`, `identificacion`, `nombres`, `apellidos`, `celular`, `telefono_opcional`, `email`, `email_opcional`, `direccion`, `fecha_inicio_contrato`, `fecha_terminacion_contrato`, `fecha_nacimiento`, `password`, `estado`, `estado_civil`, `remember_token`, `token`, `created_at`, `updated_at`) VALUES
(40, NULL, NULL, 'Superadmin', 'App', NULL, NULL, 'superadmin@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$1ekQkkS.D6eNLbdTuQf43OOZKf2D/CXeERqwOBymkp9ofWAIE81Yq', 'activo', NULL, 'NafQaWcsn4euX53mxJ9jZWBWAfJLrEawoDP82uEh7beLJIVYyE0gPU0WwwTs', NULL, '2018-04-02 00:24:05', '2018-04-02 00:24:05'),
(130, 'cédula de ciudadanía', '2222222222', 'rrrrrrrrrrrrrrrrrrrrrrrrrrrr', 'eeeeeeeeeeeee', '4444444444', NULL, 'ddde@sena.edu.co', NULL, 'calle jhdk', NULL, NULL, '2018-07-11', NULL, 'activo', NULL, NULL, '797EvoWVEP91rdoZ8sxDrthhceLEO4he3c9r639Q', '2018-07-13 02:02:17', '2018-07-13 02:02:17'),
(131, 'cédula de ciudadanía', '1111111111', 'dsddddddddddddddd', 'ssssssssssss', '2222222222', NULL, 'cccccccccccccc@sema.edu.co', NULL, NULL, '2018-07-22', '2018-07-27', NULL, NULL, 'inactivo', NULL, NULL, 'MC5b99ltA6ojIgJGnuvLS0VuWX8kArwRA5ULffnN', '2018-07-13 02:18:24', '2018-07-13 02:18:24'),
(132, 'cédula de ciudadanía', '1231231231', 'asdasd', 'asdasdasd', '1233333333', '2131231231', 'supera2in@sena.edu.co', NULL, 'calle del olvido', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-14 23:18:08', '2018-07-14 23:18:08'),
(133, 'cédula de ciudadanía', '1234567891', 'mar', 'martinez', '1233777333', '2131231232', 'martinez@sena.edu.co', NULL, 'calle del olmo', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-14 23:20:30', '2018-07-14 23:20:30'),
(134, 'cédula de ciudadanía', '1233431231', 'asdasd', 'asdasdasd', '1233333333', '2131231231', 'supera2i70n@sena.edu.co', NULL, 'calle del olvido', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-14 23:37:34', '2018-07-14 23:37:34'),
(135, 'cédula de ciudadanía', '1238867891', 'mar', 'martinez', '1233777333', '2131231232', 'martinez76@sena.edu.co', NULL, 'calle del olmo', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-14 23:37:34', '2018-07-14 23:37:34'),
(136, 'cédula de ciudadanía', '0033431231', 'asdasd', 'asdasdasd', '1233333333', '2131231231', 'lupera2i70n@sena.edu.co', NULL, 'calle del olvido', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-15 00:08:33', '2018-07-15 00:08:33'),
(137, 'cédula de ciudadanía', '1200867891', 'msamy', 'asdasdasd', '1233777333', '2131231232', 'partinez76@sena.edu.co', NULL, 'calle del olmo', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-15 00:10:50', '2018-07-15 00:10:50'),
(138, 'cédula de ciudadanía', '1200800891', 'msamy', 'asdasdasd', '1233777333', '2131231232', 'pbrtinez76@sena.edu.co', NULL, 'calle del olmo', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-15 00:11:46', '2018-07-15 00:11:46'),
(139, 'cédula de ciudadanía', '0000678905', 'asdasd', 'asdasdasd', '1233333333', '2131231231', 'bupera2i70n@sena.edu.co', NULL, 'calle del olvido', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-15 00:12:17', '2018-07-15 00:12:17'),
(140, 'cédula de ciudadanía', '990800891', 'msamy', 'asdasdasd', '1233777333', '2131231232', 'pbrltinez76@sena.edu.co', NULL, 'calle del olmo', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-15 00:12:45', '2018-07-15 00:12:45'),
(141, 'cédula de ciudadanía', '0006789056', 'asdasd', 'asdasdasd', '1233333333', '2131231231', 'bpupera2i70n@sena.edu.co', NULL, 'calle del olvido', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-15 00:13:59', '2018-07-15 00:13:59'),
(142, 'cédula de ciudadanía', '9908008917', 'msamy', 'asdasdasd', '1233777333', '2131231232', 'pbrltipnez76@sena.edu.co', NULL, 'calle del olmo', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-15 00:13:59', '2018-07-15 00:13:59'),
(143, 'cédula de ciudadanía', '1234567890', 'asdasd', 'asdasdasd', '1233333333', '2131231231', 'upera2i70n@sena.edu.co', NULL, 'calle del olvido', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-15 00:21:07', '2018-07-15 00:21:07'),
(144, 'cédula de ciudadanía', '1243567891', 'msamy', 'asdasdasd', '1233777333', '2131231232', 'rltipnez76@sena.edu.co', NULL, 'calle del olmo', NULL, NULL, '8-07-19', NULL, 'activo', NULL, NULL, NULL, '2018-07-15 00:21:07', '2018-07-15 00:21:07'),
(145, 'cédula de ciudadanía', '0009676534', 'Lola', 'fiel', '1313455566', '3213356', 'lola@sena.edu.co', 'lola@hotmail.com', 'calle yuh', NULL, NULL, '2018-07-10', NULL, 'activo', NULL, NULL, 'BeRHMWSFSukCYtsvgqEyuT2gLqTp3PRabO6RshUL', '2018-07-16 01:43:17', '2018-07-16 01:43:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_anexos_archivos1_idx` (`archivo_id`);

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `capitulos`
--
ALTER TABLE `capitulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_capitulos_users1_idx` (`user_id`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ciudades_departamentos1_idx` (`departamento_id`);

--
-- Indices de la tabla `correos`
--
ALTER TABLE `correos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `correos_users`
--
ALTER TABLE `correos_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_correos_has_users_users1_idx` (`user_id`),
  ADD KEY `fk_correos_has_users_correos1_idx` (`correo_id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_departamentos_paises1_idx` (`pais_id`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_documentos_users1_idx` (`user_id`),
  ADD KEY `fk_documentos_users2_idx` (`user_creador_id`),
  ADD KEY `fk_documentos_archivos1_idx` (`archivo_id`),
  ADD KEY `fk_documentos_tipos_documentales1_idx` (`tipo_documental_id`),
  ADD KEY `fk_documentos_anexos1_idx` (`anexo_id`),
  ADD KEY `fk_documentos_documentos1_idx` (`documento_anexo_id`);

--
-- Indices de la tabla `funciones`
--
ALTER TABLE `funciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_logs_users1_idx` (`user_id`);

--
-- Indices de la tabla `logs_errors`
--
ALTER TABLE `logs_errors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_logs_errors_logs1_idx` (`log_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orden_menu_UNIQUE` (`orden_menu`);

--
-- Indices de la tabla `modulos_funciones`
--
ALTER TABLE `modulos_funciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_modulos_has_funciones_funciones1_idx` (`funcion_id`),
  ADD KEY `fk_modulos_has_funciones_modulos1_idx` (`modulo_id`);

--
-- Indices de la tabla `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indices de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indices de la tabla `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_roles_users1_idx` (`user_id`);

--
-- Indices de la tabla `roles_users`
--
ALTER TABLE `roles_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_roles_has_users_users1_idx` (`user_id`),
  ADD KEY `fk_roles_has_users_roles1_idx` (`rol_id`);

--
-- Indices de la tabla `tipos_documentales`
--
ALTER TABLE `tipos_documentales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipos_documentales_capitulos1_idx` (`capitulo_id`),
  ADD KEY `fk_tipos_documentales_users1_idx` (`user_id`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ubicaciones_ciudades1_idx` (`ciudad_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_identificacion_unique` (`identificacion`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anexos`
--
ALTER TABLE `anexos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `capitulos`
--
ALTER TABLE `capitulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1113;

--
-- AUTO_INCREMENT de la tabla `correos`
--
ALTER TABLE `correos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `correos_users`
--
ALTER TABLE `correos_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `funciones`
--
ALTER TABLE `funciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=567;

--
-- AUTO_INCREMENT de la tabla `logs_errors`
--
ALTER TABLE `logs_errors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `modulos_funciones`
--
ALTER TABLE `modulos_funciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `roles_users`
--
ALTER TABLE `roles_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `tipos_documentales`
--
ALTER TABLE `tipos_documentales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anexos`
--
ALTER TABLE `anexos`
  ADD CONSTRAINT `fk_anexos_archivos1` FOREIGN KEY (`archivo_id`) REFERENCES `archivos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `capitulos`
--
ALTER TABLE `capitulos`
  ADD CONSTRAINT `fk_capitulos_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `fk_ciudades_departamentos1` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `correos_users`
--
ALTER TABLE `correos_users`
  ADD CONSTRAINT `fk_correos_has_users_correos1` FOREIGN KEY (`correo_id`) REFERENCES `correos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_correos_has_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `fk_departamentos_paises1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `fk_documentos_anexos1` FOREIGN KEY (`anexo_id`) REFERENCES `anexos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_documentos_archivos1` FOREIGN KEY (`archivo_id`) REFERENCES `archivos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_documentos_documentos1` FOREIGN KEY (`documento_anexo_id`) REFERENCES `documentos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_documentos_tipos_documentales1` FOREIGN KEY (`tipo_documental_id`) REFERENCES `tipos_documentales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_documentos_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_documentos_users2` FOREIGN KEY (`user_creador_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_logs_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `logs_errors`
--
ALTER TABLE `logs_errors`
  ADD CONSTRAINT `fk_logs_errors_logs1` FOREIGN KEY (`log_id`) REFERENCES `logs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `modulos_funciones`
--
ALTER TABLE `modulos_funciones`
  ADD CONSTRAINT `fk_modulos_has_funciones_funciones1` FOREIGN KEY (`funcion_id`) REFERENCES `funciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_modulos_has_funciones_modulos1` FOREIGN KEY (`modulo_id`) REFERENCES `modulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `fk_roles_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `roles_users`
--
ALTER TABLE `roles_users`
  ADD CONSTRAINT `fk_roles_has_users_roles1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_roles_has_users_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tipos_documentales`
--
ALTER TABLE `tipos_documentales`
  ADD CONSTRAINT `fk_tipos_documentales_capitulos1` FOREIGN KEY (`capitulo_id`) REFERENCES `capitulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipos_documentales_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `fk_ubicaciones_ciudades1` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudades` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
