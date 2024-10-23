-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for record_management_db
CREATE DATABASE IF NOT EXISTS `record_management_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `record_management_db`;

-- Dumping structure for table record_management_db.tbl_assigned_tasks
CREATE TABLE IF NOT EXISTS `tbl_assigned_tasks` (
  `assigned_task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL COMMENT 'U = Uploaded; C = checking ; A = Approved; R = Revisions',
  `task_status` varchar(1) NOT NULL,
  `comment` text NOT NULL,
  `encoded_by` int(11) NOT NULL,
  `date_assigned` datetime NOT NULL,
  `notification_status` int(1) NOT NULL,
  `task_grades` int(3) NOT NULL,
  PRIMARY KEY (`assigned_task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table record_management_db.tbl_assigned_tasks: ~10 rows (approximately)
INSERT INTO `tbl_assigned_tasks` (`assigned_task_id`, `task_id`, `user_id`, `status`, `task_status`, `comment`, `encoded_by`, `date_assigned`, `notification_status`, `task_grades`) VALUES
	(7, 6, 4, 'U', 'F', '', 0, '2024-05-14 01:18:36', 0, 0),
	(8, 4, 4, 'A', 'F', '', 0, '2024-05-14 07:49:48', 0, 23),
	(9, 7, 5, 'U', '0', '', 0, '2024-05-14 22:05:06', 0, 0),
	(10, 5, 6, 'C', 'F', 'very good', 0, '2024-05-14 22:21:19', 0, 0),
	(12, 8, 5, 'U', 'F', '', 0, '2024-05-28 10:21:09', 1, 0),
	(13, 5, 8, 'U', 'F', '', 0, '2024-07-06 18:40:24', 0, 0),
	(14, 0, 0, 'U', '0', '', 0, '2024-07-27 12:36:26', 1, 0),
	(16, 4, 3, 'U', 'F', '', 0, '2024-07-27 12:51:51', 1, 0),
	(22, 4, 2, 'U', 'F', '', 2, '2024-07-27 16:02:59', 1, 0),
	(23, 4, 7, 'P', '', '', 2, '2024-10-23 21:27:43', 0, 0);

-- Dumping structure for table record_management_db.tbl_assigned_task_files
CREATE TABLE IF NOT EXISTS `tbl_assigned_task_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `assigned_task_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table record_management_db.tbl_assigned_task_files: ~9 rows (approximately)
INSERT INTO `tbl_assigned_task_files` (`file_id`, `assigned_task_id`, `file_name`, `date_added`) VALUES
	(2, 5, 'file_example_MP3_700KB.mp3', '2024-05-14 00:08:42'),
	(3, 5, 'file_example_MP3_700KB.mp3', '2024-05-14 00:11:00'),
	(4, 7, 'file_example_MP3_700KB.mp3', '2024-05-14 21:59:42'),
	(5, 9, 'file_example_MP3_700KB.mp3', '2024-05-14 22:06:46'),
	(6, 8, 'file_example_MP3_700KB.mp3', '2024-05-14 22:13:06'),
	(7, 10, 'file_example_MP3_700KB.mp3', '2024-05-14 22:22:21'),
	(8, 13, 'file_example_MP3_700KB.mp3', '2024-07-06 18:42:21'),
	(13, 8, '1.pdf', '0000-00-00 00:00:00'),
	(14, 8, 'revisions-Aug-28-2024 (1).docx', '0000-00-00 00:00:00');

-- Dumping structure for table record_management_db.tbl_comments
CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `assigned_task_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table record_management_db.tbl_comments: ~29 rows (approximately)
INSERT INTO `tbl_comments` (`comment_id`, `comment`, `assigned_task_id`, `task_id`, `user_id`, `date_added`) VALUES
	(1, '', 7, 0, 4, '2024-07-27 17:57:43'),
	(2, 'sample', 7, 0, 4, '2024-07-27 18:02:51'),
	(3, 'asd asdd asf af asf', 22, 0, 2, '2024-07-27 18:04:50'),
	(4, 'Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.', 7, 0, 2, '2024-07-27 18:05:49'),
	(5, 'asdsd', 7, 0, 2, '2024-07-27 18:09:43'),
	(6, 'asd', 7, 0, 4, '2024-07-27 18:09:54'),
	(7, 's', 7, 0, 4, '2024-07-27 18:10:01'),
	(8, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.', 7, 0, 2, '2024-07-27 18:10:36'),
	(9, 'yes', 7, 0, 4, '2024-07-27 18:10:48'),
	(10, 'asd', 7, 0, 4, '2024-07-27 20:22:34'),
	(11, 'as', 7, 0, 4, '2024-07-27 20:24:51'),
	(12, 'a', 7, 0, 4, '2024-07-27 20:25:18'),
	(13, 'a', 7, 0, 4, '2024-07-27 20:25:22'),
	(14, 'as', 7, 0, 4, '2024-07-27 20:25:43'),
	(15, 'a', 7, 0, 4, '2024-07-27 20:26:06'),
	(16, 'w', 7, 0, 4, '2024-07-27 20:26:10'),
	(17, 'qe', 0, 0, 4, '2024-07-27 20:27:44'),
	(18, 'asd', 7, 0, 4, '2024-07-27 20:28:23'),
	(19, 's', 7, 0, 4, '2024-07-27 20:28:26'),
	(20, 'a', 7, 0, 4, '2024-07-27 20:28:52'),
	(21, 'sda', 7, 0, 4, '2024-07-27 20:28:54'),
	(22, 'asd', 7, 0, 4, '2024-07-27 20:30:35'),
	(23, 'ad', 7, 0, 4, '2024-07-27 20:30:59'),
	(24, 'asd', 7, 0, 4, '2024-07-27 20:31:02'),
	(25, 'q', 7, 0, 4, '2024-07-27 20:31:16'),
	(26, 'qweqwe', 7, 0, 4, '2024-07-27 20:31:19'),
	(27, 'qwe', 7, 0, 4, '2024-07-27 20:31:24'),
	(28, 'wqe', 8, 0, 2, '2024-08-26 15:42:09'),
	(29, 'asd', 8, 0, 2, '2024-08-26 15:43:06');

-- Dumping structure for table record_management_db.tbl_logs
CREATE TABLE IF NOT EXISTS `tbl_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `remarks` text NOT NULL,
  `updated_from` varchar(250) NOT NULL,
  `updated_to` varchar(250) NOT NULL,
  `module` varchar(15) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table record_management_db.tbl_logs: ~3 rows (approximately)
INSERT INTO `tbl_logs` (`log_id`, `remarks`, `updated_from`, `updated_to`, `module`, `date_added`, `user_id`) VALUES
	(18, 'Description', '', 'sa', 'Tasks', '2024-10-23 15:38:59', 2),
	(19, 'Task title', 'Task 1 samples', 'Task 1', 'Tasks', '2024-10-23 15:39:20', 2),
	(20, 'Description', 'sa', 'sample only', 'Tasks', '2024-10-23 15:39:20', 2);

-- Dumping structure for table record_management_db.tbl_notifications
CREATE TABLE IF NOT EXISTS `tbl_notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `assigned_task_id` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `title` varchar(150) NOT NULL,
  `status` int(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table record_management_db.tbl_notifications: ~17 rows (approximately)
INSERT INTO `tbl_notifications` (`notification_id`, `user_id`, `task_id`, `assigned_task_id`, `remarks`, `title`, `status`, `date_added`) VALUES
	(2, 2, 4, 21, '', 'Assigned Task', 0, '2024-07-27 16:17:52'),
	(3, 2, 4, 22, '', 'Assigned Task', 0, '2024-07-27 16:04:24'),
	(4, 0, 9, 0, '', '', 0, '2024-07-28 15:59:33'),
	(5, 5, 8, 12, '', 'Task Overdue', 1, '2024-07-28 16:35:45'),
	(6, 3, 4, 16, '', 'Task Overdue', 1, '2024-07-28 16:35:45'),
	(7, 2, 4, 22, '', 'Task Overdue', 0, '2024-07-28 16:40:13'),
	(8, 0, 0, 14, '', 'Task Overdue', 1, '2024-07-28 16:42:44'),
	(9, 4, 0, 8, '', 'Task Under Review', 0, '2024-07-28 18:34:13'),
	(10, 4, 0, 8, '', 'Task Under Review', 0, '2024-07-28 18:34:17'),
	(11, 4, 4, 8, '', 'Task Needs Revision', 0, '2024-07-28 18:34:16'),
	(12, 4, 4, 8, '', 'Task Under Review', 0, '2024-07-28 18:34:10'),
	(13, 4, 4, 8, '', 'Task Approved', 0, '2024-07-28 18:34:08'),
	(14, 4, 6, 7, '', 'Faculty name Faculty middle Faculty last uploaded ', 0, '2024-07-28 18:39:48'),
	(15, 3, 6, 7, '', 'Faculty name Faculty middle Faculty last uploaded ', 1, '2024-07-28 18:39:46'),
	(16, 4, 4, 8, '', 'Juan  Dela Cruz submitted you a grade in Task: Task 1 sample', 1, '2024-08-10 15:33:46'),
	(17, 6, 5, 10, '', 'Task Under Review', 1, '2024-08-26 17:03:27'),
	(18, 7, 4, 23, '', 'Assigned Task', 1, '2024-10-23 21:27:43');

-- Dumping structure for table record_management_db.tbl_programs
CREATE TABLE IF NOT EXISTS `tbl_programs` (
  `program_id` int(11) NOT NULL AUTO_INCREMENT,
  `program_name` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`program_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table record_management_db.tbl_programs: ~5 rows (approximately)
INSERT INTO `tbl_programs` (`program_id`, `program_name`, `user_id`, `date_added`) VALUES
	(9, 'Bachelor of Science in Information Technology1', 2, '2024-05-12 20:30:24'),
	(10, 'Bachelor of Science in Information Systems', 2, '2024-05-12 20:30:32'),
	(12, 'Bachelor of Science in Industrial Technology', 2, '2024-05-14 22:06:49'),
	(13, 'asd', 0, '2024-08-26 15:03:32'),
	(14, 'wewe', 0, '2024-08-26 15:30:32');

-- Dumping structure for table record_management_db.tbl_tasks
CREATE TABLE IF NOT EXISTS `tbl_tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_title` varchar(75) NOT NULL,
  `task_desc` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `posted_date` datetime NOT NULL,
  `deadline_date` datetime NOT NULL,
  `hide_status` int(1) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table record_management_db.tbl_tasks: ~5 rows (approximately)
INSERT INTO `tbl_tasks` (`task_id`, `task_title`, `task_desc`, `user_id`, `status`, `posted_date`, `deadline_date`, `hide_status`, `date_added`) VALUES
	(4, 'Task 1', 'sample only', 2, 'F', '2024-05-13 00:00:00', '2024-07-27 00:00:00', 0, '0000-00-00 00:00:00'),
	(5, 'Grades', 'Testing', 2, 'F', '2024-05-14 00:00:00', '2024-05-15 00:00:00', 0, '0000-00-00 00:00:00'),
	(6, 'Capstone project submission', 'For faculty', 3, 'F', '2024-05-14 00:00:00', '2024-05-17 00:00:00', 0, '0000-00-00 00:00:00'),
	(8, 'Grades 1st Semester', 'for 1st sem only', 2, 'F', '2024-05-28 00:00:00', '2024-06-03 00:00:00', 0, '0000-00-00 00:00:00'),
	(9, 's', 's', 2, 'F', '2024-07-28 00:00:00', '2024-07-27 00:00:00', 1, '0000-00-00 00:00:00');

-- Dumping structure for table record_management_db.tbl_users
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `user_category` varchar(15) NOT NULL COMMENT 'D - dean; F - faculty ; S - staff; P - program chair; R  - registrar',
  `username` varchar(30) NOT NULL,
  `password` text NOT NULL,
  `program_id` int(11) NOT NULL,
  `designation` varchar(75) NOT NULL,
  `academic_rank` varchar(75) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table record_management_db.tbl_users: ~8 rows (approximately)
INSERT INTO `tbl_users` (`user_id`, `first_name`, `middle_name`, `last_name`, `user_category`, `username`, `password`, `program_id`, `designation`, `academic_rank`, `date_added`) VALUES
	(2, 'Juan', '', 'Dela Cruz', 'D', 'dean', '0cc175b9c0f1b6a831c399e269772661', 9, 'Sample', ' ', '2024-05-13 11:40:56'),
	(3, 'Fname', 'Mname', 'Lname', 'P', 'Chair', '0cc175b9c0f1b6a831c399e269772661', 9, 'Blank', 'A', '2024-05-14 01:08:38'),
	(4, 'Faculty name', 'Faculty middle', 'Faculty last', 'F', 'Faculty', '0cc175b9c0f1b6a831c399e269772661', 9, 'Testing', 'S', '2024-05-14 01:15:44'),
	(5, 'vince', 'vince', 'vince', 'R', 'vince', '0cc175b9c0f1b6a831c399e269772661', 9, 'a', 'a', '2024-05-14 22:02:56'),
	(6, 'is1', 'is1', 'is1', 'F', 'is1', '4948716b17d1ab2089a1e4bf38ea692b', 10, 'a', 'a', '2024-05-14 22:16:31'),
	(7, 'ischair', 'ischair', 'ischair', 'P', 'ischair', '9ed8fc3ca122a1d37f1b54e9c022819f', 10, 'a', 'a', '2024-05-14 22:17:24'),
	(8, 'a', 'a', 'a', 'F', 'faculty1', '0cc175b9c0f1b6a831c399e269772661', 10, 'a', 'a', '2024-07-06 18:39:59'),
	(9, 's', 's', 's', 'S', '3', 'eccbc87e4b5ce2fe28308fd9f2a7baf3', 9, '3', '3', '2024-08-26 17:41:11');

-- Dumping structure for trigger record_management_db.update_task_status
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `update_task_status` AFTER UPDATE ON `tbl_tasks` FOR EACH ROW UPDATE tbl_assigned_tasks SET task_status = NEW.status WHERE task_id = NEW.task_id//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
