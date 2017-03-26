/*
SQLyog Ultimate v11.27 (32 bit)
MySQL - 5.7.14 : Database - mataapp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mataapp` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `mataapp`;

/*Table structure for table `binding` */

DROP TABLE IF EXISTS `binding`;

CREATE TABLE `binding` (
  `openid` varchar(50) NOT NULL,
  `lno` varchar(10) NOT NULL,
  PRIMARY KEY (`openid`,`lno`),
  KEY `binding_ibfk_2` (`lno`),
  KEY `binding_ibfk_3` (`openid`),
  CONSTRAINT `binding_ibfk_2` FOREIGN KEY (`lno`) REFERENCES `lesson` (`lno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `binding_ibfk_3` FOREIGN KEY (`openid`) REFERENCES `studentinfo` (`openid`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `lesson` */

DROP TABLE IF EXISTS `lesson`;

CREATE TABLE `lesson` (
  `lno` varchar(10) NOT NULL,
  `telphone` varchar(12) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `pnum` int(11) NOT NULL,
  `lplace` varchar(20) NOT NULL,
  PRIMARY KEY (`lno`,`telphone`),
  KEY `lesson_ibfk_1` (`telphone`),
  CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`telphone`) REFERENCES `login` (`telphone`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `log` */

DROP TABLE IF EXISTS `log`;

CREATE TABLE `log` (
  `dates` datetime NOT NULL,
  `lno` varchar(10) NOT NULL,
  `telphone` varchar(12) NOT NULL,
  `state` int(11) NOT NULL,
  `arrive` int(11) NOT NULL,
  `arriveid` text NOT NULL,
  `notarriveid` text,
  PRIMARY KEY (`dates`,`lno`,`telphone`),
  KEY `lno` (`lno`),
  KEY `telphone` (`telphone`),
  CONSTRAINT `log_ibfk_2` FOREIGN KEY (`lno`) REFERENCES `lesson` (`lno`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `log_ibfk_3` FOREIGN KEY (`telphone`) REFERENCES `login` (`telphone`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `login` */

DROP TABLE IF EXISTS `login`;

CREATE TABLE `login` (
  `telphone` varchar(12) NOT NULL,
  `name` varchar(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`telphone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Table structure for table `studentinfo` */

DROP TABLE IF EXISTS `studentinfo`;

CREATE TABLE `studentinfo` (
  `openid` varchar(50) NOT NULL,
  `sid` varchar(10) DEFAULT NULL,
  `sname` varchar(10) DEFAULT NULL,
  `scollege` varchar(20) DEFAULT NULL,
  `sclass` varchar(10) DEFAULT NULL,
  `stelephone` varchar(20) DEFAULT NULL,
  `avatarUrl` text,
  PRIMARY KEY (`openid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
