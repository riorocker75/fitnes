-- -------------------------------------------------------------
-- TablePlus 3.8.0(336)
--
-- https://tableplus.com/
--
-- Database: fitness
-- Generation Time: 2020-12-12 19:31:40.7380
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `absensi`;
CREATE TABLE `absensi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pengunjung_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jam_keluar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `detail_transaksi`;
CREATE TABLE `detail_transaksi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `transaksi_id` bigint unsigned NOT NULL,
  `nama_obat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `berapa_bulan_member` int DEFAULT NULL,
  `harga` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `instruktur`;
CREATE TABLE `instruktur` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengunjung_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pengunjung_id` bigint unsigned NOT NULL,
  `berakhir_pada` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `pengunjung`;
CREATE TABLE `pengunjung` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE `transaksi` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengunjung_id` bigint unsigned NOT NULL,
  `total_harga` double NOT NULL,
  `bayar` double DEFAULT NULL,
  `kembalian` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `absensi` (`id`, `pengunjung_id`, `tanggal`, `jam_masuk`, `jam_keluar`, `created_at`, `updated_at`) VALUES
('1', '1', '2020-12-12', '01:00', '02:00', '2020-12-12 10:27:58', '2020-12-12 10:27:58'),
('2', '2', '2020-12-12', '02:30', '04:15', '2020-12-12 10:29:05', '2020-12-12 10:29:05'),
('3', '21', '2020-12-12', '10:00', '12:00', '2020-12-12 10:40:36', '2020-12-12 10:40:36'),
('4', '3', '2020-12-12', '05:00', '06:00', '2020-12-12 12:23:55', '2020-12-12 12:23:55'),
('5', '4', '2020-12-12', '07:00', '09:29', '2020-12-12 12:24:59', '2020-12-12 12:24:59');

INSERT INTO `detail_transaksi` (`id`, `transaksi_id`, `nama_obat`, `berapa_bulan_member`, `harga`, `created_at`, `updated_at`) VALUES
('1', '1', NULL, '1', '100000', '2020-12-12 09:52:52', '2020-12-12 09:52:52'),
('2', '2', NULL, '3', '250000', '2020-12-12 10:18:57', '2020-12-12 10:18:57'),
('3', '5', NULL, '3', '250000', '2020-12-12 12:19:49', '2020-12-12 12:19:49'),
('4', '6', NULL, '3', '250000', '2020-12-12 12:23:30', '2020-12-12 12:23:30');

INSERT INTO `instruktur` (`id`, `hari`, `nama`, `alamat`, `jenis_kelamin`, `pengunjung_id`, `created_at`, `updated_at`) VALUES
('1', 'senin', 'Hic ad ratione qui n', 'Aute sed consequatur', 'Pria', '3', '2020-11-22 11:55:13', '2020-11-22 11:55:13'),
('2', 'senin', 'Voluptatem perspicia', 'Dolorem repudiandae', 'Pria', '20', '2020-11-22 11:55:26', '2020-11-22 11:55:26'),
('3', 'sabtu', 'Voluptatem Enim ull', 'In molestias facere', 'Pria', '19', '2020-11-22 11:55:44', '2020-11-22 11:59:00');

INSERT INTO `member` (`id`, `pengunjung_id`, `berakhir_pada`, `created_at`, `updated_at`) VALUES
('1', '21', '2020-01-12', '2020-12-12 09:52:52', '2020-12-12 09:52:52'),
('2', '21', '2021-03-12', '2020-12-12 10:18:57', '2020-12-12 10:18:57'),
('3', '22', '2021-03-12', '2020-12-12 12:19:49', '2020-12-12 12:19:49'),
('4', '3', '2021-03-12', '2020-12-12 12:23:30', '2020-12-12 12:23:30');

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
('1', '2014_10_12_000000_create_users_table', '1'),
('2', '2019_08_19_000000_create_failed_jobs_table', '1'),
('3', '2020_11_10_102440_create_pengunjung_table', '1'),
('7', '2020_11_10_104711_create_member_table', '1'),
('8', '2020_11_10_105116_create_detail_transaksi_table', '1'),
('10', '2020_11_10_102517_create_absensi_table', '2'),
('11', '2020_11_10_102537_create_instruktur_table', '3'),
('12', '2020_11_10_102553_create_transaksi_table', '4');

INSERT INTO `pengunjung` (`id`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `jenis_kelamin`, `created_at`, `updated_at`) VALUES
('1', 'Beatae vel sed conse', 'Neque rem velit cons', '1998-09-28', 'Accusamus eveniet vo', 'Wanita', '2020-11-11 07:20:22', '2020-11-11 07:51:31'),
('2', 'Magnam sed exercitat', 'Quia repudiandae dol', '2007-06-21', 'Perspiciatis quas a', 'Wanita', '2020-11-11 07:34:28', '2020-11-11 07:34:28'),
('3', 'Veniam non corrupti asdasdasdasdas dasdas', 'Vitae fugiat exerci', '2016-11-04', 'Ex architecto illum', 'Pria', '2020-11-11 07:36:37', '2020-11-11 07:36:37'),
('4', 'Qui consectetur quo', 'Illo sint molestiae', '2015-12-01', 'Ducimus enim et ita', 'Wanita', '2020-11-11 07:53:11', '2020-11-11 07:53:11'),
('5', 'Ea irure in at duis', 'Animi est esse maxi', '2009-01-27', 'Nesciunt ad digniss', 'Wanita', '2020-11-11 07:53:15', '2020-11-11 07:53:15'),
('6', 'Sint totam velit dol', 'Reprehenderit qui pl', '1994-10-21', 'Vel mollit perspicia', 'Wanita', '2020-11-11 07:53:18', '2020-11-11 07:53:18'),
('7', 'Explicabo Sed labor', 'Autem voluptates qui', '2010-10-25', 'Nostrum recusandae', 'Pria', '2020-11-11 07:53:21', '2020-11-11 07:53:21'),
('8', 'Illo odit recusandae', 'Labore voluptate vol', '1972-12-20', 'Enim saepe eligendi', 'Pria', '2020-11-11 07:53:24', '2020-11-11 07:53:24'),
('9', 'Minim ad labore volu', 'Soluta aspernatur do', '2003-03-05', 'Ex dolorem nihil ill', 'Wanita', '2020-11-11 07:53:27', '2020-11-11 07:53:27'),
('10', 'Qui sed quibusdam co', 'Perferendis quis mol', '1980-10-19', 'Amet et asperiores', 'Wanita', '2020-11-11 07:53:31', '2020-11-11 07:53:31'),
('11', 'Voluptate amet illu', 'Culpa accusamus qui', '1978-03-08', 'Culpa facere enim c', 'Pria', '2020-11-11 07:53:34', '2020-11-11 07:53:34'),
('12', 'Culpa minus omnis s', 'Dolor ipsam tempore', '1985-02-23', 'Nulla cumque sed qua', 'Pria', '2020-11-11 07:53:38', '2020-11-11 07:53:38'),
('13', 'Et perspiciatis est', 'Sed natus et aute si', '1975-11-04', 'Consequatur Digniss', 'Pria', '2020-11-11 07:53:40', '2020-11-11 07:53:40'),
('14', 'Eius quia ipsum alia', 'Corporis exercitatio', '1995-09-11', 'Molestiae vel quia n', 'Pria', '2020-11-11 07:53:42', '2020-11-11 07:53:42'),
('15', 'Voluptatem molestia', 'Tempora quis dolor m', '1989-10-18', 'Lorem nisi qui perfe', 'Pria', '2020-11-11 07:53:47', '2020-11-11 07:53:47'),
('16', 'Nisi ut neque perspi', 'Nostrum sunt aliqua', '1998-09-28', 'Quia laudantium in', 'Pria', '2020-11-11 07:53:50', '2020-11-11 07:53:50'),
('17', 'Autem consequuntur n', 'Praesentium alias et', '1996-11-07', 'Commodi ea cumque al', 'Pria', '2020-11-11 07:53:55', '2020-11-11 07:53:55'),
('19', 'Firman Saut Simarmata', 'Sidikalang', '1990-02-20', 'JL sidikalang', 'Pria', '2020-11-11 09:13:14', '2020-11-11 09:13:14'),
('20', 'Cut Salsa', 'Tuntungan', '1999-07-01', 'JL Lap Golf', 'Wanita', '2020-11-22 09:53:30', '2020-11-22 09:53:30'),
('21', 'Fugit deserunt quam', 'Consequatur Expedit', '1973-07-12', 'Quisquam vel esse v', 'Pria', '2020-11-22 11:41:01', '2020-11-22 11:41:01'),
('22', 'Sunt temporibus est', 'Molestiae sed obcaec', '2004-01-12', 'Perferendis vel pari', 'Pria', '2020-12-12 12:19:35', '2020-12-12 12:19:35');

INSERT INTO `transaksi` (`id`, `kode_transaksi`, `pengunjung_id`, `total_harga`, `bayar`, `kembalian`, `created_at`, `updated_at`) VALUES
('1', 'TRM', '21', '100000', '100000', '0', '2020-12-12 09:52:52', '2020-12-12 09:52:52'),
('2', 'TRM', '21', '250000', '300000', '50000', '2020-12-12 10:18:57', '2020-12-12 10:18:57'),
('3', 'ABSEN', '1', '10000', '20000', '10000', '2020-12-12 10:27:58', '2020-12-12 10:27:58'),
('4', 'ABSEN', '2', '20000', '50000', '30000', '2020-12-12 10:29:05', '2020-12-12 10:29:05'),
('5', 'TRM', '22', '250000', '300000', '50000', '2020-12-12 12:19:49', '2020-12-12 12:19:49'),
('6', 'TRM', '3', '250000', '500000', '250000', '2020-12-12 12:23:30', '2020-12-12 12:23:30'),
('7', 'ABSEN', '4', '30000', '50000', '20000', '2020-12-12 12:24:59', '2020-12-12 12:24:59');

INSERT INTO `users` (`id`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
('1', 'Super Admin', 'admingym', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'NztS6vMMvnIhQgn2NcvvI8FOMCPdiVQPGPxXZF8WmEJ12TgW2oGGJGfGHIy3', '2020-11-11 07:20:13', '2020-11-11 07:20:13');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;