-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: ***REMOVED***
-- Generation Time: May 24, 2013 at 10:09 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.15-1~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comparatuescuela`
--

-- --------------------------------------------------------

--
-- Table structure for table `reportes_ciudadanos`
--

CREATE TABLE IF NOT EXISTS `reportes_ciudadanos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cct` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email_input` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nombre_input` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ocupacion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `denuncia` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_agent` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `likes` int(11) NOT NULL DEFAULT '0',
  `categoria` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `publicar` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `reportes_ciudadanos`
--

INSERT INTO `reportes_ciudadanos` (`id`, `cct`, `email_input`, `nombre_input`, `ocupacion`, `denuncia`, `timestamp`, `user_agent`, `likes`, `categoria`, `publicar`) VALUES
(1, '09DPR2103Y', 'asdf@asdf.com', 'some name', 'ocupacion 2', 'asdfasdfasdf', '2013-05-25 01:40:34', 'Opera/9.80 (X11; Linux i686) Presto/2.12.388 Version/12.15', 0, 'ocupacion 2', 0),
(2, '09DPR2103Y', 'fourht@asd.com', 'fourht try', 'ocupacion 2', 'fourth try', '2013-05-25 01:42:04', 'Opera/9.80 (X11; Linux i686) Presto/2.12.388 Version/12.15', 0, 'ocupacion 2', 0),
(3, '09DPR2103Y', 'asdf@as.com', 'fifth try', 'ocupacion 1', 'fifrth try', '2013-05-25 01:43:00', 'Opera/9.80 (X11; Linux i686) Presto/2.12.388 Version/12.15', 0, 'ocupacion 3', 0),
(4, '09DPR2103Y', 'as@AC.COM', 'sixth try', 'ocupacion 1', 'sixth try', '2013-05-25 01:45:34', 'Opera/9.80 (X11; Linux i686) Presto/2.12.388 Version/12.15', 0, 'ocupacion 2', 0),
(5, '09DPR2103Y', 'eigth@e.com', 'eigth try', 'ocupacion 1', 'eigth try', '2013-05-25 01:46:31', 'Opera/9.80 (X11; Linux i686) Presto/2.12.388 Version/12.15', 0, 'ocupacion 2', 0),
(6, '09DPR2103Y', 'nine@n.com', 'ninth try', 'ocupacion 2', 'ninth try', '2013-05-25 02:01:19', 'Opera/9.80 (X11; Linux i686) Presto/2.12.388 Version/12.15', 0, 'ocupacion 1', 0),
(7, '09DPR2103Y', 'ten@t.com', 'tenth', 'ocupacion 2', 'tenth', '2013-05-25 02:02:41', 'Opera/9.80 (X11; Linux i686) Presto/2.12.388 Version/12.15', 0, 'ocupacion 1', NULL),
(8, '09DPR2103Y', 'elven@el.com', 'eleven', 'ocupacion 2', 'eleven', '2013-05-25 02:04:11', 'Opera/9.80 (X11; Linux i686) Presto/2.12.388 Version/12.15', 0, 'ocupacion 1', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
