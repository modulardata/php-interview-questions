-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 08, 2012 at 10:28 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `renew_his`
--

-- --------------------------------------------------------

--
-- Table structure for table `mail_det`
--

CREATE TABLE IF NOT EXISTS `mail_det` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mail_subject` varchar(70) NOT NULL,
  `mail_content` mediumtext NOT NULL,
  `status` int(1) NOT NULL,
  `mail_date` date NOT NULL,
  `username` varchar(40) NOT NULL,
  `count` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `mail_sent_count`
--

CREATE TABLE IF NOT EXISTS `mail_sent_count` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `mail_det_id` varchar(70) NOT NULL,
  `from_mail_id` varchar(70) NOT NULL,
  `to_mail_id` varchar(70) NOT NULL,
  `student_id` int(10) NOT NULL,
  `mail_date` date NOT NULL,
  `mail_time` time NOT NULL,
  `mail_count` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `mail_settings`
--

CREATE TABLE IF NOT EXISTS `mail_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(80) NOT NULL,
  `status` int(1) NOT NULL,
  `From_name` varchar(60) NOT NULL,
  `From_address` varchar(60) NOT NULL,
  `Domain_name` varchar(60) NOT NULL,
  `SMTP` varchar(80) NOT NULL,
  `SMTP_Port` int(4) NOT NULL,
  `Username` varchar(80) NOT NULL,
  `Password` varchar(80) NOT NULL,
  `Signatore` text NOT NULL,
  `Count` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
