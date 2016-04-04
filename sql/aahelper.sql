-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2016 at 10:59 AM
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
('002111333', 'Daniel', 'Grissom', 'dgrissom@apu.edu', '8273641743', 'd8f7569462810c826d017205e2d7f1a117ed162bba62dd23cb5dfc5b5369bb29fc053a28f8887e74b131846b7da187d978a94b2e7ccfdba59f7af724d1276e40'),
('002111444', 'Rodney', 'Ulrich', 'rulrich@apu.edu', '4832753859', '3d24336153982a0a9754bbdf798a415955b060174cdd04d97b81e14443aeee3d87a2f4ec2ed7da42a012be13c15b304bdd13af7b017188bff02e088e0352e460'),
('002111555', 'Simon', 'Lin', 'slin@apu.edu', '5582274810', '1cb45669fe73406bc040dbc7ca3257159d635e0cb7ff6f2cb910f658eb729ed2984d4d8581a9552add357d5045da83adfade11236e925e73b589f5d8e4288193'),
('002112222', 'Samuel', 'Sambasivam', 'ssambasivam@apu.edu', '5985843758', '0f63545af021228f6881d315e77d1af312ec40427ef180531c99f96aaad1d2de0dc6460bfc558b96d987c4f785125bff2351a4a7ea9aab5c1c66f9911823d243');

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
('CS495', 'Topics', 1, '111'),
('CS496', 'Senior Seminar: Ethics in Computer Science', 3, '101'),
('MATH090', 'Elementary Algebra', 3, '111'),
('MATH095', 'Intermediate Algebra', 3, '111'),
('MATH110', 'College Algebra', 3, '111'),
('MATH150', 'Precalculus', 3, '111'),
('MATH151', 'Applied Calculus I', 3, '111'),
('MATH161', 'Calculus I', 5, '111'),
('MATH162', 'Calculus II', 4, '111');

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
-- Indexes for table `coreq`
--
ALTER TABLE `coreq`
  ADD PRIMARY KEY (`courseid`,`coreqid`),
  ADD KEY `coreqid` (`coreqid`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`majorid`,`courseid`),
  ADD KEY `courseid` (`courseid`);

--
-- Indexes for table `prereq`
--
ALTER TABLE `prereq`
  ADD PRIMARY KEY (`courseid`,`prereqid`),
  ADD KEY `prereqid` (`prereqid`);

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
-- Constraints for table `coreq`
--
ALTER TABLE `coreq`
  ADD CONSTRAINT `coreq_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`),
  ADD CONSTRAINT `coreq_ibfk_2` FOREIGN KEY (`coreqid`) REFERENCES `courses` (`courseid`);

--
-- Constraints for table `major`
--
ALTER TABLE `major`
  ADD CONSTRAINT `major_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`);

--
-- Constraints for table `prereq`
--
ALTER TABLE `prereq`
  ADD CONSTRAINT `prereq_ibfk_1` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`),
  ADD CONSTRAINT `prereq_ibfk_2` FOREIGN KEY (`prereqid`) REFERENCES `courses` (`courseid`);

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
  ADD CONSTRAINT `studentcourse_ibfk_2` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
