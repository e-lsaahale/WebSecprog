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
  `Passwd` varchar(16) NOT NULL
) ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Name`, `Username`, `Email`, `Age`, `Passwd`) VALUES
(1, 'Elsa', 'elsa123', 'elsa@gmail.com', 20, 'elsa1234'),
(2, 'Bima', 'bima123', 'bima@gmail.com', 19, 'bima1234'),
(3, 'Fili', 'fili6969', 'fili69@gmail.com', 20, 'fili1234'),
(4, 'brykun', 'bryant', 'bryant69@gmail.com', 21, 'bryant1234');

ALTER TABLE users
MODIFY COLUMN Id INT  AUTO_INCREMENT, AUTO_INCREMENT = 5,
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

ALTER TABLE users
MODIFY COLUMN Passwd VARCHAR(16) NOT NULL,
ADD CONSTRAINT chk_passwd_length CHECK (LENGTH(Passwd) BETWEEN 8 AND 16);
