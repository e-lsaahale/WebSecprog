-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 07:57 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bcc`
--
CREATE DATABASE IF NOT EXISTS `bcc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bcc`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Username` varchar(16) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `Passwd` varchar(255) NOT NULL,
  `Bio` varchar(30)
);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Name`, `Username`, `Email`, `Age`, `Passwd`, `Bio`) VALUES
(1, 'ini dummy', 'dummy1', 'dummy1@gmail.com', 21, '$2y$10$CTuirp7RY/5iGGddeZ22Qep3LZF5YGunfpNNNwpYt2ZCUnd2joHuO', 'haha'),
(2, 'dummy666', 'dummy666', 'dummy666@gmail.com', 66, '$2y$10$1ter2FOeFP3RlJ5XK00pFuC56swh6QW8Oeam/90n6s1O0VEOKmJ5e', NULL);
-- (1, 'Elsa', 'elsa123', 'elsa@gmail.com', 20, 'elsa1234'),
-- (2, 'Bima', 'bima123', 'bima@gmail.com', 19, 'bima1234'),
-- (3, 'Fili', 'fili6969', 'fili69@gmail.com', 20, 'fili1234'),
-- (4, 'brykun', 'bryant', 'bryant69@gmail.com', 21, 'bryant1234');

ALTER TABLE users
MODIFY COLUMN Id INT  AUTO_INCREMENT, AUTO_INCREMENT = 3,
ADD PRIMARY KEY(Id);

ALTER TABLE users
MODIFY COLUMN Name VARCHAR(25) NOT NULL,
ADD CONSTRAINT chk_name_length CHECK (LENGTH(Name) BETWEEN 4 AND 25);

ALTER TABLE users
MODIFY COLUMN Username VARCHAR(16) NOT NULL,
ADD CONSTRAINT chk_username_length CHECK (LENGTH(Username) BETWEEN 6 AND 16),
ADD CONSTRAINT chk_username_format CHECK (Username REGEXP '^[a-zA-Z0-9]+$'),
ADD CONSTRAINT chk_username_unique UNIQUE (Username);

ALTER TABLE users
MODIFY COLUMN Email VARCHAR(255) NOT NULL,
ADD CONSTRAINT chk_email_format CHECK (Email REGEXP '^[A-Za-z0-9._%-+!#$&/=?^|~]+@[A-Za-z0-9.-]+[.][A-Za-z]+$'),
ADD CONSTRAINT chk_email_unique UNIQUE (Email);

ALTER TABLE users
MODIFY COLUMN Age INT NOT NULL,
ADD CONSTRAINT chk_age_range CHECK (Age BETWEEN 17 AND 99);


--
-- Dumping data for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL
  
);

INSERT INTO `post` (`post_id`, `message`, `user_id`) VALUES
(1, 'dummy tes 111', 1),
(2, 'dummy666 - Dummy666', 1);

create table info(
	`id` int(11) NOT NULL,
  `attempt` int(11),
  `sess` varchar(255),
  `times` TIMESTAMP DEFAULT '2012-12-12 12:12:12' ON UPDATE CURRENT_TIMESTAMP,
  `stat` boolean,
  FOREIGN KEY (`id`) REFERENCES `users` (`Id`)
);

ALTER TABLE info
MODIFY COLUMN times TIMESTAMP DEFAULT '2012-12-12 12:12:12';

INSERT INTO `info` (`id`, `attempt`, `sess`, `times`, `stat`) VALUES
(1, 0, '36fa2b9b02e7825f7c5265d6831b40ab16ac3a6b9e11a5064520e7ba4974aa0e', '2012-12-12 12:12:12', 1);
    

