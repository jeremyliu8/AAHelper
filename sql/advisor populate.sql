-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2016 at 07:30 AM
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
-- Table structure for table `advisor`
--

CREATE TABLE IF NOT EXISTS `advisor` (
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advisor`
--
ALTER TABLE `advisor`
 ADD PRIMARY KEY (`advid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
