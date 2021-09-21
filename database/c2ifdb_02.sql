-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 20, 2021 at 08:11 AM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c2ifb1341511`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `IDADMIN` int(11) NOT NULL AUTO_INCREMENT,
  `IDUSER` int(11) DEFAULT NULL,
  `ADMINLASTNAME` varchar(50) DEFAULT NULL,
  `ADMINFIRTNAME` varchar(50) DEFAULT NULL,
  `ROLE` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`IDADMIN`),
  KEY `FK_EQUAL` (`IDUSER`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`IDADMIN`, `IDUSER`, `ADMINLASTNAME`, `ADMINFIRTNAME`, `ROLE`) VALUES
(2, NULL, 'Nana', 'Jeremie', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `annoucement`
--

DROP TABLE IF EXISTS `annoucement`;
CREATE TABLE IF NOT EXISTS `annoucement` (
  `IDANNOUNCEMENT` int(11) NOT NULL AUTO_INCREMENT,
  `IDADMIN` int(11) NOT NULL,
  `TITLE` varchar(24) DEFAULT NULL,
  `DESCRIPTION` longtext,
  `COVERIMAGE` varchar(50) DEFAULT NULL,
  `POSTDATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IDANNOUNCEMENT`),
  KEY `FK_POST` (`IDADMIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

DROP TABLE IF EXISTS `answer`;
CREATE TABLE IF NOT EXISTS `answer` (
  `IDANSWER` int(11) NOT NULL AUTO_INCREMENT,
  `IDTEST` int(11) NOT NULL,
  `MATRICULE` char(40) NOT NULL,
  `STARTDATE` timestamp NULL DEFAULT NULL,
  `ENDDATE` timestamp NULL DEFAULT NULL,
  `ANSWERCONTENT` varchar(20) DEFAULT NULL,
  `MARK` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`IDANSWER`),
  KEY `FK_CONCERNE` (`IDTEST`),
  KEY `FK_SEND` (`MATRICULE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `IDCOMMENT` int(11) NOT NULL AUTO_INCREMENT,
  `IDCOURSE` int(11) NOT NULL,
  `IDUSER` int(11) NOT NULL,
  `CONTENT` longtext,
  `COMMENTDATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IDCOMMENT`),
  KEY `FK_MAKE` (`IDUSER`),
  KEY `FK_RELATED_TO` (`IDCOURSE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `IDCOURSE` int(11) NOT NULL AUTO_INCREMENT,
  `IDSUBJECT` int(11) NOT NULL,
  `IDADMIN` int(11) NOT NULL,
  `COURSETITLE` varchar(30) DEFAULT NULL,
  `LEVEL` varchar(100) NOT NULL,
  `DURATION` varchar(100) NOT NULL,
  `AMOUNT` decimal(10,0) DEFAULT NULL,
  `COURSCOVER` varchar(200) NOT NULL,
  `COURSECONTENT` varchar(64) DEFAULT NULL,
  `COURSEDESCRIPTION` longtext,
  `UPLOADDATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`IDCOURSE`),
  KEY `FK_LINK` (`IDSUBJECT`),
  KEY `FK_UPLOAD` (`IDADMIN`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`IDCOURSE`, `IDSUBJECT`, `IDADMIN`, `COURSETITLE`, `LEVEL`, `DURATION`, `AMOUNT`, `COURSCOVER`, `COURSECONTENT`, `COURSEDESCRIPTION`, `UPLOADDATE`) VALUES
(9, 6, 2, 'BTP', '', '', '23242', 'AdobeStock_377572212_Preview.jpeg', 'front_fullcolor_1024x599.pdf', 'dewfww', '2021-09-15 18:59:01'),
(10, 5, 2, 'BATIMENT', 'Moyen', 'Deux semaines', '45662', 'Screenshot 2021-09-09 102001.png', 'front_fullcolor_1024x599.pdf', 'fgegtrh', '2021-09-16 13:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `learner`
--

DROP TABLE IF EXISTS `learner`;
CREATE TABLE IF NOT EXISTS `learner` (
  `MATRICULE` char(40) NOT NULL,
  `IDUSER` int(11) DEFAULT NULL,
  `LASTNAME` varchar(50) DEFAULT NULL,
  `LEARNERFIRSTNAME` varchar(30) DEFAULT NULL,
  `STATUT` varchar(23) DEFAULT NULL,
  PRIMARY KEY (`MATRICULE`),
  KEY `FK_IS` (`IDUSER`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `learner`
--

INSERT INTO `learner` (`MATRICULE`, `IDUSER`, `LASTNAME`, `LEARNERFIRSTNAME`, `STATUT`) VALUES
('learner120210908', 1, 'Nana', 'Jeremie', NULL),
('learner220210919', 2, 'Jeremie', 'Jeremie', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `newletter`
--

DROP TABLE IF EXISTS `newletter`;
CREATE TABLE IF NOT EXISTS `newletter` (
  `IDNEWS` int(11) NOT NULL AUTO_INCREMENT,
  `MATRICULE` char(40) NOT NULL,
  `EMAILADRESS` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`IDNEWS`),
  KEY `FK_REGISTER` (`MATRICULE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `subcription`
--

DROP TABLE IF EXISTS `subcription`;
CREATE TABLE IF NOT EXISTS `subcription` (
  `IDSUBCRIPTION` int(11) NOT NULL AUTO_INCREMENT,
  `IDCOURSE` int(11) NOT NULL,
  `MATRICULE` char(40) NOT NULL,
  `AMOUNTPAID` decimal(10,0) DEFAULT NULL,
  `SUBSCRIPTIONDATE` datetime DEFAULT NULL,
  `READINGPAGE` int(11) DEFAULT NULL,
  `IMG` varchar(200) NOT NULL,
  `ADRESS` varchar(100) NOT NULL,
  `POSTAL` varchar(100) NOT NULL,
  `PAIEMENT_TYPE` varchar(100) NOT NULL,
  `COUNTRY` varchar(100) NOT NULL,
  `PROMO` varchar(100) NOT NULL,
  `PHONE` varchar(100) NOT NULL,
  `PROGRESS` int(11) NOT NULL DEFAULT '0',
  `ISDONE` int(11) NOT NULL DEFAULT '0',
  `ACCEPT` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`IDSUBCRIPTION`),
  KEY `FK_DO` (`MATRICULE`),
  KEY `FK_IS_FOR` (`IDCOURSE`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcription`
--

INSERT INTO `subcription` (`IDSUBCRIPTION`, `IDCOURSE`, `MATRICULE`, `AMOUNTPAID`, `SUBSCRIPTIONDATE`, `READINGPAGE`, `IMG`, `ADRESS`, `POSTAL`, `PAIEMENT_TYPE`, `COUNTRY`, `PROMO`, `PHONE`, `PROGRESS`, `ISDONE`, `ACCEPT`) VALUES
(9, 10, 'learner120210908', '45662', '2021-09-18 09:09:42', 0, 'Screenshot (3).png', 'Wayalguin, Burkina Faso', 'BP 322', 'Orange', 'Burkina Faso', 'fbhegegehvegvheg', '65656533', 0, 0, 1),
(10, 10, 'learner120210908', '45662', '2021-09-19 18:22:14', 0, 'vlcsnap-2020-03-18-21h54m11s015.png', 'asajdga', 'hgdhsfd', 'Orange', 'Burkina Faso', 'fbhegegehvegvheg', '65446', 50, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `IDSUBJECT` int(11) NOT NULL AUTO_INCREMENT,
  `SUBJECTNAME` varchar(30) DEFAULT NULL,
  `SUBJECTIMAGE` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`IDSUBJECT`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`IDSUBJECT`, `SUBJECTNAME`, `SUBJECTIMAGE`) VALUES
(5, 'BATIMENT', 'Image'),
(6, 'INFORMATIQUE', 'Image'),
(7, 'MINE', 'Image'),
(10, 'GENIE CIVIL', 'Image'),
(11, 'CONSTRUCTION', 'Image');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `IDTEST` int(11) NOT NULL AUTO_INCREMENT,
  `IDCOURSE` int(11) NOT NULL,
  `TESTCONTENT` varchar(64) DEFAULT NULL,
  `DURATION` time DEFAULT NULL,
  `CORRECTION` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`IDTEST`),
  KEY `FK_HAVE` (`IDCOURSE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `IDUSER` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `TELEPHONE` varchar(24) NOT NULL,
  `TYPE` varchar(30) DEFAULT NULL,
  `IMAGEPROFILE` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`IDUSER`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`IDUSER`, `USERNAME`, `PASSWORD`, `EMAIL`, `TELEPHONE`, `TYPE`, `IMAGEPROFILE`) VALUES
(1, 'jerenana', 'b479279b92826acfb7607f1248f89a97', 'nanajeremie097@gmail.com', '65384473', 'learner', NULL),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'nanajeremie097@gmail.com', '65384473', 'learner', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_EQUAL` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`IDUSER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `annoucement`
--
ALTER TABLE `annoucement`
  ADD CONSTRAINT `FK_POST` FOREIGN KEY (`IDADMIN`) REFERENCES `admin` (`IDADMIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `FK_CONCERNE` FOREIGN KEY (`IDTEST`) REFERENCES `test` (`IDTEST`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SEND` FOREIGN KEY (`MATRICULE`) REFERENCES `learner` (`MATRICULE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_MAKE` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`IDUSER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RELATED_TO` FOREIGN KEY (`IDCOURSE`) REFERENCES `course` (`IDCOURSE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `FK_LINK` FOREIGN KEY (`IDSUBJECT`) REFERENCES `subject` (`IDSUBJECT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_UPLOAD` FOREIGN KEY (`IDADMIN`) REFERENCES `admin` (`IDADMIN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `learner`
--
ALTER TABLE `learner`
  ADD CONSTRAINT `FK_IS` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`IDUSER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `newletter`
--
ALTER TABLE `newletter`
  ADD CONSTRAINT `FK_REGISTER` FOREIGN KEY (`MATRICULE`) REFERENCES `learner` (`MATRICULE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcription`
--
ALTER TABLE `subcription`
  ADD CONSTRAINT `FK_DO` FOREIGN KEY (`MATRICULE`) REFERENCES `learner` (`MATRICULE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_IS_FOR` FOREIGN KEY (`IDCOURSE`) REFERENCES `course` (`IDCOURSE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `FK_HAVE` FOREIGN KEY (`IDCOURSE`) REFERENCES `course` (`IDCOURSE`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
