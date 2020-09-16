-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping data for table boards.boards: ~7 rows (approximately)
/*!40000 ALTER TABLE `boards` DISABLE KEYS */;
INSERT INTO `boards` (`id`, `boardCode`, `size`, `type`, `location`, `locationType`, `price`, `campaign_name`) VALUES
	(1, 100, '10 x 20', 'Megaboard', 'Obilicev Venac', 'Throughway', 150, 'sasafraz'),
	(2, 101, '10 x 30', 'Bigboard', 'Njegoseva', 'Throughway', 180, 'sasafraz'),
	(3, 102, '10 x 15', 'Cityboard', 'Knez Mihajlova', 'Walkway', 120, 'sasafraz'),
	(4, 103, '10 x 20', 'Megaboard', 'Visnjicka', 'Highway', 150, NULL),
	(5, 104, '10 x 15', 'Cityboard', 'Kaludjerica', 'Highway', 120, NULL),
	(6, 105, '10 x 30', 'Bigboard', 'Kneza Milosa', 'Walkway', 180, NULL),
	(7, 106, '10 x 20', 'Megaboard', 'Dusanovac', 'Highway', 150, NULL),
	(8, 107, '10 x 30', 'Bigboard', 'Vasina', 'Throughway', 180, NULL);
/*!40000 ALTER TABLE `boards` ENABLE KEYS */;

-- Dumping data for table boards.bookings: ~4 rows (approximately)
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` (`id`, `startDate`, `endDate`, `users_name`, `campaigns_id`) VALUES
	(1, '2020-09-10', '2020-09-17', 'Admin', 3),
	(2, '2020-09-10', '2020-09-17', 'Admin', 3),
	(3, '2020-09-10', '2020-09-17', 'Admin', 3);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;

-- Dumping data for table boards.campaigns: ~2 rows (approximately)
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
INSERT INTO `campaigns` (`id`, `totalBoards`, `totalPrice`, `name`, `startDate`, `endDate`) VALUES
	(3, 3, 450, 'sasafraz', '2020-09-10', '2020-09-17');
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;

-- Dumping data for table boards.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
	(1, 'Admin', 'admin@admin.com', 'admin123');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
