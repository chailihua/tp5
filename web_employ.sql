/*
 Navicat Premium Data Transfer

 Source Server         : sanj
 Source Server Type    : MySQL
 Source Server Version : 50717
 Source Host           : 127.0.0.1:3306
 Source Schema         : sanj

 Target Server Type    : MySQL
 Target Server Version : 50717
 File Encoding         : 65001

 Date: 09/07/2020 16:20:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for web_employ
-- ----------------------------
DROP TABLE IF EXISTS `web_employ`;
CREATE TABLE `web_employ`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT 'MD5密码',
  `status` tinyint(1) UNSIGNED NOT NULL COMMENT '用户状态:1正常；2冻结',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `user_name`(`user_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of web_employ
-- ----------------------------
INSERT INTO `web_employ` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- ----------------------------
-- Table structure for web_house_reserve
-- ----------------------------
DROP TABLE IF EXISTS `web_house_reserve`;
CREATE TABLE `web_house_reserve`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL COMMENT '入住时间',
  `end_date` date NOT NULL COMMENT '退房时间',
  `house_type` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '房间类型',
  `house_num` tinyint(2) NOT NULL COMMENT '预定间数',
  `contact` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '联系人姓名',
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '联系人电话',
  `remark` text CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '备注',
  `status` tinyint(1) UNSIGNED NOT NULL COMMENT '状态:0:待入住;1:未入住退房;2:入住后退房;',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '客房预定记录表' ROW_FORMAT = Dynamic STORAGE MEMORY;

-- ----------------------------
-- Table structure for web_house_type
-- ----------------------------
DROP TABLE IF EXISTS `web_house_type`;
CREATE TABLE `web_house_type`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(2) NOT NULL COMMENT '房间类型',
  `des` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '房间类型描述',
  `is_valid` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否有效:1有效;0无效',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '房间类型表' ROW_FORMAT = Dynamic STORAGE MEMORY;

-- ----------------------------
-- Records of web_house_type
-- ----------------------------
INSERT INTO `web_house_type` VALUES (1, 1, '豪华大床房(门市价898元、网上预订499元)', 1);
INSERT INTO `web_house_type` VALUES (2, 2, '豪华标准间(门市价898元、网上预订499元)', 1);
INSERT INTO `web_house_type` VALUES (3, 3, '行政套房(门市价1198元、网上预订659元)', 1);
INSERT INTO `web_house_type` VALUES (4, 4, '商务休闲房(门市价998元、网上预订549元)', 1);
INSERT INTO `web_house_type` VALUES (5, 5, '豪华套房(门市价1588元、网上预订879元)', 1);

SET FOREIGN_KEY_CHECKS = 1;
