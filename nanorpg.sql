-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2016 at 04:05 
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
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL COMMENT 'id du message',
  `id_sender` int(11) NOT NULL COMMENT 'id de l''expéditeur',
  `id_receiver` int(11) NOT NULL COMMENT 'id du destinataire',
  `msg_body` text NOT NULL COMMENT 'corps du message',
  `send_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'date d''envoi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL COMMENT 'primary key',
  `id_creator` int(11) NOT NULL COMMENT 'Id du créateur',
  `name` varchar(60) NOT NULL COMMENT 'Nom du jeu',
  `description` text NOT NULL COMMENT 'Courte description du jeu',
  `sensible` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Vrai si c''est un jeu incluant un contenu sensible (sexe, violence...)',
  `last_modified` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de dernière modification'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Informations sur un jeu';

-- --------------------------------------------------------

--
-- Table structure for table `game_delete`
--

CREATE TABLE `game_delete` (
  `id` int(11) NOT NULL COMMENT 'id de l''entrée',
  `id_game` int(11) NOT NULL COMMENT 'Id du jeu',
  `id_requester` int(11) NOT NULL COMMENT 'Id du demandeur de la suppression (souvent le créateur, mais pas toujours)',
  `reason` text NOT NULL COMMENT 'Raison de la suppression',
  `request_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date de la requête',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Vaut vrai quand la requête a été traitée',
  `decision` text COMMENT 'Décision de l''admin qui a traité la requête',
  `id_admin` int(11) DEFAULT NULL COMMENT 'Id du dernier admin à avoir traité la requête',
  `decision_date` datetime DEFAULT NULL COMMENT 'Date de la décision de l''admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `libraries`
--

CREATE TABLE `libraries` (
  `id` int(11) NOT NULL COMMENT 'id de l''entrée ',
  `id_user` int(11) NOT NULL COMMENT 'id du joueur correspondant',
  `id_game` int(11) NOT NULL COMMENT 'id du jeu correspondant',
  `last_played` datetime DEFAULT NULL COMMENT 'date de dernier accès'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sender` (`id_sender`,`id_receiver`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_creator` (`id_creator`);

--
-- Indexes for table `game_delete`
--
ALTER TABLE `game_delete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_game` (`id_game`),
  ADD KEY `id_requester` (`id_requester`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `libraries`
--
ALTER TABLE `libraries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`,`id_game`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id du message';
--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';
--
-- AUTO_INCREMENT for table `game_delete`
--
ALTER TABLE `game_delete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de l''entrée';
--
-- AUTO_INCREMENT for table `libraries`
--
ALTER TABLE `libraries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id de l''entrée ';
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
