-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2014 at 12:04 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `social_travel_guide`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `activity_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(50) NOT NULL,
  `activity_name` varchar(200) NOT NULL,
  `activity_desc` varchar(500) DEFAULT NULL,
  `rating` int(10) unsigned DEFAULT NULL,
  `duration_hrs` int(11) DEFAULT NULL,
  `duration_mins` int(11) DEFAULT NULL,
  `activity_type` varchar(45) NOT NULL,
  `itinerary_id` int(10) unsigned NOT NULL COMMENT 'Foreign key from itinerary table',
  `in_schedule` tinyint(1) NOT NULL,
  `order_number` int(11) DEFAULT NULL,
  `activity_addr1` varchar(45) NOT NULL COMMENT 'Street name',
  `activity_addr2` varchar(45) NOT NULL COMMENT 'Unit no.',
  `acitivity_addr3` varchar(45) NOT NULL COMMENT 'ZIP/Postal',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_author` varchar(45) NOT NULL,
  `comment_string` varchar(500) NOT NULL,
  `activity_id` int(10) unsigned NOT NULL COMMENT 'activity table foreign key',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `itinerary`
--

CREATE TABLE IF NOT EXISTS `itinerary` (
  `itinerary_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itinerary_name` varchar(50) NOT NULL,
  `itinerary_desc` varchar(500) DEFAULT NULL COMMENT 'Itinerary description',
  `destination` varchar(50) NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `user_id` int(10) unsigned NOT NULL COMMENT 'Foreign key for user table',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`itinerary_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `itinerary`
--

INSERT INTO `itinerary` (`itinerary_id`, `itinerary_name`, `itinerary_desc`, `destination`, `start_date`, `end_date`, `user_id`, `create_time`) VALUES
(1, 'Visit Pittsburgh', 'Say Hi to dad''s friends', 'Pittsburgh', '0000-00-00', '0000-00-00', 12, '2014-04-16 04:10:51'),
(2, 'Memorial Day Weekend @ Boston', 'Finally get to tour boston', 'Boston', '0000-00-00', '0000-00-00', 12, '2014-04-16 04:28:57'),
(3, 'Date test', 'Testing date functionality', 'Nowhere', '0000-00-00', '0000-00-00', 12, '2014-04-16 16:30:35'),
(4, 'Date as Text', 'Testing date functionality', 'Nowhere', '04/16/2014', '04/24/2014', 12, '2014-04-16 16:32:46'),
(5, 'Maine Trip in May', 'Parents are coming to visit', 'Maine', '05/10/2014', '05/21/2014', 12, '2014-04-16 16:35:23'),
(6, 'Maine Trip in May 2', 'Try again', 'Maine', '05/10/2014', '05/21/2014', 12, '2014-04-16 16:36:26'),
(7, 'New Haven this weekend', 'Going to stay there for Good Friday and Easter', 'New Haven', '04/18/2014', '04/22/2014', 1, '2014-04-16 17:40:03'),
(8, 'Summer @ Washington state', 'I''m going to Tacoma, Washington for my internship this summer. Will appreciate any good places to visit while I''m there.', 'Tacoma, Washington', '05/29/2014', '06/30/2014', 13, '2014-04-16 21:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `email`, `create_time`) VALUES
(1, 'Admin', 'Istrator', 'admin', 'password', 'danyeo@bu.edu', '2014-03-25 02:53:33'),
(2, 'Daniel', 'Yeo', 'danielyeo', 'password', 'coldan@gmail.com', '2014-03-29 20:22:57'),
(12, 'Daniel', 'Yeo', 'wholelife', 'password', 'contact@danielyeo.com', '2014-04-10 22:41:42'),
(13, 'Trina', 'Tan', 'trinatan', 'password', 'trinavtan@gmail.com', '2014-04-16 21:14:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
