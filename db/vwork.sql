/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : vwork

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-02-09 22:29:40
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `customer`
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('1', 'TB304040', null, 'Tarlek', 'Tarnoy', 'niran@ff.com', '09884848898', null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `dirparty`
-- ----------------------------
DROP TABLE IF EXISTS `dirparty`;
CREATE TABLE `dirparty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dirparty
-- ----------------------------
INSERT INTO `dirparty` VALUES ('1', 'HR', null);
INSERT INTO `dirparty` VALUES ('2', 'พนักงาน', null);
INSERT INTO `dirparty` VALUES ('3', 'มหาวิทยาลัย', null);
INSERT INTO `dirparty` VALUES ('4', 'สนง.ตำรวจ', null);
INSERT INTO `dirparty` VALUES ('5', 'กระทรวงแรงงาน', null);
INSERT INTO `dirparty` VALUES ('6', 'กงสุล', null);
INSERT INTO `dirparty` VALUES ('7', 'สถานทูต', null);

-- ----------------------------
-- Table structure for `employee`
-- ----------------------------
DROP TABLE IF EXISTS `employee`;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` int(2) DEFAULT NULL,
  `emp_no` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `period` varchar(255) DEFAULT NULL,
  `effective_date` datetime DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `existing_wp` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `emp_start_date` datetime DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES ('1', null, '200001', 'นิรันดร์', 'วังญาติ', '1', null, null, 'dfdf@cdd.com', '098848448', null, '2020-01-28', null, '1', '1', '2020-02-05 15:44:13', null, null, null, null);

-- ----------------------------
-- Table structure for `job`
-- ----------------------------
DROP TABLE IF EXISTS `job`;
CREATE TABLE `job` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_no` varchar(255) DEFAULT NULL,
  `job_date` datetime DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of job
-- ----------------------------

-- ----------------------------
-- Table structure for `job_line`
-- ----------------------------
DROP TABLE IF EXISTS `job_line`;
CREATE TABLE `job_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) DEFAULT NULL,
  `action_date` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `detail` text,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of job_line
-- ----------------------------

-- ----------------------------
-- Table structure for `job_title`
-- ----------------------------
DROP TABLE IF EXISTS `job_title`;
CREATE TABLE `job_title` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of job_title
-- ----------------------------
INSERT INTO `job_title` VALUES ('1', 'รับแจ้งข้อมูล', null);
INSERT INTO `job_title` VALUES ('2', 'ติดต่อ/เช็คข้อมูล', null);
INSERT INTO `job_title` VALUES ('3', 'ส่งเอกสารเพื่อขอลายเซ็น', null);
INSERT INTO `job_title` VALUES ('4', 'ยื่นเอกสาร', null);
INSERT INTO `job_title` VALUES ('5', 'รับเอกสาร', null);
INSERT INTO `job_title` VALUES ('6', 'ส่งมอบงาน', null);

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `usergroup` varchar(255) DEFAULT NULL,
  `use_start` time DEFAULT NULL,
  `use_end` time DEFAULT NULL,
  `branch_price` varchar(255) DEFAULT NULL,
  `is_product` int(11) DEFAULT NULL,
  `is_return` int(11) DEFAULT NULL,
  `is_history` int(11) DEFAULT NULL,
  `is_customer` int(11) DEFAULT NULL,
  `is_tool` int(11) DEFAULT NULL,
  `is_dashboard` int(11) DEFAULT NULL,
  `is_user` int(11) DEFAULT NULL,
  `is_all` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('3', 'niran.w', 'e10adc3949ba59abbe56e057f20f883e', 'tarlek tarnoy', 'Center', 'user', '07:00:00', '19:00:00', '00001', '1', '1', '1', '1', '1', '1', '0', '0');
INSERT INTO `user` VALUES ('4', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Administrator', 'Center', 'user', '07:00:00', '23:00:00', 'สำนักงานใหญ่', '1', '1', '1', '1', '1', '1', '1', '1');
