-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2025 at 02:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_jobc`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apply`
--

CREATE TABLE `tbl_apply` (
  `apply_id` int(11) NOT NULL,
  `apply_date` int(11) NOT NULL,
  `apply_status` int(50) NOT NULL DEFAULT 1,
  `apply_file` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_apply`
--

INSERT INTO `tbl_apply` (`apply_id`, `apply_date`, `apply_status`, `apply_file`, `user_id`, `job_post_id`) VALUES
(15, 20251018, 0, 'Abstarct Model.pdf', 6, 45),
(16, 20251019, 0, 'JobC_table_design.docx', 5, 45),
(17, 20251021, 0, 'English For Career( Short notes)-1.pdf', 10, 50),
(18, 20251021, 0, 'Jibin_CV.pdf', 10, 45),
(19, 20251021, 2, 'Jibin_CV.pdf', 10, 48),
(20, 20251022, 0, 'English For Career( Short notes)-1.pdf', 2, 44),
(21, 20251022, 0, 'English For Career( Short notes)-1.pdf', 3, 65),
(22, 20251022, 0, 'English For Career( Short notes)-1.pdf', 7, 63),
(23, 20251022, 0, 'English For Career( Short notes)-1.pdf', 2, 48),
(24, 20251022, 0, 'English For Career( Short notes)-1.pdf', 4, 49),
(25, 20251022, 0, 'English For Career( Short notes)-1.pdf', 5, 50),
(26, 20251022, 0, 'English For Career( Short notes)-1.pdf', 6, 51),
(27, 20251022, 0, 'English For Career( Short notes)-1.pdf', 8, 45),
(28, 20251022, 0, 'English For Career( Short notes)-1.pdf', 9, 60),
(29, 20251022, 0, 'English For Career( Short notes)-1.pdf', 10, 62),
(30, 20251022, 0, 'English For Career( Short notes)-1.pdf', 11, 65),
(31, 20251022, 0, 'English For Career( Short notes)-1.pdf', 12, 67),
(32, 20251022, 0, 'English For Career( Short notes)-1.pdf', 13, 59),
(33, 20251022, 0, 'English For Career( Short notes)-1.pdf', 21, 59),
(34, 20251022, 0, 'English For Career( Short notes)-1.pdf', 21, 44),
(35, 20251022, 0, 'English For Career( Short notes)-1.pdf', 23, 46),
(36, 20251022, 0, 'English For Career( Short notes)-1.pdf', 26, 61),
(37, 20251022, 0, 'English For Career( Short notes)-1.pdf', 27, 63),
(38, 20251022, 0, 'English For Career( Short notes)-1.pdf', 28, 64),
(39, 20251022, 0, 'English For Career( Short notes)-1.pdf', 29, 66),
(40, 20251022, 0, 'English For Career( Short notes)-1.pdf', 30, 68),
(41, 20251022, 0, 'English For Career( Short notes)-1.pdf', 31, 47),
(42, 20251022, 0, 'English For Career( Short notes)-1.pdf', 31, 0),
(43, 20251022, 0, 'English For Career( Short notes)-1.pdf', 33, 52),
(44, 20251022, 0, 'English For Career( Short notes)-1.pdf', 34, 53),
(45, 20251022, 0, 'English For Career( Short notes)-1.pdf', 34, 0),
(46, 20251022, 0, 'English For Career( Short notes)-1.pdf', 35, 53),
(47, 20251023, 4, 'SRS_jobC.docx', 2, 45);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_apply`
--
ALTER TABLE `tbl_apply`
  ADD PRIMARY KEY (`apply_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_apply`
--
ALTER TABLE `tbl_apply`
  MODIFY `apply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
