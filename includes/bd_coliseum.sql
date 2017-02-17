/*
SQLyog Ultimate v11.33 (32 bit)
MySQL - 10.1.16-MariaDB : Database - coliseum
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`coliseum` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `coliseum`;

/*Table structure for table `accounts` */

DROP TABLE IF EXISTS `accounts`;

CREATE TABLE `accounts` (
  `AID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(10) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Join_date` date NOT NULL,
  `Login_ip` varchar(40) NOT NULL,
  `Register_ip` varchar(40) NOT NULL,
  PRIMARY KEY (`AID`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

/*Table structure for table `console` */

DROP TABLE IF EXISTS `console`;

CREATE TABLE `console` (
  `AID` int(11) NOT NULL,
  `Text` varchar(500) NOT NULL,
  `Date` datetime NOT NULL,
  `Count` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `duel` */

DROP TABLE IF EXISTS `duel`;

CREATE TABLE `duel` (
  `DID` int(11) NOT NULL AUTO_INCREMENT,
  `Retante` int(11) NOT NULL,
  `Retado` int(11) NOT NULL,
  `Date` int(11) NOT NULL,
  `State` int(11) NOT NULL,
  PRIMARY KEY (`DID`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `MID` int(11) NOT NULL AUTO_INCREMENT,
  `Sender` varchar(10) DEFAULT NULL,
  `Receiver` varchar(10) DEFAULT NULL,
  `Subject` varchar(30) DEFAULT NULL,
  `Message` varchar(500) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  `State` int(11) DEFAULT NULL,
  PRIMARY KEY (`MID`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Table structure for table `messages_sent` */

DROP TABLE IF EXISTS `messages_sent`;

CREATE TABLE `messages_sent` (
  `MsID` int(11) NOT NULL AUTO_INCREMENT,
  `Sender` varchar(10) NOT NULL,
  `Receiver` varchar(10) NOT NULL,
  `Subject` varchar(30) NOT NULL,
  `Message` varchar(500) NOT NULL,
  `Date` datetime NOT NULL,
  `State` int(11) NOT NULL,
  PRIMARY KEY (`MsID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `online` */

DROP TABLE IF EXISTS `online`;

CREATE TABLE `online` (
  `Date` int(11) NOT NULL,
  `Ip` varchar(40) NOT NULL,
  `Username` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `players` */

DROP TABLE IF EXISTS `players`;

CREATE TABLE `players` (
  `PID` int(11) NOT NULL AUTO_INCREMENT,
  `AID` int(11) NOT NULL,
  `Name` varchar(10) NOT NULL,
  `Body` int(11) NOT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
