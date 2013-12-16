-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2013 at 05:26 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

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
  PRIMARY KEY (`Pro_id`,`Cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cat_and_pro`
--

INSERT INTO `cat_and_pro` (`Pro_id`, `Cat_id`) VALUES
(1, 2),
(1, 5),
(1, 8),
(1, 9),
(2, 2),
(2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `Img_id` int(11) NOT NULL AUTO_INCREMENT,
  `Pro_id` int(11) NOT NULL,
  `Url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`Img_id`, `Pro_id`, `Url`) VALUES
(1, 1, 'public/backend/images/oscommerce_template_0171_M.jpg'),
(2, 1, 'public/backend/images/6605_88888888888.jpg'),
(3, 1, 'public/backend/images/7777777777777.jpg'),
(5, 2, '222222'),
(6, 3, 'public/backend/images/lt-leo-hitech-600x1068.jpg'),
(7, 3, 'public/backend/images/4673_oscommerce_template_0171_M.jpg'),
(8, 3, 'public/backend/images/3323_lt-leo-hitech-600x1068.jpg'),
(9, 3, 'public/backend/images/Chrysanthemum.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Pro_id`, `Name`, `Price`, `Description`, `Quantity`, `Status`, `Thumb`) VALUES
(1, 'Pro1', 12, 'haha', 1, 1, 'public/backend/images/lt-leo-hitech-600x1068.jpg'),
(2, 'Pro2', 12, '12', 12, 1, 'public/backend/images/hhhh.png'),
(3, 'pro3', 231, '21', 121, 1, 'public/backend/images/quanao.jpg'),
(4, 'Pro 3', 12, 'ffdfd', 121, 1, 'public/backend/images/ssss.jpg'),
(5, 'pro4', 21, '221', 121, 1, 'public/backend/images/33333333333.jpg'),
(6, 'Pro 6', 54, '545', 54, 1, 'public/backend/images/1111.jpg'),
(7, 'sdd', 0, '', 1, 1, 'public/backend/images/4444444444.jpg');

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
(2, 'demo@gmail.com', '1234567', 'Phan The Binh', 1),
(3, 'binhpt', '1234567', 'HAHAhas', 1),
(4, 'user@gmail.com', '1234567', 'User', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
