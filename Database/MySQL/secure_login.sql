-- phpMyAdmin SQL Dump
-- version 4.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 29, 2015 at 10:30 AM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `secure_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(1, '1428920903'),
(1, '1428921384'),
(2, '1429001207'),
(2, '1429001249'),
(2, '1429001263'),
(2, '1429174690'),
(2, '1429174698'),
(28, '1429181753'),
(24, '1429185228'),
(24, '1429186134'),
(24, '1429186582'),
(2, '1429187172'),
(2, '1429187186'),
(24, '1429187473'),
(24, '1429187502'),
(24, '1429187519'),
(32, '1429187720'),
(32, '1429187729'),
(32, '1429187742'),
(2, '1429190122'),
(2, '1429191325'),
(2, '1429262469'),
(2, '1429262480'),
(33, '1429265537'),
(33, '1429518222'),
(33, '1429518233'),
(33, '1429518256'),
(33, '1429518274'),
(29, '1429518945'),
(29, '1429518963'),
(33, '1429519770'),
(33, '1429611295'),
(2, '1429688089'),
(33, '1429688444'),
(2, '1429690246'),
(33, '1429857225'),
(49, '1429865856'),
(48, '1429883206'),
(33, '1430120351'),
(33, '1430120359'),
(48, '1430811075'),
(48, '1431072843'),
(48, '1431075522'),
(48, '1431087665'),
(42, '1431417584'),
(42, '1431417634'),
(48, '1431429344'),
(48, '1431430705'),
(48, '1431430720'),
(48, '1431430728'),
(48, '1431430757'),
(48, '1431430829'),
(33, '1431520564'),
(33, '1431520976'),
(33, '1431547469'),
(60, '1431941791'),
(60, '1431950379'),
(33, '1431956241'),
(33, '1432020472'),
(48, '1432107580'),
(48, '1432122982'),
(60, '1432151054'),
(60, '1432201401'),
(48, '1432206053'),
(60, '1432208007'),
(60, '1432213468'),
(60, '1432279765'),
(33, '1432282869'),
(33, '1432282892'),
(33, '1432282929'),
(33, '1432284243'),
(33, '1432284249'),
(60, '1432284568'),
(33, '1432288601'),
(33, '1432290752'),
(48, '1432291308'),
(60, '1432294550'),
(33, '1432297842'),
(48, '1432313840'),
(48, '1432375775'),
(73, '1432545433'),
(73, '1432545439'),
(73, '1432545446'),
(73, '1432545458'),
(60, '1432552233'),
(60, '1432725399'),
(48, '1432803038');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `admin`, `username`, `email`, `password`, `salt`) VALUES
(48, 1, 'Admin', 'a@a.com', '0a4ce2d72d3f3f3ec405709256901b95181269c2bce8aadae92a6022286a94f314ff9983777043521432170b1b4cb8ccaf766b284f00c9a3338e62dfd26db362', 'b6df84e696711b09ec9f0eb1c211c52441cf37d4267884447775b302892a7e5ca93976ad3b44dbc8e715b800077d35e630109a5577e05d321c1879c8a8fa02f6'),
(74, 1, 'Adam Byström', 'adam@bystrom.se', '32dd609b61510f30c92bb9ea1e56986b20113118278db76720b4836360f76f0bea7aafba5f6771f66882599be89298e0d577e6fd1db74169240aa862c2f4193f', '6d3ab51f13059365d695fd0e485acb7592d84cd1216e48443fda461d66f4826c345acb9010e22e426057bfa8377b9eab3f86a66240a04c7d0a5fd9e6033c0e31');

-- --------------------------------------------------------

--
-- Table structure for table `s_message`
--

CREATE TABLE IF NOT EXISTS `s_message` (
  `id` int(11) NOT NULL,
  `title` varchar(30) CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_swedish_ci NOT NULL,
  `close` tinyint(1) NOT NULL DEFAULT '0',
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stop_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `s_message`
--
ALTER TABLE `s_message`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `s_message`
--
ALTER TABLE `s_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
