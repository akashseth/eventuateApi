-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2017 at 09:05 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eventuate`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings_shruti@gmail.com`
--

CREATE TABLE IF NOT EXISTS `bookings_shruti@gmail.com` (
  `sno` int(10) NOT NULL,
  `date` date DEFAULT NULL,
  `type_service` varchar(50) DEFAULT NULL,
  `name_serviceprovider` varchar(100) DEFAULT NULL,
  `service_specification` varchar(100) DEFAULT NULL,
  `amount_paid` int(6) DEFAULT NULL,
  `amount_due` int(6) DEFAULT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings_shruti@gmail.com`
--

INSERT INTO `bookings_shruti@gmail.com` (`sno`, `date`, `type_service`, `name_serviceprovider`, `service_specification`, `amount_paid`, `amount_due`) VALUES
(1, '2017-04-25', 'hotel', 'sarin inn', 'big hall', 500, 1000),
(2, '2017-04-28', 'travel', 'uber', 'big van', 200, 500),
(3, '2017-05-18', 'flower decorator', 'shruti', 'orchid', 100, 200),
(4, '2017-04-24', 'tent house', 'srivastava tents', '4 tents', 300, 500),
(5, '2017-04-29', 'video', 'jai ambe video', 'videography', 300, 500);

-- --------------------------------------------------------

--
-- Table structure for table `event_details`
--

CREATE TABLE IF NOT EXISTS `event_details` (
  `email_id` varchar(50) NOT NULL,
  `eventtype` varchar(25) NOT NULL,
  `eventdatedayofmonth` int(2) NOT NULL,
  `eventdatemonth` int(2) NOT NULL,
  `eventdateyear` int(4) NOT NULL,
  `eventtimefromhours` int(2) NOT NULL,
  `eventtimefromminutes` int(2) NOT NULL,
  `eventtimetohours` int(2) NOT NULL,
  `eventtimetominutes` int(2) NOT NULL,
  `eventbudget` int(6) NOT NULL,
  `totalexpenditure` int(6) NOT NULL,
  `budgetleft` int(6) NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_details`
--

INSERT INTO `event_details` (`email_id`, `eventtype`, `eventdatedayofmonth`, `eventdatemonth`, `eventdateyear`, `eventtimefromhours`, `eventtimefromminutes`, `eventtimetohours`, `eventtimetominutes`, `eventbudget`, `totalexpenditure`, `budgetleft`) VALUES
('shruti@gmail.com', 'Wedding', 29, 6, 2017, 16, 0, 23, 59, 10000, 1100, 8900);

-- --------------------------------------------------------

--
-- Table structure for table `expenditure_shruti@gmail.com`
--

CREATE TABLE IF NOT EXISTS `expenditure_shruti@gmail.com` (
  `sno` int(10) NOT NULL,
  `date` date DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `details` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenditure_shruti@gmail.com`
--

INSERT INTO `expenditure_shruti@gmail.com` (`sno`, `date`, `amount`, `details`) VALUES
(2, '2017-04-20', 1000, 'to caterer'),
(4, '2016-04-01', 100, 'to shruti');

-- --------------------------------------------------------

--
-- Table structure for table `profile_organizer`
--

CREATE TABLE IF NOT EXISTS `profile_organizer` (
  `email_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mob` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile_organizer`
--

INSERT INTO `profile_organizer` (`email_id`, `name`, `mob`, `address`) VALUES
('shruti@gmail.com', 'shruti', '8090317973', 'varanasi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `EMAIL_ID` varchar(50) NOT NULL,
  `USER_TYPE` varchar(10) NOT NULL,
  `PASSCODE` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`EMAIL_ID`),
  UNIQUE KEY `EMAIL_ID` (`EMAIL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stores EmailId, UserType (Organizer/Service) & Password of all registered users';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`EMAIL_ID`, `USER_TYPE`, `PASSCODE`) VALUES
('akash@gmail.com', 'Organizer', '0002'),
('shruti@gmail.com', 'Organizer', '0013');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
