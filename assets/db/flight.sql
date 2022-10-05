-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           5.7.33 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour flight_db
CREATE DATABASE IF NOT EXISTS `flight_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `flight_db`;

-- Listage de la structure de la table flight_db. ph_airlines
CREATE TABLE IF NOT EXISTS `ph_airlines` (
  `airline_id` int(11) NOT NULL AUTO_INCREMENT,
  `airline_name` varchar(50) NOT NULL,
  `airline_description` text,
  `airline_picture` varchar(50) NOT NULL,
  `airline_contact_number` varchar(50) DEFAULT NULL,
  `airline_email` varchar(50) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`airline_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table flight_db. ph_airports
CREATE TABLE IF NOT EXISTS `ph_airports` (
  `airport_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_id` int(11) NOT NULL,
  `airport_name` varchar(50) NOT NULL,
  PRIMARY KEY (`airport_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table flight_db. ph_bookings
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table flight_db. ph_cities
CREATE TABLE IF NOT EXISTS `ph_cities` (
  `city_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(250) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '0',
  `city_picture` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table flight_db. ph_countries
CREATE TABLE IF NOT EXISTS `ph_countries` (
  `ctry_id` int(11) NOT NULL AUTO_INCREMENT,
  `ctry_phone` int(5) NOT NULL,
  `ctry_code` char(2) NOT NULL,
  `ctry_name` varchar(80) NOT NULL,
  `ctry_capital` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`ctry_id`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table flight_db. ph_payments
CREATE TABLE IF NOT EXISTS `ph_payments` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_code` varchar(100) NOT NULL,
  `bo_id` int(11) NOT NULL,
  `pay_amount` decimal(10,0) NOT NULL,
  `pay_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table flight_db. ph_trajets
CREATE TABLE IF NOT EXISTS `ph_trajets` (
  `trajet_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_from_id` int(11) NOT NULL,
  `city_to_id` int(11) NOT NULL,
  PRIMARY KEY (`trajet_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COMMENT='Table qui contient les trajet sur lequel la scociété d''aviation tourne';

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table flight_db. ph_trips
CREATE TABLE IF NOT EXISTS `ph_trips` (
  `trip_id` int(11) NOT NULL AUTO_INCREMENT,
  `city_from_id` int(11) NOT NULL,
  `city_to_id` int(11) NOT NULL,
  `depart_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `duration` varchar(50) NOT NULL,
  `fixed_price_premium_class` varchar(50) NOT NULL,
  `fixed_price_economic_price` varchar(50) NOT NULL,
  `fixed_price_business_class` varchar(50) NOT NULL,
  `fixed_price_first_class` varchar(50) NOT NULL,
  `take_off` varchar(50) DEFAULT NULL,
  `landing` varchar(50) DEFAULT NULL,
  `total_time` varchar(50) DEFAULT NULL,
  `airline_id` varchar(50) DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `trip_categorie` enum('One way','Round') DEFAULT NULL,
  `nb_stop` int(11) DEFAULT NULL,
  `trip_status` varchar(50) NOT NULL DEFAULT '1',
  `conditions` text NOT NULL,
  PRIMARY KEY (`trip_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table flight_db. ph_users
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Les données exportées n'étaient pas sélectionnées.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
