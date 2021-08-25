-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.16-standard


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema billing
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ billing;
USE billing;

--
-- Table structure for table `billing`.`category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category` varchar(50) NOT NULL default '',
  `description` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`category`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Table structure for table `billing`.`config`
--

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `rowkey` varchar(4) NOT NULL default '',
  `company` varchar(100) NOT NULL default '',
  `dateformat` varchar(10) NOT NULL default '',
  `dateseparator` char(1) NOT NULL default '/',
  `application` varchar(45) NOT NULL default '',
  `menu` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`rowkey`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`.`config`
--

/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`rowkey`,`company`,`dateformat`,`dateseparator`,`application`,`menu`) VALUES 
 ('0','Total Data Pty Ltd','dmY','/','Timesheet and Billing','billmenu.php');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;


--
-- Table structure for table `billing`.`item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `item` varchar(50) NOT NULL default '',
  `subcategory` varchar(50) NOT NULL default '',
  `description` varchar(200) NOT NULL default '',
  `supplier` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `billing`.`subcategory`
--

DROP TABLE IF EXISTS `subcategory`;
CREATE TABLE `subcategory` (
  `subcategory` varchar(50) NOT NULL default '',
  `category` varchar(50) NOT NULL default '',
  `description` varchar(200) NOT NULL default '',
  PRIMARY KEY  (`subcategory`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `billing`.`supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `supplier` varchar(50) NOT NULL default '',
  `address` varchar(50) NOT NULL default '',
  `contact` varchar(50) NOT NULL default '',
  `telephone` varchar(45) NOT NULL default '',
  PRIMARY KEY  (`supplier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
