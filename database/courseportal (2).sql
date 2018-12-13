-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2018 at 09:42 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courseportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseid` int(10) NOT NULL,
  `coursename` varchar(50) DEFAULT NULL,
  `coursedescription` varchar(200) DEFAULT NULL,
  `coursedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `coursename`, `coursedescription`, `coursedate`) VALUES
(1, 'C Programming', 'C is a general-purpose, imperative computer programming language, supporting structured programming, lexical variable scope and recursion, while a static type system prevents many unintended operation', '2018-04-06 12:22:00'),
(2, 'Data Structure', 'After completion of the course students can understand data structure and how to implement different data structures using C programming language', '2018-04-06 12:30:00'),
(3, 'Computer Organization', 'It deals with the functional components of a computer, interconnections of the components and performance of the computer', '2018-04-06 12:34:00'),
(4, 'Automata Theory', 'Automata theory is the study of abstract machines and automata, as well as the computational problems that can be solved using them. It is a theory in theoretical computer science and discrete math', '2018-04-06 12:35:00'),
(5, 'Computer Architechture', 'Computer architecture is a set of rules and methods that describe the functionality, organization, and implementation of computer systems.', '2018-04-06 12:37:00'),
(6, 'Internet Technology', 'Computer Internet technology refers to devices, software, hardware and transmission protocols used to connect computers together in order to receive or send data from one computer to another . . . ', '2018-04-06 12:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `coursecontent`
--

CREATE TABLE `coursecontent` (
  `ccid` int(80) NOT NULL,
  `courseid` int(10) NOT NULL,
  `contentname` varchar(100) NOT NULL,
  `url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursecontent`
--



-- --------------------------------------------------------

--
-- Table structure for table `coursefaculty`
--

CREATE TABLE `coursefaculty` (
  `cfid` int(80) NOT NULL,
  `courseid` int(10) NOT NULL,
  `userid` int(50) NOT NULL,
  `coursefacultydate` datetime NOT NULL,
  `approval` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursefaculty`
--

INSERT INTO `coursefaculty` (`cfid`, `courseid`, `userid`, `coursefacultydate`, `approval`) VALUES
(1, 5, 3, '2018-04-19 12:20:00', 1),
(2, 5, 5, '2018-04-19 12:44:00', 1),
(3, 1, 6, '2018-04-19 13:48:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `coursestudent`
--

CREATE TABLE `coursestudent` (
  `csid` int(80) NOT NULL,
  `courseid` int(10) NOT NULL,
  `userid` int(50) NOT NULL,
  `coursestudentdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursestudent`
--

INSERT INTO `coursestudent` (`csid`, `courseid`, `userid`, `coursestudentdate`) VALUES
(1, 6, 1, '2018-04-19 12:15:00'),
(2, 6, 2, '2018-04-19 12:16:00'),
(3, 4, 4, '2018-04-19 12:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(50) NOT NULL,
  `username` varchar(80) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `useremail`, `password`) VALUES
(1, 'Souvik Dutta', 'souvik.d20795@gmail.com', '$2y$10$5kdBhdZSZyEBktr1CEUUnegwrplRGR1zUyhGQB6MIu/vy4u4rOBM6'),
(2, 'Samarpan Dutta', 'samd@gmail.com', '$2y$10$SY51j34fDdw4PjibovbF6uPIEJZpb8y9m5crm8V/vSaPjurWE17pC'),
(3, 'Abhisek Guha', 'ag@gmail.com', '$2y$10$I5KCbEP2s/dLt8SrHGx/aOyZok.zcGleU7R9o50BDuYehHhyyGJrm'),
(4, 'Tamoghna Hazra', 'th@gmail.com', '$2y$10$OJVSA.59ZBP9FZp/nsx3MO4taoZawrVfYgLfUexhQrhhsjulVib8W'),
(5, 'Sayan Das', 'sd@gmail.com', '$2y$10$Qh8OIBFOaR4.rp1chyJjHecRpzYDXcFH6P9Hm1iUfS/EJtOXpVy9y'),
(6, 'mrinmoy majumder', 'mm@gmail.com', '$2y$10$hPsuKz.sLmQ33zEiun/.2eZe7Ri7LC1BbaNtyN.Gyz5ZlTv5p9Ya6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `coursecontent`
--
ALTER TABLE `coursecontent`
  ADD PRIMARY KEY (`ccid`),
  ADD KEY `cccourseid` (`courseid`);

--
-- Indexes for table `coursefaculty`
--
ALTER TABLE `coursefaculty`
  ADD PRIMARY KEY (`cfid`),
  ADD KEY `fcoursefaculty` (`courseid`),
  ADD KEY `fuserfaculty` (`userid`);

--
-- Indexes for table `coursestudent`
--
ALTER TABLE `coursestudent`
  ADD PRIMARY KEY (`csid`),
  ADD KEY `fcoursestudent` (`courseid`),
  ADD KEY `fuserstudent` (`userid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coursecontent`
--
ALTER TABLE `coursecontent`
  MODIFY `ccid` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3524;

--
-- AUTO_INCREMENT for table `coursefaculty`
--
ALTER TABLE `coursefaculty`
  MODIFY `cfid` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coursestudent`
--
ALTER TABLE `coursestudent`
  MODIFY `csid` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coursecontent`
--
ALTER TABLE `coursecontent`
  ADD CONSTRAINT `cccourseid` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`);

--
-- Constraints for table `coursefaculty`
--
ALTER TABLE `coursefaculty`
  ADD CONSTRAINT `fcoursefaculty` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`),
  ADD CONSTRAINT `fuserfaculty` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `coursestudent`
--
ALTER TABLE `coursestudent`
  ADD CONSTRAINT `fcoursestudent` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`),
  ADD CONSTRAINT `fuserstudent` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
