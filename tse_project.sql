-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Apr 22, 2025 at 02:03 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`Student_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
