/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : kjoestock

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-01-02 20:35:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `transaction`
-- ----------------------------
DROP TABLE IF EXISTS `transaction`;
CREATE TABLE `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_type` int(11) DEFAULT NULL,
  `trans_date` datetime DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `prod_code` varchar(255) DEFAULT NULL,
  `prod_name` varchar(255) DEFAULT NULL,
  `prod_model` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `promotion` varchar(255) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of transaction
-- ----------------------------
INSERT INTO `transaction` VALUES ('1', '1', '2020-01-02 03:01:58', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, 'สำนักงานใหญ่', '---', '2619', '4');
INSERT INTO `transaction` VALUES ('2', '1', '2020-01-02 03:01:58', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, 'สำนักงานใหญ่', '---', '2619', '4');
INSERT INTO `transaction` VALUES ('3', '1', '2020-01-02 03:01:58', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, 'สำนักงานใหญ่', '---', '2619', '4');
INSERT INTO `transaction` VALUES ('4', '1', '2020-01-02 03:01:58', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, 'สำนักงานใหญ่', '---', '2619', '4');
INSERT INTO `transaction` VALUES ('5', '2', '2020-01-02 08:01:54', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, '00001', '---', '2519', '4');
INSERT INTO `transaction` VALUES ('6', '2', '2020-01-02 08:01:27', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, '00001', '---', '2519', '4');
INSERT INTO `transaction` VALUES ('7', '2', '2020-01-02 08:01:46', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, '00001', '---', '2519', '4');
INSERT INTO `transaction` VALUES ('8', '2', '2020-01-02 08:01:30', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, '00001', '---', '2519', '4');
INSERT INTO `transaction` VALUES ('9', '2', '2020-01-02 08:01:38', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, '00001', '---', '2519', '4');
INSERT INTO `transaction` VALUES ('10', '2', '2020-01-02 08:01:02', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, 'สำนักงานใหญ่', '---', '2619', '4');
INSERT INTO `transaction` VALUES ('11', '2', '2020-01-02 08:01:10', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, '00001', '---', '2519', '4');
INSERT INTO `transaction` VALUES ('12', '2', '2020-01-02 08:01:39', null, 'ML01XCD2-2157514', 'MICHELIN 215/75R14 112P XCD2', null, '00001', '---', '2119', '4');
INSERT INTO `transaction` VALUES ('13', '2', '2020-01-02 08:01:46', null, 'ML01XCD2-2157514', 'MICHELIN 215/75R14 112P XCD2', null, '00001', '---', '2119', '4');
INSERT INTO `transaction` VALUES ('14', '2', '2020-01-02 08:01:14', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, 'สำนักงานใหญ่', '---', '2619', '4');
INSERT INTO `transaction` VALUES ('15', '1', '2020-01-02 08:01:39', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, '00001', '---', '2519', '4');
INSERT INTO `transaction` VALUES ('16', '1', '2020-01-02 08:01:11', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, '00001', '---', '2519', '4');
INSERT INTO `transaction` VALUES ('17', '1', '2020-01-02 08:01:03', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, '00001', '---', '2519', '4');
INSERT INTO `transaction` VALUES ('18', '2', '2020-01-02 08:01:03', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, '00001', '---', '2519', '4');
INSERT INTO `transaction` VALUES ('19', '2', '2020-01-02 08:01:05', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, '00001', '---', '2519', '4');
INSERT INTO `transaction` VALUES ('20', '2', '2020-01-02 08:01:06', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, '00001', '---', '2519', '4');
INSERT INTO `transaction` VALUES ('21', '2', '2020-01-02 08:01:08', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, 'สำนักงานใหญ่', '---', '2619', '4');
INSERT INTO `transaction` VALUES ('22', '2', '2020-01-02 08:01:10', null, 'BSL01L677-19514C', 'BRIDGESTONE 195R14C 8PR L677', null, 'สำนักงานใหญ่', '---', '2619', '4');
INSERT INTO `transaction` VALUES ('23', '1', '2020-01-02 08:01:53', null, 'FSL01CV9000-19514C', 'FIRESTONE 195R14C 8PR CV9000', null, 'สำนักงานใหญ่', '---', '3719', '4');
INSERT INTO `transaction` VALUES ('24', '1', '2020-01-02 08:01:53', null, 'FSL01CV9000-19514C', 'FIRESTONE 195R14C 8PR CV9000', null, 'สำนักงานใหญ่', '---', '3719', '4');
INSERT INTO `transaction` VALUES ('25', '1', '2020-01-02 08:01:53', null, 'FSL01CV9000-19514C', 'FIRESTONE 195R14C 8PR CV9000', null, 'สำนักงานใหญ่', '---', '3719', '4');
INSERT INTO `transaction` VALUES ('26', '1', '2020-01-02 08:01:53', null, 'FSL01CV9000-19514C', 'FIRESTONE 195R14C 8PR CV9000', null, 'สำนักงานใหญ่', '---', '3719', '4');
