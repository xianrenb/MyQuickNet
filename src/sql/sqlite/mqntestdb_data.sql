/*
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zone = "+00:00";
*/
BEGIN EXCLUSIVE;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


INSERT INTO `table_a` (`id`, `valid`, `my_a`, `my_x`) VALUES(1, 0, 0, 0);
INSERT INTO `table_a` (`id`, `valid`, `my_a`, `my_x`) VALUES(2, 0, 1, 1);
INSERT INTO `table_a` (`id`, `valid`, `my_a`, `my_x`) VALUES(3, 0, 2, 2);
INSERT INTO `table_a` (`id`, `valid`, `my_a`, `my_x`) VALUES(4, 0, 3, 3);
INSERT INTO `table_a` (`id`, `valid`, `my_a`, `my_x`) VALUES(5, 0, 4, 4);
INSERT INTO `table_a` (`id`, `valid`, `my_a`, `my_x`) VALUES(6, 0, 5, 5);
INSERT INTO `table_a` (`id`, `valid`, `my_a`, `my_x`) VALUES(7, 0, 6, 6);
INSERT INTO `table_a` (`id`, `valid`, `my_a`, `my_x`) VALUES(8, 0, 7, 7);
INSERT INTO `table_a` (`id`, `valid`, `my_a`, `my_x`) VALUES(9, 0, 8, 8);
INSERT INTO `table_a` (`id`, `valid`, `my_a`, `my_x`) VALUES(10, 0, 9, 9);

INSERT INTO `table_b` (`id`, `valid`, `my_b`, `my_x`, `my_y`) VALUES(1, 0, 1, 2, 3);
INSERT INTO `table_b` (`id`, `valid`, `my_b`, `my_x`, `my_y`) VALUES(2, 0, 2, 3, 4);
INSERT INTO `table_b` (`id`, `valid`, `my_b`, `my_x`, `my_y`) VALUES(3, 0, 3, 4, 5);
INSERT INTO `table_b` (`id`, `valid`, `my_b`, `my_x`, `my_y`) VALUES(4, 0, 4, 5, 6);
INSERT INTO `table_b` (`id`, `valid`, `my_b`, `my_x`, `my_y`) VALUES(5, 0, 5, 6, 7);
INSERT INTO `table_b` (`id`, `valid`, `my_b`, `my_x`, `my_y`) VALUES(6, 0, 6, 7, 8);
INSERT INTO `table_b` (`id`, `valid`, `my_b`, `my_x`, `my_y`) VALUES(7, 0, 7, 8, 9);
INSERT INTO `table_b` (`id`, `valid`, `my_b`, `my_x`, `my_y`) VALUES(8, 0, 8, 9, 10);
INSERT INTO `table_b` (`id`, `valid`, `my_b`, `my_x`, `my_y`) VALUES(9, 0, 9, 10, 11);
INSERT INTO `table_b` (`id`, `valid`, `my_b`, `my_x`, `my_y`) VALUES(10, 0, 10, 11, 12);

INSERT INTO `table_c` (`id`, `valid`, `my_c`, `my_y`) VALUES(1, 0, 2, 4);
INSERT INTO `table_c` (`id`, `valid`, `my_c`, `my_y`) VALUES(2, 0, 3, 5);
INSERT INTO `table_c` (`id`, `valid`, `my_c`, `my_y`) VALUES(3, 0, 4, 6);
INSERT INTO `table_c` (`id`, `valid`, `my_c`, `my_y`) VALUES(4, 0, 5, 7);
INSERT INTO `table_c` (`id`, `valid`, `my_c`, `my_y`) VALUES(5, 0, 6, 8);
INSERT INTO `table_c` (`id`, `valid`, `my_c`, `my_y`) VALUES(6, 0, 7, 9);
INSERT INTO `table_c` (`id`, `valid`, `my_c`, `my_y`) VALUES(7, 0, 8, 10);
INSERT INTO `table_c` (`id`, `valid`, `my_c`, `my_y`) VALUES(8, 0, 9, 11);
INSERT INTO `table_c` (`id`, `valid`, `my_c`, `my_y`) VALUES(9, 0, 10, 12);
INSERT INTO `table_c` (`id`, `valid`, `my_c`, `my_y`) VALUES(10, 0, 11, 13);

INSERT INTO `testing_auto_record` (`id`, `valid`, `my_a`, `my_b`, `my_c`, `my_d`, `my_e`, `my_blob`) VALUES(1, 0, 1, 2.2, 3, 'string', 0, /* 0x626c6f62 */ x'626c6f62');
INSERT INTO `testing_auto_record` (`id`, `valid`, `my_a`, `my_b`, `my_c`, `my_d`, `my_e`, `my_blob`) VALUES(2, 0, 0, 1.1, 2, 'abc', 1, /* 0x6e657720626c6f62 */ x'6e657720626c6f62');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
