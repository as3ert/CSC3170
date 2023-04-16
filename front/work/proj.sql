/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : proj

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 16/04/2023 10:00:04
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for administers
-- ----------------------------
DROP TABLE IF EXISTS `administers`;
CREATE TABLE `administers`  (
  `ADMINISTER_ID` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SUBCOMPANY_ID` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ADMINISTER_NAME` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PSSDWORD` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ADMINISTER_ID`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of administers
-- ----------------------------

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `EMPLOYEE_ID` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `MANAGE_PROJECT_ID` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `EMPLOYEE_NAME` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `AGE` decimal(2, 0) NOT NULL,
  `ENTRY_DATE` date NOT NULL,
  `GENDER` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `SALARY` decimal(8, 2) NOT NULL,
  `POSITION` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `LOCATION` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PSSDWORD` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`EMPLOYEE_ID`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employees
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `EMPLOYEE_ID` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PROJECT_ID` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`EMPLOYEE_ID`, `PROJECT_ID`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for managers
-- ----------------------------
DROP TABLE IF EXISTS `managers`;
CREATE TABLE `managers`  (
  `MANAGER_ID` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PROJECT_ID` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`MANAGER_ID`, `PROJECT_ID`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of managers
-- ----------------------------

-- ----------------------------
-- Table structure for projects
-- ----------------------------
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects`  (
  `PROJECT_ID` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ADMINISTER_ID` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `PROJECT_NAME` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `START_DATE` date NOT NULL,
  `END_DATE` date NOT NULL,
  `FRONT_END_NUMBER` decimal(2, 0) NOT NULL,
  `BACK_END_NUMBER` decimal(2, 0) NOT NULL,
  `TESTING_NUMBER` decimal(2, 0) NOT NULL,
  PRIMARY KEY (`PROJECT_ID`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of projects
-- ----------------------------

-- ----------------------------
-- Table structure for subcompanies
-- ----------------------------
DROP TABLE IF EXISTS `subcompanies`;
CREATE TABLE `subcompanies`  (
  `SUBCOMPANY_ID` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `BUDGET` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `LOCATION` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`SUBCOMPANY_ID`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subcompanies
-- ----------------------------

USE proj;

-- -----------------------------------------------------

INSERT INTO `employees` (`EMPLOYEE_ID`, `EMPLOYEE_NAME`, `AGE`, `ENTRY_DATE`,
                         `GENDER`, `SALARY`, `POSITION`, `LOCATION`, `password`) VALUES
('000001', 'John', '24', '2021-08-14', 'Male', '11000', 'Front End', 'Shenzhen', `123456`),
('000002', 'Mary', '23', '2022-07-18', 'Female', '13000', 'Front End', 'Shenzhen', `123456`),
('000003', 'Peter', '26', '2020-01-04', 'Male', '12000', 'Front End', 'Shenzhen', `123456`),
('000004', 'Andrew', '27', '2019-06-05', 'Male', '11000', 'Front End', 'New York', `123456`),
('000005', 'Robert', '25', '2020-09-30', 'Male', '15000', 'Front End', 'New York', `123456`),
('000006', 'Michael', '26', '2021-06-07', 'Female', '8000', 'Front End', 'New York', `123456`),
('000007', 'Thomas', '22', '2022-08-19', 'Male', '14000', 'Front End', 'Berlin', `123456`),
('000008', 'Charles', '29', '2017-04-18', 'Female', '12000', 'Front End', 'Berlin', `123456`),
('000009', 'Christopher', '30', '2017-01-20', 'Female', '11000', 'Front End', 'Berlin', `123456`),
('000010', 'Song', '21', '2022-03-13', 'Female', '21000', 'Front End', 'Berlin', `123456`),
('000011', 'Arthur', '22', '2021-12-30', 'Male', '31000', 'Back End', 'Shenzhen', `123456`),
('000012', 'Paul', '24', '2021-06-08', 'Male', '17000', 'Back End', 'Shenzhen', `123456`),
('000013', 'Mark', '26', '2020-03-05', 'Male', '20000', 'Back End', 'Shenzhen', `123456`),
('000014', 'William', '28', '2019-11-11', 'Male', '26000', 'Back End', 'New York', `123456`),
('000015', 'Richard', '24', '2021-08-18', 'Male', '23000', 'Back End', 'New York', `123456`),
('000016', 'Joseph', '27', '2019-01-15', 'Male', '17000', 'Back End', 'New York', `123456`),
('000017', 'Daniel', '25', '2021-12-02', 'Male', '20000', 'Back End', 'Berlin', `123456`),
('000018', 'Matthew', '29', '2019-09-02', 'Male', '19000', 'Back End', 'Berlin', `123456`),
('000019', 'Anthony', '22', '2022-10-01', 'Female', '16000', 'Back End', 'Berlin', `123456`),
('000020', 'Donald', '25', '2021-06-03', 'Male', '21000', 'Back End', 'Berlin', `123456`),
('000021', 'Jane', '23', '2022-07-09', 'Female', '9000', 'Testing', 'Shenzhen', `123456`),
('000022', 'David', '26', '2021-01-02', 'Male', '12000', 'Testing', 'Shenzhen', `123456`),
('000023', 'Steven', '28', '2020-01-01', 'Male', '21000', 'Testing', 'Shenzhen', `123456`),
('000024', 'Mark', '24', '2021-08-26', 'Male', '14000', 'Testing', 'New York', `123456`),
('000025', 'Paul', '23', '2022-09-24', 'Male', '15000', 'Testing', 'New York', `123456`),
('000026', 'George', '24', '2021-03-16', 'Male', '13000', 'Testing', 'New York', `123456`),
('000027', 'Kenneth', '23', '2022-06-28', 'Female', '11000', 'Testing', 'Berlin', `123456`),
('000028', 'Andrew', '27', '2019-08-09', 'Male', '12000', 'Testing', 'Berlin', `123456`),
('000029', 'Edward', '29', '2020-07-18', 'Female', '10000', 'Testing', 'Berlin', `123456`),
('000030', 'Brian', '28', '2021-08-29', 'Male', '11000', 'Testing', 'Berlin', `123456`);

INSERT INTO `administers` (`ADMINISTER_ID`, `SUBCOMPANY_ID`,
                           `ADMINISTER_NAME`) VALUES
('100001', '000001', 'Lucas'),
('100002', '000002', 'Lily'),
('100003', '000003', 'Tom');

INSERT INTO `subcompanies` (`SUBCOMPANY_ID`, `BUDGET`, `LOCATION`) VALUES
('000001', '200000', 'Shenzhen'),
('000002', '200000', 'New York'),
('000003', '200000', 'Berlin');

SET FOREIGN_KEY_CHECKS = 1;

INSERT INTO `projects` (`PROJECT_ID`, `ADMINISTER_ID`,
                       `PROJECT_NAME`, `START_DATE`, `END_DATE`, `FRONT_END_NUMBER`,
                       `BACK_END_NUMBER`, `TESTING_NUMBER`) VALUES 
('200001', '100001', 'Shenzhen_Project1', '2023-01-01', '2024-01-01', '1', '1', '1');

INSERT INTO `projects` (`PROJECT_ID`, `ADMINISTER_ID`,
                       `PROJECT_NAME`, `START_DATE`, `END_DATE`, `FRONT_END_NUMBER`,
                       `BACK_END_NUMBER`, `TESTING_NUMBER`) VALUES 
('200002', '100001', 'Shenzhen_Project2', '2023-01-02', '2024-01-02', '1', '1', '1');

INSERT INTO `projects` (`PROJECT_ID`, `ADMINISTER_ID`,
                       `PROJECT_NAME`, `START_DATE`, `END_DATE`, `FRONT_END_NUMBER`,
                       `BACK_END_NUMBER`, `TESTING_NUMBER`) VALUES 
('200003', '100003', 'Berlin_Project1', '2023-01-03', '2024-01-03', '1', '1', '1');
