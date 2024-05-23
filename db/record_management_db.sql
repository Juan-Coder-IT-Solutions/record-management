-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2024 at 02:22 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `record_management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assigned_tasks`
--

CREATE TABLE `tbl_assigned_tasks` (
  `assigned_task_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL COMMENT 'P - pending ; F - finished; A - approved',
  `comment` text NOT NULL,
  `date_assigned` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_assigned_tasks`
--

INSERT INTO `tbl_assigned_tasks` (`assigned_task_id`, `task_id`, `user_id`, `status`, `comment`, `date_assigned`) VALUES
(5, 4, 2, 'P', '', '2024-05-13 22:53:41'),
(6, 5, 4, 'P', 'sample comment', '2024-05-14 15:31:08'),
(8, 5, 5, 'P', '', '2024-05-14 15:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assigned_task_files`
--

CREATE TABLE `tbl_assigned_task_files` (
  `file_id` int(11) NOT NULL,
  `assigned_task_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_assigned_task_files`
--

INSERT INTO `tbl_assigned_task_files` (`file_id`, `assigned_task_id`, `file_name`, `date_added`) VALUES
(2, 5, '13675-background.png', '2024-05-14 00:08:42'),
(3, 5, '57206-images-(1).png', '2024-05-14 00:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_programs`
--

CREATE TABLE `tbl_programs` (
  `program_id` int(11) NOT NULL,
  `program_name` varchar(50) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_programs`
--

INSERT INTO `tbl_programs` (`program_id`, `program_name`, `date_added`) VALUES
(9, 'Bachelor of Science in Information Technology', '2024-05-12 20:30:24'),
(10, 'Bachelor of Science in Information Systems', '2024-05-12 20:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tasks`
--

CREATE TABLE `tbl_tasks` (
  `task_id` int(11) NOT NULL,
  `task_title` varchar(75) NOT NULL,
  `task_desc` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `posted_date` date NOT NULL,
  `deadline_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tasks`
--

INSERT INTO `tbl_tasks` (`task_id`, `task_title`, `task_desc`, `user_id`, `posted_date`, `deadline_date`) VALUES
(4, 'Task 1 sample', '', 2, '2024-05-13', '2024-05-17'),
(5, 'Task 2', 'sample task', 2, '2024-05-15', '2024-05-25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `user_category` varchar(15) NOT NULL COMMENT 'D - dean; F - faculty ; S - staff; P - program chair; R  - registrar',
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `program_id` int(11) NOT NULL,
  `designation` varchar(75) NOT NULL,
  `academic_rank` varchar(75) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `first_name`, `middle_name`, `last_name`, `user_category`, `username`, `password`, `program_id`, `designation`, `academic_rank`, `date_added`) VALUES
(2, 'Juan', '', 'Dela Cruz', 'D', 'dean', '0cc175b9c0f1b6a831c399e269772661', 9, 'Sample', ' ', '2024-05-13 11:40:56'),
(4, 'Eduard', '', 'Lapu-os', 'F', 'eduard', '0cc175b9c0f1b6a831c399e269772661', 10, 'sample', 'sample', '2024-05-14 15:10:21'),
(5, 'Mary Jean', 'Santos', 'Smith', 'F', 'faculty', '0cc175b9c0f1b6a831c399e269772661', 9, ' ', '  ', '2024-05-14 15:12:18'),
(6, 'John', 'Doe', 'Smith', 'P', 'programchair', '0cc175b9c0f1b6a831c399e269772661', 9, ' ', ' ', '2024-05-14 15:13:26'),
(7, 'Kathryn', 'Chandria', 'Bernardo', 'R', 'registrar', '0cc175b9c0f1b6a831c399e269772661', 0, ' ', ' ', '2024-05-14 15:15:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_assigned_tasks`
--
ALTER TABLE `tbl_assigned_tasks`
  ADD PRIMARY KEY (`assigned_task_id`);

--
-- Indexes for table `tbl_assigned_task_files`
--
ALTER TABLE `tbl_assigned_task_files`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `tbl_programs`
--
ALTER TABLE `tbl_programs`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `tbl_tasks`
--
ALTER TABLE `tbl_tasks`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_assigned_tasks`
--
ALTER TABLE `tbl_assigned_tasks`
  MODIFY `assigned_task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_assigned_task_files`
--
ALTER TABLE `tbl_assigned_task_files`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_programs`
--
ALTER TABLE `tbl_programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_tasks`
--
ALTER TABLE `tbl_tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
