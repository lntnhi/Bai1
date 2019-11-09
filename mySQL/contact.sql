-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2019 at 01:48 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contact`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PhoneNumber` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ID`, `Name`, `Email`, `PhoneNumber`, `Username`) VALUES
(1, 'Nhi', 'haha@gmail.com', '0987654321', 'admin'),
(2, 'Nhi2', 'hihi@gmail.com', '0987654322', 'admin'),
(3, 'Nhi3', 'haha@gmail.com', '0987654323', 'admin'),
(4, 'Nhi4', 'hihi@gmail.com', '0987654324', 'admin'),
(5, 'Nhi5', NULL, '0987654325', 'admin'),
(6, 'Nhi6', NULL, '0987654326', 'admin'),
(7, 'Nhi7', NULL, '0987654327', 'admin'),
(8, 'Nhi8', NULL, '0987654328', 'admin'),
(9, 'Hiha', NULL, '0987654329', 'sau'),
(10, 'Nhinhi', NULL, '0123456712', 'sau');

-- --------------------------------------------------------

--
-- Table structure for table `contact_tag`
--

DROP TABLE IF EXISTS `contact_tag`;
CREATE TABLE IF NOT EXISTS `contact_tag` (
  `ContactID` int(11) NOT NULL,
  `TagID` int(11) NOT NULL,
  PRIMARY KEY (`ContactID`,`TagID`),
  KEY `TagID` (`TagID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_tag`
--

INSERT INTO `contact_tag` (`ContactID`, `TagID`) VALUES
(1, 1),
(2, 1),
(6, 1),
(8, 1),
(2, 2),
(7, 2),
(3, 3),
(7, 3),
(5, 4),
(7, 4),
(9, 5),
(10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Username` (`Username`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`ID`, `Name`, `Username`) VALUES
(1, 'Family', 'admin'),
(2, 'School', 'admin'),
(3, 'Work', 'admin'),
(4, 'Friend', 'admin'),
(5, 'Family', 'sau'),
(6, 'Home', 'sau');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Username`, `Password`, `Fullname`) VALUES
('admin', '123', 'Nhi'),
('sau', '456', 'Mon');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`);

--
-- Constraints for table `contact_tag`
--
ALTER TABLE `contact_tag`
  ADD CONSTRAINT `contact_tag_ibfk_1` FOREIGN KEY (`ContactID`) REFERENCES `contact` (`ID`),
  ADD CONSTRAINT `contact_tag_ibfk_2` FOREIGN KEY (`TagID`) REFERENCES `tag` (`ID`);

--
-- Constraints for table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `user` (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
