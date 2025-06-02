-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 02, 2025 at 05:50 PM
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
-- Table structure for table `enrollment_period`
--

DROP TABLE IF EXISTS `enrollment_period`;
CREATE TABLE IF NOT EXISTS `enrollment_period` (
  `period_id` int(11) NOT NULL AUTO_INCREMENT,
  `semester_id` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`period_id`)
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
-- Table structure for table `grade`
--

DROP TABLE IF EXISTS `grade`;
CREATE TABLE IF NOT EXISTS `grade` (
  `grade` char(2) NOT NULL,
  `grade_point` decimal(4,2) DEFAULT NULL,
  `is_pass` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`grade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `industrial_training`
--

DROP TABLE IF EXISTS `industrial_training`;
CREATE TABLE IF NOT EXISTS `industrial_training` (
  `training_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `supervisor_name` varchar(100) DEFAULT NULL,
  `student_status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`training_id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('L100001', '098f6bcd4621d373cade4e832627b4f6', 'Law', 'Xiao Xi', 12395712, 'LXX@gmail.com', 'FIST');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Constraints for table `industrial_training`
--
ALTER TABLE `industrial_training`
  ADD CONSTRAINT `industrial_training_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`Student_ID`);

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
