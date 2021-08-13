-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 13, 2021 at 08:45 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c2ifdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE
IF NOT EXISTS `admin`
(
  `IDADMIN` int NOT NULL AUTO_INCREMENT,
  `IDUSER` int DEFAULT NULL,
  `ADMINLASTNAME` varchar
(50) DEFAULT NULL,
  `ADMINFIRTNAME` varchar
(50) DEFAULT NULL,
  `ROLE` varchar
(40) DEFAULT NULL,
  PRIMARY KEY
(`IDADMIN`),
  KEY `FK_EQUAL`
(`IDUSER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `annoucement`
--

DROP TABLE IF EXISTS `annoucement`;
CREATE TABLE
IF NOT EXISTS `annoucement`
(
  `IDANNOUNCEMENT` int NOT NULL AUTO_INCREMENT,
  `IDADMIN` int NOT NULL,
  `TITLE` varchar
(24) DEFAULT NULL,
  `DESCRIPTION` longtext,
  `COVERIMAGE` varchar
(50) DEFAULT NULL,
  `POSTDATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY
(`IDANNOUNCEMENT`),
  KEY `FK_POST`
(`IDADMIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE
IF NOT EXISTS `answer`
(
  `IDANSWER` int NOT NULL AUTO_INCREMENT,
  `IDTEST` int NOT NULL,
  `MATRICULE` char
(40) NOT NULL,
  `STARTDATE` timestamp NULL DEFAULT NULL,
  `ENDDATE` timestamp NULL DEFAULT NULL,
  `ANSWERCONTENT` varchar
(20) DEFAULT NULL,
  `MARK` decimal
(10,0) DEFAULT NULL,
  PRIMARY KEY
(`IDANSWER`),
  KEY `FK_CONCERNE`
(`IDTEST`),
  KEY `FK_SEND`
(`MATRICULE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE
IF NOT EXISTS `comment`
(
  `IDCOMMENT` int NOT NULL AUTO_INCREMENT,
  `IDCOURSE` int NOT NULL,
  `IDUSER` int NOT NULL,
  `CONTENT` longtext,
  `COMMENTDATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY
(`IDCOMMENT`),
  KEY `FK_MAKE`
(`IDUSER`),
  KEY `FK_RELATED_TO`
(`IDCOURSE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE
IF NOT EXISTS `course`
(
  `IDCOURSE` int NOT NULL AUTO_INCREMENT,
  `IDSUBJECT` int NOT NULL,
  `IDADMIN` int NOT NULL,
  `COURSETITLE` varchar
(30) DEFAULT NULL,
  `AMOUNT` decimal
(10,0) DEFAULT NULL,
  `COURSECONTENT` varchar
(64) DEFAULT NULL,
  `COURSEDESCRIPTION` longtext,
  `UPLOADDATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY
(`IDCOURSE`),
  KEY `FK_LINK`
(`IDSUBJECT`),
  KEY `FK_UPLOAD`
(`IDADMIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `learner`
--

DROP TABLE IF EXISTS `learner`;
CREATE TABLE
IF NOT EXISTS `learner`
(
  `MATRICULE` char
(40) NOT NULL,
  `IDUSER` int DEFAULT NULL,
  `LASTNAME` varchar
(50) DEFAULT NULL,
  `LEARNERFIRSTNAME` varchar
(30) DEFAULT NULL,
  `STATUT` varchar
(23) DEFAULT NULL,
  PRIMARY KEY
(`MATRICULE`),
  KEY `FK_IS`
(`IDUSER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `learner`
--

INSERT INTO `learner` (`
MATRICULE`,
`IDUSER
`, `LASTNAME`, `LEARNERFIRSTNAME`, `STATUT`) VALUES
('learner320210813', 3, 'Yaro', 'Emmanuel', NULL),
('learner420210813', 4, 'Yaro', 'Emmanuel', NULL),
('learner520210813', 5, 'Yaro', 'Emmanuel', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `newletter`
--

DROP TABLE IF EXISTS `newletter`;
CREATE TABLE
IF NOT EXISTS `newletter`
(
  `IDNEWS` int NOT NULL AUTO_INCREMENT,
  `MATRICULE` char
(40) NOT NULL,
  `EMAILADRESS` varchar
(24) DEFAULT NULL,
  PRIMARY KEY
(`IDNEWS`),
  KEY `FK_REGISTER`
(`MATRICULE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subcription`
--

DROP TABLE IF EXISTS `subcription`;
CREATE TABLE
IF NOT EXISTS `subcription`
(
  `IDSUBCRIPTION` int NOT NULL AUTO_INCREMENT,
  `IDCOURSE` int NOT NULL,
  `MATRICULE` char
(40) NOT NULL,
  `AMOUNTPAID` decimal
(10,0) DEFAULT NULL,
  `SUBSCRIPTIONDATE` timestamp NULL DEFAULT NULL,
  `READINGPAGE` int DEFAULT NULL,
  PRIMARY KEY
(`IDSUBCRIPTION`),
  KEY `FK_DO`
(`MATRICULE`),
  KEY `FK_IS_FOR`
(`IDCOURSE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE
IF NOT EXISTS `subject`
(
  `IDSUBJECT` int NOT NULL AUTO_INCREMENT,
  `SUBJECTNAME` varchar
(30) DEFAULT NULL,
  `SUBJECTIMAGE` varchar
(64) DEFAULT NULL,
  PRIMARY KEY
(`IDSUBJECT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE
IF NOT EXISTS `test`
(
  `IDTEST` int NOT NULL AUTO_INCREMENT,
  `IDCOURSE` int NOT NULL,
  `TESTCONTENT` varchar
(64) DEFAULT NULL,
  `DURATION` time DEFAULT NULL,
  `CORRECTION` varchar
(64) DEFAULT NULL,
  PRIMARY KEY
(`IDTEST`),
  KEY `FK_HAVE`
(`IDCOURSE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE
IF NOT EXISTS `users`
(
  `IDUSER` int NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar
(30) CHARACTER
SET utf8
COLLATE utf8_general_ci DEFAULT NULL,
  `PASSWORD` varchar
(255) CHARACTER
SET utf8
COLLATE utf8_general_ci DEFAULT NULL,
  `EMAIL` varchar
(20) DEFAULT NULL,
  `TELEPHONE` varchar
(24) NOT NULL,
  `TYPE` varchar
(30) DEFAULT NULL,
  `IMAGEPROFILE` varchar
(30) DEFAULT NULL,
  PRIMARY KEY
(`IDUSER`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`
IDUSER`,
`USERNAME
`, `PASSWORD`, `EMAIL`, `TELEPHONE`, `TYPE`, `IMAGEPROFILE`) VALUES
(3, 'manu', '202cb962ac59075b964b07152d234b70', 'yaroemmanuelbekassoe', '7118386', 'learner', NULL),
(4, 'username', '$2y$10$5jljnZLz847CTxsPj1kPnOPuM/5lfQW/c6FL24GFhm4QolHrbZLQO', 'yaroemmanuelbekassoe', '71188386', 'learner', NULL),
(5, 'manu12', '$2y$10$mwQOkXfLwpzQZLQd1B8CaOr.Sxy09YAiuiCv4G3Jl/xYfm.lM18S.', 'yaroemmanuelbekassoe', '71188386', 'learner', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
ADD CONSTRAINT `FK_EQUAL` FOREIGN KEY
(`IDUSER`) REFERENCES `users`
(`IDUSER`) ON
DELETE CASCADE ON
UPDATE CASCADE;

--
-- Constraints for table `annoucement`
--
ALTER TABLE `annoucement`
ADD CONSTRAINT `FK_POST` FOREIGN KEY
(`IDADMIN`) REFERENCES `admin`
(`IDADMIN`) ON
DELETE CASCADE ON
UPDATE CASCADE;

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
ADD CONSTRAINT `FK_CONCERNE` FOREIGN KEY
(`IDTEST`) REFERENCES `test`
(`IDTEST`) ON
DELETE CASCADE ON
UPDATE CASCADE,
ADD CONSTRAINT `FK_SEND` FOREIGN KEY
(`MATRICULE`) REFERENCES `learner`
(`MATRICULE`) ON
DELETE CASCADE ON
UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
ADD CONSTRAINT `FK_MAKE` FOREIGN KEY
(`IDUSER`) REFERENCES `users`
(`IDUSER`) ON
DELETE CASCADE ON
UPDATE CASCADE,
ADD CONSTRAINT `FK_RELATED_TO` FOREIGN KEY
(`IDCOURSE`) REFERENCES `course`
(`IDCOURSE`) ON
DELETE CASCADE ON
UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
ADD CONSTRAINT `FK_LINK` FOREIGN KEY
(`IDSUBJECT`) REFERENCES `subject`
(`IDSUBJECT`) ON
DELETE CASCADE ON
UPDATE CASCADE,
ADD CONSTRAINT `FK_UPLOAD` FOREIGN KEY
(`IDADMIN`) REFERENCES `admin`
(`IDADMIN`) ON
DELETE CASCADE ON
UPDATE CASCADE;

--
-- Constraints for table `learner`
--
ALTER TABLE `learner`
ADD CONSTRAINT `FK_IS` FOREIGN KEY
(`IDUSER`) REFERENCES `users`
(`IDUSER`) ON
DELETE CASCADE ON
UPDATE CASCADE;

--
-- Constraints for table `newletter`
--
ALTER TABLE `newletter`
ADD CONSTRAINT `FK_REGISTER` FOREIGN KEY
(`MATRICULE`) REFERENCES `learner`
(`MATRICULE`) ON
DELETE CASCADE ON
UPDATE CASCADE;

--
-- Constraints for table `subcription`
--
ALTER TABLE `subcription`
ADD CONSTRAINT `FK_DO` FOREIGN KEY
(`MATRICULE`) REFERENCES `learner`
(`MATRICULE`) ON
DELETE CASCADE ON
UPDATE CASCADE,
ADD CONSTRAINT `FK_IS_FOR` FOREIGN KEY
(`IDCOURSE`) REFERENCES `course`
(`IDCOURSE`) ON
DELETE CASCADE ON
UPDATE CASCADE;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
ADD CONSTRAINT `FK_HAVE` FOREIGN KEY
(`IDCOURSE`) REFERENCES `course`
(`IDCOURSE`) ON
DELETE CASCADE ON
UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
