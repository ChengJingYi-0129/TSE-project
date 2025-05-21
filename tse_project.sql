-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 21, 2025 at 05:00 AM
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
  `elective` tinyint(1) DEFAULT NULL,
  `Elective_Group` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`Subject_Code`, `Subject_Name`, `Subject_Credit_Hours`, `Graded`, `Prerequirement_Subject_Code`, `elective`, `Elective_Group`) VALUES
('LMPU3182', 'PENGHAYATAN ETIKA & PERADABAN', 2, 0, NULL, 0, 1),
('LMPU3192', 'FALSAFAH DAN ISU SEMASA', 2, 0, NULL, 0, 1),
('MPU3214', 'FUNDAMENTALS OF FRENCH', 2, 0, NULL, 1, 2),
('MPU3312', 'INTEGRITY AND LEADERSHIP', 2, 0, NULL, 1, 3),
('MPU3409', 'PERSONAL SOCIAL RESPONSIBILITY', 2, 0, NULL, 1, 4),
('TAI6213', 'AI FUNDAMENTALS', 3, 1, NULL, 0, NULL),
('TAO1221', 'COMP ARC AND ORGANISATION', 4, 1, NULL, 0, NULL),
('TBS6313', 'USINESS STATISTICAL ANALYSIS', 3, 1, NULL, 1, 5),
('TCC6323', 'CLOUD COMPUTING', 3, 1, NULL, 1, 5),
('TCI6313', 'COMPUTER INTELLIGENCE', 3, 1, NULL, 0, NULL),
('TCL6323', 'CYBER LAW', 3, 1, NULL, 1, 5),
('TCN6313', 'COMPUTER NETWORKS', 3, 1, NULL, 0, NULL),
('TCP6114', 'COMPUTER PROGRAMMING', 4, 1, NULL, 0, NULL),
('TCV6313', 'COMPUTER VISION', 3, 1, NULL, 0, NULL),
('TDA6313', 'DATA ANALYTICS FUNDAMENTALS', 3, 1, NULL, 1, 5),
('TDA6323', 'ALGORITHM DESIGN AND ANALYSIS', 3, 1, 'TDS6213', 0, NULL),
('TDB6113', 'DATABASE SYSTEMS', 3, 1, NULL, 0, NULL),
('TDC1231', 'DATA COMM AND NETWORK', 4, 1, NULL, 0, NULL),
('TDM6323', 'DATA MINING AND MACHINE LEARNING', 3, 1, NULL, 1, 5),
('TDS6213', 'DATA STRUCTURES AND ALGORITHMS', 3, 1, 'TCP6114', 0, NULL),
('TDW6323', 'DATA WRANGLING AND VISUAIZATION', 3, 1, NULL, 1, 5),
('TEH6213', 'ETHICAL HACKING AND SEC ASSMT', 3, 1, NULL, 1, 5),
('TEP6123', 'ETHICS AND PROF CONDUCTS', 3, 1, NULL, 0, NULL),
('TES6313', 'EXPERT SYSTEMS', 3, 1, NULL, 0, NULL),
('THI6223', 'HUMAN COMPUTER INTERACTION', 3, 1, NULL, 0, NULL),
('TIA6313', 'INFMATIOASSURANCE AND SCURITY', 3, 1, NULL, 1, 5),
('TIT6323', 'INTERNET OF tHINGS (IoT) FUNDAMENTALS', 3, 1, NULL, 1, 5),
('TMA1111', 'MATHEMATICAL TECHNIQUES', 4, 1, NULL, 0, NULL),
('TMA1211', 'DISCRETE MATH AND PROBABILITY', 4, 1, NULL, 0, NULL),
('TML6223', 'MACHINE LEARNING', 3, 1, 'TAI6213', 0, NULL),
('TMS6313', 'MANAGEMEN OF INFORMATION SECURITY', 3, 1, NULL, 1, 5),
('TNL6323', 'NATURAL LANGUAGE PROCESSING', 3, 1, 'TML6223', 0, NULL),
('TOP2121', 'OBJECT-ORIENTED PROGRAMMING', 3, 1, NULL, 0, NULL),
('TOS6113', 'OPERATING SYSTEMS', 3, 1, NULL, 0, NULL),
('TPB6213', 'PROJECT MANAGEMENT FOR BUSINESS ANALYST', 3, 1, NULL, 1, 5),
('TPL6213', 'PROGRAMMING LANGUAGE CONCEPT', 3, 1, 'TCP6114', 0, NULL),
('TPR6223', 'PATTERN RECOGNITION', 3, 1, NULL, 0, NULL),
('TPR6313', 'PROJECT (PHASE 1)', 3, 1, NULL, 0, NULL),
('TPR6323', 'PROJECT (PHASE 2)', 3, 1, NULL, 0, NULL),
('TSA6213', 'SYSTEM ANALYSIS AND DESIGN', 3, 1, NULL, 0, NULL),
('TSE6223', 'SOFTWARE ENGINE FUNDAMENTALS', 3, 1, NULL, 0, NULL),
('TSW6323', 'SEMANTIC WEB TECHNOLOGY', 3, 1, 'TWT6223', 0, NULL),
('TTV2161', 'TECHNOPRENEUR VENTURE', 2, 1, NULL, 0, NULL),
('TWT6223', 'WEB TECHNIQUES AND APPLICATION', 3, 1, NULL, 0, NULL),
('WCB1040', 'PERFORMING ARTS', 2, 0, NULL, 1, NULL),
('WCB1050', 'PERFORMING ARTS', 2, 0, NULL, 1, NULL);

--
-- Indexes for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
