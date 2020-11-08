# Host: localhost  (Version: 5.5.53)
# Date: 2018-04-06 13:30:41
# Generator: MySQL-Front 5.3  (Build 4.234)
/*!40101 SET NAMES gb2312 */;

#
# Structure for table "message"
#
CREATE DATABASE test;
USE test;
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `content` mediumtext,
  `isread` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

#
# Structure for table "users"
#

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

insert into users (username,password) values("zz@qq.com","ea7f01f5ed2c41b9c3abd9dc0cf99610");
# zz@qq.com flag{n1ce_G0OOOOOOod}
