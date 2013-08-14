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
-- Table structure for table `reportes_ciudadano_likes`
--


CREATE TABLE IF NOT EXISTS `reportes_ciudadano_likes` (
  `id` int(10) NOT NULL auto_increment,
  `ip` varchar(20) collate utf8_unicode_ci NOT NULL,
  `user_agent` varchar(200) collate utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `denuncia` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
