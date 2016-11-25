/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50623
Source Host           : localhost:3306
Source Database       : wangpan

Target Server Type    : MYSQL
Target Server Version : 50623
File Encoding         : 65001

Date: 2016-11-25 12:25:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nickname` varchar(64) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `registered` datetime NOT NULL,
  `totalsize` bigint(20) unsigned NOT NULL,
  `usedsize` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`ID`,`email`,`nickname`),
  UNIQUE KEY `ID` (`ID`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING HASH,
  UNIQUE KEY `nikename` (`nickname`) USING HASH
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'SYSTEM', '0', 'root', '', '2016-11-24 23:39:49', '0', '0');
