-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: ***REMOVED***
-- Generation Time: Mar 06, 2013 at 12:14 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `compara`
--

-- --------------------------------------------------------

--
-- Table structure for table `entidades`
--

CREATE TABLE IF NOT EXISTS `entidades` (
  `id` int(10) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cct_count` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `entidades`
--

INSERT INTO `entidades` (`id`, `nombre`, `cct_count`) VALUES
(1, 'AGUASCALIENTES', 3003),
(2, 'BAJA CALIFORNIA', 5438),
(3, 'BAJA CALIFORNIA SUR', 1712),
(4, 'CAMPECHE', 2793),
(5, 'COAHUILA DE ZARAGOZA', 6971),
(6, 'COLIMA', 1844),
(7, 'CHIAPAS', 21919),
(8, 'CHIHUAHUA', 8894),
(9, 'DISTRITO FEDERAL', 16099),
(10, 'DURANGO', 7260),
(11, 'GUANAJUATO', 14146),
(12, 'GUERRERO', 13631),
(13, 'HIDALGO', 10283),
(14, 'JALISCO', 17548),
(15, 'MEXICO', 25759),
(16, 'MICHOACAN DE OCAMPO', 16800),
(17, 'MORELOS', 4331),
(18, 'NAYARIT', 4446),
(19, 'NUEVO LEON', 10142),
(20, 'OAXACA', 16763),
(21, 'PUEBLA', 17105),
(22, 'QUERETARO', 4951),
(23, 'QUINTANA ROO', 2915),
(24, 'SAN LUIS POTOSI', 10491),
(25, 'SINALOA', 8585),
(26, 'SONORA', 6488),
(27, 'TABASCO', 6853),
(28, 'TAMAULIPAS', 7702),
(29, 'TLAXCALA', 3093),
(30, 'VERACRUZ DE IGNACIO ', 27317),
(31, 'YUCATAN', 4970),
(32, 'ZACATECAS', 6626);
