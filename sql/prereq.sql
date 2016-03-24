-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2016 at 08:59 AM
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
-- Table structure for table `prereq`
--

CREATE TABLE `prereq` (
  `courseid` varchar(7) NOT NULL,
  `prereqid` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prereq`
--

INSERT INTO `prereq` (`courseid`, `prereqid`) VALUES
('CS225', 'CS220'),
('CS250', 'CS225'),
('CS330', 'CS225'),
('CS340', 'CS225'),
('CS340', 'CS330'),
('CS350', 'CS220'),
('CS350', 'MATH151'),
('CS350', 'MATH161'),
('CS363', 'CS225'),
('CS390', 'CS220'),
('CS400', 'CS380'),
('CS420', 'CS330'),
('CS425', 'CS420'),
('CS430', 'CS225'),
('CS435', 'CS330'),
('CS435', 'CS390'),
('CS445', 'CS225'),
('CS455', 'CS220'),
('CS455', 'MATH161'),
('CS470', 'CS380'),
('CS470', 'CS390'),
('CS480', 'CS470'),
('MATH150', 'MATH110'),
('MATH151', 'MATH110'),
('MATH161', 'MATH150'),
('MATH162', 'MATH161');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prereq`
--
ALTER TABLE `prereq`
  ADD PRIMARY KEY (`courseid`,`prereqid`),
  ADD KEY `prereqid` (`prereqid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prereq`
--
ALTER TABLE `prereq`
  ADD CONSTRAINT `prereq_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `courses` (`ciscourseid`),
  ADD CONSTRAINT `prereq_ibfk_2` FOREIGN KEY (`prereqid`) REFERENCES `courses` (`ciscourseid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
