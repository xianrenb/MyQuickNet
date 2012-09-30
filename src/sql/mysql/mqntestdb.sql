SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `table_a`;
CREATE TABLE `table_a` (
  `id` int(11) NOT NULL,
  `valid` tinyint(4) NOT NULL,
  `my_a` int(11) NOT NULL,
  `my_x` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `valid` (`valid`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `table_a` (`id`, `valid`, `my_a`, `my_x`) VALUES
(1, 0, 0, 0),
(2, 0, 1, 1),
(3, 0, 2, 2),
(4, 0, 3, 3),
(5, 0, 4, 4),
(6, 0, 5, 5),
(7, 0, 6, 6),
(8, 0, 7, 7),
(9, 0, 8, 8),
(10, 0, 9, 9);

DROP TABLE IF EXISTS `table_b`;
CREATE TABLE `table_b` (
  `id` int(11) NOT NULL,
  `valid` tinyint(4) NOT NULL,
  `my_b` int(11) NOT NULL,
  `my_x` int(11) NOT NULL,
  `my_y` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `valid` (`valid`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `table_b` (`id`, `valid`, `my_b`, `my_x`, `my_y`) VALUES
(1, 0, 1, 2, 3),
(2, 0, 2, 3, 4),
(3, 0, 3, 4, 5),
(4, 0, 4, 5, 6),
(5, 0, 5, 6, 7),
(6, 0, 6, 7, 8),
(7, 0, 7, 8, 9),
(8, 0, 8, 9, 10),
(9, 0, 9, 10, 11),
(10, 0, 10, 11, 12);

DROP TABLE IF EXISTS `table_c`;
CREATE TABLE `table_c` (
  `id` int(11) NOT NULL,
  `valid` tinyint(4) NOT NULL,
  `my_c` int(11) NOT NULL,
  `my_y` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `valid` (`valid`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `table_c` (`id`, `valid`, `my_c`, `my_y`) VALUES
(1, 0, 2, 4),
(2, 0, 3, 5),
(3, 0, 4, 6),
(4, 0, 5, 7),
(5, 0, 6, 8),
(6, 0, 7, 9),
(7, 0, 8, 10),
(8, 0, 9, 11),
(9, 0, 10, 12),
(10, 0, 11, 13);

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `data` int(11) NOT NULL,
  KEY `data` (`data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

DROP TABLE IF EXISTS `testing_auto_record`;
CREATE TABLE `testing_auto_record` (
  `id` int(11) NOT NULL,
  `valid` tinyint(4) NOT NULL,
  `my_a` tinyint(4) NOT NULL,
  `my_b` float NOT NULL,
  `my_c` int(11) NOT NULL,
  `my_d` varchar(255) COLLATE utf8_bin NOT NULL,
  `my_e` int(11) NOT NULL,
  `my_blob` tinyblob NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `valid` (`valid`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `testing_auto_record` (`id`, `valid`, `my_a`, `my_b`, `my_c`, `my_d`, `my_e`, `my_blob`) VALUES
(1, 0, 1, 2.2, 3, 'string', 0, 0x626c6f62),
(2, 0, 0, 1.1, 2, 'abc', 1, 0x6e657720626c6f62);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
