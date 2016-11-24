/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50623
Source Host           : localhost:3306
Source Database       : wangpan

Target Server Type    : MYSQL
Target Server Version : 50623
File Encoding         : 65001

Date: 2016-11-25 00:48:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for userfile
-- ----------------------------
DROP TABLE IF EXISTS `userfile`;
CREATE TABLE `userfile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `fileid` int(10) unsigned NOT NULL,
  `filename` varchar(64) NOT NULL,
  `filetype` varchar(10) NOT NULL,
  `parentid` int(10) unsigned NOT NULL,
  `state` int(2) unsigned NOT NULL,
  `share` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `fileid` (`fileid`),
  KEY `filetype` (`filetype`),
  KEY `parentid` (`parentid`),
  CONSTRAINT `fileid` FOREIGN KEY (`fileid`) REFERENCES `file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `filetype` FOREIGN KEY (`filetype`) REFERENCES `file` (`type`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userfile
-- ----------------------------
INSERT INTO `userfile` VALUES ('1', '1', '1', 'disk', 'disk', '1', '1', '0');
