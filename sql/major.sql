-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2016 at 08:48 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aahelper`
--

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `majorid` varchar(4) NOT NULL,
  `courseid` varchar(7) NOT NULL,
  `required` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `major`
--

INSERT INTO `major` (`majorid`, `courseid`, `required`) VALUES
('CIS', 'ACCT120', 'REQUIRED'),
('CIS', 'BUSI210', 'REQUIRED'),
('CIS', 'CS220', 'REQUIRED'),
('CIS', 'CS225', 'REQUIRED'),
('CIS', 'CS250', 'REQUIRED'),
('CIS', 'CS330', 'REQUIRED'),
('CIS', 'CS340', 'ELECTIVE '),
('CIS', 'CS350', 'REQUIRED'),
('CIS', 'CS363', 'ELECTIVE'),
('CIS', 'CS380', 'REQUIRED'),
('CIS', 'CS390', 'REQUIRED'),
('CIS', 'CS400', 'ELECTIVE'),
('CIS', 'CS420', 'REQUIRED'),
('CIS', 'CS425', 'ELECTIVE'),
('CIS', 'CS430', 'ELECTIVE'),
('CIS', 'CS435', 'REQUIRED'),
('CIS', 'CS445', 'ELECTIVE'),
('CIS', 'CS470', 'REQUIRED'),
('CIS', 'CS480', 'REQUIRED'),
('CIS', 'CS495', 'REQUIRED'),
('CIS', 'CS496', 'REQUIRED'),
('CIS', 'MATH090', 'REQUIRED'),
('CIS', 'MATH095', 'REQUIRED'),
('CIS', 'MATH110', ' REQUIRED'),
('CIS', 'MATH151', 'REQUIRED'),
('CS', 'CS220', 'REQUIRED'),
('CS', 'CS225', 'REQUIRED'),
('CS', 'CS250', 'REQUIRED'),
('CS', 'CS330', 'REQUIRED'),
('CS', 'CS340', 'REQUIRED'),
('CS', 'CS350', 'REQUIRED'),
('CS', 'CS363', 'ELECTIVE '),
('CS', 'CS380', 'REQUIRED'),
('CS', 'CS390', 'REQUIRED'),
('CS', 'CS400', 'REQUIRED'),
('CS', 'CS420', 'ELECTIVE'),
('CS', 'CS425', 'ELECTIVE'),
('CS', 'CS430', ' ELECTIVE'),
('CS', 'CS435', 'ELECTIVE'),
('CS', 'CS445', 'REQUIRED'),
('CS', 'CS455', 'REQUIRED'),
('CS', 'CS470', 'REQUIRED'),
('CS', 'CS480', 'REQUIRED'),
('CS', 'CS495', 'REQUIRED'),
('CS', 'CS496', 'REQUIRED'),
('CS', 'MATH110', 'REQUIRED'),
('CS', 'MATH150', 'REQUIRED'),
('CS', 'MATH161', 'REQUIRED'),
('CS', 'MATH162', 'REQUIRED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`majorid`,`courseid`),
  ADD KEY `courseid` (`courseid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `major`
--
ALTER TABLE `major`
  ADD CONSTRAINT `major_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `courses` (`ciscourseid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
