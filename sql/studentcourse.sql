-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2016 at 01:13 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

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
-- Table structure for table `studentcourse`
--

CREATE TABLE `studentcourse` (
  `studentid` varchar(9) NOT NULL COMMENT 'Unique identifier for each registered professor, Primary Key',
  `courseid` varchar(7) NOT NULL COMMENT 'unique identifier part of a composite primary key',
  `grade` varchar(2) NOT NULL COMMENT 'the grade received by the student',
  `termtaken` varchar(5) NOT NULL COMMENT 'Which term the class was taken',
  `status` char(1) NOT NULL COMMENT 'character that describes the status of the class in relation to the student.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentcourse`
--

INSERT INTO `studentcourse` (`studentid`, `courseid`, `grade`, `termtaken`, `status`) VALUES
('002406078', 'CS220', 'A-', '20127', 'C'),
('002406078', 'CS225', 'B', '20131', 'C'),
('002406078', 'MATH162', 'B+', '20131', 'C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `studentcourse`
--
ALTER TABLE `studentcourse`
  ADD PRIMARY KEY (`studentid`,`courseid`),
  ADD KEY `courseid` (`courseid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `studentcourse`
--
ALTER TABLE `studentcourse`
  ADD CONSTRAINT `studentcourse_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`),
  ADD CONSTRAINT `studentcourse_ibfk_2` FOREIGN KEY (`courseid`) REFERENCES `courses` (`ciscourseid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
