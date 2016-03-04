-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2016 at 10:42 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `advising helper`
--

-- --------------------------------------------------------

--
-- Table structure for table `cisstudentcourse`
--

CREATE TABLE IF NOT EXISTS `cisstudentcourse` (
  `cisstudentid` varchar(9) NOT NULL COMMENT ' unique identifier for each registered student, Primary Key',
  `cscourseid` varchar(7) NOT NULL COMMENT ' unique identifier for each registered professor, Primary Key',
  `grade` varchar(2) NOT NULL COMMENT ' GRADE B+, B, B-',
  `termtkn` int(5) NOT NULL COMMENT ' Which term the class was taken 20157 (2015 = YEAR, 7 = TERM) Terms: 1=SPRING 3=SUMMER_A 7=FALL   if 00000, then it is a transfer credit',
  `status` char(1) NOT NULL,
  `id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cisstudentcourse`
--
ALTER TABLE `cisstudentcourse`
 ADD PRIMARY KEY (`cisstudentid`,`cscourseid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
