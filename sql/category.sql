/*
 Navicat Premium Dump SQL

 Source Server         : test
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 17/02/2025 11:16:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id` int NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `category_content` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (1, '生活板', '生活瑣事、日常趣事，這裡都能聊！📢 無論是美食分享、旅遊攻略、理財心得，還是居家收納、時間管理，都歡迎來討論交流，讓生活變得更美好！✨');
INSERT INTO `category` VALUES (2, '3C板', '最新科技、手機、筆電、智慧家電，這裡通通有！📱💻 無論是新品開箱、選購指南，還是軟硬體問題討論，快來和大家一起交流你的 3C 生活！');
INSERT INTO `category` VALUES (3, '遊戲板', '不管是主機、PC、手遊，還是懷舊經典，這裡都是玩家的天堂！🎮💥 來分享攻略、戰績、心得，找戰友組隊，或是討論最新遊戲資訊，一起享受遊戲的樂趣！');
INSERT INTO `category` VALUES (4, '動漫板', '二次元愛好者集合！📺🎨 這裡可以聊經典神作、推薦冷門佳作、討論劇情發展，也能分享動漫周邊、角色應援，無論新番還是懷舊動畫，都歡迎來交流！');
INSERT INTO `category` VALUES (5, '感情板', '戀愛煩惱、曖昧心事、友情困惑，這裡是你的樹洞與軍師！💌💕 無論是甜蜜放閃還是情感疑難雜症，都可以來討論，讓我們一起用心傾聽，陪你走過心動與心痛！');
INSERT INTO `category` VALUES (6, '追星板', '歡迎來到追星板！✨ 這裡是粉絲們交流的天地，不管你喜歡韓團、日星、歐美偶像，還是動漫聲優，都可以在這裡分享最新資訊、討論舞台表現、聊聊愛豆的趣事，一起為偶像應援！💖 快來加入我們吧！');
INSERT INTO `category` VALUES (7, '影劇板', '電影、影集、綜藝，這裡是觀影迷的交流基地！🎬📺 熱門大片、冷門佳片、追劇心得，還有經典回顧與影評分析，快來一起討論你的必看清單！🍿');

SET FOREIGN_KEY_CHECKS = 1;
