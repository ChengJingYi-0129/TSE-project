-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 27, 2025 at 03:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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

CREATE TABLE `admin` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_name` varchar(255) NOT NULL,
  `Admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_ID`, `Admin_name`, `Admin_pass`) VALUES
(1, 'Admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` varchar(20) NOT NULL,
  `prerequisite_id` int(11) DEFAULT NULL,
  `lecturer_id` varchar(20) DEFAULT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `credit_hours` int(11) DEFAULT NULL,
  `is_core` tinyint(1) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_prerequisite`
--

CREATE TABLE `course_prerequisite` (
  `prerequisite_id` int(11) NOT NULL,
  `required_course_id` varchar(20) DEFAULT NULL,
  `min_grade` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enrollment`
--

CREATE TABLE `enrollment` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `course_id` varchar(20) DEFAULT NULL,
  `admin_id` varchar(20) DEFAULT NULL,
  `semester_id` varchar(20) DEFAULT NULL,
  `enrollment_date` date DEFAULT NULL,
  `student_status` varchar(50) DEFAULT NULL,
  `final_grade` varchar(2) DEFAULT NULL,
  `registration_start` date DEFAULT NULL,
  `registration_end` date DEFAULT NULL,
  `is_retake` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `grade` char(2) NOT NULL,
  `grade_point` decimal(4,2) DEFAULT NULL,
  `is_pass` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `industrial_training`
--

CREATE TABLE `industrial_training` (
  `training_id` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `supervisor_name` varchar(100) DEFAULT NULL,
  `student_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecturer_id` varchar(20) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` datetime DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `invoice_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` varchar(20) NOT NULL,
  `semester_name` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `Student_ID` varchar(10) NOT NULL,
  `Student_Name` varchar(50) DEFAULT NULL,
  `Student_Password` varchar(50) DEFAULT NULL,
  `Student_Contact_Number` int(11) DEFAULT NULL,
  `Date_Registered` date DEFAULT NULL,
  `Date_Graduated` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`Student_ID`, `Student_Name`, `Student_Password`, `Student_Contact_Number`, `Date_Registered`, `Date_Graduated`) VALUES
('1211110648', 'Fernando Lim Jia Yee', 'Mmu409FLJY', 168121050, '2022-08-04', '2026-08-03'),
('242UT244B7', 'Cheng Jing Yi', 'MMU129CJY', 172471629, '2022-08-04', '2026-08-03'),
('S100001', 'John Doe', 'password123', 2147483647, '2020-08-15', '2024-05-10'),
('S100002', 'Alice Smith', 'alice2021', 2147483647, '2019-09-01', '2023-06-15'),
('S100003', 'Bob Johnson', 'bob321pass', 2147483647, '2021-03-12', '2025-07-30'),
('S100004', 'Charlie Brown', 'charlieBrown2020', 2147483647, '2022-01-22', '2026-08-01'),
('S100005', 'Diana Green', 'diana@2022', 2147483647, '2021-11-05', '2025-06-18'),
('S100006', 'Eve White', 'evepass123', 2147483647, '2020-06-17', '2024-12-12'),
('S100007', 'Frank Miller', 'frank2023!', 2147483647, '2019-04-02', '2023-11-09'),
('S100008', 'Grace Lee', 'gracePass2022', 2109876543, '2022-02-28', '2026-10-25'),
('S100009', 'Hank Harris', 'hank2021!', 1098765432, '2019-07-19', '2023-12-30'),
('S100010', 'Ivy Adams', 'ivy@password', 2147483647, '2021-08-30', '2025-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `Subject_Code` varchar(8) NOT NULL,
  `Subject_Name` varchar(50) DEFAULT NULL,
  `Subject_Credit_Hours` int(11) DEFAULT NULL,
  `Graded` tinyint(1) DEFAULT NULL,
  `Prerequirement_Subject_Code` varchar(8) DEFAULT NULL,
  `elective` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Subject_Code`, `Subject_Name`, `Subject_Credit_Hours`, `Graded`, `Prerequirement_Subject_Code`, `elective`) VALUES
('LMPU3182', 'PENGHAYATAN ETIKA & PERADABAN', 2, 0, NULL, 0),
('LMPU3192', 'FALSAFAH DAN ISU SEMASA', 2, 0, NULL, 0),
('MPU3214', 'FUNDAMENTALS OF FRENCH', 2, 0, NULL, 1),
('MPU3312', 'INTEGRITY AND LEADERSHIP', 2, 0, NULL, 1),
('MPU3409', 'PERSONAL SOCIAL RESPONSIBILITY', 2, 0, NULL, 1),
('TAI6213', 'AI FUNDAMENTALS', 3, 1, NULL, 0),
('TAO1221', 'COMP ARC AND ORGANISATION', 4, 1, NULL, 0),
('TBS6313', 'USINESS STATISTICAL ANALYSIS', 3, 1, NULL, 1),
('TCC6323', 'CLOUD COMPUTING', 3, 1, NULL, 1),
('TCI6313', 'COMPUTER INTELLIGENCE', 3, 1, NULL, 0),
('TCL6323', 'CYBER LAW', 3, 1, NULL, 1),
('TCN6313', 'COMPUTER NETWORKS', 3, 1, NULL, 0),
('TCP6114', 'COMPUTER PROGRAMMING', 4, 1, NULL, 0),
('TCV6313', 'COMPUTER VISION', 3, 1, NULL, 0),
('TDA6313', 'DATA ANALYTICS FUNDAMENTALS', 3, 1, NULL, 1),
('TDA6323', 'ALGORITHM DESIGN AND ANALYSIS', 3, 1, 'TDS6213', 0),
('TDB6113', 'DATABASE SYSTEMS', 3, 1, NULL, 0),
('TDC1231', 'DATA COMM AND NETWORK', 4, 1, NULL, 0),
('TDM6323', 'DATA MINING AND MACHINE LEARNING', 3, 1, NULL, 1),
('TDS6213', 'DATA STRUCTURES AND ALGORITHMS', 3, 1, 'TCP6114', 0),
('TDW6323', 'DATA WRANGLING AND VISUAIZATION', 3, 1, NULL, 1),
('TEH6213', 'ETHICAL HACKING AND SEC ASSMT', 3, 1, NULL, 1),
('TEP6123', 'ETHICS AND PROF CONDUCTS', 3, 1, NULL, 0),
('TES6313', 'EXPERT SYSTEMS', 3, 1, NULL, 0),
('THI6223', 'HUMAN COMPUTER INTERACTION', 3, 1, NULL, 0),
('TIA6313', 'INFMATIOASSURANCE AND SCURITY', 3, 1, NULL, 1),
('TIT6323', 'INTERNET OF tHINGS (IoT) FUNDAMENTALS', 3, 1, NULL, 1),
('TMA1111', 'MATHEMATICAL TECHNIQUES', 4, 1, NULL, 0),
('TMA1211', 'DISCRETE MATH AND PROBABILITY', 4, 1, NULL, 0),
('TML6223', 'MACHINE LEARNING', 3, 1, 'TAI6213', 0),
('TMS6313', 'MANAGEMEN OF INFORMATION SECURITY', 3, 1, NULL, 1),
('TNL6323', 'NATURAL LANGUAGE PROCESSING', 3, 1, 'TML6223', 0),
('TOP2121', 'OBJECT-ORIENTED PROGRAMMING', 3, 1, NULL, 0),
('TOS6113', 'OPERATING SYSTEMS', 3, 1, NULL, 0),
('TPB6213', 'PROJECT MANAGEMENT FOR BUSINESS ANALYST', 3, 1, NULL, 1),
('TPL6213', 'PROGRAMMING LANGUAGE CONCEPT', 3, 1, 'TCP6114', 0),
('TPR6223', 'PATTERN RECOGNITION', 3, 1, NULL, 0),
('TPR6313', 'PROJECT (PHASE 1)', 3, 1, NULL, 0),
('TPR6323', 'PROJECT (PHASE 2)', 3, 1, NULL, 0),
('TSA6213', 'SYSTEM ANALYSIS AND DESIGN', 3, 1, NULL, 0),
('TSE6223', 'SOFTWARE ENGINE FUNDAMENTALS', 3, 1, NULL, 0),
('TSW6323', 'SEMANTIC WEB TECHNOLOGY', 3, 1, 'TWT6223', 0),
('TTV2161', 'TECHNOPRENEUR VENTURE', 2, 1, NULL, 0),
('TWT6223', 'WEB TECHNIQUES AND APPLICATION', 3, 1, NULL, 0),
('WCB1040', 'PERFORMING ARTS', 2, 0, NULL, 1),
('WCB1050', 'PERFORMING ARTS', 2, 0, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `lecturer_id` (`lecturer_id`);

--
-- Indexes for table `course_prerequisite`
--
ALTER TABLE `course_prerequisite`
  ADD PRIMARY KEY (`prerequisite_id`);

--
-- Indexes for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `fk_enrollment_course` (`course_id`),
  ADD KEY `fk_enrollment_semester` (`semester_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`grade`);

--
-- Indexes for table `industrial_training`
--
ALTER TABLE `industrial_training`
  ADD PRIMARY KEY (`training_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturer_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`Student_ID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`Subject_Code`),
  ADD UNIQUE KEY `Subject_Code` (`Subject_Code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_prerequisite`
--
ALTER TABLE `course_prerequisite`
  MODIFY `prerequisite_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enrollment`
--
ALTER TABLE `enrollment`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `industrial_training`
--
ALTER TABLE `industrial_training`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturer` (`lecturer_id`);

--
-- Constraints for table `enrollment`
--
ALTER TABLE `enrollment`
  ADD CONSTRAINT `enrollment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`Student_ID`),
  ADD CONSTRAINT `fk_enrollment_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `fk_enrollment_semester` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`);

--
-- Constraints for table `industrial_training`
--
ALTER TABLE `industrial_training`
  ADD CONSTRAINT `industrial_training_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`Student_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student_info` (`Student_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
