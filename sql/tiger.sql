/*
Navicat MySQL Data Transfer

Source Server         : Mysql
Source Server Version : 50512
Source Host           : localhost:3306
Source Database       : tiger

Target Server Type    : MYSQL
Target Server Version : 50512
File Encoding         : 65001

Date: 2013-08-27 18:18:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `tb_basedinformation`
-- ----------------------------
DROP TABLE IF EXISTS `tb_basedinformation`;
CREATE TABLE `tb_basedinformation` (
  `guId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '动物名称',
  `probability` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '概率，用百分别表示',
  `addition` int(10) NOT NULL DEFAULT '0' COMMENT '附加条件(再转几次)',
  `times` int(10) NOT NULL DEFAULT '1' COMMENT '倍数',
  PRIMARY KEY (`guId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_basedinformation
-- ----------------------------
INSERT INTO `tb_basedinformation` VALUES ('1', '飞禽', '0.04', '0', '2');
INSERT INTO `tb_basedinformation` VALUES ('2', '燕子', '0.03', '0', '6');
INSERT INTO `tb_basedinformation` VALUES ('3', '鸽子', '0.02', '0', '8');
INSERT INTO `tb_basedinformation` VALUES ('4', '孔雀', '0.01', '0', '12');
INSERT INTO `tb_basedinformation` VALUES ('5', '老鹰', '0.01', '0', '12');
INSERT INTO `tb_basedinformation` VALUES ('6', '走兽', '0.04', '0', '2');
INSERT INTO `tb_basedinformation` VALUES ('7', '兔子', '0.03', '0', '6');
INSERT INTO `tb_basedinformation` VALUES ('8', '猴子', '0.02', '0', '8');
INSERT INTO `tb_basedinformation` VALUES ('9', '熊猫', '0.01', '0', '12');
INSERT INTO `tb_basedinformation` VALUES ('10', '狮子', '0.01', '0', '12');
INSERT INTO `tb_basedinformation` VALUES ('11', '大白鲨', '0.005', '0', '24');
INSERT INTO `tb_basedinformation` VALUES ('12', '射灯', '0.05', '1', '0');
INSERT INTO `tb_basedinformation` VALUES ('13', '大炮', '99.715', '0', '0');

-- ----------------------------
-- Table structure for `tb_online`
-- ----------------------------
DROP TABLE IF EXISTS `tb_online`;
CREATE TABLE `tb_online` (
  `guId` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) COLLATE utf8_bin DEFAULT NULL COMMENT '登录邮箱(用户名)',
  `nick` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `onlineTime` datetime DEFAULT NULL COMMENT '在线时间',
  `lastTime` datetime DEFAULT NULL,
  PRIMARY KEY (`guId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_online
-- ----------------------------
INSERT INTO `tb_online` VALUES ('4', '562549047@qq.com', 'xiaogu', '2013-08-27 15:04:54', '2013-08-27 15:04:54');

-- ----------------------------
-- Table structure for `tb_record`
-- ----------------------------
DROP TABLE IF EXISTS `tb_record`;
CREATE TABLE `tb_record` (
  `guId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL COMMENT '用户ID',
  `type` int(2) DEFAULT NULL COMMENT '状态  1表示提取，0表示充值',
  `money` double(9,2) DEFAULT NULL COMMENT '金额',
  `state` int(2) DEFAULT NULL COMMENT '状态 0 表示失败 1表示成功',
  `insertTime` datetime DEFAULT NULL,
  `updateTime` datetime DEFAULT NULL,
  PRIMARY KEY (`guId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_record
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_transrecord`
-- ----------------------------
DROP TABLE IF EXISTS `tb_transrecord`;
CREATE TABLE `tb_transrecord` (
  `guId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL COMMENT '用户Id',
  `type` int(2) DEFAULT NULL COMMENT '类型，是钱转银元 0  还是银元转钱 1',
  `insertTime` datetime DEFAULT NULL COMMENT '转换时间',
  `money` double(9,2) DEFAULT NULL,
  `silverdollar` int(11) DEFAULT NULL COMMENT '银元',
  PRIMARY KEY (`guId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_transrecord
-- ----------------------------

-- ----------------------------
-- Table structure for `tb_user`
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `guId` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  `nick` varchar(40) COLLATE utf8_bin DEFAULT NULL COMMENT '用户昵称',
  `pwd` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '用户密码',
  `secretQuestion` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '用户密保问题',
  `secretAnswer` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '用户密保答案',
  `mobile` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '用户手机',
  `sex` char(2) COLLATE utf8_bin DEFAULT NULL COMMENT '性别',
  `headPic` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '头像',
  `email` varchar(40) COLLATE utf8_bin DEFAULT NULL COMMENT '邮箱',
  `bankName` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '银行名称',
  `bankAccount` varchar(40) COLLATE utf8_bin DEFAULT NULL COMMENT '银行帐号',
  `cardHolder` varchar(10) COLLATE utf8_bin DEFAULT NULL COMMENT '持卡人名',
  `totalMoney` double(9,2) DEFAULT NULL COMMENT '总资产',
  `desirableMoney` double(9,2) DEFAULT NULL COMMENT '可取金额',
  `useableMoney` double(9,2) DEFAULT NULL COMMENT '可用金额',
  `frostMoney` double(9,2) DEFAULT NULL COMMENT '冻结金额',
  `remainMoney` double(9,2) DEFAULT NULL COMMENT '资金余额',
  `availableSilver` int(11) DEFAULT NULL COMMENT '可用银币',
  PRIMARY KEY (`guId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES ('1', 'xiaogu', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, '562549047@qq.com', null, null, null, '500.00', '500.00', '500.00', '0.00', '500.00', '51');
INSERT INTO `tb_user` VALUES ('2', 'xiaogu2', 'e10adc3949ba59abbe56e057f20f883e', null, null, null, null, null, '1@qq.com', null, null, null, '500.00', '500.00', '500.00', '0.00', '500.00', '20');

-- ----------------------------
-- Table structure for `tb_wholebase`
-- ----------------------------
DROP TABLE IF EXISTS `tb_wholebase`;
CREATE TABLE `tb_wholebase` (
  `guId` int(11) NOT NULL AUTO_INCREMENT,
  `wholeBase` varchar(10) COLLATE utf8_bin NOT NULL COMMENT '整体基数',
  `maxNumber` int(10) NOT NULL COMMENT '压的数量上限',
  PRIMARY KEY (`guId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_wholebase
-- ----------------------------
INSERT INTO `tb_wholebase` VALUES ('1', '1/2', '100');
