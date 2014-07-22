-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 21 Juillet 2014 à 18:08
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `eventapp`
--
CREATE DATABASE IF NOT EXISTS `eventapp` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `eventapp`;

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chat_user_sender` bigint(20) NOT NULL,
  `chat_user_receiver` bigint(20) NOT NULL,
  `chat_message` text NOT NULL,
  `chat_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`chat_id`),
  KEY `chat_user_sender` (`chat_user_sender`,`chat_user_receiver`),
  KEY `chat_user_receiver` (`chat_user_receiver`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`chat_id`, `chat_user_sender`, `chat_user_receiver`, `chat_message`, `chat_time`) VALUES
(1, 10202951483540580, 268310453348365, 'hey', '2014-07-14 18:15:50'),
(2, 10202951483540580, 268310453348365, 'coucou', '2014-07-14 18:17:04'),
(3, 10202951483540580, 268310453348365, 'sire', '2014-07-14 18:30:43'),
(4, 10202951483540580, 268310453348365, 'daba chnou tssalawlike :p??', '2014-07-14 18:30:52'),
(5, 10202951483540580, 268310453348365, 'so?', '2014-07-14 18:32:34'),
(6, 10202951483540580, 268310453348365, 'daba?', '2014-07-14 18:32:43'),
(7, 10202951483540580, 268310453348365, 'okay', '2014-07-14 18:33:10'),
(8, 10202951483540580, 268310453348365, 'teyyarra', '2014-07-14 23:50:26'),
(9, 10202951483540580, 268310453348365, 'as socrate said the truth is not existant', '2014-07-14 23:51:01'),
(10, 268310453348365, 10202951483540580, 'siire ten3ass', '2014-07-14 23:51:30'),
(11, 10202951483540580, 268310453348365, 'n3ass hire nta, hitach ana weld goku hgd,ejzhgdhzej,gdhzjegdhzjgefdhzfhexdnfezhghgtedxhyzeghgxchjezgdxchjzegdxehjzgxhjezgxhjegzxhjgzehjgxhzejgxhezjgxhejzgxhjzegxzehjxgzehj', '2014-07-14 23:52:00'),
(12, 10202951483540580, 268310453348365, 'afine', '2014-07-15 00:33:42'),
(13, 753896647975714, 10202951483540580, 'salam', '2014-07-15 01:06:56'),
(14, 10202951483540580, 880152931994714, 'afine??', '2014-07-15 01:07:12'),
(15, 10202951483540580, 753896647975714, '3alaykomo salam', '2014-07-15 01:09:09'),
(16, 10202951483540580, 880152931994714, 'afine anta dwi', '2014-07-15 23:08:52'),
(17, 880152931994714, 10202951483540580, 'ca va :p', '2014-07-15 23:21:47'),
(18, 10202951483540580, 880152931994714, 'lhamdoullah ^^', '2014-07-15 23:22:02'),
(19, 10202951483540580, 268310453348365, 'anta dwi', '2014-07-17 23:11:39'),
(20, 10202951483540580, 268310453348365, 'anta fine', '2014-07-17 23:12:47'),
(21, 10202951483540580, 880152931994714, 'okay', '2014-07-17 23:12:53'),
(22, 10202951483540580, 753896647975714, 'afine sate', '2014-07-18 00:56:02'),
(23, 268310453348365, 10202951483540580, 'heeyy!!', '2014-07-18 00:56:30'),
(24, 10202951483540580, 268310453348365, 'bikhire??', '2014-07-18 00:56:47'),
(25, 10202951483540580, 880152931994714, 'affine', '2014-07-18 17:15:20'),
(26, 10202951483540580, 268310453348365, 'okau', '2014-07-19 01:41:02'),
(27, 10202951483540580, 753896647975714, 'shoufe', '2014-07-19 01:41:10'),
(28, 10202951483540580, 880152931994714, 'c bon', '2014-07-19 01:41:21'),
(29, 10202951483540580, 268310453348365, 'okayy', '2014-07-19 01:46:07'),
(30, 10202951483540580, 268310453348365, 'c bon it works man :)', '2014-07-19 02:20:28'),
(31, 10202951483540580, 268310453348365, 'hey ca va??', '2014-07-19 02:34:36'),
(32, 10202951483540580, 753896647975714, 'chnou bari??', '2014-07-19 02:34:42'),
(33, 10202951483540580, 880152931994714, 'coucou', '2014-07-19 02:34:47'),
(34, 10202951483540580, 880152931994714, 'wajaweb a ssahbi ^^', '2014-07-19 02:35:03'),
(35, 10202951483540580, 268310453348365, 'okay', '2014-07-19 02:36:25'),
(36, 10202951483540580, 268310453348365, 'hey ca va?', '2014-07-19 03:43:32'),
(37, 10202951483540580, 268310453348365, 'hey', '2014-07-19 04:42:10'),
(38, 10202951483540580, 268310453348365, 'afine', '2014-07-19 04:42:47'),
(39, 10202951483540580, 268310453348365, 'hey', '2014-07-19 15:14:07'),
(40, 10202951483540580, 880152931994714, 'coucou', '2014-07-19 15:19:27'),
(41, 10202951483540580, 268310453348365, 'hello', '2014-07-19 15:21:33'),
(42, 10202951483540580, 268310453348365, 'hey', '2014-07-19 15:31:12'),
(43, 10202951483540580, 268310453348365, 'coucou', '2014-07-19 15:31:23'),
(44, 10202951483540580, 268310453348365, 'key', '2014-07-19 15:31:48'),
(45, 10202951483540580, 880152931994714, 'afine', '2014-07-19 15:43:29'),
(46, 10202951483540580, 268310453348365, 'coucou', '2014-07-19 15:44:22'),
(47, 10202951483540580, 880152931994714, 'hey', '2014-07-19 15:47:58'),
(48, 10202951483540580, 753896647975714, 'efine', '2014-07-19 15:50:49'),
(49, 10202951483540580, 22, 'malek khayeb??', '2014-07-21 00:29:51'),
(50, 10202951483540580, 22, 'eded', '2014-07-21 00:31:53'),
(51, 10202951483540580, 22, 'ed', '2014-07-21 00:31:53'),
(52, 10202951483540580, 22, 'e', '2014-07-21 00:31:54'),
(53, 10202951483540580, 22, 'd', '2014-07-21 00:31:54'),
(54, 10202951483540580, 22, 'e', '2014-07-21 00:31:54'),
(55, 10202951483540580, 12, 'hder assahbi', '2014-07-21 01:35:41');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_name` varchar(100) NOT NULL,
  `event_time` time NOT NULL,
  `event_date` date NOT NULL,
  `usr_create` bigint(20) NOT NULL,
  `event_place` varchar(100) NOT NULL,
  `event_pic` varchar(150) NOT NULL,
  `event_description` text NOT NULL,
  `event_cat` bigint(20) NOT NULL,
  `event_type` varchar(100) NOT NULL,
  PRIMARY KEY (`event_id`),
  KEY `usr_create` (`usr_create`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Contenu de la table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_time`, `event_date`, `usr_create`, `event_place`, `event_pic`, `event_description`, `event_cat`, `event_type`) VALUES
(74, 'this is no longuer shit shit', '12:12:00', '2014-07-16', 10202951483540580, 'HTIS nnoqsdnsq', '74.jpg', 'SWDWSWSDSW', 12, 'Public'),
(77, 'jqdqks', '12:12:00', '2014-07-14', 10202951483540580, 'somwhere in the sky', '77.jpg', 'here', 18, 'Public'),
(79, 'this is not 74 it is 79', '12:12:00', '2014-07-14', 268310453348365, 'HTIS nnoqsdnsq', '79.jpg', 'SWDWSWSDSW', 12, 'Public'),
(84, 'wcwx', '12:12:00', '2014-07-18', 268310453348365, 'FERD', '12.jpg', 'sqdsqdsq', 12, 'Public'),
(85, 'hello peopole derti', '12:12:00', '2014-07-18', 10202951483540580, 'casablanca', '85.jpg', 'walou', 18, 'Private'),
(89, 'hello', '12:12:00', '2014-07-18', 10202951483540580, 'somewhere', '89.jpg', 'heey', 18, 'Private'),
(90, 'A public person posted this', '12:12:12', '2014-07-19', 1, 'PUBLIC PLACE', '74.jpg', 'PUBLIC PUBLICATION', 12, 'Public');

-- --------------------------------------------------------

--
-- Structure de la table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `feedback_event_id` int(11) unsigned NOT NULL,
  `feedback_user_id` bigint(20) NOT NULL,
  `feedback_message` text NOT NULL,
  `feedback_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`feedback_id`),
  KEY `feedback_user_id` (`feedback_user_id`),
  KEY `feedback_event_id` (`feedback_event_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Contenu de la table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `feedback_event_id`, `feedback_user_id`, `feedback_message`, `feedback_time`) VALUES
(1, 77, 10202951483540580, 'this is my first oppinion of this', '2014-07-17 17:22:56'),
(2, 77, 10202951483540580, 'again', '2014-07-17 18:42:14'),
(3, 77, 753896647975714, '3andek allah9e a BA kakashi', '2014-07-17 18:43:45'),
(4, 74, 10202951483540580, 'okaay', '2014-07-17 23:15:47'),
(5, 74, 10202951483540580, 'so this seems interesting', '2014-07-17 23:18:01'),
(6, 84, 10202951483540580, 'waaw great', '2014-07-18 01:11:32'),
(7, 84, 10202951483540580, 'extreemly great', '2014-07-18 01:11:39'),
(8, 89, 10202951483540580, 'welcome guys in my event', '2014-07-18 18:50:02'),
(9, 74, 10202951483540580, 'hhsd', '2014-07-21 00:28:54'),
(10, 74, 10202951483540580, 'dsfds', '2014-07-21 00:28:55'),
(11, 74, 10202951483540580, 'sdfd', '2014-07-21 00:28:56'),
(12, 74, 10202951483540580, 'sdfdsdsfds', '2014-07-21 00:28:57'),
(13, 74, 10202951483540580, 'sdfsdf', '2014-07-21 00:28:58'),
(14, 74, 10202951483540580, 'hihi', '2014-07-21 00:42:08'),
(15, 74, 10202951483540580, 'hoho', '2014-07-21 00:42:10'),
(16, 74, 10202951483540580, 'ijlzdez', '2014-07-21 00:42:11'),
(17, 74, 10202951483540580, 'ezd', '2014-07-21 00:42:12'),
(18, 74, 10202951483540580, 'ezdez', '2014-07-21 00:42:13'),
(19, 74, 10202951483540580, 'ezdezd', '2014-07-21 00:42:13'),
(20, 74, 10202951483540580, 'ezdezdezd', '2014-07-21 00:42:13'),
(21, 74, 10202951483540580, 'ezdezdezdez', '2014-07-21 00:42:13'),
(22, 74, 10202951483540580, 'ezdezdezdezedd', '2014-07-21 00:42:13'),
(23, 74, 10202951483540580, 'ezd', '2014-07-21 00:42:14'),
(24, 74, 10202951483540580, 'zed', '2014-07-21 00:42:14'),
(25, 74, 10202951483540580, 'zed', '2014-07-21 00:42:15'),
(26, 74, 10202951483540580, 'ezd', '2014-07-21 00:42:15'),
(27, 74, 10202951483540580, 'ezd', '2014-07-21 00:42:16'),
(28, 74, 10202951483540580, 'ezd', '2014-07-21 00:42:16'),
(29, 74, 10202951483540580, 'ezd', '2014-07-21 00:42:17'),
(30, 74, 10202951483540580, 'ezd', '2014-07-21 00:42:17'),
(31, 74, 10202951483540580, 'ezdez', '2014-07-21 00:42:17');

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_event_id` int(11) unsigned NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_link` varchar(50) NOT NULL,
  `usr_upload` bigint(20) NOT NULL,
  PRIMARY KEY (`file_id`),
  KEY `file_event_id` (`file_event_id`),
  KEY `file_event_id_2` (`file_event_id`),
  KEY `usr_upload` (`usr_upload`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Contenu de la table `files`
--

INSERT INTO `files` (`file_id`, `file_event_id`, `file_name`, `file_link`, `usr_upload`) VALUES
(21, 85, 'Global Community Leadership Council 2014-2015 - Final.pdf', '1.pdf', 10202951483540580),
(22, 85, 'Girls Education.pdf', '8522.pdf', 10202951483540580),
(24, 85, 'SaidAlaouiIdriss_Algorith_Paper.pdf', '8523.pdf', 10202951483540580),
(25, 85, 'SaidAlaoui_Resume.pdf', '8525.pdf', 10202951483540580),
(26, 74, 'Cracking the Coding Interview, 4 Edition - 150 Programming Interview Questions and Solutions.pdf', '7426.pdf', 10202951483540580),
(27, 74, 'SaidAlaoui_Resume.pdf', '7427.pdf', 10202951483540580),
(28, 74, 'SaidAlaoui_Resume.pdf', '7428.pdf', 10202951483540580),
(29, 74, 'SaidAlaoui_Resume.pdf', '7429.pdf', 10202951483540580),
(30, 74, 'SaidAlaoui_Resume.pdf', '7430.pdf', 10202951483540580),
(31, 74, 'SaidAlaoui_Resume.pdf', '7431.pdf', 10202951483540580),
(32, 74, 'SaidAlaoui_Resume.pdf', '7432.pdf', 10202951483540580),
(33, 74, 'SaidAlaoui_Resume.pdf', '7433.pdf', 10202951483540580);

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `user_me` bigint(20) NOT NULL,
  `last_chat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sent_chat` varchar(5) NOT NULL DEFAULT 'no',
  `user_other` bigint(20) NOT NULL,
  `friend_request` varchar(50) NOT NULL DEFAULT 'Friends',
  PRIMARY KEY (`user_me`,`user_other`),
  KEY `user_1` (`user_me`,`user_other`),
  KEY `user_1_2` (`user_me`),
  KEY `user_2` (`user_other`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `friends`
--

INSERT INTO `friends` (`user_me`, `last_chat`, `sent_chat`, `user_other`, `friend_request`) VALUES
(11, '2014-07-21 18:04:46', 'no', 10202951483540580, 'Friends'),
(268310453348365, '2014-07-19 15:44:22', 'yes', 10202951483540580, 'Friends'),
(753896647975714, '2014-07-19 15:50:49', 'yes', 10202951483540580, 'Friends'),
(10202951483540580, '2014-07-21 18:06:51', 'no', 11, 'Friends'),
(10202951483540580, '2014-07-19 15:30:00', 'no', 268310453348365, 'Friends'),
(10202951483540580, '2014-07-19 15:50:49', 'no', 753896647975714, 'Friends'),
(10202951483540580, '2014-07-19 15:47:58', 'no', 880152931994714, 'Friends');

-- --------------------------------------------------------

--
-- Structure de la table `interests`
--

CREATE TABLE IF NOT EXISTS `interests` (
  `interest_id` int(11) NOT NULL AUTO_INCREMENT,
  `interest_name` varchar(50) NOT NULL,
  `interest_score` int(11) NOT NULL,
  PRIMARY KEY (`interest_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Contenu de la table `interests`
--

INSERT INTO `interests` (`interest_id`, `interest_name`, `interest_score`) VALUES
(10, 'haha', 0),
(11, 'Hike', 0),
(12, 'Football', 3),
(13, 'something special', 0),
(14, 'ziide', 3),
(16, 'Teniss', 0),
(17, 'Tennis', 0),
(18, 'Counter Strike', 1),
(19, 'kora', 0),
(20, 'something', 0),
(21, 'TEST1', 0),
(22, 'TEST3', 0),
(23, 'TEST2', 0),
(24, 'TES4', 0),
(25, 'SQD', 0),
(26, 'SQDS', 0),
(27, 'DQS', 0),
(28, 'SQDSQD', 0),
(29, 'DSSQDQ', 0),
(30, 'SQDQSDSQ', 0),
(31, 'SDQSQD', 0),
(32, 'fer', 0);

-- --------------------------------------------------------

--
-- Structure de la table `joinevents`
--

CREATE TABLE IF NOT EXISTS `joinevents` (
  `joinevent_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_id` int(10) unsigned NOT NULL,
  `usr_id` bigint(20) NOT NULL,
  PRIMARY KEY (`joinevent_id`),
  KEY `event_id` (`event_id`,`usr_id`),
  KEY `usr_id` (`usr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Contenu de la table `joinevents`
--

INSERT INTO `joinevents` (`joinevent_id`, `event_id`, `usr_id`) VALUES
(15, 77, 10202951483540580),
(13, 79, 10202951483540580),
(16, 79, 10202951483540580),
(12, 84, 10202951483540580),
(17, 84, 10202951483540580),
(18, 85, 10202951483540580),
(19, 89, 10202951483540580),
(20, 90, 10202951483540580);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_title` varchar(100) NOT NULL,
  `notification_user` bigint(20) NOT NULL,
  `notification_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notification_image` varchar(50) NOT NULL,
  `event_id` int(10) unsigned DEFAULT NULL,
  `sender_id` bigint(20) DEFAULT NULL,
  `notification_status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `notification_user` (`notification_user`),
  KEY `event_id` (`event_id`,`sender_id`),
  KEY `sender_id` (`sender_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Contenu de la table `notification`
--

INSERT INTO `notification` (`notification_id`, `notification_title`, `notification_user`, `notification_time`, `notification_image`, `event_id`, `sender_id`, `notification_status`) VALUES
(35, 'someone calling', 10202951483540580, '2014-07-18 20:43:00', '85.jpg', 85, NULL, 'old'),
(36, 'again calling you', 10202951483540580, '2014-07-18 20:33:00', '85.jpg', 85, NULL, 'old'),
(37, 'NOTIF', 10202951483540580, '2014-07-20 19:36:45', '', 74, NULL, 'old'),
(38, 'hey lool', 10202951483540580, '2014-07-20 19:38:08', '', 77, NULL, 'old'),
(39, 'coucou', 10202951483540580, '2014-07-20 19:38:31', '77.jpg', 77, NULL, 'old'),
(40, 'lool', 10202951483540580, '2014-07-20 19:39:03', '77.jpg', 77, NULL, 'old'),
(41, 'titou', 10202951483540580, '2014-07-20 19:39:03', '85', 85, NULL, 'old'),
(42, 'Kakashi Don invited you to pike this is no longuer shit shit', 1, '2014-07-21 01:16:23', '74.jpg', 74, NULL, NULL),
(43, 'Kakashi Don invited you to pike this is no longuer shit shit', 22, '2014-07-21 01:16:25', '74.jpg', 74, NULL, NULL),
(44, 'Kakashi Don invited you to pike this is no longuer shit shit', 753896647975714, '2014-07-21 01:16:27', '74.jpg', 74, NULL, NULL),
(45, 'Kakashi Don invited you to pike this is no longuer shit shit', 12, '2014-07-21 01:16:32', '74.jpg', 74, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `picture_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) unsigned NOT NULL,
  `pic_link` varchar(100) NOT NULL,
  `usr_upload` bigint(20) NOT NULL,
  PRIMARY KEY (`picture_id`),
  KEY `event_id` (`event_id`),
  KEY `usr_upload` (`usr_upload`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `picture`
--

INSERT INTO `picture` (`picture_id`, `event_id`, `pic_link`, `usr_upload`) VALUES
(23, 85, '1.jpg', 10202951483540580),
(24, 85, '8524.jpg', 10202951483540580),
(25, 84, '8425.jpg', 10202951483540580),
(26, 74, '7426.jpg', 10202951483540580),
(27, 74, '7427.jpg', 10202951483540580),
(28, 74, '7428.jpg', 10202951483540580),
(29, 74, '7429.jpg', 10202951483540580),
(30, 74, '7430.jpg', 10202951483540580),
(31, 74, '7431.jpg', 10202951483540580),
(32, 74, '7432.jpg', 10202951483540580),
(33, 74, '7433.jpg', 10202951483540580),
(34, 74, '7434.jpg', 10202951483540580),
(35, 74, '7435.jpg', 10202951483540580),
(36, 74, '7436.jpg', 10202951483540580),
(37, 74, '7437.jpg', 10202951483540580);

-- --------------------------------------------------------

--
-- Structure de la table `userapps`
--

CREATE TABLE IF NOT EXISTS `userapps` (
  `usr_email` varchar(50) NOT NULL,
  `usr_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usr_lname` varchar(50) NOT NULL,
  `usr_fname` varchar(100) NOT NULL,
  `Facebook_ID` bigint(20) NOT NULL,
  `profil_link` varchar(255) NOT NULL,
  `birthday` date DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `picture_link` varchar(255) NOT NULL DEFAULT 'default.jpg',
  PRIMARY KEY (`Facebook_ID`),
  KEY `Facebook_ID` (`Facebook_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `userapps`
--

INSERT INTO `userapps` (`usr_email`, `usr_created`, `usr_lname`, `usr_fname`, `Facebook_ID`, `profil_link`, `birthday`, `location`, `gender`, `picture_link`) VALUES
('someonePublic', '2014-07-19 16:00:32', 'Public', 'Person', 1, '', NULL, '', '', 'default.jpg'),
('', '2014-07-21 00:31:05', 'def', 'ede', 11, '', NULL, '', '', 'default.jpg'),
('', '2014-07-20 23:08:21', 'dddd', 'dddd', 12, '', NULL, '', '', 'default.jpg'),
('', '2014-07-20 23:08:50', '22', '22', 22, '', NULL, '', '', 'default.jpg'),
('', '2014-07-20 23:08:44', 'SSS', 'SSS', 33, '', NULL, '', '', 'default.jpg'),
('', '2014-07-20 23:08:29', 'AAA', 'AAA', 34, '', NULL, '', '', 'default.jpg'),
('elabridiali@gmail.com', '2014-05-30 02:01:03', 'Elabridi', 'Ali', 268310453348365, 'https://www.facebook.com/app_scoped_user_id/268310453348365/', '1990-05-31', 'Ifrane, Morocco', 'male', '1982323_252235748289169_768536785_n_4.jpg'),
('elabridiali@live.fr', '0000-00-00 00:00:00', 'El', 'Ali', 753896647975714, 'https://www.facebook.com/app_scoped_user_id/753896647975714/', '1950-05-31', 'Rabat, Morocco', '', '252231_1002029915278_1941483569_n_1.jpg'),
('teensdoor@gmail.com', '0000-00-00 00:00:00', 'Eddahmani', 'Aymane', 880152931994714, 'https://www.facebook.com/app_scoped_user_id/880152931994714/', '1995-10-16', 'Midelt', '', '10513356_906096386067035_156912104903362139_n.jpg'),
('s.a.idriss@hotmail.fr', '2014-07-14 00:26:53', 'Kakashi', 'Don', 10202951483540580, 'https://www.facebook.com/app_scoped_user_id/10202951483540580/', '1970-01-01', 'Ifrane, Morocco', 'male', '10269414_10203285658934756_2129261071064046260_n.jpg');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`chat_user_sender`) REFERENCES `userapps` (`Facebook_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`chat_user_receiver`) REFERENCES `userapps` (`Facebook_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`usr_create`) REFERENCES `userapps` (`Facebook_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`feedback_user_id`) REFERENCES `userapps` (`Facebook_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`feedback_event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`file_event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`usr_upload`) REFERENCES `userapps` (`Facebook_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends_ibfk_1` FOREIGN KEY (`user_me`) REFERENCES `userapps` (`Facebook_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friends_ibfk_2` FOREIGN KEY (`user_other`) REFERENCES `userapps` (`Facebook_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `joinevents`
--
ALTER TABLE `joinevents`
  ADD CONSTRAINT `joinevents_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `joinevents_ibfk_2` FOREIGN KEY (`usr_id`) REFERENCES `userapps` (`Facebook_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`notification_user`) REFERENCES `userapps` (`Facebook_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_ibfk_4` FOREIGN KEY (`sender_id`) REFERENCES `userapps` (`Facebook_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `picture_ibfk_2` FOREIGN KEY (`usr_upload`) REFERENCES `userapps` (`Facebook_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
