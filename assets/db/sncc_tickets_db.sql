-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Listage de la structure de la table sncc_tickets_db. ph_airlines
CREATE TABLE IF NOT EXISTS `ph_airlines` (
  `airline_id` int(11) NOT NULL AUTO_INCREMENT,
  `airline_name` varchar(50) NOT NULL,
  `airline_description` text,
  `airline_picture` varchar(50) NOT NULL,
  `airline_contact_number` varchar(50) DEFAULT NULL,
  `airline_email` varchar(50) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`airline_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Listage des données de la table sncc_tickets_db.ph_airlines : ~2 rows (environ)
/*!40000 ALTER TABLE `ph_airlines` DISABLE KEYS */;
INSERT INTO `ph_airlines` (`airline_id`, `airline_name`, `airline_description`, `airline_picture`, `airline_contact_number`, `airline_email`, `country_id`) VALUES
	(5, 'Train Cinquantainaire', 'Train cinquantenaire', 'default.jpg', '09338393', 'cinq@sncc.cd', 1),
	(6, 'Nouveau train', 'Nouveau ', 'default.jpg', '09338393', 'cinq@sncc.cd', 1);
/*!40000 ALTER TABLE `ph_airlines` ENABLE KEYS */;

-- Listage de la structure de la table sncc_tickets_db. ph_airports
CREATE TABLE IF NOT EXISTS `ph_airports` (
  `airport_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `airport_name` varchar(50) NOT NULL,
  PRIMARY KEY (`airport_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table sncc_tickets_db.ph_airports : ~0 rows (environ)
/*!40000 ALTER TABLE `ph_airports` DISABLE KEYS */;
/*!40000 ALTER TABLE `ph_airports` ENABLE KEYS */;

-- Listage de la structure de la table sncc_tickets_db. ph_bookings
CREATE TABLE IF NOT EXISTS `ph_bookings` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `booking_date` datetime NOT NULL,
  `bk_nb_adult` int(11) NOT NULL,
  `bk_nb_child` int(11) NOT NULL,
  `bk_nb_infant` int(11) NOT NULL,
  `bk_caoch` varchar(50) NOT NULL,
  `bk_taxe` varchar(50) NOT NULL,
  `bk_fee` varchar(50) NOT NULL,
  `base_amount` varchar(50) NOT NULL,
  `bk_total_amount` varchar(50) NOT NULL,
  `transaction_mode` varchar(50) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `bk_status` enum('process','cancel','confirm') NOT NULL DEFAULT 'process',
  `bk_token` varchar(250) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Listage des données de la table sncc_tickets_db.ph_bookings : ~0 rows (environ)
/*!40000 ALTER TABLE `ph_bookings` DISABLE KEYS */;
INSERT INTO `ph_bookings` (`booking_id`, `trip_id`, `user_id`, `booking_date`, `bk_nb_adult`, `bk_nb_child`, `bk_nb_infant`, `bk_caoch`, `bk_taxe`, `bk_fee`, `base_amount`, `bk_total_amount`, `transaction_mode`, `transaction_id`, `bk_status`, `bk_token`) VALUES
	(10, 8, 4, '2022-10-04 22:04:17', 1, 2, 2, '1', '0', '0', '0', '', 'mobile money', 'Trans.ID:CO210806.1848.C18716', 'confirm', 'SNCC382595PINCD'),
	(11, 9, 5, '2022-10-05 11:45:53', 1, 2, 0, '1', '0', '0', '0', '', 'mobile money', 'Trans.ID:CO210806.1848.C18716', 'process', 'SNCC711785PINCD');
/*!40000 ALTER TABLE `ph_bookings` ENABLE KEYS */;

-- Listage de la structure de la table sncc_tickets_db. ph_cities
CREATE TABLE IF NOT EXISTS `ph_cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(250) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `city_picture` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Listage des données de la table sncc_tickets_db.ph_cities : ~6 rows (environ)
/*!40000 ALTER TABLE `ph_cities` DISABLE KEYS */;
INSERT INTO `ph_cities` (`city_id`, `city_name`, `country_id`, `city_picture`) VALUES
	(1, 'Lubumbashi', 1, NULL),
	(2, 'Mbuji-mayi', 1, NULL),
	(10, 'Kananga', 1, NULL),
	(11, 'Kinshasa', 1, NULL),
	(12, 'Likasi', 1, NULL),
	(13, 'Kolwezi', 1, NULL),
	(14, 'Kamina', 1, NULL);
/*!40000 ALTER TABLE `ph_cities` ENABLE KEYS */;

-- Listage de la structure de la table sncc_tickets_db. ph_countries
CREATE TABLE IF NOT EXISTS `ph_countries` (
  `ctry_id` int(11) NOT NULL AUTO_INCREMENT,
  `ctry_phone` int(5) NOT NULL,
  `ctry_code` char(2) NOT NULL,
  `ctry_name` varchar(80) NOT NULL,
  `ctry_capital` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`ctry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Listage des données de la table sncc_tickets_db.ph_countries : ~0 rows (environ)
/*!40000 ALTER TABLE `ph_countries` DISABLE KEYS */;
INSERT INTO `ph_countries` (`ctry_id`, `ctry_phone`, `ctry_code`, `ctry_name`, `ctry_capital`) VALUES
	(1, 243, '1', 'RDC', 'Kinshasa');
/*!40000 ALTER TABLE `ph_countries` ENABLE KEYS */;

-- Listage de la structure de la table sncc_tickets_db. ph_payments
CREATE TABLE IF NOT EXISTS `ph_payments` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_code` varchar(100) NOT NULL,
  `bo_id` int(11) NOT NULL,
  `pay_amount` decimal(10,0) NOT NULL,
  `pay_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table sncc_tickets_db.ph_payments : ~0 rows (environ)
/*!40000 ALTER TABLE `ph_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `ph_payments` ENABLE KEYS */;

-- Listage de la structure de la table sncc_tickets_db. ph_trajets
CREATE TABLE IF NOT EXISTS `ph_trajets` (
  `trajet_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_from_id` int(11) NOT NULL,
  `city_to_id` int(11) NOT NULL,
  PRIMARY KEY (`trajet_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Table qui contient les trajet sur lequel la scociété d''aviation tourne';

-- Listage des données de la table sncc_tickets_db.ph_trajets : ~4 rows (environ)
/*!40000 ALTER TABLE `ph_trajets` DISABLE KEYS */;
INSERT INTO `ph_trajets` (`trajet_id`, `city_from_id`, `city_to_id`) VALUES
	(1, 1, 2),
	(2, 1, 3),
	(3, 2, 1),
	(4, 3, 2);
/*!40000 ALTER TABLE `ph_trajets` ENABLE KEYS */;

-- Listage de la structure de la table sncc_tickets_db. ph_trips
CREATE TABLE IF NOT EXISTS `ph_trips` (
  `trip_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_from_id` int(11) NOT NULL,
  `city_to_id` int(11) NOT NULL,
  `depart_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `fixed_price_premium_class` varchar(50) DEFAULT NULL,
  `fixed_price_economic_price` varchar(50) DEFAULT NULL,
  `fixed_price_business_class` varchar(50) DEFAULT NULL,
  `fixed_price_first_class` varchar(50) DEFAULT NULL,
  `take_off` varchar(50) DEFAULT NULL,
  `landing` varchar(50) DEFAULT NULL,
  `total_time` varchar(50) DEFAULT NULL,
  `airline_id` varchar(50) DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `trip_categorie` enum('One way','Round') DEFAULT NULL,
  `nb_stop` int(11) DEFAULT NULL,
  `trip_status` varchar(50) DEFAULT '1',
  `conditions` text,
  `start_depart` text,
  `price_by_place` text,
  `place_numbers` text,
  PRIMARY KEY (`trip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Listage des données de la table sncc_tickets_db.ph_trips : ~3 rows (environ)
/*!40000 ALTER TABLE `ph_trips` DISABLE KEYS */;
INSERT INTO `ph_trips` (`trip_id`, `city_from_id`, `city_to_id`, `depart_date`, `return_date`, `duration`, `fixed_price_premium_class`, `fixed_price_economic_price`, `fixed_price_business_class`, `fixed_price_first_class`, `take_off`, `landing`, `total_time`, `airline_id`, `arrival_date`, `trip_categorie`, `nb_stop`, `trip_status`, `conditions`, `start_depart`, `price_by_place`, `place_numbers`) VALUES
	(8, 1, 1, '2022-10-04', '2022-10-04', '2', '200', '300', '400', '500', '0', '0', '2', '5', '2022-10-04', 'One way', NULL, '1', 'not', NULL, NULL, NULL),
	(9, 10, 11, '2022-10-20', NULL, NULL, NULL, NULL, NULL, NULL, '8:12 AM', NULL, NULL, '6', NULL, NULL, NULL, '1', NULL, 'Lubumnbashi gare', '20', '200'),
	(10, 13, 10, '2022-10-28', NULL, NULL, NULL, NULL, NULL, NULL, '14:00 PM', NULL, NULL, '5', NULL, NULL, NULL, '1', NULL, 'Likasi centre ville', '10', '1500');
/*!40000 ALTER TABLE `ph_trips` ENABLE KEYS */;

-- Listage de la structure de la table sncc_tickets_db. ph_users
CREATE TABLE IF NOT EXISTS `ph_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `user_picture` varchar(100) NOT NULL DEFAULT 'default-profile-picture-avatar-png-green.jpg',
  `last_name` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `user_pwd` varchar(100) NOT NULL,
  `user_role` varchar(100) NOT NULL,
  `user_created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_status` int(11) NOT NULL DEFAULT '1',
  `home_airport` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table sncc_tickets_db.ph_users : ~2 rows (environ)
/*!40000 ALTER TABLE `ph_users` DISABLE KEYS */;
INSERT INTO `ph_users` (`user_id`, `user_email`, `first_name`, `user_picture`, `last_name`, `phone_number`, `user_pwd`, `user_role`, `user_created_at`, `user_status`, `home_airport`) VALUES
	(4, 'erickbanze@gmail.com', 'Erick', 'default-profile-picture-avatar-png-green.jpg', 'Banze', '098393383', '$2y$10$crgua7g.QyX32MnxlAFRXOxp1IiqGc8q3wf6/wc6Gel1DYf3TJlJK', 'traveller', '2022-10-04 16:53:54', 1, NULL),
	(5, 'erickbanze4@gmail.com', 'Ngoy', 'default-profile-picture-avatar-png-green.jpg', 'Ilunga', '903939393', '$2y$10$BFSPHMybpVXyzUU/t5ZxpuyQcGf6sF934qARS2O5Cs7ppfWZTp4Gu', 'traveller', '2022-10-04 17:04:22', 1, NULL),
	(6, 'gloriamuhemba@gmail.com', 'Gloria', 'default-profile-picture-avatar-png-green.jpg', 'Muhemba', '03939393', '$2y$10$uAIUBffJltDelI/lgaieJeuk7VZjafhETV6XB2w5sf8EmJWFB0g2C', 'admin', '2022-10-04 17:36:26', 1, NULL);
/*!40000 ALTER TABLE `ph_users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
