/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50535
Source Host           : localhost:3306
Source Database       : yii2

Target Server Type    : MYSQL
Target Server Version : 50535
File Encoding         : 65001

Date: 2015-01-29 15:49:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yii_user`
-- ----------------------------
DROP TABLE IF EXISTS `yii_user`;
CREATE TABLE `yii_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(225) NOT NULL,
  `pwd` char(32) NOT NULL,
  `authKey` char(200) NOT NULL,
  `accessToken` char(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_user
-- ----------------------------
INSERT INTO `yii_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'test100key', '100-token');
