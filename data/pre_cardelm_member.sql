/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50045
Source Host           : localhost:3306
Source Database       : dz30

Target Server Type    : MYSQL
Target Server Version : 50045
File Encoding         : 65001

Date: 2013-07-19 16:53:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `pre_cardelm_member`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelm_member`;
CREATE TABLE `pre_cardelm_member` (
  `memberid` mediumint(8) unsigned NOT NULL auto_increment,
  `uid` mediumint(8) NOT NULL,
  PRIMARY KEY  (`memberid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelm_member
-- ----------------------------

-- ----------------------------
-- Table structure for `pre_cardelm_mokuai`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelm_mokuai`;
CREATE TABLE `pre_cardelm_mokuai` (
  `mokuaiid` smallint(6) unsigned NOT NULL auto_increment,
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelm_mokuai
-- ----------------------------
INSERT INTO `pre_cardelm_mokuai` VALUES ('1', '1', '1', '商品展示', 'goods', '商品展示模块', '', 'yiqixueba_goods/', 'www.cardelm.com', 'a:4:{i:0;a:10:{s:4:\"name\";s:9:\"goodscats\";s:4:\"menu\";s:12:\"商品分类\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:1;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:1;a:10:{s:4:\"name\";s:8:\"goodsmod\";s:4:\"menu\";s:12:\"商品模型\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:2;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:2;a:10:{s:4:\"name\";s:9:\"goodslist\";s:4:\"menu\";s:12:\"商品管理\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:3;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:5:\"extra\";a:1:{s:10:\"langexists\";s:1:\"0\";}}', 'V1.0', 'a:0:{}');
INSERT INTO `pre_cardelm_mokuai` VALUES ('2', '1', '0', '点评系统', 'dianping', '', '', 'yiqixueba_dianping/', 'www.cardelm.com', 'a:1:{i:0;a:10:{s:4:\"name\";s:12:\"dianpinglist\";s:4:\"menu\";s:12:\"点评管理\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:1;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}}', 'V1.0', 'a:0:{}');
INSERT INTO `pre_cardelm_mokuai` VALUES ('3', '1', '0', '服务端', 'server', '', '', 'yiqixueba_server/', 'www.cardelm.com', 'a:4:{i:0;a:10:{s:4:\"name\";s:9:\"sitegroup\";s:4:\"menu\";s:9:\"站长组\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:1;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:1;a:10:{s:4:\"name\";s:4:\"site\";s:4:\"menu\";s:12:\"站长管理\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:2;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:2;a:10:{s:4:\"name\";s:6:\"mokuai\";s:4:\"menu\";s:12:\"模块管理\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:3;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:3;a:10:{s:4:\"name\";s:10:\"dataupdate\";s:4:\"menu\";s:12:\"数据更新\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:4;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}}', 'V1.0', 'a:0:{}');
INSERT INTO `pre_cardelm_mokuai` VALUES ('4', '1', '1', '商家联盟', 'brand', '商家联盟模块', '', 'yiqixueba_brand/', 'www.cardelm.com', 'a:6:{i:0;a:10:{s:4:\"name\";s:5:\"brand\";s:4:\"menu\";s:0:\"\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:2:\"11\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:0;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:1;a:10:{s:4:\"name\";s:5:\"brand\";s:4:\"menu\";s:12:\"商家联盟\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"1\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:0;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:2;a:10:{s:4:\"name\";s:10:\"brandgroup\";s:4:\"menu\";s:9:\"商家组\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:1;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:3;a:10:{s:4:\"name\";s:9:\"brandcats\";s:4:\"menu\";s:12:\"商家分类\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:2;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}i:4;a:10:{s:4:\"name\";s:9:\"brandlist\";s:4:\"menu\";s:12:\"商家管理\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:3;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}s:5:\"extra\";a:1:{s:10:\"langexists\";s:1:\"0\";}}', 'V1.0', 'a:0:{}');
INSERT INTO `pre_cardelm_mokuai` VALUES ('5', '1', '0', '微信墙', 'wxq123', '', '', 'yiqixueba_wxq123/', 'www.wxq123.com', 'a:1:{i:0;a:10:{s:4:\"name\";s:7:\"wxqcats\";s:4:\"menu\";s:12:\"微信分类\";s:3:\"url\";s:0:\"\";s:4:\"type\";s:1:\"3\";s:7:\"adminid\";s:1:\"0\";s:12:\"displayorder\";i:0;s:8:\"navtitle\";s:0:\"\";s:7:\"navicon\";s:0:\"\";s:10:\"navsubname\";s:0:\"\";s:9:\"navsuburl\";s:0:\"\";}}', 'V1.0', 'a:0:{}');

-- ----------------------------
-- Table structure for `pre_cardelm_page`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelm_page`;
CREATE TABLE `pre_cardelm_page` (
  `pageid` varchar(32) NOT NULL,
  `mokuai` char(40) NOT NULL,
  `pagetype` char(40) NOT NULL,
  `submod` char(40) NOT NULL,
  PRIMARY KEY  (`pageid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelm_page
-- ----------------------------
INSERT INTO `pre_cardelm_page` VALUES ('440f0740cee8be0d9e511abece77885c', 'base', 'admincp', 'setting');
INSERT INTO `pre_cardelm_page` VALUES ('63d6c0828a46593a2d24af5517d6e93a', 'server', 'admincp', 'dataupdate');
INSERT INTO `pre_cardelm_page` VALUES ('7f9e8f90b33192d42a53fc858fbc80a7', 'base', 'admincp', 'index');
INSERT INTO `pre_cardelm_page` VALUES ('b0426cae16df94f0b32e0d6d82d21bf9', 'base', 'admincp', 'mokuai');
INSERT INTO `pre_cardelm_page` VALUES ('c550ee8d064d278191f54d2d629238bc', 'server', 'admincp', 'mokuai');

-- ----------------------------
-- Table structure for `pre_cardelm_server_site`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelm_server_site`;
CREATE TABLE `pre_cardelm_server_site` (
  `siteid` mediumint(8) unsigned NOT NULL auto_increment,
  `sitegroupid` smallint(3) NOT NULL,
  `siteurl` varchar(255) NOT NULL,
  `salt` char(6) NOT NULL,
  `sitekey` char(32) NOT NULL,
  `searchurl` varchar(255) NOT NULL,
  `charset` char(10) NOT NULL,
  `clientip` char(15) NOT NULL,
  `version` char(50) NOT NULL,
  `installtime` int(10) unsigned NOT NULL,
  `updatetime` int(10) unsigned NOT NULL,
  `uninstalltime` int(10) unsigned NOT NULL,
  `regtime` int(10) NOT NULL,
  `realname` char(20) NOT NULL,
  `phone` char(80) NOT NULL,
  `address` char(100) NOT NULL,
  `jianyi` varchar(255) NOT NULL,
  `prov` char(30) NOT NULL,
  `city` char(30) NOT NULL,
  `dist` char(30) NOT NULL,
  `groupexpiry` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `mokuais` text NOT NULL,
  `shibiema` char(4) NOT NULL,
  `token` char(6) NOT NULL,
  PRIMARY KEY  (`siteid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelm_server_site
-- ----------------------------
INSERT INTO `pre_cardelm_server_site` VALUES ('1', '0', 'http://localhost/demo/dz3utf8/', '', '', '', 'UTF-8', '', 'X3', '1373644800', '1373731200', '0', '0', '', '', '', '', '', '', '', '1405267200', '0', '', '', '');
INSERT INTO `pre_cardelm_server_site` VALUES ('2', '1', 'http://localhost/discuzdemo/dz3utf8/', 'bwkkB2', 'f3954214a15a1fb88eedfffff26fd650', '', 'utf-8', '127.0.0.1', 'X3-20130620-30000000', '1374206400', '1374208003', '0', '0', '', '', '', '', '', '', '', '0', '0', '', '', '');

-- ----------------------------
-- Table structure for `pre_cardelm_setting`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelm_setting`;
CREATE TABLE `pre_cardelm_setting` (
  `skey` char(255) NOT NULL,
  `svalue` text NOT NULL,
  PRIMARY KEY  (`skey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelm_setting
-- ----------------------------

-- ----------------------------
-- Table structure for `pre_cardelmserver_code`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelmserver_code`;
CREATE TABLE `pre_cardelmserver_code` (
  `codeid` mediumint(8) unsigned NOT NULL auto_increment,
  `type` char(20) NOT NULL,
  `key` char(40) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY  (`codeid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelmserver_code
-- ----------------------------
INSERT INTO `pre_cardelmserver_code` VALUES ('2', 'admin', 'php1', '&lt;?php\r\n$this_page = \'\';\r\n?&gt;');
INSERT INTO `pre_cardelmserver_code` VALUES ('3', 'admin', 'test', '&lt;?php\r\n    if(jdahsd){\r\n    }\r\n?&gt;');
INSERT INTO `pre_cardelmserver_code` VALUES ('4', 'admin', 'test1', 'sadfsadas');

-- ----------------------------
-- Table structure for `pre_cardelmserver_menu`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelmserver_menu`;
CREATE TABLE `pre_cardelmserver_menu` (
  `menuid` smallint(3) unsigned NOT NULL auto_increment,
  `menuname` char(20) NOT NULL,
  `menutitle` char(20) NOT NULL,
  `upid` smallint(3) NOT NULL,
  `displayorder` smallint(3) NOT NULL,
  PRIMARY KEY  (`menuid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelmserver_menu
-- ----------------------------
INSERT INTO `pre_cardelmserver_menu` VALUES ('1', 'system', '系统设置', '0', '0');
INSERT INTO `pre_cardelmserver_menu` VALUES ('2', 'setting', '基础设置', '1', '0');
INSERT INTO `pre_cardelmserver_menu` VALUES ('3', 'sitegroup', '站长组', '1', '1');
INSERT INTO `pre_cardelmserver_menu` VALUES ('4', 'site', '站长管理', '1', '2');
INSERT INTO `pre_cardelmserver_menu` VALUES ('5', 'menu', '菜单管理', '1', '3');
INSERT INTO `pre_cardelmserver_menu` VALUES ('6', 'mokuai', '模块管理', '1', '4');

-- ----------------------------
-- Table structure for `pre_cardelmserver_mokuai`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelmserver_mokuai`;
CREATE TABLE `pre_cardelmserver_mokuai` (
  `mokuaiid` smallint(3) unsigned NOT NULL auto_increment,
  `mokuainame` char(20) NOT NULL,
  `mokuaititle` char(20) NOT NULL,
  `mokuaiico` char(40) NOT NULL,
  `description` char(255) NOT NULL,
  `displayorder` smallint(3) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `system` tinyint(1) NOT NULL,
  PRIMARY KEY  (`mokuaiid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelmserver_mokuai
-- ----------------------------
INSERT INTO `pre_cardelmserver_mokuai` VALUES ('1', 'shop', '联盟商家', 'cf/041917n6ykgs6ke4qigasq.png', '商家联盟简介商家联盟简介商家联盟简介商家联盟简介商家联盟简介商家联盟简介商家联盟简介', '0', '0', '0');
INSERT INTO `pre_cardelmserver_mokuai` VALUES ('2', 'goods', '商品展示', '', '配合联盟商家的商品展示的模块', '0', '0', '0');
INSERT INTO `pre_cardelmserver_mokuai` VALUES ('3', 'dianping', '点评系统', '', '配合联盟商家的点评系统', '0', '0', '0');
INSERT INTO `pre_cardelmserver_mokuai` VALUES ('4', 'cardelm', '卡益联盟', 'cf/112337fjsgivts6z0otoss.png', '配合联盟商家的一卡通系统', '0', '0', '0');
INSERT INTO `pre_cardelmserver_mokuai` VALUES ('5', 'wxq123', '微信墙123', 'cf/112312rp14hiofsd46zhau.jpg', '配合联盟商家的微信系统', '0', '0', '0');

-- ----------------------------
-- Table structure for `pre_cardelmserver_mokuaiver`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelmserver_mokuaiver`;
CREATE TABLE `pre_cardelmserver_mokuaiver` (
  `mokuaiverid` smallint(3) unsigned NOT NULL auto_increment,
  `mokuaivername` char(20) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `updatedescription` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `mokuaiid` varchar(255) NOT NULL,
  PRIMARY KEY  (`mokuaiverid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelmserver_mokuaiver
-- ----------------------------
INSERT INTO `pre_cardelmserver_mokuaiver` VALUES ('1', 'v1.0', '1373873541', '联盟商家的版本说明', '0', '1');

-- ----------------------------
-- Table structure for `pre_cardelmserver_page`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelmserver_page`;
CREATE TABLE `pre_cardelmserver_page` (
  `pageid` mediumint(8) unsigned NOT NULL auto_increment,
  `mokuaiid` smallint(3) NOT NULL,
  `pagetype` char(20) NOT NULL,
  `pagename` char(40) NOT NULL,
  `pagetitle` char(40) NOT NULL,
  `description` char(255) NOT NULL,
  PRIMARY KEY  (`pageid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelmserver_page
-- ----------------------------
INSERT INTO `pre_cardelmserver_page` VALUES ('1', '1', 'admin', 'setting', '设置', '系统自带的设置文件');
INSERT INTO `pre_cardelmserver_page` VALUES ('2', '1', 'admin', 'cats', '分类管理', '分类管理');
INSERT INTO `pre_cardelmserver_page` VALUES ('3', '2', 'admin', 'setting', '设置', '系统自带的设置文件');
INSERT INTO `pre_cardelmserver_page` VALUES ('6', '1', 'admin', 'shoplist', '商家管理', '商家管理');
INSERT INTO `pre_cardelmserver_page` VALUES ('7', '1', 'index', 'shopdisplay', '联盟商家', '前台的店铺展示');

-- ----------------------------
-- Table structure for `pre_cardelmserver_site`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelmserver_site`;
CREATE TABLE `pre_cardelmserver_site` (
  `siteid` mediumint(8) unsigned NOT NULL auto_increment,
  `sitegroupid` smallint(3) NOT NULL,
  `siteurl` varchar(255) NOT NULL,
  `salt` char(6) NOT NULL,
  `sitekey` char(32) NOT NULL,
  `searchurl` varchar(255) NOT NULL,
  `charset` char(10) NOT NULL,
  `clientip` char(15) NOT NULL,
  `version` char(50) NOT NULL,
  `installtime` int(10) unsigned NOT NULL,
  `updatetime` int(10) unsigned NOT NULL,
  `uninstalltime` int(10) unsigned NOT NULL,
  `regtime` int(10) NOT NULL,
  `realname` char(20) NOT NULL,
  `phone` char(80) NOT NULL,
  `address` char(100) NOT NULL,
  `jianyi` varchar(255) NOT NULL,
  `prov` char(30) NOT NULL,
  `city` char(30) NOT NULL,
  `dist` char(30) NOT NULL,
  `groupexpiry` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  `mokuais` text NOT NULL,
  `shibiema` char(4) NOT NULL,
  `token` char(6) NOT NULL,
  `sitegroup` varchar(255) NOT NULL,
  PRIMARY KEY  (`siteid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelmserver_site
-- ----------------------------
INSERT INTO `pre_cardelmserver_site` VALUES ('1', '0', 'http://localhost/demo/dz3utf8/', '', '', '', 'UTF-8', '', 'X3', '1373644800', '1373731200', '0', '0', '', '', '', '', '', '', '', '1405267200', '0', '', '', '', '1');

-- ----------------------------
-- Table structure for `pre_cardelmserver_sitegroup`
-- ----------------------------
DROP TABLE IF EXISTS `pre_cardelmserver_sitegroup`;
CREATE TABLE `pre_cardelmserver_sitegroup` (
  `sitegroupid` smallint(3) unsigned NOT NULL auto_increment,
  `sitegroupname` char(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `mokuaitest` varchar(255) NOT NULL,
  PRIMARY KEY  (`sitegroupid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pre_cardelmserver_sitegroup
-- ----------------------------
INSERT INTO `pre_cardelmserver_sitegroup` VALUES ('1', '测试组', '1', '1');
INSERT INTO `pre_cardelmserver_sitegroup` VALUES ('2', '设计组', '1', '1');
