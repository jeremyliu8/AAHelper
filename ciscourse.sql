-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2016 at 09:55 AM
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
-- Table structure for table `ciscourse`
--

CREATE TABLE IF NOT EXISTS `ciscourse` (
  `courseid` varchar(7) NOT NULL COMMENT ' Primary key for the table. Unique to each class',
  `classname` varchar(50) NOT NULL COMMENT ' Name of the class',
  `units` int(1) NOT NULL COMMENT ' Number of units for this class',
  `term` varchar(3) DEFAULT NULL,
  `required` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ciscourse`
--

INSERT INTO `ciscourse` (`courseid`, `classname`, `units`, `term`, `required`) VALUES
('ACCT120', 'Principles of Accounting I', 4, '111', 1),
('BUSI210', 'Principles of Organization & Management', 3, '111', 1),
('CS220', 'Intro to CS I', 4, '111', 1),
('CS225', 'Intro to CS II', 4, '111', 1),
('CS250', 'Operating Systems', 3, '011', 1),
('CS330', 'Systems Programming', 3, '101', 1),
('CS340', 'Systems Programming II', 3, '011', 0),
('CS350', 'Discrete Structures', 3, '111', 1),
('CS363', 'Web Programming', 3, '011', 0),
('CS380', 'Data Structures', 3, '011', 1),
('CS390', 'Database Mgt Systems', 3, '111', 1),
('CS400', 'Compiler Construction', 3, '101', 0),
('CS420', 'Telecommunications & Interfacing', 3, '011', 1),
('CS425', 'Fundamentals of Network Administration', 3, '101', 0),
('CS430', 'Artificial Intelligence', 3, '101', 0),
('CS435', 'Advanced Database', 3, '011', 1),
('CS445', 'Compilers, Architecture, & Organization', 4, '101', 0),
('CS455', 'Numerical Analysis', 3, '011', 0),
('CS470', 'Software Engineering I', 3, '101', 1),
('CS480', 'Software Engineering II', 3, '011', 1),
('CS495', 'Topics', 1, '111', 0),
('CS496', 'Senior Seminar: Ethics in Computer Science', 3, '101', 0),
('MATH090', 'Elementary Algebra', 3, '111', 1),
('MATH095', 'Intermediate Algebra', 3, '111', 1),
('MATH110', 'College Algebra', 3, '111', 1),
('MATH151', 'Applied Calculus I', 3, '111', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ciscourse`
--
ALTER TABLE `ciscourse`
 ADD PRIMARY KEY (`courseid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
