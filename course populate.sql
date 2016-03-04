-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2016 at 08:56 AM
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
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `courseid` varchar(7) NOT NULL COMMENT ' Primary key for the table. Unique to each class',
  `classname` varchar(50) NOT NULL COMMENT ' Name of the class',
  `units` int(1) NOT NULL COMMENT ' Number of units for this class',
  `term` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `classname`, `units`, `term`) VALUES
('CS220', 'Intro to CS I', 4, '111'),
('CS225', 'Intro to CS II', 4, '111'),
('CS250', 'Operating Systems', 3, '011'),
('CS330', 'Systems Programming', 3, '101'),
('CS340', 'Systems Programming II', 3, '011'),
('CS350', 'Discrete Structures', 3, '111'),
('CS363', 'Web Programming', 3, '011'),
('CS380', 'Data Structures', 3, '011'),
('CS390', 'Database Mgt Systems', 3, '111'),
('CS400', 'Compiler Construction', 3, '101'),
('CS420', 'Telecommunications', 3, '011'),
('CS425', 'Fundamentals of Network Administration', 3, '101'),
('CS430', 'Artificial Intelligence', 3, '101'),
('CS435', 'Advanced Database', 3, '011'),
('CS445', 'Compilers, Architecture, & Organization', 4, '101'),
('CS455', 'Numerical Analysis', 3, '011'),
('CS470', 'Software Engineering I', 3, '101'),
('CS480', 'Software Engineering II', 3, '011'),
('CS495', 'Topics', 1, '111'),
('CS496', 'Senior Seminar: Ethics in Computer Science', 3, '101');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
 ADD PRIMARY KEY (`courseid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
