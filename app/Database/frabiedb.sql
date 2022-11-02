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
-- Database: `frabiedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comdfdt`
--

CREATE TABLE `comdfdt` (
  `dfdtId` int(11) NOT NULL,
  `compKey` int(11) NOT NULL,
  `dfdtday` varchar(255) NOT NULL,
  `dfdtperiod` int(11) NOT NULL,
  `dfdtfrom` varchar(255) NOT NULL,
  `dfdtto` varchar(255) NOT NULL,
  `dfdtduration` int(11) NOT NULL,
  `dfdtclosebefore` int(11) NOT NULL,
  `dfdtsmartview` int(11) NOT NULL,
  `isActive` int(11) NOT NULL,
  `bkngCont` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comdfdt`
--

INSERT INTO `comdfdt` (`dfdtId`, `compKey`, `dfdtday`, `dfdtperiod`, `dfdtfrom`, `dfdtto`, `dfdtduration`, `dfdtclosebefore`, `dfdtsmartview`, `isActive`, `bkngCont`) VALUES
(1, 1, 'Sunday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(2, 1, 'Sunday', 2, '16:00', '22:00', 60, 60, 1, 0, 1),
(3, 1, 'Monday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(7, 1, 'Monday', 2, '16:00', '21:00', 30, 60, 1, 1, 1),
(8, 1, 'Tuesday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(9, 1, 'Tuesday', 2, '14:00', '19:00', 30, 60, 1, 1, 1),
(10, 1, 'Wednesday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(11, 1, 'Wednesday', 2, '15:00', '23:00', 30, 60, 1, 1, 1),
(12, 1, 'Thursday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(13, 1, 'Thursday', 2, '15:00', '19:00', 20, 30, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `compacc`
--

CREATE TABLE `compacc` (
  `accId` int(11) NOT NULL,
  `compKey` int(11) NOT NULL,
  `compAccTypeKey` int(11) NOT NULL,
  `AccName` varchar(255) NOT NULL,
  `AccNumb` varchar(255) NOT NULL,
  `AccEmail` varchar(255) NOT NULL,
  `AccPassword` varchar(255) NOT NULL,
  `AccPrefLang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compacc`
--

INSERT INTO `compacc` (`accId`, `compKey`, `compAccTypeKey`, `AccName`, `AccNumb`, `AccEmail`, `AccPassword`, `AccPrefLang`) VALUES
(1, 1, 1, 'Faisal', '0541070070', 'ABCadmin@gmail.com', 'st7TRNZVFr.M6', 'English'),
(2, 1, 2, 'Ahmed', '054SSDDDFF', 'abc_reception@gmail.com', 'st7TRNZVFr.M6', 'English'),
(3, 1, 3, 'Khalid', '054WWEEERR', 'qwe_customer@gmail.com', 'st7TRNZVFr.M6', 'English'),
(9, 1, 3, 'Faris', '0504195381', 'asd@asd.com', 'st7TRNZVFr.M6', 'English'),
(11, 1, 3, 'Zxc', '0553455565', 'zxc@gmail.com', 'st7TRNZVFr.M6', 'English'),
(13, 1, 2, 'qwerqwe', '12341234', 'abc@gmail.com', 'st7TRNZVFr.M6', 'Arabic');

-- --------------------------------------------------------

--
-- Table structure for table `compacctype`
--

CREATE TABLE `compacctype` (
  `accTypeId` int(11) NOT NULL,
  `accType` varchar(255) NOT NULL,
  `accDesc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compacctype`
--

INSERT INTO `compacctype` (`accTypeId`, `accType`, `accDesc`) VALUES
(1, 'Admin', 'The admin account of an organization has full access to the organization control panel '),
(2, 'Reception', 'The Reception account can view the reservation made by the customers and make new ones  '),
(3, 'Customers ', 'The customers accounts can book an appointment, view all existing or upcoming appointments, and view a summary of the sent attachments ');

-- --------------------------------------------------------

--
-- Table structure for table `compad`
--

CREATE TABLE `compad` (
  `adId` int(11) NOT NULL,
  `compKey` int(11) NOT NULL,
  `adPhotoName` varchar(255) NOT NULL,
  `adUrl` varchar(255) NOT NULL,
  `adApproved` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compad`
--

INSERT INTO `compad` (`adId`, `compKey`, `adPhotoName`, `adUrl`, `adApproved`) VALUES
(6, 1, 'ourCustomers-bg.jpg', 'www.www.ca', 0),
(7, 1, 'slider10.jpg', 'ad 2 url ', 0),
(8, 1, 'slider10_1.jpg', 'DentalAd.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `compages`
--

CREATE TABLE `compages` (
  `pageId` int(11) NOT NULL,
  `compKey` int(11) NOT NULL,
  `pageName` varchar(255) NOT NULL,
  `pagePhoto` varchar(255) NOT NULL,
  `pageTxt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compages`
--

INSERT INTO `compages` (`pageId`, `compKey`, `pageName`, `pagePhoto`, `pageTxt`) VALUES
(3, 1, 'zxcvzxcv1', 'slider3.jpg', 'zxcvzxcv zxcvzxcv zxcvzxcv zxcvzxcv zxcvzxcv zxcvzxcv zxcvzxcv '),
(5, 1, 'asdfsadfas2', 'about-bg2.jpg', 'asdfsadfasdfsadf asdfsadfasdfsadfasdfsadfasdfsadf asdfsadfasdfsadfasdfsadfasdfsadfasdfsadf'),
(6, 1, 'qwer3', 'slider1.jpg', 'qwer qwer qwerqwer qwer qwer qwer qwer qwerqwer qwer qwer qwer qwer qwerqwer qwer qwer qwer qwer qwer'),
(7, 1, 'page4', 'appointment-image.jpg', 'page4page4page4page4 page4page4page4page4page4 page4page4page4page4 page4page4page4page4 page4page4page4');

-- --------------------------------------------------------

--
-- Table structure for table `compattachment`
--

CREATE TABLE `compattachment` (
  `attchId` int(11) NOT NULL,
  `compKey` int(11) NOT NULL,
  `compCustResKey` int(11) NOT NULL,
  `attchName` varchar(255) NOT NULL,
  `attchSize` int(11) NOT NULL,
  `attchSntStat` int(11) NOT NULL,
  `attchSmary` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compattachment`
--

INSERT INTO `compattachment` (`attchId`, `compKey`, `compCustResKey`, `attchName`, `attchSize`, `attchSntStat`, `attchSmary`) VALUES
(1, 1, 9, 'xray.pdf ', 715, 1, 'The sent report is an x-ray of the right hand due to his complaints ');

-- --------------------------------------------------------

--
-- Table structure for table `compbranch`
--

CREATE TABLE `compbranch` (
  `branchID` int(11) NOT NULL,
  `compKey` int(11) NOT NULL,
  `BranchName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compbranch`
--

INSERT INTO `compbranch` (`branchID`, `compKey`, `BranchName`) VALUES
(1, 1, 'Dhahran '),
(3, 1, 'Riyadh'),
(4, 1, 'Dammam'),
(5, 1, 'Jeddah');

-- --------------------------------------------------------

--
-- Table structure for table `compcustres`
--

CREATE TABLE `compcustres` (
  `custResID` int(11) NOT NULL,
  `compKey` int(11) NOT NULL,
  `compAccKey` int(11) NOT NULL,
  `vstrNam` varchar(120) NOT NULL,
  `compSrvKey` int(11) NOT NULL,
  `custResDt` datetime NOT NULL,
  `custResAttended` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compcustres`
--

INSERT INTO `compcustres` (`custResID`, `compKey`, `compAccKey`, `vstrNam`, `compSrvKey`, `custResDt`, `custResAttended`) VALUES
(1, 1, 3, 'Khalid', 22, '2022-02-17 08:00:00', 0),
(2, 1, 9, 'Ahmd', 25, '2022-02-10 18:00:00', 0),
(3, 1, 9, 'Ali', 34, '2022-03-07 19:00:00', 0),
(4, 1, 3, 'Mhmed', 22, '2022-02-14 01:30:00', 0),
(5, 1, 9, 'Faris', 34, '2022-03-09 00:00:00', 0),
(6, 1, 9, 'Faisal', 34, '2022-03-09 03:00:00', 0),
(7, 1, 9, 'Faaiissaall', 34, '2022-03-05 09:00:00', 0),
(8, 1, 9, 'Alnaseef', 34, '2022-03-16 10:30:00', 1),
(9, 1, 9, 'Saqeer ', 34, '2022-03-14 12:00:00', 0),
(25, 1, 9, 'Salman', 34, '2022-03-21 10:30:00', 1),
(33, 1, 9, 'Faris', 34, '2022-03-27 11:00:00', 0),
(34, 1, 9, 'Faris', 22, '2022-03-27 08:30:00', 0),
(35, 1, 9, 'Faris', 34, '2022-03-27 10:30:00', 0),
(36, 1, 1, 'Faisal', 25, '2022-05-18 09:00:00', 0),
(37, 1, 1, 'Faisal', 25, '2022-06-02 07:30:00', 0),
(38, 1, 1, 'Faisal', 25, '2022-06-02 16:30:00', 0),
(39, 1, 1, 'Faisal', 25, '2022-06-01 18:30:00', 0),
(40, 1, 1, 'Faisal', 34, '2022-06-16 18:30:00', 0),
(41, 1, 9, 'Faris', 25, '2022-06-02 10:30:00', 0),
(42, 1, 9, 'Ahmed', 25, '2022-06-06 07:30:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `compdep`
--

CREATE TABLE `compdep` (
  `DepID` int(11) NOT NULL,
  `compKey` int(11) NOT NULL,
  `DepName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compdep`
--

INSERT INTO `compdep` (`DepID`, `compKey`, `DepName`) VALUES
(1, 1, 'Dental'),
(2, 1, 'General2'),
(4, 1, 'Ears'),
(6, 1, 'XRay'),
(7, 1, 'Skin ');

-- --------------------------------------------------------

--
-- Table structure for table `compmsgs`
--

CREATE TABLE `compmsgs` (
  `msgId` int(11) NOT NULL,
  `compKey` int(11) NOT NULL,
  `msgBalance` int(11) NOT NULL,
  `msgChrgDt` datetime NOT NULL,
  `msgLstUsdDt` datetime NOT NULL,
  `msgSmry` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compmsgs`
--

INSERT INTO `compmsgs` (`msgId`, `compKey`, `msgBalance`, `msgChrgDt`, `msgLstUsdDt`, `msgSmry`) VALUES
(1, 1, 500, '2021-12-28 04:08:45', '2021-12-28 04:08:45', 'Ad. sent to existing patients who visited with-in a year ');

-- --------------------------------------------------------

--
-- Table structure for table `compservice`
--

CREATE TABLE `compservice` (
  `srvId` int(11) NOT NULL,
  `compKey` int(11) NOT NULL,
  `cmpSrvBrnch` int(11) NOT NULL,
  `depKey` int(11) NOT NULL,
  `srvName` varchar(255) NOT NULL,
  `srvPrice` int(11) NOT NULL,
  `srvPyUrl` varchar(255) NOT NULL,
  `srvBio` text NOT NULL,
  `srvAviStatus` int(11) NOT NULL,
  `srvLstResDt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compservice`
--

INSERT INTO `compservice` (`srvId`, `compKey`, `cmpSrvBrnch`, `depKey`, `srvName`, `srvPrice`, `srvPyUrl`, `srvBio`, `srvAviStatus`, `srvLstResDt`) VALUES
(22, 1, 3, 1, 'Abcde', 132, 'www.pay.com', 'Ser Bio ex', 1, '2022-06-08 00:00:00'),
(25, 1, 4, 1, 'Amer', 500, 'www.paymentNow.com', 'Service Bio Back													', 1, '2022-06-12 00:00:00'),
(34, 1, 3, 6, 'qwewer', 50, 'hjgjhgkjh', 'mnbmnb																																																																																													', 0, '2022-06-26 00:00:00'),
(36, 1, 1, 1, 'fgh', 700, 'www.ghjdghjd.com', 'adsfgsdhrtyjvbnmv										', 1, '2022-06-22 00:00:00'),
(38, 1, 3, 2, 'fgh', 900, 'wertwer', 'wertwert												', 1, '2022-06-13 00:00:00'),
(54, 1, 3, 2, 'sdfgsdf', 34563, 'sdfgsdf', 'sdfgsdfg																									', 1, '2022-06-13 00:00:00'),
(55, 1, 4, 6, 'yryu', 456, 'cvbncvbn', 'cvbncvbn										', 1, '2022-06-27 00:00:00'),
(56, 1, 5, 1, 'fgh', 700, 'www.ghjdghjd.com', 'adsfgsdhrtyjvbnmv																							', 1, '2022-06-22 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `compsrvdt`
--

CREATE TABLE `compsrvdt` (
  `SrvDtId` int(11) NOT NULL,
  `compKey` int(11) NOT NULL,
  `compSrvKey` int(11) NOT NULL,
  `srvDtDay` varchar(255) NOT NULL,
  `srvDtPeriod` int(11) NOT NULL,
  `srvDtFrom` varchar(255) NOT NULL,
  `srvDtTo` varchar(255) NOT NULL,
  `srvDtDur` int(11) NOT NULL,
  `srvDtCloseBf` int(11) NOT NULL,
  `srvDtSmartView` int(11) NOT NULL,
  `srvDtIsActive` int(11) NOT NULL,
  `srvBokCnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `compsrvdt`
--

INSERT INTO `compsrvdt` (`SrvDtId`, `compKey`, `compSrvKey`, `srvDtDay`, `srvDtPeriod`, `srvDtFrom`, `srvDtTo`, `srvDtDur`, `srvDtCloseBf`, `srvDtSmartView`, `srvDtIsActive`, `srvBokCnt`) VALUES
(15, 1, 22, 'Sunday', 1, '8:00', '12:00', 30, 60, 1, 1, 1),
(16, 1, 22, 'Sunday', 2, '16:00', '20:00', 60, 60, 1, 0, 1),
(17, 1, 22, 'Monday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(18, 1, 22, 'Monday', 2, '16:00', '23:00', 30, 60, 1, 1, 1),
(19, 1, 22, 'Tuesday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(20, 1, 22, 'Tuesday', 2, '16:00', '23:00', 30, 60, 1, 1, 1),
(21, 1, 22, 'Wednesday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(22, 1, 22, 'Wednesday', 2, '15:00', '21:00', 30, 60, 1, 1, 1),
(23, 1, 22, 'Thursday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(24, 1, 22, 'Thursday', 2, '16:00', '20:00', 30, 30, 1, 1, 1),
(45, 1, 25, 'Sunday', 1, '9:00', '12:00', 30, 60, 1, 1, 1),
(46, 1, 25, 'Sunday', 2, '16:00', '20:00', 60, 60, 1, 0, 1),
(47, 1, 25, 'Monday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(48, 1, 25, 'Monday', 2, '17:00', '21:00', 30, 60, 1, 1, 1),
(49, 1, 25, 'Tuesday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(50, 1, 25, 'Tuesday', 2, '16:00', '23:00', 30, 60, 1, 1, 1),
(51, 1, 25, 'Wednesday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(52, 1, 25, 'Wednesday', 2, '18:00', '20:00', 30, 60, 1, 1, 1),
(53, 1, 25, 'Thursday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(54, 1, 25, 'Thursday', 2, '16:00', '18:00', 30, 30, 1, 1, 1),
(55, 1, 34, 'Sunday', 1, '10:00', '13:00', 30, 60, 1, 1, 1),
(56, 1, 34, 'Sunday', 2, '16:00', '22:00', 60, 60, 1, 0, 1),
(57, 1, 34, 'Monday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(58, 1, 34, 'Monday', 2, '15:00', '20:00', 30, 60, 1, 1, 1),
(59, 1, 34, 'Tuesday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(60, 1, 34, 'Tuesday', 2, '16:00', '20:00', 30, 60, 1, 1, 1),
(61, 1, 34, 'Wednesday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(62, 1, 34, 'Wednesday', 2, '16:00', '23:00', 30, 60, 1, 1, 1),
(63, 1, 34, 'Thursday', 1, '7:00', '12:00', 30, 60, 1, 1, 1),
(64, 1, 34, 'Thursday', 2, '16:00', '20:00', 30, 30, 1, 1, 1),
(65, 1, 54, 'Sunday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(66, 1, 54, 'Sunday', 2, '16:00', '22:00', 60, 60, 1, 0, 0),
(67, 1, 54, 'Monday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(68, 1, 54, 'Monday', 2, '16:00', '21:00', 30, 60, 1, 1, 0),
(69, 1, 54, 'Tuesday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(70, 1, 54, 'Tuesday', 2, '14:00', '19:00', 30, 60, 1, 1, 0),
(71, 1, 54, 'Wednesday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(72, 1, 54, 'Wednesday', 2, '15:00', '23:00', 30, 60, 1, 1, 0),
(73, 1, 54, 'Thursday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(74, 1, 54, 'Thursday', 2, '15:00', '19:00', 30, 30, 1, 1, 0),
(75, 1, 55, 'Sunday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(76, 1, 55, 'Sunday', 2, '16:00', '22:00', 60, 60, 1, 0, 0),
(77, 1, 55, 'Monday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(78, 1, 55, 'Monday', 2, '16:00', '21:00', 30, 60, 1, 1, 0),
(79, 1, 55, 'Tuesday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(80, 1, 55, 'Tuesday', 2, '14:00', '19:00', 30, 60, 1, 1, 0),
(81, 1, 55, 'Wednesday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(82, 1, 55, 'Wednesday', 2, '15:00', '23:00', 30, 60, 1, 1, 0),
(83, 1, 55, 'Thursday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(84, 1, 55, 'Thursday', 2, '15:00', '19:00', 30, 30, 1, 1, 0),
(85, 1, 56, 'Sunday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(86, 1, 56, 'Sunday', 2, '16:00', '22:00', 60, 60, 1, 0, 0),
(87, 1, 56, 'Monday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(88, 1, 56, 'Monday', 2, '16:00', '21:00', 30, 60, 1, 1, 0),
(89, 1, 56, 'Tuesday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(90, 1, 56, 'Tuesday', 2, '14:00', '19:00', 30, 60, 1, 1, 0),
(91, 1, 56, 'Wednesday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(92, 1, 56, 'Wednesday', 2, '15:00', '23:00', 30, 60, 1, 1, 0),
(93, 1, 56, 'Thursday', 1, '7:00', '12:00', 30, 60, 1, 1, 0),
(94, 1, 56, 'Thursday', 2, '15:00', '19:00', 60, 30, 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comdfdt`
--
ALTER TABLE `comdfdt`
  ADD PRIMARY KEY (`dfdtId`);

--
-- Indexes for table `compacc`
--
ALTER TABLE `compacc`
  ADD PRIMARY KEY (`accId`);

--
-- Indexes for table `compacctype`
--
ALTER TABLE `compacctype`
  ADD PRIMARY KEY (`accTypeId`);

--
-- Indexes for table `compad`
--
ALTER TABLE `compad`
  ADD PRIMARY KEY (`adId`);

--
-- Indexes for table `compages`
--
ALTER TABLE `compages`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `compattachment`
--
ALTER TABLE `compattachment`
  ADD PRIMARY KEY (`attchId`);

--
-- Indexes for table `compbranch`
--
ALTER TABLE `compbranch`
  ADD PRIMARY KEY (`branchID`);

--
-- Indexes for table `compcustres`
--
ALTER TABLE `compcustres`
  ADD PRIMARY KEY (`custResID`);

--
-- Indexes for table `compdep`
--
ALTER TABLE `compdep`
  ADD PRIMARY KEY (`DepID`);

--
-- Indexes for table `compmsgs`
--
ALTER TABLE `compmsgs`
  ADD PRIMARY KEY (`msgId`);

--
-- Indexes for table `compservice`
--
ALTER TABLE `compservice`
  ADD PRIMARY KEY (`srvId`);

--
-- Indexes for table `compsrvdt`
--
ALTER TABLE `compsrvdt`
  ADD PRIMARY KEY (`SrvDtId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comdfdt`
--
ALTER TABLE `comdfdt`
  MODIFY `dfdtId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `compacc`
--
ALTER TABLE `compacc`
  MODIFY `accId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `compacctype`
--
ALTER TABLE `compacctype`
  MODIFY `accTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `compad`
--
ALTER TABLE `compad`
  MODIFY `adId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `compages`
--
ALTER TABLE `compages`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `compattachment`
--
ALTER TABLE `compattachment`
  MODIFY `attchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `compbranch`
--
ALTER TABLE `compbranch`
  MODIFY `branchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `compcustres`
--
ALTER TABLE `compcustres`
  MODIFY `custResID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `compdep`
--
ALTER TABLE `compdep`
  MODIFY `DepID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `compmsgs`
--
ALTER TABLE `compmsgs`
  MODIFY `msgId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `compservice`
--
ALTER TABLE `compservice`
  MODIFY `srvId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `compsrvdt`
--
ALTER TABLE `compsrvdt`
  MODIFY `SrvDtId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
