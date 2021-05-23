-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2021 at 09:38 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(6) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `Username`, `Password`, `FirstName`, `LastName`, `RegDate`) VALUES
(1, 'admin', '$2y$10$dCTYaDqcZWSMbWqndxEcyuUT9a9Qp/zi0FUIh7tBprg863DdS3iTS', 'Tris', 'Macharia', '2021-05-10 14:16:55');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `ID` int(50) UNSIGNED NOT NULL,
  `RegNo` varchar(50) NOT NULL,
  `SerialNo` varchar(255) NOT NULL,
  `Model` varchar(255) NOT NULL,
  `Status` int(1) NOT NULL,
  `DATETIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`ID`, `RegNo`, `SerialNo`, `Model`, `Status`, `DATETIME`) VALUES
(1, 'SCT221-0206/2016', '12DF5677', 'HP', 0, '2021-05-16 12:30:07'),
(2, 'SCT221-0207/2016', 'FR5654TY', 'DELL', 0, '2021-05-20 21:39:06'),
(3, 'SCT221-0264/2016', 'SCT78912LF', 'DELL', 1, '2021-05-20 21:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `security`
--

CREATE TABLE `security` (
  `ID` int(6) NOT NULL,
  `IDNo` int(8) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `security`
--

INSERT INTO `security` (`ID`, `IDNo`, `Password`, `FirstName`, `LastName`, `RegDate`) VALUES
(1, 12345678, '$2y$10$QLlyiH8WPWaPF4lenYMLnu6S0hmwSGsIn.RtCE2fWIz2NZW0z47wq', 'JANE', 'DOE', '2021-05-16 10:46:54');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `ID` int(50) UNSIGNED NOT NULL,
  `RegNo` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `IDNo` int(8) NOT NULL,
  `Faculty` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `DATETIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `RegNo`, `FirstName`, `LastName`, `IDNo`, `Faculty`, `Password`, `DATETIME`) VALUES
(1, 'SCT221-0206/2016', 'TEST', 'TEST', 12345678, 'FSET', '$2y$10$zI4kq7xbz/XMf/h9iK9i4O8ySCHJFOueb/6ExVfi.K6euqQ1Xl1RG', '2021-05-20 20:32:09'),
(2, 'SCT221-0207/2016', 'JOHN', 'DOE', 98765456, 'FSET', '$2y$10$hPgLCUYWqWsvjHiaoJ2W7uFIggsxedStDM1VoAxG5azN3zF9tym8C', '2021-05-20 20:33:15'),
(3, 'SCT221-0264/2016', 'JANE', 'DOE', 34124567, 'FSET', '$2y$10$KMMvQZlPZHPqLzgRmlugR.wxhAM9v0xy7CiN2G..nZbfgYKDwN/fe', '2021-05-20 20:35:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `SerialNo` (`SerialNo`);

--
-- Indexes for table `security`
--
ALTER TABLE `security`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`IDNo`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RegNo` (`RegNo`),
  ADD UNIQUE KEY `IDNo` (`IDNo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `ID` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `security`
--
ALTER TABLE `security`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
