-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2023 at 05:21 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `funnimedia`
--
CREATE DATABASE IF NOT EXISTS `funnimedia` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `funnimedia`;

-- --------------------------------------------------------

--
-- Table structure for table `auth-challenge`
--

DROP TABLE IF EXISTS `auth-challenge`;
CREATE TABLE IF NOT EXISTS `auth-challenge` (
  `idUser` int(11) NOT NULL,
  `challenge` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `registerDate` date NOT NULL,
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth-challenge`
--

INSERT INTO `auth-challenge` (`idUser`, `challenge`, `registerDate`) VALUES
(8, '83997b10983b144a44563d424e7cf8e2', '2023-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `auth-permissions`
--

DROP TABLE IF EXISTS `auth-permissions`;
CREATE TABLE IF NOT EXISTS `auth-permissions` (
  `idRole` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  KEY `idUser` (`idUser`),
  KEY `idRole` (`idRole`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth-permissions`
--

INSERT INTO `auth-permissions` (`idRole`, `idUser`) VALUES
(1, 1),
(2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `auth-roles`
--

DROP TABLE IF EXISTS `auth-roles`;
CREATE TABLE IF NOT EXISTS `auth-roles` (
  `idRole` int(11) NOT NULL,
  `roleName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth-roles`
--

INSERT INTO `auth-roles` (`idRole`, `roleName`) VALUES
(1, 'Admin'),
(2, 'Publisher'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `auth-user`
--

DROP TABLE IF EXISTS `auth-user`;
CREATE TABLE IF NOT EXISTS `auth-user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth-user`
--

INSERT INTO `auth-user` (`idUser`, `username`, `email`, `password`, `active`) VALUES
(1, 'admin', 'smi.grupo1.2023@gmail.com', 'admin', 1),
(8, 'AAAAAA', 'fariafactor2@gmail.com', 'amongus123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `email-accounts`
--

DROP TABLE IF EXISTS `email-accounts`;
CREATE TABLE IF NOT EXISTS `email-accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accountName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `smtpServer` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `port` int(11) NOT NULL,
  `useSSL` tinyint(4) NOT NULL,
  `timeout` int(11) NOT NULL,
  `loginName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `displayName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email-accounts`
--

INSERT INTO `email-accounts` (`id`, `accountName`, `smtpServer`, `port`, `useSSL`, `timeout`, `loginName`, `password`, `email`, `displayName`) VALUES
(1, 'Gmail - SMIGrupo1', 'smtp.gmail.com', 465, 1, 30, 'smi.grupo1.2023@gmail.com', 'ihoueaxuzqqqphgm', 'smi.grupo1.2023@gmail.com', 'Sistemas Multimédia para a Internet Grupo 1');

-- --------------------------------------------------------

--
-- Table structure for table `media-category`
--

DROP TABLE IF EXISTS `media-category`;
CREATE TABLE IF NOT EXISTS `media-category` (
  `idCategory` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idCategory`),
  UNIQUE KEY `SECONDARY` (`categoryName`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media-category`
--

INSERT INTO `media-category` (`idCategory`, `categoryName`) VALUES
(1, 'Action'),
(3, 'Drama'),
(2, 'Fantasy');

-- --------------------------------------------------------

--
-- Table structure for table `media-comment`
--

DROP TABLE IF EXISTS `media-comment`;
CREATE TABLE IF NOT EXISTS `media-comment` (
  `idComment` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) NOT NULL,
  `idContent` int(11) NOT NULL,
  `comment` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idComment`),
  KEY `idUser` (`idUser`),
  KEY `idContent` (`idContent`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media-comment`
--

INSERT INTO `media-comment` (`idComment`, `idUser`, `idContent`, `comment`) VALUES
(9, 1, 18, 'so funny');

-- --------------------------------------------------------

--
-- Table structure for table `media-content`
--

DROP TABLE IF EXISTS `media-content`;
CREATE TABLE IF NOT EXISTS `media-content` (
  `idContent` int(11) NOT NULL AUTO_INCREMENT,
  `idSeries` int(11) DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  `displayName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `episodeNumber` int(11) NOT NULL,
  `private` tinyint(1) NOT NULL,
  `publishDate` date NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`idContent`),
  UNIQUE KEY `name` (`name`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media-content`
--

INSERT INTO `media-content` (`idContent`, `idSeries`, `idUser`, `displayName`, `name`, `episodeNumber`, `private`, `publishDate`, `views`) VALUES
(3, 2, 1, 'val2', 'val.mp4', 1, 0, '2023-06-05', 59),
(15, 2, 1, 'dsa', 'camera1.mov', 2, 0, '2023-06-07', 3),
(16, 2, 1, '765', 'minecraft.mp4', 3, 0, '2023-06-07', 2),
(17, 3, 1, '43', 'Minecraft Adventures #125.mp4', 1, 0, '2023-06-07', 1),
(18, 4, 1, '443', 'cat.mp4', 1, 0, '2023-06-07', 3),
(19, 5, 1, '42423', 'teste.mov', 1, 0, '2023-06-07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `media-content-categories`
--

DROP TABLE IF EXISTS `media-content-categories`;
CREATE TABLE IF NOT EXISTS `media-content-categories` (
  `idCategory` int(11) NOT NULL,
  `idContent` int(11) NOT NULL,
  KEY `media-content-categories_ibfk_1` (`idCategory`),
  KEY `media-content-categories_ibfk_2` (`idContent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media-content-categories`
--

INSERT INTO `media-content-categories` (`idCategory`, `idContent`) VALUES
(1, 3),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth-challenge`
--
ALTER TABLE `auth-challenge`
  ADD CONSTRAINT `auth-challenge_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `auth-user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth-permissions`
--
ALTER TABLE `auth-permissions`
  ADD CONSTRAINT `auth-permissions_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `auth-user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth-permissions_ibfk_2` FOREIGN KEY (`idRole`) REFERENCES `auth-roles` (`idRole`);

--
-- Constraints for table `media-comment`
--
ALTER TABLE `media-comment`
  ADD CONSTRAINT `media-comment_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `auth-user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `media-comment_ibfk_2` FOREIGN KEY (`idContent`) REFERENCES `media-content` (`idContent`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `media-content`
--
ALTER TABLE `media-content`
  ADD CONSTRAINT `media-content_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `auth-user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `media-content-categories`
--
ALTER TABLE `media-content-categories`
  ADD CONSTRAINT `media-content-categories_ibfk_1` FOREIGN KEY (`idCategory`) REFERENCES `media-category` (`idCategory`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `media-content-categories_ibfk_2` FOREIGN KEY (`idContent`) REFERENCES `media-content` (`idContent`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
