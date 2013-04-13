-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-04-2013 a las 02:40:15
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `test_tmp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cb_admins`
--

CREATE TABLE IF NOT EXISTS `cb_admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `a_name` varchar(64) NOT NULL,
  `a_password` varchar(32) NOT NULL,
  `a_email` varchar(120) NOT NULL,
  `a_last_login` int(10) NOT NULL DEFAULT '0',
  `a_last_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cb_calidades`
--

CREATE TABLE IF NOT EXISTS `cb_calidades` (
  `calidad_id` int(11) NOT NULL AUTO_INCREMENT,
  `c_titulo` varchar(64) NOT NULL,
  PRIMARY KEY (`calidad_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `cb_calidades`
--

INSERT INTO `cb_calidades` (`calidad_id`, `c_titulo`) VALUES
(1, 'Bluray-Screener'),
(2, 'Cam'),
(3, 'DVD-Rip'),
(4, 'DVD-Screener'),
(5, 'HD-Real-1080'),
(6, 'HD-Real-720'),
(7, 'HD-Rip'),
(8, 'TS-Screener'),
(9, 'TS-Screener HQ'),
(10, 'TV-Rip'),
(11, 'VHS-Rip'),
(12, 'VHS-Screener');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cb_config`
--

CREATE TABLE IF NOT EXISTS `cb_config` (
  `config_id` int(11) NOT NULL AUTO_INCREMENT,
  `var` text NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`config_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `cb_config`
--

INSERT INTO `cb_config` (`config_id`, `var`, `value`) VALUES
(1, 'site_name', 'MovieX'),
(2, 'site_slogan', 'Películas gratis online'),
(3, 'site_path', ''),
(4, 'fb_app_id', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cb_descargas`
--

CREATE TABLE IF NOT EXISTS `cb_descargas` (
  `descarga_id` int(11) NOT NULL AUTO_INCREMENT,
  `pelicula_id` int(11) NOT NULL,
  `d_calidad` int(4) NOT NULL,
  `d_idioma` int(4) NOT NULL,
  `d_servidor` int(4) NOT NULL,
  `d_source` text NOT NULL,
  `d_upload` int(10) NOT NULL,
  `d_online` int(1) NOT NULL DEFAULT '1',
  `d_reports` int(11) NOT NULL DEFAULT '0',
  `d_hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`descarga_id`),
  KEY `pelicula_id` (`pelicula_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cb_generos`
--

CREATE TABLE IF NOT EXISTS `cb_generos` (
  `genero_id` int(11) NOT NULL AUTO_INCREMENT,
  `g_titulo` varchar(64) NOT NULL,
  `g_seo` varchar(64) NOT NULL,
  PRIMARY KEY (`genero_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `cb_generos`
--

INSERT INTO `cb_generos` (`genero_id`, `g_titulo`, `g_seo`) VALUES
(1, 'Acción', 'accion'),
(2, 'Animación e Infantil', 'animacion-e-infantil'),
(3, 'Artes Marciales', 'artes-marciales'),
(4, 'Aventura', 'aventura'),
(5, 'Bélico', 'belico'),
(6, 'Biográfica', 'biografica'),
(7, 'Ciencia Ficción', 'ciencia-ficcion'),
(8, 'Comedia', 'comedia'),
(9, 'Cortometrajes', 'cortometrajes'),
(10, 'Deporte', 'deporte'),
(11, 'Drama', 'drama'),
(12, 'Fantasia', 'fantasia'),
(13, 'Intriga', 'intriga'),
(14, 'Musical', 'musical'),
(15, 'Romance', 'romance'),
(16, 'Terror', 'terror'),
(17, 'Thriller', 'thriller'),
(18, 'Western', 'western');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cb_idiomas`
--

CREATE TABLE IF NOT EXISTS `cb_idiomas` (
  `idioma_id` int(11) NOT NULL AUTO_INCREMENT,
  `i_titulo` varchar(64) NOT NULL,
  PRIMARY KEY (`idioma_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `cb_idiomas`
--

INSERT INTO `cb_idiomas` (`idioma_id`, `i_titulo`) VALUES
(1, 'Español'),
(2, 'Latino'),
(3, 'Subtitulado'),
(4, 'Versión Original');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cb_paginas`
--

CREATE TABLE IF NOT EXISTS `cb_paginas` (
  `page_key` varchar(24) NOT NULL,
  `page_title` varchar(64) NOT NULL,
  `page_content` text NOT NULL,
  PRIMARY KEY (`page_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cb_paginas`
--

INSERT INTO `cb_paginas` (`page_key`, `page_title`, `page_content`) VALUES
('about', 'Acerca de $site', '<b>$site</b> es un sitio para visualizar y descargar pel&iacute;culas totalmente gratis.'),
('terms-of-use', 'Términos y condiciones de uso', '&bull; Aquella persona que desee permanecer o simplemente entrar en $site deberá ser mayor de edad o en otro caso contar con la aprobación de sus progenitores, tutores o aquella persona que mantenga la patria potestad sobre su persona y estar en plena posesión de sus facultades.\r\n\r\n&bull; Nosotros no reproducimos, plagiamos, distribuimos ni comunicamos públicamente películas, series, documentales o videos de música que puedan tener derechos de autor.\r\n\r\n&bull; Los enlaces que figuran en esta web han sido encontrados en diferentes webs de videos online (veoh.com , megavideo.com... ) y desconocemos si los mismos tienen contratos de cesión de derechos sobre estos videos para reproducirlos, alojarlos o permitir su descarga.\r\n\r\n&bull; Todas las marcas aquí mencionadas y logos están registrados por sus legítimos propietarios y solamente se emplean en referencia a las mismas y con un fin de cita o comentario, de acuerdo con el articulo 32 LPI.\r\n\r\n&bull; No nos hacemos responsables del uso indebido que puedes hacer del contenido de nuestra página.\r\n\r\n&bull; En ningún caso o circunstancia se podrá responsabilizar directamente o indirectamente al propietario ni a los colaboradores del ilícito uso de la información contenida en $site. Así mismo tampoco se nos podrá responsabilizar directamente o indirectamente de incorrecto uso o mala interpretación que se haga de la información y servicios incluidos. Igualmente quedara fuera de nuestra responsabilidad el materia al que usted pueda acceder desde nuestros enlaces.\r\n\r\n&bull; Si en tu país, este tipo de página está prohibido, tú y solo tú eres el responsable de la entrada a $site.\r\n\r\n&bull; Si decides permanecer en $site, quiere decir que has leído, comprendido y aceptas las condiciones de esta página.\r\n\r\n&bull; Todo el contenido ha sido exclusivamente sacado de sitios públicos de Internet, por lo que este material es considerado de libre distribución. En ningún artículo legal se menciona la prohibición de material libre por lo que esta página no infringe en ningún caso la ley.Si alguien tiene alguna duda o problema al respecto, no dude en ponerse en contacto con nosotros.\r\n\r\n&bull; Todo la información y programas aquí recogidos van destinados al efectivo cumplimiento de los derechos recogidos en el artículo 31 RD/1/1996 por el que se aprueba el texto refundido de la Ley de la Propiedad Intelectual (LPI) en especial referencia al artículo 31.2 LPI, y en concordancia con lo expresado en el artículo 100.2 de esta misma ley.\r\n\r\n&bull; Nos reservamos el derecho de vetar la entrada a cualquier sujeto a nuestra web&bull;site y a su vez se reserva el derecho de prohibir el uso de cualquier programa y/o información, en concordancia con los derechos de autor otorgados por el artículo 14 LPI.\r\n\r\n&bull; La visita o acceso a esta página web, que es de carácter privado y no público, exige la aceptación del presente aviso. En esta web se podrá acceder a contenidos publicados por webs de videos online (veoh.com , megavideo.com... ). El único material que existe en la web son enlaces a dicho contenido, facilitando únicamente la copia privada. Los propietarios de las webs de videos online (veoh.com , megavideo.com... ) son plenamente responsables de los contenidos que publiquen. Por consiguiente, $site ni aprueba, ni hace suyos los productos, servicios, contenidos, información, datos, opiniones archivos y cualquier clase de material existente en las webs de videos online (veoh.com , megavideo.com... ) y no controla ni se hace responsable de la calidad, licitud, fiabilidad y utilidad de la información, contenidos y servicios existentes en las webs de videos online (veoh.com , megavideo.com... ).'),
('contact', 'Contacto', 'Para cualquier duda, comentario o sugerencia escribenos a <b/>info@enchufaos.com.ar</b>.'),
('facebook', 'Siguenos en Facebook', '<meta http-equiv="refresh" content="0;url=http://www.facebook.com/LinkSharingSystem"> ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cb_peliculas`
--

CREATE TABLE IF NOT EXISTS `cb_peliculas` (
  `pelicula_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_titulo` varchar(128) NOT NULL,
  `p_seo` varchar(128) NOT NULL,
  `p_sinopsis` text NOT NULL,
  `p_ano` int(4) NOT NULL,
  `p_genero` int(4) NOT NULL,
  `p_idiomas` varchar(64) NOT NULL,
  `p_calidad` int(4) NOT NULL,
  `p_estreno` int(1) NOT NULL DEFAULT '0',
  `p_date` int(10) NOT NULL,
  `p_online` int(1) NOT NULL DEFAULT '1',
  `p_v_up` int(11) NOT NULL DEFAULT '0',
  `p_v_down` int(11) NOT NULL DEFAULT '0',
  `p_hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pelicula_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cb_publicidad`
--

CREATE TABLE IF NOT EXISTS `cb_publicidad` (
  `ad_key` varchar(5) NOT NULL,
  `ad_code` text NOT NULL,
  KEY `ad_key` (`ad_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cb_publicidad`
--

INSERT INTO `cb_publicidad` (`ad_key`, `ad_code`) VALUES
('popup', '&lt;script&gt;function hola(){alert(&#039;Hola Mundo&#039;)};&lt;/script&gt;'),
('ad300', ''),
('ad468', ''),
('ad160', ''),
('ad728', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cb_servidores`
--

CREATE TABLE IF NOT EXISTS `cb_servidores` (
  `servidor_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_titulo` varchar(64) NOT NULL,
  `s_plugin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`servidor_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `cb_servidores`
--

INSERT INTO `cb_servidores` (`servidor_id`, `s_titulo`, `s_plugin`) VALUES
(1, 'MovShare', 1),
(2, 'PutLocker', 1),
(3, 'SockShare', 1),
(4, 'VK', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cb_videos`
--

CREATE TABLE IF NOT EXISTS `cb_videos` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `pelicula_id` int(11) NOT NULL,
  `v_calidad` int(4) NOT NULL,
  `v_idioma` int(4) NOT NULL,
  `v_servidor` int(4) NOT NULL,
  `v_source` text NOT NULL,
  `v_embed` tinyint(1) NOT NULL DEFAULT '0',
  `v_upload` int(10) NOT NULL,
  `v_online` int(1) NOT NULL DEFAULT '1',
  `v_reports` int(11) NOT NULL DEFAULT '0',
  `v_hits` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`video_id`),
  KEY `pelicula_id` (`pelicula_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;