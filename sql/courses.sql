-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2016 at 09:40 AM
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
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseid` varchar(7) NOT NULL COMMENT ' Primary key for the table. Unique to each class',
  `classname` varchar(50) NOT NULL COMMENT ' Name of the class',
  `units` int(1) NOT NULL COMMENT ' Number of units for this class',
  `term` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseid`, `classname`, `units`, `term`) VALUES
('ACCT120', 'Principles of Accounting I', 4, '111'),
('BUSI210', 'Principles of Organization & Management', 3, '111'),
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
('CS420', 'Telecommunications & Interfacing', 3, '011'),
('CS425', 'Fundamentals of Network Administration', 3, '101'),
('CS430', 'Artificial Intelligence', 3, '101'),
('CS435', 'Advanced Database', 3, '011'),
('CS445', 'Compilers, Architecture, & Organization', 4, '101'),
('CS455', 'Numerical Analysis', 3, '011'),
('CS470', 'Software Engineering I', 3, '101'),
('CS480', 'Software Engineering II', 3, '011'),
('CS495', 'Topics/UDWI', 3, '111'),
('CS496', 'Senior Seminar: Ethics in Computer Science', 3, '101'),
('MATH090', 'Elementary Algebra', 3, '111'),
('MATH095', 'Intermediate Algebra', 3, '111'),
('MATH110', 'College Algebra', 3, '111'),
('MATH150', 'Precalculus', 3, '111'),
('MATH151', 'Applied Calculus I', 3, '111'),
('MATH161', 'Calculus I', 5, '111'),
('MATH162', 'Calculus II', 4, '111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
