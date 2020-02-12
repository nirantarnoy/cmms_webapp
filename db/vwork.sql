/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : vwork

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-02-12 13:57:00
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('1', 'TB304041', 'SCG VIETNAM', 'master', 'Tarnoy', 'gam@ff.com', '09999999', '1', null, '1581480230', '4', null, null);
INSERT INTO `customer` VALUES ('2', '111111', 'camel', 'pro', 'gram', 'niran_tarlek@hotmail.com', '023333333', '2', null, '1581480968', '4', '1581482578', '4');
INSERT INTO `customer` VALUES ('3', '2222222', 'tpbo', 'mas', 'ter', 'mas@ff.com', '07777777', '2', null, '1581482681', '4', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employee
-- ----------------------------
INSERT INTO `employee` VALUES ('3', '1', null, 'Arpat', 'Kanjana', 'Project Management - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'arpatk@scg.com', '0922567316', '1', null, '2', null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('4', '1', null, 'Jakradul', 'Makrungnapa', 'Project Management - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'jakradum@scg.com', '0832440401', '1', null, '2', null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('5', '1', null, 'Watcharaphong', 'Suchatsunthon', 'Project Management - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'watcsuch@scg.com', '0655026820', '1', null, '2', null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('6', '3', null, 'Jirapat', 'Pinvisate', 'Project Management - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'jirapapi@scg.com', '0909714593', '1', null, '2', null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('7', '1', null, 'Nathee', 'Siripornchai', 'Project Management - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'nathees@scg.com', '0867440361', '1', null, '2', null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('8', '1', null, 'Aqpakpamol', 'Chantee', 'Process Technology - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'aqpakpac@scg.com', '0991919563', '1', null, '2', null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('9', '1', null, 'Pimook', 'Tanteeratum', 'Process Technology - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'pimookt@scg.com', '0819101418', '1', null, '2', null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('10', '1', null, 'Natthakorn', 'Jirathanasin', 'Process Technology - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'natthjir@scg.com', '0926456266', '1', null, '2', null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('11', '1', null, 'Witthawin', 'Tatiyaborwornchai', 'Process Technology - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'witthawt@scg.com', '0873607057', '1', null, '2', null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('12', '1', null, 'Traipat', 'Wongsamal', 'Olefins', 'Q3/2', '2020-01-08 00:00:00', 'traipatw@scg.com', '0855919964', '1', null, '2', null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('13', '1', null, 'Nuttawut', 'Lertjaruchokkajorn', 'Olefins', 'Q3/2', '2020-01-08 00:00:00', 'nuttawul@scg.com', '0948969198', '1', null, '2', null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('14', '1', null, 'Wirasak', 'Sonamthiang', 'C4&Utilities', 'Q3/2', '2020-01-08 00:00:00', 'wirasaks@scg.com', '0924688893', '1', null, '2', null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('15', '1', null, 'Ronnakrit', 'Junrit', 'C4&Utilities', 'Q3/2', '2020-01-08 00:00:00', 'ronnakrj@scg.com', '0831541279', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('16', '1', null, 'Somboon', 'Pieanshana', 'Project Management - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'sombopie@scg.com', '0892095881', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('17', '1', null, 'Naris', 'Pramteerasomboon', 'Process Technology - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'naripr@scg.com', '0892450481', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('18', '3', null, 'Unchalee', 'Mulalee', 'Process Technology - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'unchalem@scg.com', '0988835293', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('19', '1', null, 'Chai', 'Chomchuen', 'Process Technology - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'chaichom@scg.com', '0851552924', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('20', '1', null, 'Panupong', 'Thammakul', 'Process Technology - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'panupoth@scg.com', '0863453164', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('21', '3', null, 'Saengkae', 'Pairattanakorn', 'Process Technology - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'saengkap@scg.com', '0815690406', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('22', '1', null, 'Arnupab', 'Krueaongardnukul', 'Process Technology - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'arnupabk@scg.com', '0894476824', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('23', '1', null, 'Thanapat', 'Kaweetraiphop', 'Commercial', 'Q3/1', '2020-01-07 00:00:00', 'thanapka@scg.com', '', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('24', '2', null, 'Pimpaka', 'Srichatrapimuk', 'Commercial', 'Q3/1', '2020-01-07 00:00:00', 'pimpakas@scg.com', '0817537613', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('25', '1', null, 'Vorachart', 'Chongsuk', 'Commercial', 'Q3/1', '2020-01-07 00:00:00', 'vorachac@scg.com', '0819882766', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('26', '1', null, 'Charlie', 'Chowdhury', 'Finance and Accounting', 'Q3/1', '2020-01-07 00:00:00', 'charliec@scg.com', '', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('27', '1', null, 'Apinun', 'Jirakomate', 'Finance and Accounting', 'Q3/1', '2020-01-07 00:00:00', 'apinunj@scg.com', '0897772959', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('28', '1', null, 'Asawin', 'Kaenkong', 'Olefins', 'Q3/2', '2020-01-08 00:00:00', 'asawink@scg.com', '0817611095', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('29', '1', null, 'Pittaya', 'Khanungkhid', 'Olefins', 'Q3/2', '2020-01-08 00:00:00', 'pittaykh@scg.com', '0851420492', '1', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('30', '1', null, 'Nirundorn', 'Wongmankongsin', 'Project Management - Downstream', 'Q3/1', '2020-01-07 00:00:00', 'nirundow@scg.com', '0817505940', '2', null, null, null, null, null, null, null, null, null);
INSERT INTO `employee` VALUES ('31', '3', null, 'Sarisa', 'Boonkrua', 'Finance and Accounting', 'Q3/1', '2020-01-07 00:00:00', '', '', '1', null, null, null, null, null, null, null, null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of job
-- ----------------------------
INSERT INTO `job` VALUES ('3', 'fghg', '0000-00-00 00:00:00', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '1581436815', '1581483281', '4', '4');

-- ----------------------------
-- Table structure for `job_employee`
-- ----------------------------
DROP TABLE IF EXISTS `job_employee`;
CREATE TABLE `job_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of job_employee
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
