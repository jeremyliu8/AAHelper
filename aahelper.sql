-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2016 at 01:23 AM
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
-- Table structure for table `advisor`
--

CREATE TABLE `advisor` (
  `advid` varchar(9) NOT NULL DEFAULT '',
  `fname` varchar(20) NOT NULL COMMENT 'First name of advisor',
  `lname` varchar(30) NOT NULL COMMENT 'Last name of advisor',
  `email` varchar(50) NOT NULL COMMENT 'Email address tied to this account',
  `phone` varchar(10) NOT NULL COMMENT 'Phone number of advisor',
  `password` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advisor`
--

INSERT INTO `advisor` (`advid`, `fname`, `lname`, `email`, `phone`, `password`) VALUES
('002111333', 'Daniel', 'Grissom', 'dgrissom@apu.edu', '8273641743', 'drgrissomrocks'),
('002111444', 'Rodney', 'Ulrich', 'rulrich@apu.edu', '4832753859', 'drulrichrocks'),
('002111555', 'Simon', 'Lin', 'slin@apu.edu', '5582274810', 'drlinrocks'),
('002112222', 'Samuel', 'Sambasivam', 'ssambasivam@apu.edu', '5985843758', 'drsamrocks');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `ciscourseid` varchar(7) NOT NULL COMMENT ' Primary key for the table. Unique to each class',
  `classname` varchar(50) NOT NULL COMMENT ' Name of the class',
  `units` int(1) NOT NULL COMMENT ' Number of units for this class',
  `term` varchar(3) DEFAULT NULL,
  `cs` int(1) NOT NULL,
  `cis` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ciscourseid`, `classname`, `units`, `term`, `cs`, `cis`) VALUES
('ACCT120', 'Principles of Accounting I', 4, '111', 0, 2),
('BUSI210', 'Principles of Organization & Management', 3, '111', 0, 2),
('CS220', 'Intro to CS I', 4, '111', 2, 2),
('CS225', 'Intro to CS II', 4, '111', 2, 2),
('CS250', 'Operating Systems', 3, '011', 2, 2),
('CS330', 'Systems Programming', 3, '101', 2, 2),
('CS340', 'Systems Programming II', 3, '011', 2, 1),
('CS350', 'Discrete Structures', 3, '111', 2, 2),
('CS363', 'Web Programming', 3, '011', 1, 1),
('CS380', 'Data Structures', 3, '011', 2, 2),
('CS390', 'Database Mgt Systems', 3, '111', 2, 2),
('CS400', 'Compiler Construction', 3, '101', 2, 1),
('CS420', 'Telecommunications & Interfacing', 3, '011', 1, 2),
('CS425', 'Fundamentals of Network Administration', 3, '101', 1, 1),
('CS430', 'Artificial Intelligence', 3, '101', 1, 1),
('CS435', 'Advanced Database', 3, '011', 1, 2),
('CS445', 'Compilers, Architecture, & Organization', 4, '101', 2, 1),
('CS455', 'Numerical Analysis', 3, '011', 2, 1),
('CS470', 'Software Engineering I', 3, '101', 2, 2),
('CS480', 'Software Engineering II', 3, '011', 2, 2),
('CS495', 'Topics', 1, '111', 1, 1),
('CS496', 'Senior Seminar: Ethics in Computer Science', 3, '101', 1, 1),
('MATH090', 'Elementary Algebra', 3, '111', 2, 2),
('MATH095', 'Intermediate Algebra', 3, '111', 2, 2),
('MATH110', 'College Algebra', 3, '111', 2, 2),
('MATH150', 'Precalculus', 3, '111', 2, 2),
('MATH151', 'Applied Calculus I', 3, '111', 0, 2),
('MATH161', 'Calculus I', 5, '111', 2, 0),
('MATH162', 'Calculus II', 4, '111', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` varchar(9) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `major` varchar(4) NOT NULL COMMENT 'Major of student',
  `advid` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `fname`, `lname`, `email`, `password`, `major`, `advid`) VALUES
('002252457', 'Nicole', 'Boudria', 'nboudria13@apu.edu', '8ae35ce4557d84d5064b0c156fde8387b57b057f20cb8d48e24892d158b8cd49a0f99be1346f1df40fbfd53929ca8901765ad5dd835428de45deff8795be6181', 'CS', '002111444'),
('002352690', 'Carson', 'Hall', 'carsonhall11@apu.edu', 'c00173f77fad04ac84a82059b77350763b69388e6ae8814f5ceb2f17fd7e8e17ae14b9fabb3d7d9509c763161db15dfa42050f2942263faedb071b783cf7197f', 'CS', '002112222'),
('002405470', 'Chris ', 'Sissoyev', 'csissoyev11@apu.edu', 'a1204ce4e0175b9d15a711737f2d949531147dbaea44366ed2228b88a24000c31f196d3f635b902c608d2e4de3e73a6fd09a77a70ac0ae65d71efc2644075d0b', 'CIS', '002111555'),
('002406078', 'Jeremy', 'Liu', 'jkliu11@apu.edu', '34c2581e9aae4db5d860afce90bf2d883bee51d394573aa6896fcb4b5518ef387aca9558486a72c53058a6c87ff1746299b6df74ce4b484dddc6136bba8dcaee', 'CS', '002111555');

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
-- Indexes for table `advisor`
--
ALTER TABLE `advisor`
  ADD PRIMARY KEY (`advid`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`ciscourseid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`),
  ADD KEY `advid` (`advid`);

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
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`advid`) REFERENCES `advisor` (`advid`);

--
-- Constraints for table `studentcourse`
--
ALTER TABLE `studentcourse`
  ADD CONSTRAINT `studentcourse_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentid`),
  ADD CONSTRAINT `studentcourse_ibfk_2` FOREIGN KEY (`courseid`) REFERENCES `courses` (`ciscourseid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
