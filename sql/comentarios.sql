-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- Host: ***REMOVED***
-- Generation Time: May 21, 2013 at 06:07 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6-1+lenny10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `comparatuescuela`
--

-- --------------------------------------------------------

--
-- Table structure for table `calificaciones`
--

CREATE TABLE IF NOT EXISTS `calificaciones` (
  `id` int(10) NOT NULL auto_increment,
  `cct` varchar(10) collate utf8_unicode_ci NOT NULL,
  `email` varchar(100) collate utf8_unicode_ci NOT NULL,
  `nombre` varchar(200) collate utf8_unicode_ci NOT NULL,
  `ocupacion` varchar(200) collate utf8_unicode_ci NOT NULL,
  `comentario` text collate utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `user_agent` varchar(400) collate utf8_unicode_ci NOT NULL,
  `likes` int(11) NOT NULL default '0',
  `calificacion` int(3) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `calificaciones`
--


-- --------------------------------------------------------

--
-- Table structure for table `calificacion_likes`
--

CREATE TABLE IF NOT EXISTS `calificacion_likes` (
  `id` int(10) NOT NULL auto_increment,
  `calificacion` int(10) NOT NULL,
  `ip` varchar(20) collate utf8_unicode_ci NOT NULL,
  `user_agent` varchar(200) collate utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `calificacion_likes`
--

