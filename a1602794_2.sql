-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26.10.2017 klo 21:54
-- Palvelimen versio: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a1602794`
--
CREATE DATABASE IF NOT EXISTS `a1602794` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `a1602794`;

-- --------------------------------------------------------

--
-- Rakenne taululle `albumit`
--

CREATE TABLE `albumit` (
  `id` smallint(6) NOT NULL,
  `yhtye` varchar(255) NOT NULL,
  `nimi` varchar(255) NOT NULL,
  `julkaisuvuosi` smallint(6) NOT NULL,
  `levyYhtio` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `lisatietoja` varchar(510) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vedos taulusta `albumit`
--

INSERT INTO `albumit` (`id`, `yhtye`, `nimi`, `julkaisuvuosi`, `levyYhtio`, `url`, `lisatietoja`) VALUES
(1, 'Amorphis', 'Eclipse', 2006, 'Nuclear Blast', 'https://g.co/kgs/tBmifs', 'Ensimmäinen levy, missä Tomi Joutsen toimi solistina.'),
(2, 'Arch Enemy', 'Will to Power', 2017, 'Trooper Entertainment', 'https://g.co/kgs/1dSsc1', NULL),
(5, 'Trivium', 'The Sin And The Sentence', 2017, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albumit`
--
ALTER TABLE `albumit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albumit`
--
ALTER TABLE `albumit`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
