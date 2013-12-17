-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2013 at 03:37 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `cat_and_pro`
--

INSERT INTO `cat_and_pro` (`Pro_id`, `Cat_id`) VALUES
(1, 2),
(1, 5),
(1, 8),
(1, 9),
(2, 2),
(2, 6),
(3, 2),
(3, 4),
(3, 5),
(3, 7),
(3, 8),
(5, 10),
(6, 1),
(6, 4),
(6, 5),
(6, 6),
(6, 7),
(6, 11),
(8, 2),
(9, 2),
(10, 2),
(10, 5),
(10, 11),
(11, 2),
(15, 6),
(17, 2),
(22, 5),
(25, 9),
(26, 2);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `Img_id` int(11) NOT NULL AUTO_INCREMENT,
  `Pro_id` int(11) NOT NULL,
  `Url` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Img_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

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
(9, 3, 'public/backend/images/Chrysanthemum.jpg'),
(10, 8, 'public/backend/images/3348_aa.jpg'),
(11, 8, 'public/backend/images/6279_aa.jpg'),
(12, 8, 'public/backend/images/5482_aa.jpg'),
(13, 8, 'public/backend/images/8432_aa.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Pro_id`, `Name`, `Price`, `Description`, `Quantity`, `Status`, `Thumb`) VALUES
(1, 'Pro1', 12, 'haha', 0, 1, 'public/backend/images/lt-leo-hitech-600x1068.jpg'),
(2, 'Pro2', 12, '12', 12, 1, 'public/backend/images/hhhh.png'),
(3, 'pro3', 231, '21', 121, 1, 'public/backend/images/quanao.jpg'),
(4, 'Pro 3', 12, 'ffdfd', 121, 1, 'public/backend/images/ssss.jpg'),
(5, 'pro4', 21, '221', 121, 1, 'public/backend/images/33333333333.jpg'),
(6, 'Pro 6', 54, '545', 54, 1, 'public/backend/images/1111.jpg'),
(7, 'sdd', 0, '', 1, 1, 'public/backend/images/4444444444.jpg'),
(8, 'Nokia lumia', 123, 'Lumia 520 sẽ nằm trong phân khúc smartphone tầm trung bình thấp với màn hình 4 inch dùng công nghệ Super Sensitive Touch (cho phép người dùng thao tác bằng cả găng tay dày), chip lõi kép tốc độ 1 GHz, RAM 512 MB và dung lượng lưu trữ trong 8 GB. Lumia 520 hỗ trợ khe cắm thẻ nhớ ngoài, camera sau 5 megapixel và không có camera trước. Trong khi đó, Lumia 720 sở hữu cấu hình gần như tương đồng với Lumia 520 nhưng dùng camera sau 6 megapixel, màn hình 4,3 inch và được tích hợp camera 2 megapixel phía trước.', 123, 1, 'public/backend/images/HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(9, 'pro 8', 23, 'dcsfvds', 12, 1, 'public/backend/images/5852_HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(10, 'Pro 234', 434, 'hgnf', 12, 1, 'public/backend/images/4444_HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(11, 'Pro1324', 3232, '33435r', 21, 1, 'public/backend/images/5702_HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(12, 'Nokia lumia4354', 43, 'fsgfds', 12, 1, 'public/backend/images/1341_HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(13, 'Nokia lumia 43', 21, '213edq', 21, 1, 'public/backend/images/9682_HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(14, 'Nokia lumia 3213', 34, 'savcdsv', 2121, 1, 'public/backend/images/4239_HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(15, 'Nokia lumia232', 332, 'rewt4fds', 32, 1, 'public/backend/images/6396_HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(16, 'Nokia lumia43t', 33, 'scdsfcds', 43, 1, 'public/backend/images/9941_HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(17, 'Nokia lumia45465', 54, 'fdfd', 12, 1, 'public/backend/images/6529_HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(18, 'Nokia lumia545', 32, 'dbhgfdbfds', 23, 1, 'public/backend/images/2093_HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(19, 'Nokia lumia32r', 43, 'fvdsvgfd', 32, 1, 'public/backend/images/3621_HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(20, 'Nokia lumia32r', 0, 'w', 0, 1, 'public/backend/images/1506_HT_nokia_lumia1020_jef_130711_16x9_992.jpg'),
(21, 'Nokia lumia56', 32, 'gfdsxfd', 0, 1, 'public/backend/images/aa.jpg'),
(22, 'Nokia lumia4535', 35, 'dsàv', 0, 1, 'public/backend/images/6788_aa.jpg'),
(23, 'Nokia lumia th', 32, 'vfdsg', 12, 1, 'public/backend/images/6269_aa.jpg'),
(24, 'Nokia lumia 3234', 345, 'gfdfds', 12, 1, 'public/backend/images/2709_aa.jpg'),
(25, 'Nokia lumia32t', 34, 'sagfdshgfdhg', 0, 1, 'public/backend/images/4966_aa.jpg'),
(26, 'Nokia lumia32ghh', 12, 'fdsgfds', 12, 1, 'public/backend/images/4581_aa.jpg');

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
