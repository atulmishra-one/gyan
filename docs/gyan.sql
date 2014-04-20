-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2014 at 08:11 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `qty`, `status`, `date_added`) VALUES
(1, 'Milk', 20.0000, 20, 'Active', '2014-04-20 22:43:26'),
(5, 'Dahi', 14.0000, 6, 'Active', '2014-04-20 22:52:53');

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
(13, 'atulmishra.one@gmail.com', '500c425e36e2681d64794c38e70d39f3', 'Atul Mishra', 'Inactive', '2014-04-20 12:55:04', 4);

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
