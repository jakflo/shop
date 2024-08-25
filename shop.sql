-- Adminer 4.8.1 MySQL 8.0.31 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `shop` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `shop`;

CREATE TABLE `dial_currency` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_0900_as_cs NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs;

INSERT INTO `dial_currency` (`id`, `name`) VALUES
(1,	'cz'),
(2,	'eur'),
(3,	'usd');

CREATE TABLE `dial_state` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_0900_as_cs NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs;

INSERT INTO `dial_state` (`id`, `name`) VALUES
(1,	'new'),
(2,	'paid'),
(3,	'finished'),
(4,	'canceled');

CREATE TABLE `item` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_0900_as_cs NOT NULL,
  `price` float NOT NULL,
  `dial_currency_id` int NOT NULL,
  `description` longtext COLLATE utf8mb4_0900_as_cs,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs;

INSERT INTO `item` (`id`, `name`, `price`, `dial_currency_id`, `description`) VALUES
(1,	'Asan Pet Silver 42 l',	529,	1,	'Podestýlka celulózová nehrudkující podestýlka s obsahem koloidního stříbra určena pro zakrslé králíky, hlodavce, krátkosrsté kočky, fretky a jiné domácí mazlíčky'),
(2,	'Darwin\'s Morče a králík Special 2,7 kg',	209,	1,	'Krmivo pro králíky vhodné pro králíka, morče a zakrslého králíka, krmná směs, obsahuje Vitamín E, Vitamín A a Vitamín D '),
(3,	'Nutrin Nature Teeth & Hair 50 g',	67,	1,	'Doplněk stravy pro hlodavce vhodné pro činčilu, králíka, křečka, morče, myš, potkana a osmáka, bylinky '),
(4,	'PanMalina Seno luční classic 4,5 kg',	299,	1,	'Krmivo pro hlodavce vhodné pro králíka, morče, osmáka a zakrslého králíka, seno, 12% bílkovin, 35% vlákniny ');

CREATE TABLE `order` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `price` float unsigned NOT NULL,
  `dial_currency_id` int unsigned NOT NULL,
  `created` datetime NOT NULL,
  `note` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs,
  `dial_state_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs;

INSERT INTO `order` (`id`, `user_id`, `price`, `dial_currency_id`, `created`, `note`, `dial_state_id`) VALUES
(1,	1,	529,	1,	'2024-08-25 12:40:00',	NULL,	1),
(2,	3,	433,	1,	'2024-08-25 12:45:00',	NULL,	2),
(3,	2,	41.38,	2,	'2024-08-25 12:50:00',	NULL,	3);

CREATE TABLE `order_has_item` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int unsigned NOT NULL,
  `item_id` int unsigned NOT NULL,
  `item_amount` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_as_cs;

INSERT INTO `order_has_item` (`id`, `order_id`, `item_id`, `item_amount`) VALUES
(1,	1,	1,	1),
(2,	2,	4,	1),
(3,	2,	3,	2),
(4,	3,	1,	1),
(5,	3,	2,	1),
(6,	3,	4,	1);

-- 2024-08-25 22:34:09
