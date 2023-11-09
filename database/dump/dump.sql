-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
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

-- Dumping data for table nazmahr.announcements: ~0 rows (approximately)
DELETE FROM `announcements`;
INSERT INTO `announcements` (`id`, `code`, `subject`, `content`, `attachment`, `is_send_email`, `is_active`, `created_at`, `updated_at`) VALUES
	(2, 'ANN-65480054ea276', 'contoh', '<p>update isi konten</p><p>&nbsp;</p><p><strong>Ibnu ganteng sekali</strong></p>', '65480054e7407.pdf', 1, 1, '2023-11-05 13:51:32', '2023-11-05 13:56:00');

-- Dumping data for table nazmahr.attendances: ~4 rows (approximately)
DELETE FROM `attendances`;
INSERT INTO `attendances` (`id`, `attendance_type_id`, `user_id`, `entry_at`, `exit_at`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `attendance_time_config_id`) VALUES
	(1, 1, 3, '2023-01-07 08:00:00', '2023-01-07 17:00:00', 'Wifi kosan tidak ada internet', 1, 1, NULL, '2023-11-07 19:29:41', '2023-11-07 19:29:41', 2),
	(2, 1, 4, '2023-11-07 08:15:00', '2023-11-07 17:20:00', 'Browser error', 1, 1, 1, '2023-11-07 19:47:26', '2023-11-07 20:52:57', 2),
	(10, 1, 1, '2023-11-08 14:40:48', '2023-11-08 14:57:37', 'saya telah mengerjakan fitur absensi ini', 1, 1, 1, '2023-11-08 00:40:48', '2023-11-08 00:57:37', 3);

-- Dumping data for table nazmahr.attendance_time_configs: ~7 rows (approximately)
DELETE FROM `attendance_time_configs`;
INSERT INTO `attendance_time_configs` (`id`, `attendance_type_id`, `day`, `start_time`, `end_time`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Senin', '08:00:00', '17:00:00', 1, 1, NULL, '2023-11-07 19:46:37'),
	(2, 1, 'Selasa', '08:00:00', '17:00:00', 1, NULL, '2023-11-04 01:16:07', '2023-11-04 01:16:07'),
	(3, 1, 'Rabu', '08:00:00', '17:00:00', 1, NULL, '2023-11-04 01:16:21', '2023-11-04 01:16:21'),
	(4, 1, 'Kamis', '08:00:00', '17:00:00', 1, NULL, '2023-11-04 01:16:32', '2023-11-04 01:16:32'),
	(5, 1, 'Jumat', '08:00:00', '17:00:00', 1, NULL, '2023-11-04 01:16:41', '2023-11-04 01:16:41'),
	(6, 2, 'Sabtu', '08:00:00', '17:00:00', 1, NULL, '2023-11-04 01:16:41', '2023-11-04 01:16:41'),
	(7, 2, 'Minggu', '08:00:00', '17:00:00', 1, NULL, '2023-11-04 01:16:41', '2023-11-04 01:16:41');

-- Dumping data for table nazmahr.attendance_types: ~2 rows (approximately)
DELETE FROM `attendance_types`;
INSERT INTO `attendance_types` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Weekday', 1, 1, NULL, '2023-11-06 02:33:14', '2023-11-06 02:33:14'),
	(2, 'Day Off', 1, 1, 1, '2023-11-06 02:33:23', '2023-11-06 02:33:34');

-- Dumping data for table nazmahr.casbons: ~0 rows (approximately)
DELETE FROM `casbons`;
INSERT INTO `casbons` (`id`, `user_id`, `date`, `nominal`, `status`, `refund_attachment`, `application_attachment`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 3, '2023-11-06', 900000, 'approved', NULL, NULL, 'Transportation', 1, NULL, '2023-11-05 12:19:44', '2023-11-05 12:19:44');

-- Dumping data for table nazmahr.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping data for table nazmahr.migrations: ~0 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_10_14_071454_create_permit_leaves_categories_table', 1),
	(6, '2023_10_14_071552_create_permit_leaves_table', 1),
	(7, '2023_10_14_072136_create_casbons_table', 1),
	(8, '2023_10_14_072419_create_overtimes_table', 1),
	(9, '2023_10_14_073355_create_positions_table', 1),
	(10, '2023_10_14_073552_create_task_types_table', 1),
	(11, '2023_10_14_073713_create_tasks_table', 1),
	(12, '2023_10_14_074002_create_attendance_types_table', 1),
	(13, '2023_10_14_074115_create_attendances_table', 1),
	(14, '2023_11_04_031144_create_attendance_time_config_table', 1),
	(15, '2023_11_04_071204_add_relation_position_users_position', 1),
	(16, '2023_11_05_195913_create_announcements_table', 2),
	(17, '2023_11_06_015013_add_attendance_time_config_id_attendances', 3),
	(21, '2023_11_06_030525_create_reprimands_table', 4),
	(22, '2023_11_06_040659_create_time_trackers_table', 4);

-- Dumping data for table nazmahr.overtimes: ~0 rows (approximately)
DELETE FROM `overtimes`;

-- Dumping data for table nazmahr.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping data for table nazmahr.permit_leaves: ~0 rows (approximately)
DELETE FROM `permit_leaves`;
INSERT INTO `permit_leaves` (`id`, `user_id`, `submission_type`, `start_date`, `end_date`, `attachment`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	('08628d60-33e1-492d-9254-57ed78a11c1d', 4, 'leave', '2023-11-04', '2023-11-15', '65462a9148c7f.pdf', 'contoh', 'approved', 1, 1, '2023-11-04 04:00:28', '2023-11-07 21:23:43');

-- Dumping data for table nazmahr.permit_leaves_categories: ~0 rows (approximately)
DELETE FROM `permit_leaves_categories`;

-- Dumping data for table nazmahr.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping data for table nazmahr.positions: ~3 rows (approximately)
DELETE FROM `positions`;
INSERT INTO `positions` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 1, 1, 1, NULL, NULL),
	(2, 'Manager', 1, 1, 1, NULL, NULL),
	(3, 'Karyawan', 1, 1, 1, NULL, NULL);

-- Dumping data for table nazmahr.reprimands: ~0 rows (approximately)
DELETE FROM `reprimands`;
INSERT INTO `reprimands` (`id`, `user_id`, `reprimand_type`, `start_date`, `end_date`, `content`, `attachment`, `is_send_email`, `created_at`, `updated_at`) VALUES
	(1, 3, 'SP1', NULL, NULL, 'contoh', NULL, 1, '2023-11-07 21:22:13', '2023-11-07 21:22:13');

-- Dumping data for table nazmahr.request_attendances: ~0 rows (approximately)
DELETE FROM `request_attendances`;
INSERT INTO `request_attendances` (`id`, `attendance_type_id`, `user_id`, `entry_at`, `exit_at`, `description`, `status_verification`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 1, 3, '2023-11-06 16:38:00', '2023-11-06 16:38:00', 'Jaringan internet dirumah mati', 'Pending', 1, 1, NULL, '2023-11-06 02:38:53', '2023-11-06 02:38:53');

-- Dumping data for table nazmahr.request_reimbursement: ~0 rows (approximately)
DELETE FROM `request_reimbursement`;

-- Dumping data for table nazmahr.tasks: ~0 rows (approximately)
DELETE FROM `tasks`;

-- Dumping data for table nazmahr.task_types: ~11 rows (approximately)
DELETE FROM `task_types`;
INSERT INTO `task_types` (`id`, `name`, `status`, `priority`, `created_by`, `updated_by`, `created_at`, `updated_at`, `price`) VALUES
	(1, 'Umum', 0, 'medium', 1, NULL, '2023-11-04 05:35:23', '2023-11-04 05:35:23', NULL),
	(2, 'Desain (Flyer/GFPP)', 0, 'normal', 1, 1, '2023-11-04 05:35:38', '2023-11-08 19:17:55', 25000),
	(3, 'Re-DS (Re-Desain)', 0, 'normal', 1, NULL, '2023-11-08 19:19:06', '2023-11-08 19:19:06', 5000),
	(4, 'Dinas Luar Kota / Event Preparation', 0, 'normal', 1, 1, '2023-11-08 19:19:36', '2023-11-08 19:20:06', 110000),
	(5, 'Dinas Luar Kota', 0, 'normal', 1, NULL, '2023-11-08 19:20:24', '2023-11-08 19:20:24', 200000),
	(6, 'Sharing Proyek', 0, 'normal', 1, NULL, '2023-11-08 19:20:39', '2023-11-08 19:20:39', NULL),
	(7, 'Narasumber', 0, 'normal', 1, NULL, '2023-11-08 19:21:17', '2023-11-08 19:21:17', 300000),
	(8, 'Upload Konten', 0, 'normal', 1, NULL, '2023-11-08 19:21:31', '2023-11-08 19:21:31', NULL),
	(9, 'Admin', 0, 'normal', 1, NULL, '2023-11-08 19:22:43', '2023-11-08 19:22:43', 150000),
	(10, 'PIC Proyek', 0, 'normal', 1, NULL, '2023-11-08 19:23:00', '2023-11-08 19:23:00', 300000),
	(11, 'Lain - lain', 0, 'normal', 1, NULL, '2023-11-08 19:23:11', '2023-11-08 19:23:11', NULL);

-- Dumping data for table nazmahr.time_trackers: ~3 rows (approximately)
DELETE FROM `time_trackers`;
INSERT INTO `time_trackers` (`id`, `user_id`, `start_time`, `end_time`, `total_time`, `subject`, `task`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 3, '2023-11-06 07:00:00', '2023-11-06 07:59:53', '360', 'Tugas 1', NULL, 1, 1, '2023-11-06 07:07:08', '2023-11-06 00:59:53'),
	(2, 4, '2023-11-06 07:00:00', '2023-11-06 07:59:51', '360', 'Tugas 2', NULL, 1, 1, '2023-11-06 07:07:08', '2023-11-06 00:59:51'),
	(5, 3, '2023-11-06 07:50:52', '2023-11-08 07:41:52', '2451', 'Contoh', 'Tugas 1', 1, 1, '2023-11-06 00:50:47', '2023-11-08 00:41:52');

-- Dumping data for table nazmahr.users: ~3 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `birth`, `gender`, `phone`, `address`, `ktp`, `photo`, `join_date`, `is_active`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`, `position_id`) VALUES
	(1, 'Admin', 'admin@mail.com', NULL, '$2y$10$S8HefQf.dhPUqLIYyqtuxO1h25oI3Bhv1r3zxfRgQwo45f9jPcHbW', '2023-11-04', 'L', '6281515144981', 'Jakarta', NULL, NULL, '2023-11-04', 1, NULL, NULL, NULL, '2023-11-04 00:14:37', '2023-11-04 00:14:37', 1),
	(3, 'Moh Ibnu', 'ibnuabdurrohmansutio@gmail.com', NULL, '$2y$10$Jp.7yef4eeCdn8jRC5hPT.wJY07kkj2Xi3Si5vwMPqzEEYu1.KyrS', '2023-11-04', 'L', '+6281515144981', 'Yogyakarta', '6545fc858d765.png', '6545fc8591c78.jpg', '2023-11-04', 1, 1, NULL, NULL, '2023-11-04 01:10:45', '2023-11-04 01:10:45', 3),
	(4, 'Icen Ectefania', 'icen@gmail.com', NULL, '$2y$10$lwnxaOTusRzWIjOioSYnLuxz0q5KnhkJahT7KwMR0dnraCWSJQuQu', '2001-09-23', 'P', '6281515144982', 'Singkawang', '6545fcdd46dda.jpg', '6545fcdd4a800.jpg', '2023-11-04', 1, 1, NULL, NULL, '2023-11-04 01:12:13', '2023-11-04 01:12:13', 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
