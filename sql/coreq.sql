-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2016 at 09:41 AM
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
-- Table structure for table `coreq`
--

CREATE TABLE `coreq` (
  `courseid` varchar(7) NOT NULL,
  `coreqid` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coreq`
--

INSERT INTO `coreq` (`courseid`, `coreqid`) VALUES
('CS220', 'MATH110'),
('CS380', 'CS350'),
('CS390', 'CS350'),
('CS445', 'CS350');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coreq`
--
ALTER TABLE `coreq`
  ADD PRIMARY KEY (`courseid`,`coreqid`),
  ADD KEY `coreqid` (`coreqid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coreq`
--
ALTER TABLE `coreq`
  ADD CONSTRAINT `coreq_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`),
  ADD CONSTRAINT `coreq_ibfk_2` FOREIGN KEY (`coreqid`) REFERENCES `courses` (`courseid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
