-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2018 at 04:24 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bincom_coursereg`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_fname` varchar(100) NOT NULL,
  `admin_lname` varchar(100) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_role` enum('super','normal') NOT NULL,
  `auth_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_fname`, `admin_lname`, `admin_username`, `admin_password`, `admin_role`, `auth_key`) VALUES
(1, 'super', 'admin', 'super_admin', '$2y$10$myownfunnyhashstring2uuR8SIpV4z/9M6i3XF0w1e3vd.r.WB0K', 'super', 'jbnku5iorjg98ujoi3w98yhw897yhser89uhr89h');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_title` text NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_unit` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_title`, `course_code`, `course_unit`, `dept_id`, `faculty_id`, `lecturer_id`) VALUES
(1, 'Calculus', 'MAT102', 3, 4, 2, 1),
(2, 'Algebra', 'MAT101', 3, 4, 2, 2),
(3, 'Basic Electronics', 'EEE111', 2, 1, 1, 5),
(4, 'Computer Graphics', 'ECE401', 3, 1, 1, 6),
(5, 'Introduction To Zoology', 'ZOO101', 2, 11, 2, 10),
(7, 'Thermodynamics I', 'CPE204', 3, 7, 1, 20),
(8, 'Intro To Macroeconomics', 'ECO101', 2, 9, 4, 71);

-- --------------------------------------------------------

--
-- Table structure for table `course_reg`
--

CREATE TABLE `course_reg` (
  `reg_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `courses` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `reg_status` enum('Pending','Approved','Unapproved') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_reg`
--

INSERT INTO `course_reg` (`reg_id`, `student_id`, `courses`, `comment`, `reg_status`) VALUES
(1, 6, '["1","2"]', 'ok', 'Approved'),
(8, 7, '["1","2"]', 'okay, you''re good to go', 'Approved'),
(9, 8, '["1","2","5"]', '', 'Pending'),
(11, 10, '["3","4","1","2"]', 'Ok', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_id` int(11) NOT NULL,
  `dept_name` text NOT NULL,
  `dept_code` text NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_id`, `dept_name`, `dept_code`, `faculty_id`) VALUES
(1, 'Electrical And Electronics Engineering', 'EEE', 1),
(2, 'Computer Science', 'CSC', 2),
(3, 'Physics', 'PHY', 2),
(4, 'Mathematics', 'MAT', 2),
(7, 'Chemical And Polymer Engineering', 'CPE', 1),
(8, 'Mechanical Engineering', 'MEE', 1),
(9, 'Economics', 'ECO', 4),
(10, 'Law', 'LAW', 3),
(11, 'Zoology', 'ZOO', 2),
(13, 'Botany', 'BOT', 2);

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` text NOT NULL,
  `faculty_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`faculty_id`, `faculty_name`, `faculty_code`) VALUES
(1, 'Engineering', 'ENG'),
(2, 'Science', 'SCI'),
(3, 'Arts', 'ART'),
(4, 'Management Science', 'MNS');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_firstname` text NOT NULL,
  `student_lastname` text NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `student_password` varchar(255) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `auth_key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_firstname`, `student_lastname`, `student_email`, `username`, `student_password`, `dept_id`, `faculty_id`, `auth_key`) VALUES
(6, 'Ayanwale', 'Ajewunmi', 'asquared@mail.com', 'asquared', '$2y$10$myownfunnyhashstring2uDFhlOK39N/44Gowv8OzYfx9OgWDZaqy', 2, 2, 'dzSuz29NsqTGaxu42ibXmqSlGJmf24k_'),
(7, 'Adayi', 'David', 'adayidavid@mail.com', 'adayi', '$2y$10$myownfunnyhashstring2u/uLyKio9m0Lj6BwGvGAseeisFyuv8he', 2, 2, '174EJJwLNm-Ms7tDNm_2s7GPly3kJ_oz'),
(8, 'Maryam', 'Joseph', 'maryam@mail.com', 'maryam', '$2y$10$myownfunnyhashstring2ufpv2Qbi.jukYIuVNf3SQALtVvbEgBZa', 10, 3, '3xXjOqUKMAJviBTCkmesD6uYoKw6itsL'),
(9, 'James', 'Amadi', 'amadi@mail.com', 'james', '$2y$10$myownfunnyhashstring2uet0I01wzX1gqTzANTUZlVtMRQsa8ZIC', 2, 2, 'st004key'),
(10, 'demo', 'demo', 'demo@demo.com', 'demo', '$2y$10$myownfunnyhashstring2ux.MI0prgHHj.DDEVWVIQBwTJpPrlQFm', 2, 2, 'PblMFBhBWYztt5WhSuGFKtf-BZvPPumI');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_reg`
--
ALTER TABLE `course_reg`
  ADD PRIMARY KEY (`reg_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `course_reg`
--
ALTER TABLE `course_reg`
  MODIFY `reg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
