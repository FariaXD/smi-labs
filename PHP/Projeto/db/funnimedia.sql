-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 07, 2023 at 05:34 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `auth-challenge`
--

CREATE TABLE `auth-challenge` (
  `idUser` int(11) NOT NULL,
  `challenge` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `registerDate` date NOT NULL
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

CREATE TABLE `auth-permissions` (
  `idRole` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
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

CREATE TABLE `auth-roles` (
  `idRole` int(11) NOT NULL,
  `roleName` varchar(128) COLLATE utf8_unicode_ci NOT NULL
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

CREATE TABLE `auth-user` (
  `idUser` int(11) NOT NULL,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `email-accounts` (
  `id` int(11) NOT NULL,
  `accountName` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `smtpServer` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `port` int(11) NOT NULL,
  `useSSL` tinyint(4) NOT NULL,
  `timeout` int(11) NOT NULL,
  `loginName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `displayName` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email-accounts`
--

INSERT INTO `email-accounts` (`id`, `accountName`, `smtpServer`, `port`, `useSSL`, `timeout`, `loginName`, `password`, `email`, `displayName`) VALUES
(1, 'Gmail - SMIGrupo1', 'smtp.gmail.com', 465, 1, 30, 'smi.grupo1.2023@gmail.com', 'ihoueaxuzqqqphgm', 'smi.grupo1.2023@gmail.com', 'Sistemas Multimédia para a Internet Grupo 1');

-- --------------------------------------------------------

--
-- Table structure for table `media-category`
--

CREATE TABLE `media-category` (
  `idCategory` int(11) NOT NULL,
  `categoryName` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `media-comment` (
  `idComment` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idContent` int(11) NOT NULL,
  `comment` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media-comment`
--

INSERT INTO `media-comment` (`idComment`, `idUser`, `idContent`, `comment`) VALUES
(9, 1, 18, 'so funny');

-- --------------------------------------------------------

--
-- Table structure for table `media-content`
--

CREATE TABLE `media-content` (
  `idContent` int(11) NOT NULL,
  `idSeries` int(11) DEFAULT NULL,
  `idUser` int(11) NOT NULL,
  `displayName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `episodeNumber` int(11) NOT NULL,
  `private` tinyint(1) NOT NULL,
  `publishDate` date NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media-content`
--

INSERT INTO `media-content` (`idContent`, `idSeries`, `idUser`, `displayName`, `name`, `episodeNumber`, `private`, `publishDate`, `views`) VALUES
(18, 4, 1, '443', 'cat.mp4', 1, 0, '2023-06-07', 3);

-- --------------------------------------------------------

--
-- Table structure for table `media-content-categories`
--

CREATE TABLE `media-content-categories` (
  `idCategory` int(11) NOT NULL,
  `idContent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media-content-categories`
--

INSERT INTO `media-content-categories` (`idCategory`, `idContent`) VALUES
(1, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth-challenge`
--
ALTER TABLE `auth-challenge`
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `auth-permissions`
--
ALTER TABLE `auth-permissions`
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idRole` (`idRole`);

--
-- Indexes for table `auth-roles`
--
ALTER TABLE `auth-roles`
  ADD PRIMARY KEY (`idRole`);

--
-- Indexes for table `auth-user`
--
ALTER TABLE `auth-user`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `email-accounts`
--
ALTER TABLE `email-accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media-category`
--
ALTER TABLE `media-category`
  ADD PRIMARY KEY (`idCategory`),
  ADD UNIQUE KEY `SECONDARY` (`categoryName`);

--
-- Indexes for table `media-comment`
--
ALTER TABLE `media-comment`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idContent` (`idContent`);

--
-- Indexes for table `media-content`
--
ALTER TABLE `media-content`
  ADD PRIMARY KEY (`idContent`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `idUser` (`idUser`);

--
-- Indexes for table `media-content-categories`
--
ALTER TABLE `media-content-categories`
  ADD KEY `media-content-categories_ibfk_1` (`idCategory`),
  ADD KEY `media-content-categories_ibfk_2` (`idContent`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth-user`
--
ALTER TABLE `auth-user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `email-accounts`
--
ALTER TABLE `email-accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `media-category`
--
ALTER TABLE `media-category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media-comment`
--
ALTER TABLE `media-comment`
  MODIFY `idComment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `media-content`
--
ALTER TABLE `media-content`
  MODIFY `idContent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
