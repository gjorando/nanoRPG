-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2016 at 11:50 
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nanorpg`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'primary key',
  `pseudo` varchar(20) NOT NULL COMMENT 'Pseudo de l''utilisateur',
  `name` varchar(40) NOT NULL COMMENT 'Nom complet',
  `gender` varchar(30) NOT NULL COMMENT 'Genre de l''utilisateur',
  `bio` text COMMENT 'Courte description de l''utilisateur',
  `email` varchar(255) NOT NULL COMMENT 'email de l''utilisateur',
  `pswd` varchar(255) NOT NULL COMMENT 'hash du mot de passe',
  `birth` date NOT NULL COMMENT 'Date de naissance',
  `avatar` varchar(5) DEFAULT NULL COMMENT 'vaut null si pas d''avatar, l''extension sinon',
  `admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Administrateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Données utilisateur';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
