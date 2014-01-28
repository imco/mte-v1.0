-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: ***REMOVED***
-- Tiempo de generación: 28-01-2014 a las 00:42:17
-- Versión del servidor: 5.5.34
-- Versión de PHP: 5.3.10-1ubuntu3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cte_optimizada`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE IF NOT EXISTS `programas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tema` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `zonas` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `requisitos` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `direccion` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `telefono_contacto` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sitio_web` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`id`, `nombre`, `tema`, `descripcion`, `zonas`, `requisitos`, `direccion`, `telefono`, `mail`, `telefono_contacto`, `sitio_web`) VALUES
(1, 'Programa de Desarrollo Comunitario de Fondo para la Paz IAP', 'Infraestructura física y equipamiento.', 'Fondo para la Paz es una organización que atiende el tema de desarrollo sostenible en comunidades rurales indígenas de México.', 'San Luis Potosí, Veracruz, Campeche, Oaxaca', 'La escuela debe estar en el área de cobertura de Fondo para la Paz', 'Palo Santo No. 16, Colonia Lomas Altas, Delegación Miguel Hidalgo, CP 11950, México D. F. ', '(55) 5570 2791', '"Magali Alejandra Jauregui Montalvo magali.jauregui@fondoparalapaz.org"', '" (55) 55702791 Ext. 123"', 'www.fondoparalapaz.org'),
(2, 'Programa de Escuela Integral de Proeducación, I.A.P', 'Aprendizaje permanente; prevención y desarrollo humano; vida y nutrición saludables; medio ambiente; participación y ciudadanía.\r\nFomento a la lectura\r\nFortalecimiento tecnológico', '"Proeducación es una institución sin fines de lucro que nace por la preocupación de personas comprometidas con la sociedad para promover el mejoramiento de la educación pública básica en México.\r\nTrabaja en escuelas primarias públicas mediante un modelo de intervención que promueve el desarrollo integral de los alumnos a través del fortalecimiento de todos los miembros de la comunidad educativa.\r\nTiene presencia en 6 estados de la República y está dedicada a implementar programas para poyar la solución de los problemas que detectamos en las escuelas en un esquema de acompañamiento y monitoreo continuo, desde las escuelas y respaldado por un modelo de evaluación externa.\r\n\r\n"\r\n', 'Distrito Federal, Estado de México, Michoacán, Querétaro, Morelos, Zacatecas\r\n\r\n', 'La forma de participar es a través de convenios con autoridades educativas estatales y se requiere contar con un programa de financiamiento a largo plazo, antes de seleccionar a nuevas escuelas.\r\n', 'Hidalgo 61 interior 7 Colonia San Jerónimo, Delegación Magdalena Contreras, C.P. 10200, México, D.F.\r\n', '55 75 96 57 / 16 24', 'Paola Iturbide Lugo. paolaiturbide@proeducacion.org.mx', '55 75 96 57 / 16 24', 'http://www.proeducacion.org.mx'),
(3, 'Programa Educación Benéame Promesa de Fundación Tarahumara José A. Llaguno', '"1. Entrega mensual de apoyo económico.                                                               2.Visitas domiciliarias.\r\n3. Trabajo comunitario.\r\n4. Redes y comunicación.\r\n5. Reuniones con padres de familia y autoridades indígenas locales.\r\n6.  Reuniones con tutores.\r\n7. Encuentro Anual Estudiantil Serrano “Sinibí Napawika” (Siempre Juntos).\r\n8. Servicio comunitario “Norina Bitichí” (vuelve a casa)."', '"Fundación Tarahumara José A. Llaguno es una organización que ha promovido el desarrollo comunitario de la Sierra Tarahumara por más de veinte años, particularmente en las áreas de nutrición infantil, educación, seguridad alimentaria e hídrica. \r\n\r\nEl programa de educación Benéame Promesa surge como una alternativa de apoyo y acompañamiento a jóvenes que desean continuar con sus estudios a nivel secundario, preparatoria, técnico y universitario. Este programa ofrece apoyos económicos mensuales, seguimiento continuo, y  busca capacitar e integrar a los jóvenes al desarrollo de la región a través de reuniones mensuales, los encuentros estudiantiles anuales y el servicio comunitario  anual llamado “Norina Bitchi” (Regresa a casa). Las becas que los estudiantes reciben (particularmente de secundaria y preparatoria) sirven para apoyar a las escuelas e internados de la región, que muchas veces no cuentan con infraestructura, recursos humanos o insumos como comida suficientes para atender las necesidades de la población infantil. En este ciclo escolar, la fundación apoyó a 553 jóvenes de ocho municipios de la región."', 'Chihuahua', 'El programa trabaja a través de solicitudes individuales de los estudiantes, si un estudiante está interesado, puede contactar a la Coordinadora de Educación.', 'Benito Juárez 1272. Col. Ferrocarril. Creel, Chihuahua. C.P. 33200.', '(635)4560240', '"Ana Lucía Márquez Escobedo\r\nDesarrollo Institucional\r\nlucia.marquez@tarahumara.net\r\n\r\nMariel Ramirez\r\nDirección Operativa\r\nmariel.ramirez@tarahumara.net\r\n\r\nLupita Quezada\r\nCoordinadora de Educación\r\nlupita.quezada@tarahumara.net\r\n\r\n"', ' Lupita Quezada lupita.quezada@tarahumara.net', 'www.tarahumara.net'),
(4, 'Programa Plan Empresa Escuela de Impulsa', '"\r\n- Educación financiera.\r\n- Preparación para el trabajo.\r\n- Aliento del espíritu emprendedor."', '"Impulsa, filial en México de “Junior Achievement Worldwide”, es una organización no lucrativa líder mundial en su ramo que a través de programas educativos que realizan con el apoyo de empresas y gobiernos inspiran y educan a niños y jóvenes en las áreas de educación financiera, preparación para el trabajo y el aliento al espíritu emprendedor. \r\nNuestros programas son impartidos por voluntarios dentro y fuera del salón de clase y sus contenidos se complementan con el currículo escolar. Todos ellos transmiten a los alumnos de 6 a 21 años de edad la importancia de educarse, de responsabilizarse por el propio destino, de proponerse objetivos claros y realistas, y actuar para la consecución de los mismos, de desarrollar la perseverancia, la creatividad y la confianza en uno mismo."', 'Nacional ', '"Cualquier escuela que esté interesada en contar con programas de Impulsa para sus alumnos, padres de familia o maestros puede enviar un correo electrónico a: atencion@impulsa.org.mx , indicando:\r\nNombre de la escuela\r\nUbicación\r\nPrograma que desea\r\nTeléfono\r\nNombre del director(a)\r\nCorreo electrónico\r\nLa organización trabaja con escuelas tanto públicas como privadas y cuenta con programas para alumnos desde primero de primaria hasta primeros semestres de universidad."', 'Paseo de la Reforma 505 piso 32. Col. Cuauhtémoc. Del. Cuauhtémoc. México, DF 06500', '(55) 52119444', '"Maria Juana Vera\r\nmariajuana@impulsa.org.mx"', '"(55) 52119444 atencion@impulsa.org.mx"', 'www.impusa.org.mx');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
