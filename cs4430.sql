-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2017 at 03:07 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs4430`
--

-- --------------------------------------------------------

--
-- Table structure for table `Classes`
--

CREATE TABLE `Classes` (
  `cid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Classes`
--

INSERT INTO `Classes` (`cid`, `tid`, `cname`, `subject`) VALUES
(1, 1, 'European Studies', 'History'),
(2, 4, 'Calculus 4', 'Mathematics'),
(3, 10, 'Organic Chemistry', 'Chemistry'),
(4, 2, 'Ethics', 'English'),
(5, 3, 'Database Management Systems', 'Computer Science');

-- --------------------------------------------------------

--
-- Table structure for table `ClassesWork`
--

CREATE TABLE `ClassesWork` (
  `cid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `grade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ClassesWork`
--

INSERT INTO `ClassesWork` (`cid`, `aid`, `sid`, `grade`) VALUES
(1, 1, 1, 100),
(2, 3, 2, 70),
(3, 3, 3, 60),
(4, 4, 1, 0),
(5, 5, 4, 80);

--
-- Triggers `ClassesWork`
--
DELIMITER $$
CREATE TRIGGER `t1` BEFORE INSERT ON `ClassesWork` FOR EACH ROW BEGIN
    IF 100.00 != ( SELECT SUM(`weight`) FROM `WeightOfGrades` WHERE `cid` = `new`.`cid` ) THEN
        SIGNAL SQLSTATE '45000' SET message_text = 'Class must total to 100% before a student can do any work';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Enrolled`
--

CREATE TABLE `Enrolled` (
  `sid` int(11) NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Enrolled`
--

INSERT INTO `Enrolled` (`sid`, `cid`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 3),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE `Students` (
  `sid` int(11) NOT NULL,
  `sname` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`sid`, `sname`, `status`) VALUES
(1, 'Adam', 'Senior'),
(2, 'Sarah', 'Freshman'),
(3, 'Jeff', 'Junior'),
(4, 'Jason', 'Sophomore'),
(5, 'Ted', 'Senior'),
(6, 'Eve', 'Senior'),
(7, 'Ethan', 'Freshman'),
(8, 'Alex', 'Junior'),
(9, 'Taylor', 'Sophomore');

-- --------------------------------------------------------

--
-- Table structure for table `Teachers`
--

CREATE TABLE `Teachers` (
  `tid` int(11) NOT NULL,
  `tname` varchar(100) NOT NULL,
  `position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Teachers`
--

INSERT INTO `Teachers` (`tid`, `tname`, `position`) VALUES
(1, 'Sally', 'Professor'),
(2, 'Harold', 'Professor'),
(3, 'John', 'Professor'),
(4, 'Jack', 'Professor'),
(5, 'Rose', 'Professor'),
(6, 'Sam', 'Professor'),
(7, 'Tom', 'Professor'),
(8, 'Larry', 'Professor'),
(9, 'Caleb', 'Professor'),
(10, 'Grant', 'Professor');

-- --------------------------------------------------------

--
-- Table structure for table `WeightOfGrades`
--

CREATE TABLE `WeightOfGrades` (
  `aid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `aname` varchar(50) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `WeightOfGrades`
--

INSERT INTO `WeightOfGrades` (`aid`, `cid`, `aname`, `weight`) VALUES
(1, 1, 'Exam', 50),
(2, 2, 'Homework', 25),
(3, 3, 'quiz', 30),
(4, 4, 'Canvas', 10),
(5, 5, 'Case Study', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Classes`
--
ALTER TABLE `Classes`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `tid` (`tid`);

--
-- Indexes for table `ClassesWork`
--
ALTER TABLE `ClassesWork`
  ADD PRIMARY KEY (`cid`,`aid`,`sid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `Enrolled`
--
ALTER TABLE `Enrolled`
  ADD KEY `sid` (`sid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `Students`
--
ALTER TABLE `Students`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `Teachers`
--
ALTER TABLE `Teachers`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `WeightOfGrades`
--
ALTER TABLE `WeightOfGrades`
  ADD PRIMARY KEY (`aid`),
  ADD UNIQUE KEY `cid` (`cid`,`aname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Classes`
--
ALTER TABLE `Classes`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Students`
--
ALTER TABLE `Students`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Teachers`
--
ALTER TABLE `Teachers`
  MODIFY `tid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `WeightOfGrades`
--
ALTER TABLE `WeightOfGrades`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Classes`
--
ALTER TABLE `Classes`
  ADD CONSTRAINT `Classes_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `Teachers` (`tid`);

--
-- Constraints for table `ClassesWork`
--
ALTER TABLE `ClassesWork`
  ADD CONSTRAINT `ClassesWork_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `Classes` (`cid`),
  ADD CONSTRAINT `ClassesWork_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `Students` (`sid`);

--
-- Constraints for table `Enrolled`
--
ALTER TABLE `Enrolled`
  ADD CONSTRAINT `Enrolled_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `Students` (`sid`),
  ADD CONSTRAINT `Enrolled_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `Classes` (`cid`);

--
-- Constraints for table `WeightOfGrades`
--
ALTER TABLE `WeightOfGrades`
  ADD CONSTRAINT `WeightOfGrades_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `Classes` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
