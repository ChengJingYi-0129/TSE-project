-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 17, 2025 at 05:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tse_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `Admin_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Admin_name` varchar(255) NOT NULL,
  `Admin_pass` varchar(255) NOT NULL,
  PRIMARY KEY (`Admin_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_name`, `Admin_pass`) VALUES
(1, 'Admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
CREATE TABLE IF NOT EXISTS `enrollment` (
  `enrollment_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) NOT NULL,
  `admin_id` varchar(20) DEFAULT NULL,
  `semester_id` varchar(20) NOT NULL,
  `enrollment_date` date DEFAULT NULL,
  `student_status` varchar(50) DEFAULT NULL,
  `final_grade` varchar(2) DEFAULT NULL,
  `registration_start` date DEFAULT NULL,
  `registration_end` date DEFAULT NULL,
  `is_retake` tinyint(1) DEFAULT NULL,
  `Subject_Code` varchar(8) NOT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`enrollment_id`),
  KEY `student_id` (`student_id`),
  KEY `fk_enrollment_semester` (`semester_id`),
  KEY `fk_enrollment_subject` (`Subject_Code`),
  KEY `fk_enrollment_schedule` (`schedule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `faculty_id` varchar(10) NOT NULL,
  `faculty_name` varchar(100) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`) VALUES
('FAFB', 'Faculty of Accountancy and Finance'),
('FIST', 'Faculty of Information Science and Technology'),
('FOE', 'Faculty of Engineering'),
('FOM', 'Faculty of Management');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

DROP TABLE IF EXISTS `lecturer`;
CREATE TABLE IF NOT EXISTS `lecturer` (
  `lecturer_id` varchar(20) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `Contact_Num` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `faculty_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`lecturer_id`),
  KEY `fk_lecturer_faculty` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecturer_id`, `Pass`, `first_name`, `last_name`, `Contact_Num`, `email`, `faculty_id`) VALUES
('L100001', '098f6bcd4621d373cade4e832627b4f6', 'Law', 'Xiao Xi', 12395712, 'LXX@gmail.com', 'FIST'),
('L100002', 'cc03e747a6afbbcbf8be7668acfebee5', 'Aaron', 'Yong', 10000002, 'aaron.yong@gmail.com', 'FIST'),
('L100003', 'cc03e747a6afbbcbf8be7668acfebee5', 'Hazel', 'Chia', 10000003, 'hazel.chia@gmail.com', 'FOM'),
('L100004', 'cc03e747a6afbbcbf8be7668acfebee5', 'Oscar', 'Koh', 10000004, 'oscar.koh@gmail.com', 'FOM'),
('L100005', 'cc03e747a6afbbcbf8be7668acfebee5', 'Daphne', 'Ng', 10000005, 'daphne.ng@gmail.com', 'FOM'),
('L100006', 'cc03e747a6afbbcbf8be7668acfebee5', 'Daphne', 'Ng', 10000006, 'daphne.ng@gmail.com', 'FIST'),
('L100007', 'cc03e747a6afbbcbf8be7668acfebee5', 'Ivy', 'Wong', 10000007, 'ivy.wong@gmail.com', 'FIST'),
('L100008', 'cc03e747a6afbbcbf8be7668acfebee5', 'Alice', 'Han', 10000008, 'alice.han@gmail.com', 'FIST'),
('L100009', 'cc03e747a6afbbcbf8be7668acfebee5', 'Samantha', 'Foo', 10000009, 'samantha.foo@gmail.com', 'FIST'),
('L100010', 'cc03e747a6afbbcbf8be7668acfebee5', 'Penelope', 'Quek', 10000010, 'penelope.quek@gmail.com', 'FIST'),
('L100011', 'cc03e747a6afbbcbf8be7668acfebee5', 'Daniel', 'Teo', 10000011, 'daniel.teo@gmail.com', 'FIST'),
('L100012', 'cc03e747a6afbbcbf8be7668acfebee5', 'Timothy', 'Toh', 10000012, 'timothy.toh@gmail.com', 'FIST'),
('L100013', 'cc03e747a6afbbcbf8be7668acfebee5', 'Tiffany', 'Koh', 10000013, 'tiffany.koh@gmail.com', 'FIST'),
('L100014', 'cc03e747a6afbbcbf8be7668acfebee5', 'Harris', 'Mak', 10000014, 'harris.mak@gmail.com', 'FIST'),
('L100015', 'cc03e747a6afbbcbf8be7668acfebee5', 'Aaron', 'Wong', 10000015, 'aaron.wong@gmail.com', 'FIST'),
('L100016', 'cc03e747a6afbbcbf8be7668acfebee5', 'Ethan', 'Soo', 10000016, 'ethan.soo@gmail.com', 'FIST'),
('L100017', 'cc03e747a6afbbcbf8be7668acfebee5', 'Xavier', 'Koh', 10000017, 'xavier.koh@gmail.com', 'FIST'),
('L100018', 'cc03e747a6afbbcbf8be7668acfebee5', 'Xavier', 'Chan', 10000018, 'xavier.chan@gmail.com', 'FIST'),
('L100019', 'cc03e747a6afbbcbf8be7668acfebee5', 'Kylie', 'Chong', 10000019, 'kylie.chong@gmail.com', 'FIST'),
('L100020', 'cc03e747a6afbbcbf8be7668acfebee5', 'Benjamin', 'Han', 10000020, 'benjamin.han@gmail.com', 'FIST'),
('L100021', 'cc03e747a6afbbcbf8be7668acfebee5', 'Jasmine', 'Chan', 10000021, 'jasmine.chan@gmail.com', 'FIST'),
('L100022', 'cc03e747a6afbbcbf8be7668acfebee5', 'Jasmine', 'Low', 10000022, 'jasmine.low@gmail.com', 'FIST'),
('L100023', 'cc03e747a6afbbcbf8be7668acfebee5', 'Timothy', 'Low', 10000023, 'timothy.low@gmail.com', 'FIST'),
('L100024', 'cc03e747a6afbbcbf8be7668acfebee5', 'Keith', 'Soo', 10000024, 'keith.soo@gmail.com', 'FIST'),
('L100025', 'cc03e747a6afbbcbf8be7668acfebee5', 'Jasmine', 'Chew', 10000025, 'jasmine.chew@gmail.com', 'FIST'),
('L100026', 'cc03e747a6afbbcbf8be7668acfebee5', 'Victor', 'Ismail', 10000026, 'victor.ismail@gmail.com', 'FIST'),
('L100027', 'cc03e747a6afbbcbf8be7668acfebee5', 'Quincy', 'Mah', 10000027, 'quincy.mah@gmail.com', 'FIST'),
('L100028', 'cc03e747a6afbbcbf8be7668acfebee5', 'Umi', 'Soon', 10000028, 'umi.soon@gmail.com', 'FIST'),
('L100029', 'cc03e747a6afbbcbf8be7668acfebee5', 'Wendy', 'Ng', 10000029, 'wendy.ng@gmail.com', 'FIST'),
('L100030', 'cc03e747a6afbbcbf8be7668acfebee5', 'Victor', 'Toh', 10000030, 'victor.toh@gmail.com', 'FIST'),
('L100031', 'cc03e747a6afbbcbf8be7668acfebee5', 'Grace', 'Yap', 10000031, 'grace.yap@gmail.com', 'FIST'),
('L100032', 'cc03e747a6afbbcbf8be7668acfebee5', 'Daphne', 'Yeo', 10000032, 'daphne.yeo@gmail.com', 'FIST'),
('L100033', 'cc03e747a6afbbcbf8be7668acfebee5', 'Bella', 'Teo', 10000033, 'bella.teo@gmail.com', 'FIST'),
('L100034', 'cc03e747a6afbbcbf8be7668acfebee5', 'Umi', 'Rahim', 10000034, 'umi.rahim@gmail.com', 'FIST'),
('L100035', 'cc03e747a6afbbcbf8be7668acfebee5', 'Grace', 'Manan', 10000035, 'grace.manan@gmail.com', 'FIST'),
('L100036', 'cc03e747a6afbbcbf8be7668acfebee5', 'Yvonne', 'Sim', 10000036, 'yvonne.sim@gmail.com', 'FIST'),
('L100037', 'cc03e747a6afbbcbf8be7668acfebee5', 'Ethan', 'Foo', 10000037, 'ethan.foo@gmail.com', 'FIST'),
('L100038', 'cc03e747a6afbbcbf8be7668acfebee5', 'Kylie', 'Zulkifli', 10000038, 'kylie.zulkifli@gmail.com', 'FIST'),
('L100039', 'cc03e747a6afbbcbf8be7668acfebee5', 'Nathan', 'Rahim', 10000039, 'nathan.rahim@gmail.com', 'FIST'),
('L100040', 'cc03e747a6afbbcbf8be7668acfebee5', 'Elaine', 'Neo', 10000040, 'elaine.neo@gmail.com', 'FIST'),
('L100041', 'cc03e747a6afbbcbf8be7668acfebee5', 'Hazel', 'Chong', 10000041, 'hazel.chong@gmail.com', 'FIST'),
('L100042', 'cc03e747a6afbbcbf8be7668acfebee5', 'Yuki', 'Sim', 10000042, 'yuki.sim@gmail.com', 'FIST'),
('L100043', 'cc03e747a6afbbcbf8be7668acfebee5', 'Wendy', 'Teo', 10000043, 'wendy.teo@gmail.com', 'FIST'),
('L100044', 'cc03e747a6afbbcbf8be7668acfebee5', 'Marcus', 'Sim', 10000044, 'marcus.sim@gmail.com', 'FIST'),
('L100045', 'cc03e747a6afbbcbf8be7668acfebee5', 'Victor', 'Han', 10000045, 'victor.han@gmail.com', 'FAFB'),
('L100046', 'cc03e747a6afbbcbf8be7668acfebee5', 'Luna', 'Toh', 10000046, 'luna.toh@gmail.com', 'FAFB');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `invoice_number` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`payment_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject_Code` varchar(8) NOT NULL,
  `lecturer_id` varchar(20) DEFAULT NULL,
  `semester_id` varchar(20) NOT NULL,
  `day_of_week` enum('Monday','Tuesday','Wednesday','Thursday','Friday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `Subject_Code` (`Subject_Code`),
  KEY `lecturer_id` (`lecturer_id`),
  KEY `fk_schedule_semester` (`semester_id`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `Subject_Code`, `lecturer_id`, `semester_id`, `day_of_week`, `start_time`, `end_time`, `location`) VALUES
(93, 'LMPU3182', 'L100001', '1', 'Friday', '09:00:00', '11:00:00', 'Physical'),
(94, 'LMPU3182', 'L100002', '1', 'Friday', '11:00:00', '13:00:00', 'Physical'),
(95, 'LMPU3192', 'L100003', '1', 'Monday', '15:00:00', '17:00:00', 'Online'),
(96, 'LMPU3192', 'L100004', '1', 'Friday', '09:00:00', '11:00:00', 'Physical'),
(97, 'MPU3214', 'L100005', '1', 'Friday', '11:00:00', '13:00:00', 'Physical'),
(98, 'MPU3214', 'L100006', '1', 'Wednesday', '15:00:00', '17:00:00', 'Online'),
(99, 'MPU3312', 'L100007', '1', 'Wednesday', '09:00:00', '11:00:00', 'Physical'),
(100, 'MPU3312', 'L100008', '1', 'Monday', '15:00:00', '17:00:00', 'Online'),
(101, 'MPU3409', 'L100009', '1', 'Wednesday', '14:00:00', '16:00:00', 'Online'),
(102, 'MPU3409', 'L100010', '1', 'Tuesday', '15:00:00', '17:00:00', 'Online'),
(103, 'TAI6213', 'L100011', '1', 'Tuesday', '09:00:00', '11:00:00', 'Physical'),
(104, 'TAI6213', 'L100012', '1', 'Wednesday', '08:00:00', '10:00:00', 'Online'),
(105, 'TAO1221', 'L100013', '1', 'Tuesday', '15:00:00', '17:00:00', 'Physical'),
(106, 'TAO1221', 'L100014', '1', 'Wednesday', '09:00:00', '11:00:00', 'Online'),
(107, 'TBS6313', 'L100015', '1', 'Monday', '13:00:00', '15:00:00', 'Physical'),
(108, 'TBS6313', 'L100016', '1', 'Friday', '08:00:00', '10:00:00', 'Online'),
(109, 'TCC6323', 'L100017', '1', 'Thursday', '14:00:00', '16:00:00', 'Physical'),
(110, 'TCC6323', 'L100018', '1', 'Wednesday', '10:00:00', '12:00:00', 'Online'),
(111, 'TCI6313', 'L100019', '1', 'Monday', '14:00:00', '16:00:00', 'Physical'),
(112, 'TCI6313', 'L100020', '1', 'Thursday', '09:00:00', '11:00:00', 'Online'),
(113, 'TCL6323', 'L100021', '1', 'Wednesday', '11:00:00', '13:00:00', 'Physical'),
(114, 'TCL6323', 'L100022', '1', 'Monday', '08:00:00', '10:00:00', 'Online'),
(115, 'TCN6313', 'L100023', '1', 'Friday', '13:00:00', '15:00:00', 'Physical'),
(116, 'TCN6313', 'L100024', '1', 'Tuesday', '13:00:00', '15:00:00', 'Online'),
(117, 'TCP6114', 'L100025', '1', 'Wednesday', '10:00:00', '12:00:00', 'Physical'),
(118, 'TCP6114', 'L100026', '1', 'Thursday', '13:00:00', '15:00:00', 'Online'),
(119, 'TCV6313', 'L100027', '1', 'Tuesday', '10:00:00', '12:00:00', 'Physical'),
(120, 'TCV6313', 'L100028', '1', 'Monday', '13:00:00', '15:00:00', 'Online'),
(121, 'TDA6313', 'L100029', '1', 'Wednesday', '08:00:00', '10:00:00', 'Physical'),
(122, 'TDA6313', 'L100030', '1', 'Friday', '14:00:00', '16:00:00', 'Online'),
(123, 'TDA6323', 'L100031', '1', 'Monday', '10:00:00', '12:00:00', 'Online'),
(124, 'TDA6323', 'L100032', '1', 'Thursday', '15:00:00', '17:00:00', 'Physical'),
(125, 'TDB6113', 'L100033', '1', 'Tuesday', '13:00:00', '15:00:00', 'Online'),
(126, 'TDB6113', 'L100034', '1', 'Friday', '09:00:00', '11:00:00', 'Physical'),
(127, 'TDC1231', 'L100035', '1', 'Monday', '14:00:00', '16:00:00', 'Physical'),
(128, 'TDC1231', 'L100036', '1', 'Thursday', '10:00:00', '12:00:00', 'Online'),
(129, 'TDM6323', 'L100037', '1', 'Friday', '13:00:00', '15:00:00', 'Online'),
(130, 'TDM6323', 'L100038', '1', 'Wednesday', '13:00:00', '15:00:00', 'Physical'),
(131, 'TDS6213', 'L100039', '1', 'Tuesday', '09:00:00', '11:00:00', 'Online'),
(132, 'TDS6213', 'L100040', '1', 'Thursday', '14:00:00', '16:00:00', 'Physical'),
(133, 'TDW6323', 'L100041', '1', 'Monday', '08:00:00', '10:00:00', 'Physical'),
(134, 'TDW6323', 'L100042', '1', 'Friday', '10:00:00', '12:00:00', 'Online'),
(135, 'TEH6213', 'L100043', '1', 'Wednesday', '15:00:00', '17:00:00', 'Online'),
(136, 'TEH6213', 'L100044', '1', 'Tuesday', '14:00:00', '16:00:00', 'Physical'),
(137, 'TEP6123', 'L100045', '1', 'Thursday', '13:00:00', '15:00:00', 'Online'),
(138, 'TEP6123', 'L100046', '1', 'Monday', '11:00:00', '13:00:00', 'Physical'),
(139, 'LMPU3182', 'L100001', '2', 'Tuesday', '13:00:00', '15:00:00', 'Online'),
(140, 'LMPU3182', 'L100002', '2', 'Wednesday', '14:00:00', '16:00:00', 'Physical'),
(141, 'LMPU3192', 'L100003', '2', 'Monday', '08:00:00', '10:00:00', 'Physical'),
(142, 'LMPU3192', 'L100004', '2', 'Thursday', '13:00:00', '15:00:00', 'Online'),
(143, 'MPU3214', 'L100005', '2', 'Friday', '09:00:00', '11:00:00', 'Online'),
(144, 'MPU3214', 'L100006', '2', 'Tuesday', '11:00:00', '13:00:00', 'Physical'),
(145, 'MPU3312', 'L100007', '2', 'Thursday', '15:00:00', '17:00:00', 'Online'),
(146, 'MPU3312', 'L100008', '2', 'Monday', '10:00:00', '12:00:00', 'Physical'),
(147, 'MPU3409', 'L100009', '2', 'Wednesday', '08:00:00', '10:00:00', 'Physical'),
(148, 'MPU3409', 'L100010', '2', 'Friday', '13:00:00', '15:00:00', 'Online'),
(149, 'TAI6213', 'L100011', '2', 'Tuesday', '09:00:00', '11:00:00', 'Physical'),
(150, 'TAI6213', 'L100012', '2', 'Thursday', '08:00:00', '10:00:00', 'Online'),
(151, 'TAO1221', 'L100013', '2', 'Monday', '13:00:00', '15:00:00', 'Physical'),
(152, 'TAO1221', 'L100014', '2', 'Friday', '14:00:00', '16:00:00', 'Online'),
(153, 'TBS6313', 'L100015', '2', 'Wednesday', '09:00:00', '11:00:00', 'Online'),
(154, 'TBS6313', 'L100016', '2', 'Tuesday', '14:00:00', '16:00:00', 'Physical'),
(155, 'TCC6323', 'L100017', '2', 'Monday', '08:00:00', '10:00:00', 'Physical'),
(156, 'TCC6323', 'L100018', '2', 'Thursday', '13:00:00', '15:00:00', 'Online'),
(157, 'TCI6313', 'L100019', '2', 'Wednesday', '13:00:00', '15:00:00', 'Physical'),
(158, 'TCI6313', 'L100020', '2', 'Friday', '15:00:00', '17:00:00', 'Online'),
(159, 'TCL6323', 'L100021', '2', 'Tuesday', '10:00:00', '12:00:00', 'Physical'),
(160, 'TCL6323', 'L100022', '2', 'Monday', '15:00:00', '17:00:00', 'Online'),
(161, 'TCN6313', 'L100023', '2', 'Thursday', '09:00:00', '11:00:00', 'Physical'),
(162, 'TCN6313', 'L100024', '2', 'Wednesday', '15:00:00', '17:00:00', 'Online'),
(163, 'TCP6114', 'L100025', '2', 'Friday', '08:00:00', '10:00:00', 'Physical'),
(164, 'TCP6114', 'L100026', '2', 'Tuesday', '15:00:00', '17:00:00', 'Online'),
(165, 'TCV6313', 'L100027', '2', 'Monday', '11:00:00', '13:00:00', 'Online'),
(166, 'TCV6313', 'L100028', '2', 'Thursday', '10:00:00', '12:00:00', 'Physical'),
(167, 'TDA6313', 'L100029', '2', 'Wednesday', '08:00:00', '10:00:00', 'Physical'),
(168, 'TDA6313', 'L100030', '2', 'Friday', '10:00:00', '12:00:00', 'Online'),
(169, 'TDA6323', 'L100031', '2', 'Tuesday', '13:00:00', '15:00:00', 'Online'),
(170, 'TDA6323', 'L100032', '2', 'Wednesday', '13:00:00', '15:00:00', 'Physical'),
(171, 'TDB6113', 'L100033', '2', 'Monday', '14:00:00', '16:00:00', 'Online'),
(172, 'TDB6113', 'L100034', '2', 'Thursday', '14:00:00', '16:00:00', 'Physical'),
(173, 'TDC1231', 'L100035', '2', 'Friday', '08:00:00', '10:00:00', 'Online'),
(174, 'TDC1231', 'L100036', '2', 'Tuesday', '09:00:00', '11:00:00', 'Physical'),
(175, 'TDM6323', 'L100037', '2', 'Wednesday', '11:00:00', '13:00:00', 'Physical'),
(176, 'TDM6323', 'L100038', '2', 'Monday', '13:00:00', '15:00:00', 'Online'),
(177, 'TDS6213', 'L100039', '2', 'Thursday', '08:00:00', '10:00:00', 'Online'),
(178, 'TDS6213', 'L100040', '2', 'Friday', '13:00:00', '15:00:00', 'Physical'),
(179, 'TDW6323', 'L100041', '2', 'Tuesday', '14:00:00', '16:00:00', 'Physical'),
(180, 'TDW6323', 'L100042', '2', 'Wednesday', '10:00:00', '12:00:00', 'Online'),
(181, 'TEH6213', 'L100043', '2', 'Monday', '09:00:00', '11:00:00', 'Online'),
(182, 'TEH6213', 'L100044', '2', 'Thursday', '15:00:00', '17:00:00', 'Physical'),
(183, 'TEP6123', 'L100045', '2', 'Friday', '14:00:00', '16:00:00', 'Physical'),
(184, 'TEP6123', 'L100046', '2', 'Wednesday', '15:00:00', '17:00:00', 'Online'),
(185, 'LMPU3182', 'L100001', '3', 'Wednesday', '13:00:00', '15:00:00', 'Physical'),
(186, 'LMPU3182', 'L100002', '3', 'Friday', '15:00:00', '17:00:00', 'Online'),
(187, 'LMPU3192', 'L100003', '3', 'Thursday', '13:00:00', '15:00:00', 'Physical'),
(188, 'LMPU3192', 'L100004', '3', 'Tuesday', '09:00:00', '11:00:00', 'Online'),
(189, 'MPU3214', 'L100005', '3', 'Monday', '08:00:00', '10:00:00', 'Online'),
(190, 'MPU3214', 'L100006', '3', 'Thursday', '14:00:00', '16:00:00', 'Physical'),
(191, 'MPU3312', 'L100007', '3', 'Wednesday', '11:00:00', '13:00:00', 'Online'),
(192, 'MPU3312', 'L100008', '3', 'Friday', '08:00:00', '10:00:00', 'Physical'),
(193, 'MPU3409', 'L100009', '3', 'Tuesday', '13:00:00', '15:00:00', 'Online'),
(194, 'MPU3409', 'L100010', '3', 'Monday', '14:00:00', '16:00:00', 'Physical'),
(195, 'TAI6213', 'L100011', '3', 'Friday', '11:00:00', '13:00:00', 'Physical'),
(196, 'TAI6213', 'L100012', '3', 'Wednesday', '08:00:00', '10:00:00', 'Online'),
(197, 'TAO1221', 'L100013', '3', 'Thursday', '10:00:00', '12:00:00', 'Physical'),
(198, 'TAO1221', 'L100014', '3', 'Tuesday', '14:00:00', '16:00:00', 'Online'),
(199, 'TBS6313', 'L100015', '3', 'Monday', '09:00:00', '11:00:00', 'Physical'),
(200, 'TBS6313', 'L100016', '3', 'Friday', '14:00:00', '16:00:00', 'Online'),
(201, 'TCC6323', 'L100017', '3', 'Wednesday', '15:00:00', '17:00:00', 'Online'),
(202, 'TCC6323', 'L100018', '3', 'Thursday', '08:00:00', '10:00:00', 'Physical'),
(203, 'TCI6313', 'L100019', '3', 'Tuesday', '15:00:00', '17:00:00', 'Online'),
(204, 'TCI6313', 'L100020', '3', 'Monday', '10:00:00', '12:00:00', 'Physical'),
(205, 'TCL6323', 'L100021', '3', 'Wednesday', '13:00:00', '15:00:00', 'Physical'),
(206, 'TCL6323', 'L100022', '3', 'Friday', '10:00:00', '12:00:00', 'Online'),
(207, 'TCN6313', 'L100023', '3', 'Monday', '13:00:00', '15:00:00', 'Physical'),
(208, 'TCN6313', 'L100024', '3', 'Thursday', '13:00:00', '15:00:00', 'Online'),
(209, 'TCP6114', 'L100025', '3', 'Tuesday', '10:00:00', '12:00:00', 'Online'),
(210, 'TCP6114', 'L100026', '3', 'Wednesday', '14:00:00', '16:00:00', 'Physical'),
(211, 'TCV6313', 'L100027', '3', 'Monday', '08:00:00', '10:00:00', 'Physical'),
(212, 'TCV6313', 'L100028', '3', 'Thursday', '15:00:00', '17:00:00', 'Online'),
(213, 'TDA6313', 'L100029', '3', 'Friday', '09:00:00', '11:00:00', 'Online'),
(214, 'TDA6313', 'L100030', '3', 'Tuesday', '08:00:00', '10:00:00', 'Physical'),
(215, 'TDA6323', 'L100031', '3', 'Wednesday', '10:00:00', '12:00:00', 'Physical'),
(216, 'TDA6323', 'L100032', '3', 'Monday', '15:00:00', '17:00:00', 'Online'),
(217, 'TDB6113', 'L100033', '3', 'Thursday', '13:00:00', '15:00:00', 'Online'),
(218, 'TDB6113', 'L100034', '3', 'Tuesday', '11:00:00', '13:00:00', 'Physical'),
(219, 'TDC1231', 'L100035', '3', 'Friday', '13:00:00', '15:00:00', 'Physical'),
(220, 'TDC1231', 'L100036', '3', 'Monday', '11:00:00', '13:00:00', 'Online'),
(221, 'TDM6323', 'L100037', '3', 'Wednesday', '13:00:00', '15:00:00', 'Online'),
(222, 'TDM6323', 'L100038', '3', 'Thursday', '11:00:00', '13:00:00', 'Physical'),
(223, 'TDS6213', 'L100039', '3', 'Tuesday', '13:00:00', '15:00:00', 'Online'),
(224, 'TDS6213', 'L100040', '3', 'Friday', '08:00:00', '10:00:00', 'Physical'),
(225, 'TDW6323', 'L100041', '3', 'Monday', '13:00:00', '15:00:00', 'Physical'),
(226, 'TDW6323', 'L100042', '3', 'Thursday', '09:00:00', '11:00:00', 'Online'),
(227, 'TEH6213', 'L100043', '3', 'Wednesday', '08:00:00', '10:00:00', 'Online'),
(228, 'TEH6213', 'L100044', '3', 'Friday', '14:00:00', '16:00:00', 'Physical'),
(229, 'TEP6123', 'L100045', '3', 'Tuesday', '14:00:00', '16:00:00', 'Online'),
(230, 'TEP6123', 'L100046', '3', 'Thursday', '10:00:00', '12:00:00', 'Physical'),
(231, 'TCP6114', 'L100001', '1', 'Monday', '09:00:00', '11:00:00', 'Physical'),
(232, 'TDS6213', 'L100002', '1', 'Tuesday', '13:00:00', '15:00:00', 'Online'),
(233, 'TML6223', 'L100003', '1', 'Wednesday', '10:00:00', '12:00:00', 'Physical'),
(234, 'TMA1211', 'L100004', '1', 'Thursday', '14:00:00', '16:00:00', 'Online'),
(235, 'TDA6313', 'L100005', '1', 'Friday', '11:00:00', '13:00:00', 'Physical'),
(236, 'TDB6113', 'L100006', '1', 'Monday', '15:00:00', '17:00:00', 'Online'),
(237, 'TDC1231', 'L100007', '1', 'Tuesday', '08:00:00', '10:00:00', 'Physical'),
(238, 'TDM6323', 'L100008', '1', 'Wednesday', '10:00:00', '12:00:00', 'Online'),
(239, 'TDA6323', 'L100009', '1', 'Thursday', '13:00:00', '15:00:00', 'Physical'),
(240, 'TSA6213', 'L100010', '1', 'Friday', '09:00:00', '11:00:00', 'Online'),
(241, 'LMPU3182', 'L100001', '1', 'Thursday', '11:00:00', '13:00:00', 'Physical'),
(242, 'LMPU3192', 'L100002', '1', 'Thursday', '15:00:00', '17:00:00', 'Physical'),
(243, 'MPU3214', 'L100003', '1', 'Thursday', '13:00:00', '15:00:00', 'Physical'),
(244, 'MPU3312', 'L100004', '1', 'Monday', '13:00:00', '15:00:00', 'Online'),
(245, 'MPU3409', 'L100005', '1', 'Tuesday', '15:00:00', '17:00:00', 'Physical');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
CREATE TABLE IF NOT EXISTS `semester` (
  `semester_id` varchar(20) NOT NULL,
  `semester_name` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`semester_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semester_id`, `semester_name`, `start_date`, `end_date`) VALUES
('1', 'Term 2510', '2025-02-04', '2025-04-12'),
('2', 'Term 2520', '2025-06-24', '2025-08-23'),
('3', 'Term 2530', '2025-09-28', '2025-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

DROP TABLE IF EXISTS `student_info`;
CREATE TABLE IF NOT EXISTS `student_info` (
  `Student_ID` varchar(10) NOT NULL,
  `Student_Name` varchar(50) DEFAULT NULL,
  `Student_Password` varchar(50) DEFAULT NULL,
  `Student_Contact_Number` int(11) DEFAULT NULL,
  `Date_Registered` date DEFAULT NULL,
  `Date_Graduated` date DEFAULT NULL,
  `faculty_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Student_ID`),
  KEY `fk_student_faculty` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`Student_ID`, `Student_Name`, `Student_Password`, `Student_Contact_Number`, `Date_Registered`, `Date_Graduated`, `faculty_id`) VALUES
('1211110648', 'Fernando Lim Jia Yee', 'Mmu409FLJY', 168121050, '2022-08-04', '2026-08-03', 'FIST'),
('1237896123', 'test1', '$2y$10$nxQ1t9YFaMQdzYpLf/YnTOk6seEO9zLRR/OmSUYAUpg', 123986124, '2025-05-24', '2027-12-30', NULL),
('242UT244B7', 'Cheng Jing Yi', 'MMU129CJY', 172471629, '2022-08-04', '2026-08-03', NULL),
('S100001', 'John Doe', 'password123', 2147483647, '2020-08-15', '2024-05-10', NULL),
('S100002', 'Alice Smith', 'alice2021', 2147483647, '2019-09-01', '2023-06-15', NULL),
('S100003', 'Bob Johnson', 'bob321pass', 2147483647, '2021-03-12', '2025-07-30', NULL),
('S100004', 'Charlie Brown', 'charlieBrown2020', 2147483647, '2022-01-22', '2026-08-01', NULL),
('S100005', 'Diana Green', 'diana@2022', 2147483647, '2021-11-05', '2025-06-18', NULL),
('S100006', 'Eve White', 'evepass123', 2147483647, '2020-06-17', '2024-12-12', NULL),
('S100007', 'Frank Miller', 'frank2023!', 2147483647, '2019-04-02', '2023-11-09', NULL),
('S100008', 'Grace Lee', 'gracePass2022', 2109876543, '2022-02-28', '2026-10-25', NULL),
('S100009', 'Hank Harris', 'hank2021!', 1098765432, '2019-07-19', '2023-12-30', NULL),
('S100010', 'Ivy Adams', 'ivy@password', 2147483647, '2021-08-30', '2025-05-20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `Subject_Code` varchar(8) NOT NULL,
  `Subject_Name` varchar(50) DEFAULT NULL,
  `Subject_Credit_Hours` int(11) DEFAULT NULL,
  `Graded` tinyint(1) DEFAULT NULL,
  `Prerequirement_Subject_Code` varchar(8) DEFAULT NULL,
  `elective` tinyint(1) DEFAULT NULL,
  `Elective_Group` int(11) DEFAULT NULL,
  `faculty_id` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Subject_Code`),
  UNIQUE KEY `Subject_Code` (`Subject_Code`),
  KEY `fk_subject_faculty` (`faculty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Subject_Code`, `Subject_Name`, `Subject_Credit_Hours`, `Graded`, `Prerequirement_Subject_Code`, `elective`, `Elective_Group`, `faculty_id`) VALUES
('LMPU3182', 'PENGHAYATAN ETIKA & PERADABAN', 2, 0, NULL, 0, 1, NULL),
('LMPU3192', 'FALSAFAH DAN ISU SEMASA', 2, 0, NULL, 0, 1, NULL),
('MPU3214', 'FUNDAMENTALS OF FRENCH', 2, 0, NULL, 1, 2, NULL),
('MPU3312', 'INTEGRITY AND LEADERSHIP', 2, 0, NULL, 1, 3, NULL),
('MPU3409', 'PERSONAL SOCIAL RESPONSIBILITY', 2, 0, NULL, 1, 4, NULL),
('TAI6213', 'AI FUNDAMENTALS', 3, 1, NULL, 0, NULL, 'FIST'),
('TAO1221', 'COMP ARC AND ORGANISATION', 4, 1, NULL, 0, NULL, NULL),
('TBS6313', 'USINESS STATISTICAL ANALYSIS', 3, 1, NULL, 1, 5, NULL),
('TCC6323', 'CLOUD COMPUTING', 3, 1, NULL, 1, 5, NULL),
('TCI6313', 'COMPUTER INTELLIGENCE', 3, 1, NULL, 0, NULL, NULL),
('TCL6323', 'CYBER LAW', 3, 1, NULL, 1, 5, NULL),
('TCN6313', 'COMPUTER NETWORKS', 3, 1, NULL, 0, NULL, NULL),
('TCP6114', 'COMPUTER PROGRAMMING', 4, 1, NULL, 0, NULL, NULL),
('TCV6313', 'COMPUTER VISION', 3, 1, NULL, 0, NULL, NULL),
('TDA6313', 'DATA ANALYTICS FUNDAMENTALS', 3, 1, NULL, 1, 5, NULL),
('TDA6323', 'ALGORITHM DESIGN AND ANALYSIS', 3, 1, 'TDS6213', 0, NULL, NULL),
('TDB6113', 'DATABASE SYSTEMS', 3, 1, NULL, 0, NULL, NULL),
('TDC1231', 'DATA COMM AND NETWORK', 4, 1, NULL, 0, NULL, NULL),
('TDM6323', 'DATA MINING AND MACHINE LEARNING', 3, 1, NULL, 1, 5, NULL),
('TDS6213', 'DATA STRUCTURES AND ALGORITHMS', 3, 1, 'TCP6114', 0, NULL, NULL),
('TDW6323', 'DATA WRANGLING AND VISUAIZATION', 3, 1, NULL, 1, 5, NULL),
('TEH6213', 'ETHICAL HACKING AND SEC ASSMT', 3, 1, NULL, 1, 5, NULL),
('TEP6123', 'ETHICS AND PROF CONDUCTS', 3, 1, NULL, 0, NULL, NULL),
('TES6313', 'EXPERT SYSTEMS', 3, 1, NULL, 0, NULL, NULL),
('THI6223', 'HUMAN COMPUTER INTERACTION', 3, 1, NULL, 0, NULL, NULL),
('TIA6313', 'INFMATIOASSURANCE AND SCURITY', 3, 1, NULL, 1, 5, NULL),
('TIT6323', 'INTERNET OF tHINGS (IoT) FUNDAMENTALS', 3, 1, NULL, 1, 5, NULL),
('TMA1111', 'MATHEMATICAL TECHNIQUES', 4, 1, NULL, 0, NULL, NULL),
('TMA1211', 'DISCRETE MATH AND PROBABILITY', 4, 1, NULL, 0, NULL, NULL),
('TML6223', 'MACHINE LEARNING', 3, 1, 'TAI6213', 0, NULL, NULL),
('TMS6313', 'MANAGEMEN OF INFORMATION SECURITY', 3, 1, NULL, 1, 5, NULL),
('TNL6323', 'NATURAL LANGUAGE PROCESSING', 3, 1, 'TML6223', 0, NULL, NULL),
('TOP2121', 'OBJECT-ORIENTED PROGRAMMING', 3, 1, NULL, 0, NULL, NULL),
('TOS6113', 'OPERATING SYSTEMS', 3, 1, NULL, 0, NULL, NULL),
('TPB6213', 'PROJECT MANAGEMENT FOR BUSINESS ANALYST', 3, 1, NULL, 1, 5, NULL),
('TPL6213', 'PROGRAMMING LANGUAGE CONCEPT', 3, 1, 'TCP6114', 0, NULL, NULL),
('TPR6223', 'PATTERN RECOGNITION', 3, 1, NULL, 0, NULL, NULL),
('TPR6313', 'PROJECT (PHASE 1)', 3, 1, NULL, 0, NULL, NULL),
('TPR6323', 'PROJECT (PHASE 2)', 3, 1, NULL, 0, NULL, NULL),
('TSA6213', 'SYSTEM ANALYSIS AND DESIGN', 3, 1, NULL, 0, NULL, NULL),
('TSE6223', 'SOFTWARE ENGINE FUNDAMENTALS', 3, 1, NULL, 0, NULL, NULL),
('TSW6323', 'SEMANTIC WEB TECHNOLOGY', 3, 1, 'TWT6223', 0, NULL, NULL),
('TTV2161', 'TECHNOPRENEUR VENTURE', 2, 1, NULL, 0, NULL, NULL),
('TWT6223', 'WEB TECHNIQUES AND APPLICATION', 3, 1, NULL, 0, NULL, NULL),
('WCB1040', 'PERFORMING ARTS', 2, 0, NULL, 1, NULL, NULL),
('WCB1050', 'PERFORMING ARTS', 2, 0, NULL, 1, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`Student_ID`),
  ADD CONSTRAINT `fk_enrollment_schedule` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`),
  ADD CONSTRAINT `fk_enrollment_semester` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `fk_enrollment_subject` FOREIGN KEY (`Subject_Code`) REFERENCES `subject` (`Subject_Code`);

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `fk_lecturer_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`Student_ID`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `fk_schedule_semester` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`),
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`Subject_Code`) REFERENCES `subject` (`Subject_Code`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturer` (`lecturer_id`);

--
-- Constraints for table `student_info`
--
ALTER TABLE `student_info`
  ADD CONSTRAINT `fk_student_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `fk_subject_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
