/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 100131
Source Host           : localhost:3306
Source Database       : crud

Target Server Type    : MYSQL
Target Server Version : 100131
File Encoding         : 65001

Date: 2020-01-18 11:33:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`,`code`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `mark` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `price` float(10,2) NOT NULL,
  PRIMARY KEY (`id`,`code`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
