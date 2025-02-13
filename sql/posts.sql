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

 Date: 13/02/2025 11:55:47
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `author` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `category_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_time` datetime(6) NULL DEFAULT NULL,
  `update_time` datetime(6) NULL DEFAULT NULL,
  `views` int NULL DEFAULT NULL,
  `likes` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES (1, '我老公', '如題 金珉奎><', 'e2d12e9f-bc4a-11ef-82d5-a036bc3bc806', '6', '2025-02-13 11:07:38.000000', '2025-02-13 11:07:43.000000', NULL, NULL);
INSERT INTO `posts` VALUES (2, '手機續航太差？這5個方法讓你的電量更持久！', '智慧型手機已成為我們生活的一部分，但電量總是不夠用？其實，透過降低螢幕亮度、關閉背景應用程式、自動調整省電模式等方式，可以有效延長電池壽命。趕快來看看更多小技巧吧！', '73b5be9c-baae-42ea-954e-8e7fd0e95368', '2', '2025-02-13 11:49:11.000000', '2025-02-13 11:49:14.000000', NULL, NULL);
INSERT INTO `posts` VALUES (3, '大家早餐都吃什麼？有人跟我一樣只喝豆漿嗎？', '我每天早上都只喝一杯黑咖啡就出門，不是因為減肥，而是單純沒胃口……?但現在c8餓^^ 想問問大家的早餐習慣，是一定要吃得超豐盛，還是跟我一樣簡單就好？有沒有什麼快速又不無聊的早餐推薦？', 'e2d12e9f-bc4a-11ef-82d5-a036bc3bc806', '1', '2025-02-13 11:50:05.000000', '2025-02-13 11:50:08.000000', NULL, NULL);
INSERT INTO `posts` VALUES (4, '最近有什麼超上癮的劇？求推薦！', '最近劇荒中，想找點好看的劇來追！剛看完《外傷重症中心》，覺得超好看，劇情緊湊無冷場!! 大家有沒有什麼推薦的影集或動畫？不管是燒腦、搞笑還是超展開都可以！', 'e2d12e9f-bc4a-11ef-82d5-a036bc3bc806', '7', '2025-02-13 11:54:31.000000', '2025-02-13 11:54:34.000000', NULL, NULL);
INSERT INTO `posts` VALUES (5, '這部動畫只有我覺得好看嗎？來找同好！', '有時候看到一部超讚的動畫，但跟朋友聊起來卻發現沒人看過，甚至被嫌棄QQ 有沒有哪部動畫是你私心超愛，但感覺討論度很低的？來找找有沒有人跟你一樣覺得它是神作！', 'e2d12e9f-bc4a-11ef-82d5-a036bc3bc806', '4', '2025-02-13 11:55:07.000000', '2025-02-13 11:55:09.000000', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
