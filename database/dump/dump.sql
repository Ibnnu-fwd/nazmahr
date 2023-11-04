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

-- Dumping data for table nazmahr.attendances: ~0 rows (approximately)
DELETE FROM `attendances`;

-- Dumping data for table nazmahr.attendance_time_configs: ~5 rows (approximately)
DELETE FROM `attendance_time_configs`;
INSERT INTO `attendance_time_configs` (`id`, `day`, `start_time`, `end_time`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
	(1, 'Senin', '08:00:00', '17:00:00', 1, NULL, NULL, NULL),
	(2, 'Selasa', '08:00:00', '17:00:00', 1, NULL, '2023-11-04 01:16:07', '2023-11-04 01:16:07'),
	(3, 'Rabu', '08:00:00', '17:00:00', 1, NULL, '2023-11-04 01:16:21', '2023-11-04 01:16:21'),
	(4, 'Kamis', '08:00:00', '17:00:00', 1, NULL, '2023-11-04 01:16:32', '2023-11-04 01:16:32'),
	(5, 'Jumat', '08:00:00', '17:00:00', 1, NULL, '2023-11-04 01:16:41', '2023-11-04 01:16:41');

-- Dumping data for table nazmahr.attendance_types: ~0 rows (approximately)
DELETE FROM `attendance_types`;

-- Dumping data for table nazmahr.casbons: ~0 rows (approximately)
DELETE FROM `casbons`;

-- Dumping data for table nazmahr.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping data for table nazmahr.migrations: ~15 rows (approximately)
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
	(15, '2023_11_04_071204_add_relation_position_users_position', 1);

-- Dumping data for table nazmahr.overtimes: ~0 rows (approximately)
DELETE FROM `overtimes`;

-- Dumping data for table nazmahr.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping data for table nazmahr.permit_leaves: ~0 rows (approximately)
DELETE FROM `permit_leaves`;

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

-- Dumping data for table nazmahr.tasks: ~0 rows (approximately)
DELETE FROM `tasks`;

-- Dumping data for table nazmahr.task_types: ~0 rows (approximately)
DELETE FROM `task_types`;

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
