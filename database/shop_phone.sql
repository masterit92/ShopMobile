-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2013 at 04:57 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop_phone`
--
CREATE DATABASE IF NOT EXISTS `shop_phone` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `shop_phone`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `Cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Parent_id` int(11) NOT NULL,
  `Status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Cat_id`, `Name`, `Parent_id`, `Status`) VALUES
(1, 'Featured phones', 0, 1),
(2, 'Smart phones', 0, 1),
(4, 'Accessories', 0, 1),
(5, 'Sales', 1, 1),
(6, 'Main stream', 2, 1),
(7, 'Luxury', 2, 1),
(8, 'Sales', 2, 1),
(9, 'Android', 6, 1),
(10, 'iOS', 6, 1),
(11, 'Others', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cat_and_pro`
--

CREATE TABLE IF NOT EXISTS `cat_and_pro` (
  `Pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `Cat_id` int(11) NOT NULL,
  PRIMARY KEY (`Pro_id`,`Cat_id`),
  UNIQUE KEY `Pro_id` (`Pro_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `Img_id` int(11) NOT NULL AUTO_INCREMENT,
  `Pro_id` int(11) NOT NULL,
  `Url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `Status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Img_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `Pro_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Price` float NOT NULL,
  `Description` longtext COLLATE utf8_unicode_ci,
  `Quantity` int(11) NOT NULL DEFAULT '1',
  `Status` smallint(6) NOT NULL DEFAULT '1',
  `Thumb` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`Pro_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Pro_id`, `Name`, `Price`, `Description`, `Quantity`, `Status`, `Thumb`) VALUES
(1, 'Pro1', 12, NULL, 1, 1, 'thum1');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `Role_id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`Role_id`, `Name`, `Status`) VALUES
(1, 'admin', 1),
(3, 'product', 1),
(5, 'user', 1),
(6, 'category', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_and_user`
--

CREATE TABLE IF NOT EXISTS `role_and_user` (
  `User_id` int(11) NOT NULL,
  `Role_id` int(11) NOT NULL,
  PRIMARY KEY (`User_id`,`Role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_and_user`
--

INSERT INTO `role_and_user` (`User_id`, `Role_id`) VALUES
(2, 1),
(3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `User_id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `Full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Status` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`User_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_id`, `Email`, `Password`, `Full_name`, `Status`) VALUES
(2, 'demo@gmail.com', '1234567', 'Mod', 1),
(3, 'binhpt', '1234567', 'HAHA', 1),
(4, 'user@gmail.com', '1234567', 'User', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
