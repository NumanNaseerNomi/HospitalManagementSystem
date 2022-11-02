-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2022 at 02:55 AM
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
-- Database: `ehzjdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `compgeninfo`
--

CREATE TABLE `compgeninfo` (
  `compId` int(11) NOT NULL,
  `compPublicName` varchar(255) NOT NULL,
  `compUrlShortName` varchar(255) NOT NULL,
  `compWhoRwe` text NOT NULL,
  `compWorkingHrs` text NOT NULL,
  `compLocation` text NOT NULL,
  `compPhoNumb` varchar(255) NOT NULL,
  `compWtzNumb` varchar(255) NOT NULL,
  `compEmail` varchar(255) NOT NULL,
  `compSocialAcc` text NOT NULL,
  `compLogo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compgeninfo`
--

INSERT INTO `compgeninfo` (`compId`, `compPublicName`, `compUrlShortName`, `compWhoRwe`, `compWorkingHrs`, `compLocation`, `compPhoNumb`, `compWtzNumb`, `compEmail`, `compSocialAcc`, `compLogo`) VALUES
(1, 'Frabi Hospital the Ltd', 'Frabi', 'Frabi Hospital Ltd. hrw11', '07:00AM - 04:00PM', 'Dhahran 1234', '0138731112', '0541070089', 'ABCDE@gmail.com.sa', 'FrabiTwitt1,FrabiInsta12,FrabiSnap1', 'logo_img.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compgeninfo`
--
ALTER TABLE `compgeninfo`
  ADD PRIMARY KEY (`compId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compgeninfo`
--
ALTER TABLE `compgeninfo`
  MODIFY `compId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
