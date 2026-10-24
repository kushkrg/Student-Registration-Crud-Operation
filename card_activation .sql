-- Student Registration CRUD Operation in PHP + MySQL
-- Database: `user` | Table: `card_activation`
-- Updated clean schema (2026): same database, table and column names as the
-- original version, so existing installs keep working.
-- Changes vs the old dump:
--   * Primary key + AUTO_INCREMENT declared in CREATE TABLE (the old dump
--     relied on later ALTER statements)
--   * Removed the unused `file` longblob column - NOT NULL with no default,
--     it made INSERTs fail on strict-mode MySQL/MariaDB
--   * `u_state` widened 12 -> 50 chars (the old width silently truncated
--     state names, e.g. "Himachal Pra" in the old data)
--   * `u_birthday` is now a real DATE column
--   * NO data rows are included - the old dump shipped personal/test data.
--     Never commit personal data to GitHub.
-- Note: the original file name has a space ("card_activation .sql") - it is
-- kept so existing links/bookmarks to it keep working. You can safely rename
-- it locally to card_activation.sql if you prefer.

CREATE DATABASE IF NOT EXISTS `user` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `user`;

CREATE TABLE IF NOT EXISTS `card_activation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_card` varchar(12) NOT NULL,
  `u_f_name` varchar(100) NOT NULL,
  `u_l_name` varchar(100) DEFAULT NULL,
  `u_father` varchar(100) DEFAULT NULL,
  `u_mother` varchar(100) DEFAULT NULL,
  `u_aadhar` varchar(12) DEFAULT NULL,
  `u_birthday` date DEFAULT NULL,
  `u_gender` varchar(10) DEFAULT NULL,
  `u_email` varchar(150) NOT NULL,
  `u_phone` varchar(15) NOT NULL,
  `u_state` varchar(50) DEFAULT NULL,
  `u_dist` varchar(100) DEFAULT NULL,
  `u_village` varchar(100) DEFAULT NULL,
  `u_police` varchar(100) DEFAULT NULL,
  `u_pincode` varchar(6) DEFAULT NULL,
  `u_family` varchar(50) DEFAULT NULL,
  `staff_id` varchar(12) DEFAULT NULL,
  `image` varchar(150) DEFAULT NULL,
  `uploaded` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `u_card_idx` (`u_card`),
  KEY `u_email_idx` (`u_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
