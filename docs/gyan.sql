-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2014 at 11:50 AM
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
  `supplied` enum('Yes','No') NOT NULL DEFAULT 'No',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `demands`
--

INSERT INTO `demands` (`id`, `title`, `details`, `product_id`, `caret`, `distributors_id`, `added_by`, `modified_by`, `forward`, `approved`, `supplied`, `date_added`) VALUES
(1, 'Full cream milk 1ltr for Deoria', '5 carat Full cream milk for deoria route ok', 1, 5, 4, 6, '14', 'Yes', 0, 'No', '2014-04-26 14:02:43'),
(2, 'Milk Toned', 'Needed toned milk', 2, 5, 4, 8, '', 'Yes', 1, 'No', '2014-04-26 14:39:48');

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
  `mrp` decimal(18,2) NOT NULL,
  `fact_price` decimal(18,2) NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `discount` decimal(18,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `mrp`, `fact_price`, `price`, `discount`, `qty`, `status`, `date_added`) VALUES
(1, 'Full cream milk 1tr', 23.00, 21.00, 276.00, 10.00, 10, 'Active', '2014-04-26 13:35:41'),
(2, 'Toned Milk 1/2 ltr', 18.00, 17.00, 216.00, 6.00, 5, 'Active', '2014-04-26 13:37:25');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `status`, `date_added`, `type`) VALUES
(6, 'admin@gyan.com', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'Active', '2014-04-20 11:49:20', 1),
(7, 'headoffice@gyan.com', 'b9531b4f130c39bbff268010e61d5f23', 'Head office', 'Active', '2014-04-20 11:53:09', 2),
(8, 'areamanager@gyan.com', '1aaff3fcd99f7a3b3bb5bb96982641d2', 'Area Manager', 'Active', '2014-04-20 11:54:02', 3),
(9, 'account@gyan.com', 'e268443e43d93dab7ebef303bbe9642f', 'Account Department', 'Active', '2014-04-20 11:56:21', 5),
(14, 'plant@gyan.com', '9ea0a36b3a20901fafe834eb519a595c', 'Plant', 'Active', '2014-04-26 14:00:26', 4);

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
