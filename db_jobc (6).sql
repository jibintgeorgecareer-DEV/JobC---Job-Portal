-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2025 at 11:52 AM
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
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_photo` varchar(700) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_photo`) VALUES
(8, 'Jibin', 'jibin@gmail.com', 'Jibin123', 'sigma.jpeg'),
(13, 'Zoro', 'z@gmail.com', '123', 'Zoro3.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_apply`
--

CREATE TABLE `tbl_apply` (
  `apply_id` int(11) NOT NULL,
  `apply_date` int(11) NOT NULL,
  `apply_status` varchar(50) NOT NULL,
  `apply_file` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_poster_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_apply`
--

INSERT INTO `tbl_apply` (`apply_id`, `apply_date`, `apply_status`, `apply_file`, `user_id`, `job_poster_id`) VALUES
(1, 20251009, 'Applied', 'Abstarct Model.pdf', 29, 2),
(2, 20251009, 'Applied', 'Abstarct Model.pdf', 29, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_email` varchar(50) NOT NULL,
  `company_contact` varchar(50) NOT NULL,
  `company_address` mediumtext NOT NULL,
  `company_password` varchar(50) NOT NULL,
  `company_status` int(50) NOT NULL DEFAULT 0,
  `company_date_join` date NOT NULL,
  `place_id` int(11) NOT NULL,
  `company_logo` varchar(700) NOT NULL,
  `company_proof` varchar(500) NOT NULL,
  `company_type` int(11) NOT NULL,
  `company_industry` int(11) NOT NULL,
  `about_company` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`company_id`, `company_name`, `company_email`, `company_contact`, `company_address`, `company_password`, `company_status`, `company_date_join`, `place_id`, `company_logo`, `company_proof`, `company_type`, `company_industry`, `about_company`) VALUES
(36, 'Meta', 'm@gmail.com', '234', 'INDIA', '123', 1, '0000-00-00', 2, 'Meta.jpeg', 'bg.jpeg', 0, 0, ''),
(37, 'Audi', 'audi@gmail.com', '346', 'INDIA', '123', 1, '0000-00-00', 2, 'audi.jpeg', 'bg.jpeg', 0, 0, ''),
(40, 'Amazon', 'amazon@gmail.com', '3434634', 'INDIA', '1123', 1, '0000-00-00', 2, 'amazon.jpeg', 'Bike.jpeg', 0, 0, ''),
(42, 'Xbox', 'xbox@gmail.com', '3245636', 'INDIA', '123', 1, '0000-00-00', 2, 'Xbox.jpeg', 'Bike.jpeg', 24, 9, ''),
(43, 'Walmart', 'walmart@gmail.com', '24256', 'INDIA', '123', 2, '0000-00-00', 2, 'walmart.jpeg', 'bg.jpeg', 24, 7, ''),
(44, 'Wipro', 'w@gmail.com', '444', 'INDIA', '123', 2, '0000-00-00', 2, 'wipro.jpeg', 'beach_bunny.jpeg', 16, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_industry`
--

CREATE TABLE `tbl_company_industry` (
  `industry_id` int(11) NOT NULL,
  `industry_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_company_industry`
--

INSERT INTO `tbl_company_industry` (`industry_id`, `industry_name`) VALUES
(1, 'Information Technology (IT) & Software'),
(3, 'Finance, Banking & Insurance'),
(4, 'Healthcare & Pharmaceuticals'),
(5, 'Manufacturing & Engineering'),
(6, 'Education & Training'),
(7, 'Retail & Consumer Goods (FMCG)'),
(8, 'Construction & Real Estate'),
(9, 'Media, Entertainment & Publishing'),
(10, 'Marketing, Advertising & PR'),
(11, 'Telecommunications'),
(12, 'Hospitality '),
(13, 'Logistics, Supply Chain & Transportation'),
(14, 'Government & Public Administration'),
(15, 'Consulting & Professional Services'),
(16, 'Agriculture, Forestry & Fishing'),
(17, 'Energy, Oil & Gas / Utilities');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_type`
--

CREATE TABLE `tbl_company_type` (
  `company_type_id` int(11) NOT NULL,
  `company_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_company_type`
--

INSERT INTO `tbl_company_type` (`company_type_id`, `company_type_name`) VALUES
(14, 'Sole Proprietorship'),
(15, 'General Partnership (GP)'),
(16, 'Private Limited Company (Pvt Ltd)'),
(17, 'Limited Partnership (LP)'),
(18, 'Public Limited Company (Plc / Ltd)'),
(20, 'Limited Liability Company (LLC)'),
(21, 'One Person Company (OPC)'),
(22, 'One Person Company (OPC)'),
(23, 'Government/Public Sector'),
(24, 'Multinational Corporation (MNC)'),
(25, 'Startup'),
(26, '	Joint Venture (JV)'),
(27, 'Foreign Company / Subsidiary');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `complaint_title` varchar(50) NOT NULL,
  `complaint_content` varchar(50) NOT NULL,
  `complaint_reply` varchar(50) NOT NULL,
  `complaint_date` int(11) NOT NULL,
  `complaint_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `user_id`, `complaint_title`, `complaint_content`, `complaint_reply`, `complaint_date`, `complaint_status`) VALUES
(1, 1, ' Profile Picture Option', 'There is no file column for insert a profile photo', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(50) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`, `state_id`) VALUES
(49, 'Alappuzha', 12),
(50, 'Ernakulam', 12),
(51, 'Idukki', 12),
(52, 'Kannur', 12),
(53, 'Kasaragod', 12),
(54, 'Kollam', 12),
(55, 'Kottayam', 12),
(56, 'Kozhikode', 12),
(57, 'Malappuram', 12),
(58, 'Palakkad', 12),
(59, 'Pathanamthitta', 12),
(60, 'Thiruvananthapuram', 12),
(61, 'Thrissur', 12),
(62, 'Wayanad', 12),
(63, 'Ariyalur', 23),
(64, 'Chennai', 23),
(65, 'Coimbatore', 23),
(66, 'Chengalpattu', 23),
(67, 'Madurai', 23),
(68, 'Salem', 23),
(69, 'Anakapalli', 1),
(70, 'Annamayya', 1),
(71, 'Chittoor', 1),
(72, ' North Goa', 6),
(73, 'South Goa', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_category`
--

CREATE TABLE `tbl_job_category` (
  `job_category_id` int(11) NOT NULL,
  `job_category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_job_category`
--

INSERT INTO `tbl_job_category` (`job_category_id`, `job_category_name`) VALUES
(1, 'IT & Software Development'),
(2, 'Finance & Accounting'),
(3, 'Sales & Marketing'),
(4, 'Human Resources'),
(5, 'Data Science & Analytics'),
(6, 'Design & Creative');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_languages`
--

CREATE TABLE `tbl_job_languages` (
  `job_language_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_poster`
--

CREATE TABLE `tbl_job_poster` (
  `job_post_id` int(11) NOT NULL,
  `job_post_title` varchar(50) NOT NULL,
  `job_post_content` varchar(200) NOT NULL,
  `job_post_date` date NOT NULL,
  `job_post_status` int(5) NOT NULL DEFAULT 1,
  `job_post_vacancy` int(11) NOT NULL,
  `job_post_experience` varchar(50) NOT NULL,
  `job_post_location` varchar(100) NOT NULL,
  `job_post_deadline` date NOT NULL,
  `job_post_photo` varchar(500) NOT NULL,
  `company_id` int(11) NOT NULL,
  `job_type_id` int(11) NOT NULL,
  `job_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_job_poster`
--

INSERT INTO `tbl_job_poster` (`job_post_id`, `job_post_title`, `job_post_content`, `job_post_date`, `job_post_status`, `job_post_vacancy`, `job_post_experience`, `job_post_location`, `job_post_deadline`, `job_post_photo`, `company_id`, `job_type_id`, `job_category_id`) VALUES
(2, 'Software Enginerr', 'gggg', '2025-10-09', 1, 1, '4yrs', 'Thdpa', '2026-09-05', '', 36, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_soft_skills`
--

CREATE TABLE `tbl_job_soft_skills` (
  `job_soft_skill_id` int(11) NOT NULL,
  `soft_skill_id` int(11) NOT NULL,
  `job_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_job_soft_skills`
--

INSERT INTO `tbl_job_soft_skills` (`job_soft_skill_id`, `soft_skill_id`, `job_post_id`) VALUES
(4, 6, 2),
(5, 7, 2),
(6, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_technical_skills`
--

CREATE TABLE `tbl_job_technical_skills` (
  `job_technical_skill_id` int(11) NOT NULL,
  `technical_skill_id` int(11) NOT NULL,
  `job_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_job_technical_skills`
--

INSERT INTO `tbl_job_technical_skills` (`job_technical_skill_id`, `technical_skill_id`, `job_post_id`) VALUES
(31, 33, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_type`
--

CREATE TABLE `tbl_job_type` (
  `job_type_id` int(11) NOT NULL,
  `job_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_job_type`
--

INSERT INTO `tbl_job_type` (`job_type_id`, `job_type_name`) VALUES
(3, 'Remote'),
(4, 'Hybrid'),
(5, 'Full Time'),
(6, 'Part Time'),
(7, 'Interships');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_languages`
--

CREATE TABLE `tbl_languages` (
  `languages_id` int(11) NOT NULL,
  `language_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_languages`
--

INSERT INTO `tbl_languages` (`languages_id`, `language_name`) VALUES
(1, 'English'),
(2, 'Malayalam'),
(4, 'Tamil'),
(5, 'Spanish');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `place_name` varchar(50) NOT NULL,
  `place_pincode` int(11) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `place_pincode`, `district_id`) VALUES
(2, 'Vannappuram ', 685607, 51),
(3, 'Chennai', 8968565, 64),
(4, 'Kanjar', 685698, 51);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL,
  `rating_content` varchar(50) NOT NULL,
  `rating_date` int(11) NOT NULL,
  `rating_value` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soft_skills`
--

CREATE TABLE `tbl_soft_skills` (
  `soft_skill_id` int(11) NOT NULL,
  `soft_skill_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_soft_skills`
--

INSERT INTO `tbl_soft_skills` (`soft_skill_id`, `soft_skill_name`) VALUES
(6, 'Communication'),
(7, 'Teamwork'),
(9, 'Adaptability'),
(10, 'Leadership'),
(11, 'Critical Thinking'),
(12, 'Creativity'),
(13, 'Emotional Inetelligence'),
(15, 'Team Management'),
(16, 'Conflict Resolution'),
(17, 'Active Listening'),
(18, 'Collaboration'),
(19, 'Flexibility'),
(20, 'Positive Attitude'),
(21, 'Self-Motivation'),
(22, 'Interpersonal Skills'),
(23, 'Public Speaking '),
(25, 'Empathy');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`state_id`, `state_name`) VALUES
(1, 'Andhra Pradesh'),
(2, 'Arunachal Pradesh'),
(3, 'Assam'),
(4, 'Bihar'),
(5, 'Chhattisgarh'),
(6, 'Goa'),
(7, 'Gujarat'),
(8, 'Haryana'),
(9, 'Himachal Pradesh'),
(10, 'Jharkhand'),
(11, 'Karnataka'),
(12, 'Kerala'),
(13, 'Madhya Pradesh'),
(14, 'Maharashtra'),
(15, 'Manipur'),
(16, 'Meghalaya'),
(17, 'Mizoram'),
(18, 'Nagaland'),
(19, 'Odisha'),
(20, 'Punjab'),
(21, 'Rajasthan'),
(22, 'Sikkim'),
(23, 'Tamil Nadu'),
(24, 'Telangana'),
(25, 'Tripura'),
(26, 'Uttar Pradesh'),
(27, 'Uttarakhand'),
(28, 'West Bengal');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_technical_skills`
--

CREATE TABLE `tbl_technical_skills` (
  `technical_skill_id` int(11) NOT NULL,
  `technical_skill_name` varchar(50) NOT NULL,
  `job_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_technical_skills`
--

INSERT INTO `tbl_technical_skills` (`technical_skill_id`, `technical_skill_name`, `job_category_id`) VALUES
(33, 'React', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_gender` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_contact` int(10) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_address` longtext NOT NULL,
  `user_resume` varchar(700) NOT NULL,
  `user_photo` varchar(700) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_gender`, `user_email`, `user_contact`, `user_password`, `user_address`, `user_resume`, `user_photo`, `user_status`) VALUES
(22, 'Crok', 'male', 'c@gmail.com', 213, '123', 'INDIA', 'amplifier.jpeg', 'Mr_Crock.jpeg', 1),
(23, 'Nami', 'female', 'n@gmail.com', 9786462, '123', 'JAPAN', 'chip.jpeg', 'Nami.jpeg', 1),
(25, 'Sanji', 'male', 'sanji@gmail.com', 24445, '123', 'SWEEDEN', 'a_scene.jpeg', 'Sanji.jpeg', 1),
(27, 'Mona Lisa', 'female', 'lisa@gmail.com', 2, '123', 'France', 'bg.jpeg', 'mona_lisa.jpeg', 0),
(29, 'Alan', 'male', 'a@gmail.com', 87556, '123', 'Infdia', 'bg.jpeg', 'beach_bunny.jpeg', 0),
(30, 'Leo', 'male', 'l@gmail.com', 5655345, '1234', 'INdia', 'bg.jpeg', 'beach_bunny.jpeg', 0),
(31, 'Hari', 'male', 'h@gmail.com', 987, '123', 'INDIA', 'bg.jpeg', 'freeky_cat.jpeg', 0),
(32, 'Mari', 'male', 'ma@gmail.com87', 766, '123', 'j', 'bg.jpeg', 'beach_bunny.jpeg', 0),
(33, 'FArzana', 'female', 'f@gmail.com', 86, '123', 'w', 'bg.jpeg', 'beach_bunny.jpeg', 0),
(34, 'Noora', 'female', 'noora@gmail.com', 33123, '123', 'in', 'bg.jpeg', 'freeky_cat.jpeg', 0),
(35, 'No', 'female', 'no@gmail.com', 33123, '123', 'in', 'bg.jpeg', 'freeky_cat.jpeg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_languages`
--

CREATE TABLE `tbl_user_languages` (
  `user_language_id` int(11) NOT NULL,
  `languages_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_languages`
--

INSERT INTO `tbl_user_languages` (`user_language_id`, `languages_id`, `user_id`) VALUES
(1, 1, 30),
(2, 2, 30),
(3, 1, 31),
(4, 2, 31),
(5, 1, 32),
(6, 2, 32),
(7, 1, 33),
(8, 2, 33),
(9, 1, 34),
(10, 2, 34),
(11, 1, 35),
(12, 2, 35);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_soft_skills`
--

CREATE TABLE `tbl_user_soft_skills` (
  `user_soft_skill_id` int(11) NOT NULL,
  `soft_skill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_soft_skills`
--

INSERT INTO `tbl_user_soft_skills` (`user_soft_skill_id`, `soft_skill_id`, `user_id`) VALUES
(1, 17, 30),
(2, 9, 30),
(3, 18, 30),
(4, 17, 31),
(5, 9, 31),
(6, 18, 31),
(7, 17, 32),
(8, 9, 32),
(9, 18, 32),
(10, 6, 32),
(11, 17, 33),
(12, 9, 33),
(13, 17, 34),
(14, 9, 34),
(15, 17, 35),
(16, 9, 35);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_technical_skills`
--

CREATE TABLE `tbl_user_technical_skills` (
  `user_technical_skill_id` int(11) NOT NULL,
  `technical_skill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_technical_skills`
--

INSERT INTO `tbl_user_technical_skills` (`user_technical_skill_id`, `technical_skill_id`, `user_id`) VALUES
(1, 33, 32),
(2, 33, 33),
(3, 33, 34),
(4, 33, 35);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_apply`
--
ALTER TABLE `tbl_apply`
  ADD PRIMARY KEY (`apply_id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `tbl_company_industry`
--
ALTER TABLE `tbl_company_industry`
  ADD PRIMARY KEY (`industry_id`);

--
-- Indexes for table `tbl_company_type`
--
ALTER TABLE `tbl_company_type`
  ADD PRIMARY KEY (`company_type_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_job_category`
--
ALTER TABLE `tbl_job_category`
  ADD PRIMARY KEY (`job_category_id`);

--
-- Indexes for table `tbl_job_languages`
--
ALTER TABLE `tbl_job_languages`
  ADD PRIMARY KEY (`job_language_id`);

--
-- Indexes for table `tbl_job_poster`
--
ALTER TABLE `tbl_job_poster`
  ADD PRIMARY KEY (`job_post_id`);

--
-- Indexes for table `tbl_job_soft_skills`
--
ALTER TABLE `tbl_job_soft_skills`
  ADD PRIMARY KEY (`job_soft_skill_id`);

--
-- Indexes for table `tbl_job_technical_skills`
--
ALTER TABLE `tbl_job_technical_skills`
  ADD PRIMARY KEY (`job_technical_skill_id`);

--
-- Indexes for table `tbl_job_type`
--
ALTER TABLE `tbl_job_type`
  ADD PRIMARY KEY (`job_type_id`);

--
-- Indexes for table `tbl_languages`
--
ALTER TABLE `tbl_languages`
  ADD PRIMARY KEY (`languages_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_soft_skills`
--
ALTER TABLE `tbl_soft_skills`
  ADD PRIMARY KEY (`soft_skill_id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_technical_skills`
--
ALTER TABLE `tbl_technical_skills`
  ADD PRIMARY KEY (`technical_skill_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_languages`
--
ALTER TABLE `tbl_user_languages`
  ADD PRIMARY KEY (`user_language_id`);

--
-- Indexes for table `tbl_user_soft_skills`
--
ALTER TABLE `tbl_user_soft_skills`
  ADD PRIMARY KEY (`user_soft_skill_id`);

--
-- Indexes for table `tbl_user_technical_skills`
--
ALTER TABLE `tbl_user_technical_skills`
  ADD PRIMARY KEY (`user_technical_skill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_apply`
--
ALTER TABLE `tbl_apply`
  MODIFY `apply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_company_industry`
--
ALTER TABLE `tbl_company_industry`
  MODIFY `industry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_company_type`
--
ALTER TABLE `tbl_company_type`
  MODIFY `company_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tbl_job_category`
--
ALTER TABLE `tbl_job_category`
  MODIFY `job_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_job_languages`
--
ALTER TABLE `tbl_job_languages`
  MODIFY `job_language_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_job_poster`
--
ALTER TABLE `tbl_job_poster`
  MODIFY `job_post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_job_soft_skills`
--
ALTER TABLE `tbl_job_soft_skills`
  MODIFY `job_soft_skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_job_technical_skills`
--
ALTER TABLE `tbl_job_technical_skills`
  MODIFY `job_technical_skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_job_type`
--
ALTER TABLE `tbl_job_type`
  MODIFY `job_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_languages`
--
ALTER TABLE `tbl_languages`
  MODIFY `languages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_soft_skills`
--
ALTER TABLE `tbl_soft_skills`
  MODIFY `soft_skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_technical_skills`
--
ALTER TABLE `tbl_technical_skills`
  MODIFY `technical_skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_user_languages`
--
ALTER TABLE `tbl_user_languages`
  MODIFY `user_language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_user_soft_skills`
--
ALTER TABLE `tbl_user_soft_skills`
  MODIFY `user_soft_skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_user_technical_skills`
--
ALTER TABLE `tbl_user_technical_skills`
  MODIFY `user_technical_skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
