-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2021 at 07:18 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `ds`
--

CREATE TABLE `ds` (
  `DS_code` int(10) UNSIGNED NOT NULL,
  `DS` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ds`
--

INSERT INTO `ds` (`DS_code`, `DS`) VALUES
(1, 'Kolonnawa'),
(2, 'Kaduwela'),
(3, 'Homagama'),
(4, 'Seethawaka'),
(5, 'Padukka'),
(6, 'Maharagama'),
(7, 'Sri'),
(8, 'Thimbirigasyaya'),
(9, 'Dehiwala'),
(10, 'Ratmalana'),
(11, 'Moratuwa'),
(12, 'Kesbewa'),
(13, 'Negombo'),
(14, 'Katana'),
(15, 'Divulapitiya'),
(16, 'Mirigama'),
(17, 'Minuwangoda'),
(18, 'Wattala'),
(19, 'Ja-Ela'),
(20, 'Gampaha'),
(21, 'Attanagalla'),
(22, 'Dompe'),
(23, 'Mahara'),
(24, 'Kelaniya'),
(25, 'Biyagama'),
(26, 'Panadura'),
(27, 'Bandaragama'),
(28, 'Horana'),
(29, 'Ingiriya'),
(30, 'Bulathsinhala'),
(31, 'Madurawala'),
(32, 'Millaniya'),
(33, 'Kalutara'),
(34, 'Beruwala'),
(35, 'Dodangoda'),
(36, 'Mathugama'),
(37, 'Agalawatta'),
(38, 'Palindanuwara'),
(39, 'Walallavita');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ds`
--
ALTER TABLE `ds`
  ADD PRIMARY KEY (`DS_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
