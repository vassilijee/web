-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 10:36 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fakultet`
--
DROP DATABASE IF EXISTS `fakultet`;
CREATE DATABASE IF NOT EXISTS `fakultet` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `fakultet`;

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

DROP TABLE IF EXISTS `korisnici`;
CREATE TABLE `korisnici` (
  `idKorisnika` int(11) NOT NULL,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `privilegija` enum('Admin','Korisnik','Moderator','') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Korisnik',
  `sifra` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`idKorisnika`, `ime`, `prezime`, `email`, `privilegija`, `sifra`) VALUES
(1, 'admin', 'admin', 'admin@admin.rs', 'Admin', 'f865b53623b121fd34ee5426c792e5c33af8c227'),
(2, 'Pera', 'Peric', 'pera@pera.rs', 'Korisnik', '25d200040c97887072dfd59676cdf80808a20152');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `broj_indeksa` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sifra` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `slika` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`broj_indeksa`, `prezime`, `ime`, `status`, `sifra`, `slika`) VALUES
('\'113/2', '\" or \"\"1=1\"', 'Pera', 'B', '\" or \"1=1\"', ''),
('000/23', 'Dodic', 'Pera', 'B', 'IT21', 'satoshi.jpg'),
('001/23', 'Peric', 'Sava', 'B', 'BP21', 'jaoMing.jpg'),
('100/23', 'Dodic', 'Pera', 'B', 'IT21', 'satoshi.jpg'),
('121/21', 'Dodic', 'Sava', 'S', 'IT21', ''),
('122/21', 'Peric', 'Pera', 'S', 'BP21', ''),
('123/21', 'Vukumirovic', 'Pera', 'B', 'BP21', ''),
('124/21', 'Jokic', 'Nikola', 'B', 'BP21', ''),
('125/21', 'Ignjatov', '\" where 1=1\" ivana', 'S', 'BP21', ''),
('126/21', 'Ignjatov', '\' \" where 1=1\" ivana', 'S', 'BP21', ''),
('131/21', 'Ignjatov', 'Pera', 'B', 'IT21', ''),
('132/21', 'Ignjatov', 'Pera', 'B', 'IT21', 'satoshi.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`idKorisnika`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_2` (`email`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`broj_indeksa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `idKorisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
