-- Adminer 4.8.4 MySQL 8.0.39-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `contains`;
CREATE TABLE `contains` (
  `workout_id` int NOT NULL,
  `exercise_id` int NOT NULL,
  PRIMARY KEY (`workout_id`,`exercise_id`),
  KEY `exercise_id` (`exercise_id`),
  CONSTRAINT `contains_ibfk_1` FOREIGN KEY (`workout_id`) REFERENCES `workouts` (`id`),
  CONSTRAINT `contains_ibfk_3` FOREIGN KEY (`exercise_id`) REFERENCES `exercise` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `contains` (`workout_id`, `exercise_id`) VALUES
(3,	2),
(4,	2),
(3,	11),
(4,	12);

DROP TABLE IF EXISTS `date_and_time`;
CREATE TABLE `date_and_time` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `workout` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `workout` (`workout`),
  CONSTRAINT `date_and_time_ibfk_1` FOREIGN KEY (`workout`) REFERENCES `workouts` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `date_and_time` (`id`, `date`, `time`, `workout`) VALUES
(30,	'2024-09-06',	'16:43:00',	32),
(31,	'2024-09-06',	'02:34:00',	3);

DROP TABLE IF EXISTS `exercise`;
CREATE TABLE `exercise` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(10000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sets` int NOT NULL,
  `reps` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `exercise` (`id`, `name`, `description`, `sets`, `reps`) VALUES
(2,	'Bent over rows',	'To perform bent over rows, stand with your feet shoulder-width apart and bend at the waist while keeping your back straight and knees slightly bent. Grip the barbell with your palms facing down, pull it towards your lower chest, squeezing your shoulder blades together, then slowly lower it back to the starting position, maintaining control throughout the movement.',	3,	10),
(11,	'Lat pull downs',	'To perform lat pull downs, sit at a lat pull-down machine and grasp the bar with a wide overhand grip. Pull the bar down towards your upper chest, squeezing your shoulder blades together, then slowly release it back up to the starting position, maintaining a controlled motion throughout.',	3,	10),
(12,	'Cross Body Pull Downs',	'To perform cross body pull downs, stand next to a cable machine with the handle set at the highest position. Grasp the handle with one hand, extend your arm overhead and across your body, then pull the handle down diagonally across your chest towards your opposite hip, maintaining a controlled motion and engaging your core throughout the movement.',	3,	10),
(30,	'Bench Press',	'To perform a bench press, lie flat on your back on a bench with your feet firmly on the ground and your eyes aligned under the barbell. Grip the bar slightly wider than shoulder-width, lift it off the rack, lower it slowly to your chest, then push it back up until your arms are fully extended, keeping your core tight and maintaining a controlled motion throughout.',	3,	10);

DROP TABLE IF EXISTS `workouts`;
CREATE TABLE `workouts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`(4))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `workouts` (`id`, `name`) VALUES
(3,	'Chest'),
(4,	'Back'),
(32,	'Legs');

-- 2024-09-01 22:51:11
