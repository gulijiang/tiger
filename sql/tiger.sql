/*
Navicat MySQL Data Transfer

Source Server         : Mysql
Source Server Version : 50512
Source Host           : localhost:3306
Source Database       : tiger

Target Server Type    : MYSQL
Target Server Version : 50512
File Encoding         : 65001

Date: 2013-08-22 22:33:25
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
INSERT INTO `tb_basedinformation` VALUES ('1', '飞禽', '1/12', '0', '2');
INSERT INTO `tb_basedinformation` VALUES ('2', '燕子', '1/12', '0', '6');
INSERT INTO `tb_basedinformation` VALUES ('3', '鸽子', '1/12', '0', '8');
INSERT INTO `tb_basedinformation` VALUES ('4', '孔雀', '1/12', '0', '12');
INSERT INTO `tb_basedinformation` VALUES ('5', '老鹰', '1/12', '0', '12');
INSERT INTO `tb_basedinformation` VALUES ('6', '走兽', '1/12', '0', '2');
INSERT INTO `tb_basedinformation` VALUES ('7', '兔子', '1/12', '0', '6');
INSERT INTO `tb_basedinformation` VALUES ('8', '猴子', '1/12', '0', '8');
INSERT INTO `tb_basedinformation` VALUES ('9', '熊猫', '1/12', '0', '12');
INSERT INTO `tb_basedinformation` VALUES ('10', '狮子', '1/12', '0', '12');
INSERT INTO `tb_basedinformation` VALUES ('11', '大白鲨', '1/12', '0', '24');
INSERT INTO `tb_basedinformation` VALUES ('12', '射灯', '1/12', '1', '0');
INSERT INTO `tb_basedinformation` VALUES ('13', '大炮', '0', '0', '0');

-- ----------------------------
-- Table structure for `tb_user`
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `guId` int(11) NOT NULL COMMENT '用户ID',
  `nick` varchar(40) COLLATE utf8_bin DEFAULT NULL COMMENT '用户昵称',
  `pwd` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '用户密码',
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
  `availableSilver` double(9,2) DEFAULT NULL COMMENT '可用银币',
  PRIMARY KEY (`guId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of tb_user
-- ----------------------------

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
