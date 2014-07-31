-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2014 at 10:42 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eventapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `userapps`
--

CREATE TABLE IF NOT EXISTS `userapps` (
  `usr_email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `usr_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usr_lname` varchar(50) NOT NULL,
  `usr_fname` varchar(100) NOT NULL,
  `Facebook_ID` bigint(20) NOT NULL,
  `profil_link` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `picture_link` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `confirm_code` int(10) unsigned NOT NULL,
  `confirmed` int(11) NOT NULL,
  PRIMARY KEY (`Facebook_ID`),
  KEY `Facebook_ID` (`Facebook_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userapps`
--

INSERT INTO `userapps` (`usr_email`, `password`, `usr_created`, `usr_lname`, `usr_fname`, `Facebook_ID`, `profil_link`, `birthday`, `location`, `gender`, `picture_link`, `confirm_code`, `confirmed`) VALUES
('someonePublic', '0', '2014-07-19 16:00:32', 'Public', 'Person', 1, '', NULL, '', '', 'default.jpg', 0, 0),
('', '0', '2014-07-21 00:31:05', 'def', 'ede', 11, '', NULL, '', '', 'default.jpg', 0, 0),
('', '0', '2014-07-20 23:08:21', 'dddd', 'dddd', 12, '', NULL, '', '', 'default.jpg', 0, 0),
('', '0', '2014-07-20 23:08:50', '22', '22', 22, '', NULL, '', '', 'default.jpg', 0, 0),
('', '0', '2014-07-20 23:08:44', 'SSS', 'SSS', 33, '', NULL, '', '', 'default.jpg', 0, 0),
('', '0', '2014-07-20 23:08:29', 'AAA', 'AAA', 34, '', NULL, '', '', 'default.jpg', 0, 0),
('someone@test.co', '0', '2014-07-31 19:49:18', 'test232', 'test123', 41384774, '', NULL, '', '', 'default.jpg', 722613783, 1),
('test@text.c2', '202', '2014-07-31 20:42:03', 'll', 'ali', 809539304, '', NULL, '', '', 'default.jpg', 1000442198, 0),
('test@text.c', '0', '2014-07-31 20:39:26', 'll', 'ali', 869789620, '', NULL, '', '', 'default.jpg', 1000494698, 0),
('elabridiali@gmail.com', '0', '2014-07-31 20:27:12', 'Elabridi', 'Ali', 268310453348365, 'https://www.facebook.com/app_scoped_user_id/268310453348365/', '1990-05-31', 'Ifrane, Morocco', 'male', '', 0, 1),
('elabridiali@live.fr', '0', '0000-00-00 00:00:00', 'El', 'Ali', 753896647975714, 'https://www.facebook.com/app_scoped_user_id/753896647975714/', '1950-05-31', 'Rabat, Morocco', '', '252231_1002029915278_1941483569_n_1.jpg', 0, 0),
('teensdoor@gmail.com', '0', '0000-00-00 00:00:00', 'Eddahmani', 'Aymane', 880152931994714, 'https://www.facebook.com/app_scoped_user_id/880152931994714/', '1995-10-16', 'Midelt', '', '10513356_906096386067035_156912104903362139_n.jpg', 0, 0),
('s.a.idriss@hotmail.fr', '0', '2014-07-14 00:26:53', 'sss', 'Don', 10202951483540580, 'https://www.facebook.com/app_scoped_user_id/10202951483540580/', '1970-01-01', 'Kenitra, Morocco', 'male', '10202951483540580.jpg', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
