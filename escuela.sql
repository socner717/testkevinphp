/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : escuela

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 17/01/2019 11:59:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_alumnos
-- ----------------------------
DROP TABLE IF EXISTS `t_alumnos`;
CREATE TABLE `t_alumnos`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ap_paterno` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `ap_materno` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `activo` tinyint(1) NULL DEFAULT 1,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_alumnos
-- ----------------------------
INSERT INTO `t_alumnos` VALUES (1, 'John', 'Dow', 'Down', 1, '2019-01-16 13:08:21', '2019-01-16 13:08:21');

-- ----------------------------
-- Table structure for t_calificaciones
-- ----------------------------
DROP TABLE IF EXISTS `t_calificaciones`;
CREATE TABLE `t_calificaciones`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_t_materias` int(11) NOT NULL,
  `id_t_alumno` int(11) NOT NULL,
  `calificacion` decimal(10, 2) NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_t_materias`(`id_t_materias`) USING BTREE,
  CONSTRAINT `t_calificaciones_ibfk_1` FOREIGN KEY (`id_t_materias`) REFERENCES `t_materias` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `t_calificaciones_ibfk_2` FOREIGN KEY (`id_t_materias`) REFERENCES `t_materias` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_calificaciones
-- ----------------------------
INSERT INTO `t_calificaciones` VALUES (2, 1, 1, 7.00, '2019-01-16 22:47:36', '2019-01-16 22:47:44');
INSERT INTO `t_calificaciones` VALUES (3, 2, 1, 8.00, '2019-01-16 23:48:04', '2019-01-16 23:48:04');
INSERT INTO `t_calificaciones` VALUES (4, 3, 1, 10.00, '2019-01-16 23:48:18', '2019-01-16 23:48:18');

-- ----------------------------
-- Table structure for t_materias
-- ----------------------------
DROP TABLE IF EXISTS `t_materias`;
CREATE TABLE `t_materias`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `activo` tinyint(1) NULL DEFAULT 1,
  `created_at` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_materias
-- ----------------------------
INSERT INTO `t_materias` VALUES (1, 'matematicas', 1, '2019-01-16 13:22:21', '2019-01-16 13:22:21');
INSERT INTO `t_materias` VALUES (2, 'programacion I', 1, '2019-01-16 13:22:24', '2019-01-16 13:22:24');
INSERT INTO `t_materias` VALUES (3, 'ingenieria de sofware', 1, '2019-01-16 13:22:26', '2019-01-16 13:22:26');

SET FOREIGN_KEY_CHECKS = 1;
