-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2014 at 03:29 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gyan`
--

-- --------------------------------------------------------

--
-- Table structure for table `demands`
--

CREATE TABLE IF NOT EXISTS `demands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `details` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `caret` int(11) NOT NULL,
  `distributors_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `modified_by` varchar(128) NOT NULL,
  `forward` enum('Yes','No') NOT NULL DEFAULT 'No',
  `approved` int(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `demands`
--

INSERT INTO `demands` (`id`, `title`, `details`, `product_id`, `caret`, `distributors_id`, `added_by`, `modified_by`, `forward`, `approved`, `date_added`) VALUES
(9, 'Milk', 'Milk needed', 5, 6, 4, 6, '', 'Yes', 1, '2014-04-22 23:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE IF NOT EXISTS `distributors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `initial_name` varchar(12) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` enum('Active','Inactive') CHARACTER SET utf8 COLLATE utf8_bin DEFAULT 'Inactive',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`id`, `initial_name`, `name`, `email`, `contact_no`, `address`, `status`) VALUES
(4, 'Mr', 'Atul Mishra', 'atulmishra.one@gmail.com', '9654586130', 'Nodia sector 66', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `price` decimal(18,4) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `qty`, `status`, `date_added`) VALUES
(5, 'Dahi', 14.0000, 6, 'Active', '2014-04-20 22:52:53'),
(6, 'Milk', 500.0000, 20, 'Active', '2014-04-24 18:56:31'),
(7, 'Paneer', 400.0000, 100, 'Active', '2014-04-24 18:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(128) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `date_added` datetime NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `status`, `date_added`, `type`) VALUES
(6, 'admin@gyan.com', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Active', '2014-04-20 11:49:20', 1),
(7, 'headoffice@gyan.com', 'b9531b4f130c39bbff268010e61d5f23', 'Head office', 'Active', '2014-04-20 11:53:09', 2),
(8, 'areamanager@gyan.com', '1aaff3fcd99f7a3b3bb5bb96982641d2', 'Area Manager', 'Active', '2014-04-20 11:54:02', 3),
(9, 'account@gyan.com', 'e268443e43d93dab7ebef303bbe9642f', 'Account Department', 'Active', '2014-04-20 11:56:21', 5),
(13, 'atulmishra.one@gmail.com', 'c48a62bd2a2ac2db21bcd1b77f1a04d8', 'Atul Mishra', 'Active', '2014-04-24 18:43:34', 4);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'ADMIN'),
(2, 'HEAD_OFFICE'),
(3, 'AREA_MANAGER'),
(4, 'PLANT'),
(5, 'ACCOUNT_DEPARTMENT');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
