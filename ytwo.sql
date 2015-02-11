/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50535
Source Host           : localhost:3306
Source Database       : ytwo

Target Server Type    : MYSQL
Target Server Version : 50535
File Encoding         : 65001

Date: 2015-02-11 10:45:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `yii_follow`
-- ----------------------------
DROP TABLE IF EXISTS `yii_follow`;
CREATE TABLE `yii_follow` (
  `uid` int(11) NOT NULL,
  `fid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_follow
-- ----------------------------
INSERT INTO `yii_follow` VALUES ('3', '2');
INSERT INTO `yii_follow` VALUES ('4', '3');
INSERT INTO `yii_follow` VALUES ('2', '3');
INSERT INTO `yii_follow` VALUES ('3', '1');
INSERT INTO `yii_follow` VALUES ('3', '5');
INSERT INTO `yii_follow` VALUES ('6', '3');
INSERT INTO `yii_follow` VALUES ('6', '4');
INSERT INTO `yii_follow` VALUES ('4', '5');
INSERT INTO `yii_follow` VALUES ('5', '2');
INSERT INTO `yii_follow` VALUES ('5', '4');
INSERT INTO `yii_follow` VALUES ('5', '6');
INSERT INTO `yii_follow` VALUES ('5', '3');
INSERT INTO `yii_follow` VALUES ('1', '3');
INSERT INTO `yii_follow` VALUES ('1', '2');
INSERT INTO `yii_follow` VALUES ('3', '6');
INSERT INTO `yii_follow` VALUES ('2', '1');
INSERT INTO `yii_follow` VALUES ('4', '1');
INSERT INTO `yii_follow` VALUES ('5', '1');
INSERT INTO `yii_follow` VALUES ('1', '5');

-- ----------------------------
-- Table structure for `yii_msg`
-- ----------------------------
DROP TABLE IF EXISTS `yii_msg`;
CREATE TABLE `yii_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `send_time` int(11) NOT NULL,
  `reply` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_msg
-- ----------------------------
INSERT INTO `yii_msg` VALUES ('1', '5', '3', '请问下yii2的数据库如何操作', '请问下yii2的数据库如何操作，具体是增删查改怎么处理', '1', '1422704588', '0');
INSERT INTO `yii_msg` VALUES ('2', '5', '3', '我已经关乎你了', '呵呵，我已经关注你了！我们成为好友！', '1', '1422704682', '0');
INSERT INTO `yii_msg` VALUES ('3', '5', '3', '今天晚上看武媚娘大结局', '今天晚上看武媚娘大结局可好？本周就播完了，下周播放活色生香', '1', '1422704951', '0');
INSERT INTO `yii_msg` VALUES ('4', '5', '3', '你觉得laravel框架怎么样？', '我最近已在看laravel,觉得他比yii2要灵活些？大家觉得怎么样？', '1', '1422705046', '0');
INSERT INTO `yii_msg` VALUES ('5', '1', '3', 'yii2数据关联操作', 'yii2数据关联操作与技术实践', '1', '1422782387', '0');
INSERT INTO `yii_msg` VALUES ('6', '3', '1', '消息实时显示测试', '消息实时显示测试消息实时显示测试消息实时显示测试消息实时显示测试消息实时显示测试消息实时显示测试', '1', '1422793408', '0');
INSERT INTO `yii_msg` VALUES ('7', '2', '1', '韩流什么的弱爆了，华流才是最屌的', '周董说过：韩流什么的弱爆了，华流才是最屌的，哎呦！不错哦！', '1', '1422793534', '0');
INSERT INTO `yii_msg` VALUES ('8', '4', '1', 'BAT三巨头抢占移动互联网', '看BAT三巨头抢占移动互联网，入口很重要，占领入口大战一触即发，谁将是最后的王者，让我们拭目以待', '1', '1422793639', '0');
INSERT INTO `yii_msg` VALUES ('9', '5', '1', '响应式网页设计最新框架', '响应式网页设计最新框架越来越流行了，我们选择bootstrap来实现这样的效果', '1', '1422793741', '0');
INSERT INTO `yii_msg` VALUES ('10', '3', '2', 'php消息实时推送问题', '如何有效解决php消息实施推送问题', '1', '1422844371', '0');
INSERT INTO `yii_msg` VALUES ('11', '2', '3', '解决消息回复问题', '如何有效解决解决消息回复问题', '1', '1422844620', '1');
INSERT INTO `yii_msg` VALUES ('12', '2', '3', '习近平亲自主持起草军队政治规定', '2014年12月30日，中共中央向全党全军转发《关于新形势下军队政治工作若干问题的决定》', '1', '1422847618', '0');
INSERT INTO `yii_msg` VALUES ('15', '3', '5', '今天晚上看武媚娘大结局', '非常不错的片子！下周播放活色生香 ，期待~', '1', '1422862139', '1');
INSERT INTO `yii_msg` VALUES ('13', '1', '3', '公务员职级晋升条件出炉:正科满15年享副处待遇', '公务员职级晋升条件出炉:正科满15年享副处待遇', '1', '1422849944', '0');
INSERT INTO `yii_msg` VALUES ('14', '2', '3', 'yii2数据关联操作2', 'yii2数据关联操作2', '1', '1422850149', '0');
INSERT INTO `yii_msg` VALUES ('16', '3', '5', '你觉得laravel框架怎么样？', '我用了下，laravel确实比yii要强大得多啊', '1', '1422862538', '1');
INSERT INTO `yii_msg` VALUES ('17', '5', '3', '你觉得laravel框架怎么样？', '应该是这样大，以后多多交流啊', '0', '1422862863', '1');
INSERT INTO `yii_msg` VALUES ('19', '2', '1', '异步过程中出现的各种问题', 'yii2在异步过程中出现的各种问题，需要高手来解答啊！', '1', '1422863063', '0');
INSERT INTO `yii_msg` VALUES ('20', '1', '2', '韩流什么的弱爆了，华流才是最屌的', '大家都来支持华语流行音乐，华流才能更吊哦！', '1', '1422863139', '1');
INSERT INTO `yii_msg` VALUES ('21', '2', '1', '中国对朝提供8万吨燃油 朝空军训练增加', '中国对朝提供8万吨燃油 朝空军训练增加', '1', '1422863389', '0');
INSERT INTO `yii_msg` VALUES ('22', '1', '2', '中国对朝提供8万吨燃油 朝空军训练增加', '真的是伤不起，像这种独裁国家我们还喂白眼狼！', '1', '1422863469', '1');
INSERT INTO `yii_msg` VALUES ('23', '2', '1', '中国对朝提供8万吨燃油 朝空军训练增加', '是这样的，这样的独裁国家，我们竟然和他做朋友，真是耻辱吧', '1', '1422863557', '1');
INSERT INTO `yii_msg` VALUES ('24', '1', '2', '中国对朝提供8万吨燃油 朝空军训练增加', '可不是吗？不知道领导人咋想的？', '1', '1422863674', '1');
INSERT INTO `yii_msg` VALUES ('25', '1', '5', '司机开车时徒手拔牙 致车辆失控冲下高速公路', '司机开车时徒手拔牙 致车辆失控冲下高速公路,安全重要', '1', '1422863973', '0');
INSERT INTO `yii_msg` VALUES ('26', '5', '1', '司机开车时徒手拔牙 致车辆失控冲下高速公路', '司机开车一定要注意安全，不然就成了马路杀手', '1', '1422864162', '1');
INSERT INTO `yii_msg` VALUES ('27', '1', '3', '非常简洁的后台管理系统模板下载', '非常简洁的后台管理系统模板下载非常简洁的后台管理系统模板下载', '1', '1422865377', '0');
INSERT INTO `yii_msg` VALUES ('28', '1', '3', '实时消息推送检测', '实时消息推送检测实时消息推送检测', '1', '1422871016', '0');
INSERT INTO `yii_msg` VALUES ('29', '1', '3', '实时消息推送检测2', '实时消息推送检测实时消息推送检测2', '0', '1422871113', '0');
INSERT INTO `yii_msg` VALUES ('30', '3', '1', '非常简洁的后台管理系统模板下载', '确实如此，很好很强大', '0', '1422875131', '1');
INSERT INTO `yii_msg` VALUES ('31', '3', '1', 'RBAC后台权限管理开发的怎么样了？', 'RBAC后台权限管理开发的怎么样了？', '0', '1423118550', '0');
INSERT INTO `yii_msg` VALUES ('32', '3', '1', 'RBAC后台权限管理开发的进度管理', 'RBAC后台权限管理开发的进度管理', '0', '1423118600', '0');

-- ----------------------------
-- Table structure for `yii_privilege`
-- ----------------------------
DROP TABLE IF EXISTS `yii_privilege`;
CREATE TABLE `yii_privilege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `route` varchar(225) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_privilege
-- ----------------------------
INSERT INTO `yii_privilege` VALUES ('1', 'admin/article/add', '文章添加');
INSERT INTO `yii_privilege` VALUES ('2', 'admin/article/update', '文章更新');
INSERT INTO `yii_privilege` VALUES ('3', 'admin/article/delete', '文章删除');
INSERT INTO `yii_privilege` VALUES ('4', 'admin/article/search', '文章查找 ');
INSERT INTO `yii_privilege` VALUES ('5', 'admin/article/review', '文章预览');
INSERT INTO `yii_privilege` VALUES ('6', 'admin/article/comment', '文章评论');
INSERT INTO `yii_privilege` VALUES ('7', 'admin/article/list', '文章列表');

-- ----------------------------
-- Table structure for `yii_role`
-- ----------------------------
DROP TABLE IF EXISTS `yii_role`;
CREATE TABLE `yii_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(225) NOT NULL,
  `desc` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_role
-- ----------------------------
INSERT INTO `yii_role` VALUES ('1', 'admin', '管理员');
INSERT INTO `yii_role` VALUES ('2', 'vip', 'VIP用户');
INSERT INTO `yii_role` VALUES ('3', 'user', '普通用户');
INSERT INTO `yii_role` VALUES ('5', 'level1', '初级管理员');

-- ----------------------------
-- Table structure for `yii_role_privilege`
-- ----------------------------
DROP TABLE IF EXISTS `yii_role_privilege`;
CREATE TABLE `yii_role_privilege` (
  `role_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_role_privilege
-- ----------------------------
INSERT INTO `yii_role_privilege` VALUES ('1', '1');
INSERT INTO `yii_role_privilege` VALUES ('1', '2');
INSERT INTO `yii_role_privilege` VALUES ('1', '3');
INSERT INTO `yii_role_privilege` VALUES ('1', '4');
INSERT INTO `yii_role_privilege` VALUES ('1', '5');
INSERT INTO `yii_role_privilege` VALUES ('1', '6');
INSERT INTO `yii_role_privilege` VALUES ('3', '4');
INSERT INTO `yii_role_privilege` VALUES ('3', '5');
INSERT INTO `yii_role_privilege` VALUES ('1', '7');
INSERT INTO `yii_role_privilege` VALUES ('2', '6');
INSERT INTO `yii_role_privilege` VALUES ('2', '5');
INSERT INTO `yii_role_privilege` VALUES ('2', '4');
INSERT INTO `yii_role_privilege` VALUES ('5', '7');
INSERT INTO `yii_role_privilege` VALUES ('2', '1');
INSERT INTO `yii_role_privilege` VALUES ('5', '6');
INSERT INTO `yii_role_privilege` VALUES ('5', '5');

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
  `nickname` varchar(225) NOT NULL,
  `thumb` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `created_at` int(11) NOT NULL DEFAULT '0',
  `updated_at` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of yii_user
-- ----------------------------
INSERT INTO `yii_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'test100key', '100-token', '管理员', '/avatar/1422621856.jpg', 'admin@admin.com', '0', '0', '1');
INSERT INTO `yii_user` VALUES ('2', 'lisi', '21232f297a57a5a743894a0e4a801fc3', 'test100key', '100-token', '李四', '/avatar/1422622620.jpg', 'lisi@126.com', '0', '0', '5');
INSERT INTO `yii_user` VALUES ('3', 'zfeig', '21232f297a57a5a743894a0e4a801fc3', 'test100key', '100-token', '飞哥', '/avatar/1422672927.jpg', 'zfeig@126.com', '0', '0', '1');
INSERT INTO `yii_user` VALUES ('4', 'baidu', '21232f297a57a5a743894a0e4a801fc3', 'test100key', '100-token', '百度', '', 'baidu@126.com', '0', '0', '3');
INSERT INTO `yii_user` VALUES ('5', 'xiaoq', '21232f297a57a5a743894a0e4a801fc3', 'test100key', '100-token', '小强', '', 'xiaoq@126.com', '0', '0', '3');
INSERT INTO `yii_user` VALUES ('6', 'cong', '21232f297a57a5a743894a0e4a801fc3', 'test100key', '100-token', '聪哥', '', 'cong@126.com', '0', '0', '3');
