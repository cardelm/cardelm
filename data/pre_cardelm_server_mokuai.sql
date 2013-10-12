/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : dz30

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2013-07-22 13:36:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pre_cardelm_server_mokuai`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelm_server_mokuai`;
CREATE TABLE `pre_cardelm_server_mokuai` (
  `mokuaiid` smallint(6) unsigned NOT NULL auto_increment,
  `pluginid` smallint(6) NOT NULL,
  `available` tinyint(1) NOT NULL default '0',
  `adminid` tinyint(1) unsigned NOT NULL default '0',
  `name` varchar(40) NOT NULL default '',
  `identifier` varchar(40) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `datatables` varchar(255) NOT NULL default '',
  `directory` varchar(100) NOT NULL default '',
  `copyright` varchar(100) NOT NULL default '',
  `modules` text NOT NULL,
  `version` varchar(20) NOT NULL default '',
  `setting` text NOT NULL,
  PRIMARY KEY  (`mokuaiid`),
  UNIQUE KEY `identifier` (`identifier`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelm_server_mokuai
-- ----------------------------
INSERT INTO `pre_cardelm_server_mokuai` VALUES ('6', '15', '1', '0', '服务端', 'server', '', '', 'yiqixueba_server/', 'www.cardelm.com', 'a:4:{i:0;a:10:{s:4:\"name\";s:9:\"sitegroup\";s:4:\"menu\";s:9:\"站长组\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:1;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:1;a:10:{s:4:\"name\";s:4:\"site\";s:4:\"menu\";s:12:\"站长管理\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:2;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:2;a:10:{s:4:\"name\";s:6:\"mokuai\";s:4:\"menu\";s:12:\"模块管理\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:3;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:3;a:10:{s:4:\"name\";s:10:\"dataupdate\";s:4:\"menu\";s:12:\"数据更新\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:4;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}}', 'V1.0', 'a:0:{}');
INSERT INTO `pre_cardelm_server_mokuai` VALUES ('7', '16', '1', '1', '商家联盟', 'brand', '商家联盟模块', '', 'yiqixueba_brand/', 'www.cardelm.com', 'a:6:{i:0;a:10:{s:4:\"name\";s:5:\"brand\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"11\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:0;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:1;a:10:{s:4:\"name\";s:5:\"brand\";s:4:\"menu\";s:12:\"商家联盟\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"1\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:0;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:2;a:10:{s:4:\"name\";s:10:\"brandgroup\";s:4:\"menu\";s:9:\"商家组\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:1;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:3;a:10:{s:4:\"name\";s:9:\"brandcats\";s:4:\"menu\";s:12:\"商家分类\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:2;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:4;a:10:{s:4:\"name\";s:9:\"brandlist\";s:4:\"menu\";s:12:\"商家管理\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:3;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:5:\"extra\";a:1:{s:10:\"langexists\";s:1:\"0\";}}', 'V1.0', 'a:0:{}');
