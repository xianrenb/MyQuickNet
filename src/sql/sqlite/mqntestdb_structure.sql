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


DROP TABLE IF EXISTS `table_a`;
CREATE TABLE "table_a" (
  "id" int(11) NOT NULL,
  "valid" tinyint(4) NOT NULL,
  "my_a" int(11) NOT NULL,
  "my_x" int(11) NOT NULL,
  PRIMARY KEY ("id"),
  UNIQUE /* KEY "valid" */ ("valid","id")
);

DROP TABLE IF EXISTS `table_b`;
CREATE TABLE "table_b" (
  "id" int(11) NOT NULL,
  "valid" tinyint(4) NOT NULL,
  "my_b" int(11) NOT NULL,
  "my_x" int(11) NOT NULL,
  "my_y" int(11) NOT NULL,
  PRIMARY KEY ("id"),
  UNIQUE /* KEY "valid" */ ("valid","id")
);

DROP TABLE IF EXISTS `table_c`;
CREATE TABLE "table_c" (
  "id" int(11) NOT NULL,
  "valid" tinyint(4) NOT NULL,
  "my_c" int(11) NOT NULL,
  "my_y" int(11) NOT NULL,
  PRIMARY KEY ("id"),
  UNIQUE /* KEY "valid" */ ("valid","id")
);

DROP TABLE IF EXISTS `test`;
CREATE TABLE "test" (
  "data" int(11) NOT NULL
  /* KEY "data" ("data") */
);

DROP TABLE IF EXISTS `testing_auto_record`;
CREATE TABLE "testing_auto_record" (
  "id" int(11) NOT NULL,
  "valid" tinyint(4) NOT NULL,
  "my_a" tinyint(4) NOT NULL,
  "my_b" float NOT NULL,
  "my_c" int(11) NOT NULL,
  "my_d" varchar(255) /* COLLATE utf8_bin */ NOT NULL,
  "my_e" int(11) NOT NULL,
  PRIMARY KEY ("id"),
  UNIQUE /* KEY "valid" */ ("valid","id")
);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
