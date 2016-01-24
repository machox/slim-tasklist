-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 23, 2016 at 04:32 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tasklist`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `user_id`, `name`, `description`, `created_at`) VALUES
(1, 1, 'task pertama', 'ini task pertama', '2016-01-23 02:24:48'),
(2, 1, 'task kedua', 'ini task kedua', '2016-01-23 07:21:35'),
(3, 1, 'task ketiga', 'ini task ketiga', '2016-01-23 07:22:13'),
(4, 1, 'task keempat', 'ini task keempat', '2016-01-23 07:24:08'),
(5, 2, 'task kesatu', 'ini task kesatu', '2016-01-23 07:34:12'),
(6, 2, 'task kesatu', 'ini task kesatu', '2016-01-23 07:38:35');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `api_key`, `created_at`) VALUES
(1, 'bayu@bayu.com', 'a4bcc7b4cc573b022860dcca0da01f28e2eccdde', '2402a377f193f1cb82a5c9847562c05536d19d15', '2016-01-22 17:30:42'),
(2, 'joko@joko.com', 'bd309238509e2e9d9f92fd6c3717dba5c31c2935', '40229ff780438bf20b53c529e4ab2c633559a572', '2016-01-22 17:32:56'),
(3, 'budi@budi.com', '0054e679f1d4ccdf95436ec0a30f4d737ad5dae7', 'e528376124a17628745735d735a78db30250b830', '2016-01-23 02:13:25'),
(4, 'indah@indah.com', '844efe5def6a897f8b5552433d954f968078bbe0', '5ddb1dda2300d6412f8aecb46cbdcf38d8ad6384', '2016-01-23 02:14:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
