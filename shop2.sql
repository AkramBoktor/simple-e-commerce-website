-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2018 at 10:05 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
`cat_id` int(11) NOT NULL,
  `catname` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `visibe` tinyint(4) NOT NULL DEFAULT '0',
  `allow_comment` tinyint(4) DEFAULT '0',
  `allow_ads` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `catname`, `description`, `ordering`, `visibe`, `allow_comment`, `allow_ads`) VALUES
(7, 'Toys', 'this toys for every childern', 2, 1, 1, 0),
(8, 'private', 'this pc is cost $50', 3, 1, 1, 1),
(9, 'PlayStation5', 'this play Station 4', 4, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `add_date` date NOT NULL,
  `country_made` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `description`, `price`, `add_date`, `country_made`, `image`, `status`, `rating`, `cat_id`, `user_id`) VALUES
(3, 'Mobile Samsung', 'this pc is cost $50', 'cost 50 $', '0000-00-00', 'Tokeya', '', 'Used', 0, 8, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT 'identify user or admin',
  `trust_status` int(11) NOT NULL DEFAULT '0',
  `reg_status` int(11) NOT NULL DEFAULT '0',
  `Date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `fullname`, `group_id`, `trust_status`, `reg_status`, `Date`) VALUES
(1, 'akram', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'akram.boktor@hotmail.com', 'akramboktor', 1, 1, 1, '0000-00-00'),
(3, 'Ahmed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Ahmed@yahoo.com', 'Ahmed Mohmed', 0, 0, 1, '2018-01-11'),
(6, 'Asma123', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Asma@outlook.com', 'Asma.b.ibrahim', 0, 0, 1, '2018-01-12'),
(7, 'Abanoub', 'b3c0730cf3f50613e40561e67c871fdb92820cf9', 'Abanoup@hotmail.com', 'Abanoub Ibrahim', 0, 0, 0, '2018-01-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
 ADD PRIMARY KEY (`cat_id`), ADD UNIQUE KEY `catname` (`catname`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`item_id`), ADD UNIQUE KEY `name` (`name`), ADD KEY `member_1` (`user_id`), ADD KEY `cat_1` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
ADD CONSTRAINT `cat_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `member_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
