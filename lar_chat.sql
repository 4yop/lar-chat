/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : lar_chat

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2021-05-26 17:52:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '个性签名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', '1', '', '2021-03-11 17:21:39', '1', '1', '2021-03-11 17:21:26', '2021-03-11 17:21:28', '', '想做①嗰佷酷の亽，扭頭僦赱，比伱殘忍，比伱狠。');
INSERT INTO `users` VALUES ('2', '528', 'asdf982034789@qq.com', null, '$2y$10$Y9iJMc6eIr7fkHQaU7iKO.LSuDoA6Hp.2q.vlMQQyiz75N2UE04P6', null, null, null, '/static/img/guanxi.d2e10cb3.jpg', '屌你屎忽。');
INSERT INTO `users` VALUES ('3', '456', '1131559748@qq.com', null, '$2y$10$sxEvQ9kanLbEhUpFVy8juuMJB0BULK6/bM8wCLNR1OR9UKdDEWibS', null, null, null, '/static/img/guanxi.d2e10cb3.jpg', '屌你屎忽');

-- ----------------------------
-- Table structure for user_friends
-- ----------------------------
DROP TABLE IF EXISTS `user_friends`;
CREATE TABLE `user_friends` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `friend_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '好友id',
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user_friends
-- ----------------------------
INSERT INTO `user_friends` VALUES ('1', '2', '3', null, null, '0');
INSERT INTO `user_friends` VALUES ('2', '3', '2', null, null, '0');
