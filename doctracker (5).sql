-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2019 at 06:11 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doctracker`
--
CREATE DATABASE IF NOT EXISTS `doctracker` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `doctracker`;

-- --------------------------------------------------------

--
-- Table structure for table `asset_category`
--

DROP TABLE IF EXISTS `asset_category`;
CREATE TABLE IF NOT EXISTS `asset_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `asset_purchase`
--

DROP TABLE IF EXISTS `asset_purchase`;
CREATE TABLE IF NOT EXISTS `asset_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ro_id` int(11) NOT NULL,
  `asset_category_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `members_of_purchase_committee` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `file_purchase_request_apporval` varchar(100) DEFAULT NULL,
  `file_quotation` varchar(100) DEFAULT NULL,
  `file_purchase_commite` varchar(100) DEFAULT NULL,
  `file_purchase_order` varchar(100) DEFAULT NULL,
  `file_pro_forma_final_invoice` varchar(100) DEFAULT NULL,
  `natural_head` varchar(255) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `funding_agency_id` int(11) DEFAULT NULL,
  `funding_agency_bu_id` int(11) DEFAULT NULL,
  `cost_centre_id` int(11) DEFAULT NULL,
  `cost_centre_sub_id` int(11) DEFAULT NULL,
  `lo` varchar(100) DEFAULT NULL,
  `ho_comment` varchar(255) DEFAULT NULL,
  `ref_number` varchar(100) DEFAULT NULL,
  `ref_date` date DEFAULT NULL,
  `ac_comment` text,
  `status` int(11) DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `asset_category_id` (`asset_category_id`) USING BTREE,
  KEY `vendor_id` (`vendor_id`) USING BTREE,
  KEY `project_id` (`project_id`) USING BTREE,
  KEY `ro_id` (`ro_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `program_id` (`program_id`) USING BTREE,
  KEY `funding_agency_id` (`funding_agency_id`) USING BTREE,
  KEY `funding_agency_bu_id` (`funding_agency_bu_id`) USING BTREE,
  KEY `cost_centre_id` (`cost_centre_id`) USING BTREE,
  KEY `cost_centre_sub_id` (`cost_centre_sub_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `claim_request`
--

DROP TABLE IF EXISTS `claim_request`;
CREATE TABLE IF NOT EXISTS `claim_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT 'Employee Code',
  `state_id` int(9) NOT NULL COMMENT 'Level Id',
  `request_type` varchar(30) DEFAULT NULL,
  `visit_from` varchar(100) NOT NULL COMMENT 'Visit From',
  `visit_to` varchar(100) NOT NULL COMMENT 'Visit To',
  `mode` varchar(100) NOT NULL COMMENT 'Mode',
  `date` varchar(50) NOT NULL DEFAULT '',
  `amount` decimal(10,0) NOT NULL,
  `amount2` decimal(10,0) NOT NULL COMMENT 'Fare',
  `amount3` decimal(10,0) NOT NULL COMMENT 'Hotel Expenses',
  `amount4` decimal(10,0) NOT NULL COMMENT 'Food',
  `amount5` decimal(10,0) NOT NULL COMMENT 'Miscellaneous',
  `amountinword` varchar(150) NOT NULL COMMENT 'Amount In Words',
  `purpose` varchar(100) DEFAULT NULL,
  `dc` varchar(50) DEFAULT NULL,
  `fund_agency` varchar(100) DEFAULT NULL COMMENT 'Funding Agency',
  `nature_service` varchar(100) DEFAULT NULL COMMENT 'Nature of Services ',
  `ro_comment` varchar(255) DEFAULT NULL COMMENT 'Ro Comment',
  `naturehead` varchar(100) DEFAULT NULL COMMENT 'Natural Head',
  `project_id` int(11) DEFAULT NULL,
  `project_budget_line_id` int(11) DEFAULT NULL,
  `costcenter_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `locationdescription_id` int(11) DEFAULT NULL,
  `ho_comment` varchar(255) DEFAULT NULL,
  `tds` decimal(10,0) DEFAULT NULL,
  `advance` decimal(10,0) DEFAULT NULL,
  `net` decimal(10,0) DEFAULT NULL,
  `refnumber` varchar(30) DEFAULT NULL,
  `refdate` varchar(50) DEFAULT NULL,
  `ac_comment` varchar(255) DEFAULT NULL COMMENT 'Account Comment',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `project_id` (`project_id`) USING BTREE,
  KEY `project_budget_line_id` (`project_budget_line_id`) USING BTREE,
  KEY `request1_ibfk_4` (`costcenter_id`) USING BTREE,
  KEY `program_id` (`program_id`) USING BTREE,
  KEY `locationdescription_id` (`locationdescription_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Triggers `claim_request`
--
DROP TRIGGER IF EXISTS `COMMENTlog2`;
DELIMITER $$
CREATE TRIGGER `COMMENTlog2` BEFORE UPDATE ON `claim_request` FOR EACH ROW BEGIN
IF (NEW.ho_comment != OLD.ho_comment) THEN

  INSERT INTO `comment_log` set request_id= NEW.`id`, comment_by=3,`comment`=OLD.ho_comment,update_at=old.`update_at`;
 
END IF;

IF (NEW.ro_comment != OLD.ro_comment) THEN
INSERT INTO `comment_log` set request_id= NEW.`id`, comment_by=2,`comment`=OLD.ro_comment,update_at=old.`update_at`;
  end if;
  
IF (NEW.ac_comment != OLD.ac_comment) THEN
INSERT INTO `comment_log` set request_id= NEW.`id`, comment_by=4,`comment`=OLD.ac_comment,update_at=old.`update_at`;
end if;
  
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `newentrylog`;
DELIMITER $$
CREATE TRIGGER `newentrylog` AFTER INSERT ON `claim_request` FOR EACH ROW INSERT INTO `claim_request_log` (`id`, `request_id`, `status_id`, `update_at`) VALUES (NULL, new.`id`, new.`state_id`, CURRENT_TIMESTAMP)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `claim_request_log`
--

DROP TABLE IF EXISTS `claim_request_log`;
CREATE TABLE IF NOT EXISTS `claim_request_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `status_id` tinyint(1) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=444 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment_log`
--

DROP TABLE IF EXISTS `comment_log`;
CREATE TABLE IF NOT EXISTS `comment_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cost_centre`
--

DROP TABLE IF EXISTS `cost_centre`;
CREATE TABLE IF NOT EXISTS `cost_centre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cost_centre_sub`
--

DROP TABLE IF EXISTS `cost_centre_sub`;
CREATE TABLE IF NOT EXISTS `cost_centre_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cost_centre_id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `cost_centre_sub_ibfk_1` (`cost_centre_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `country_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `district_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ro_id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `contact_no` bigint(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `ro_id` (`ro_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `funding_agency`
--

DROP TABLE IF EXISTS `funding_agency`;
CREATE TABLE IF NOT EXISTS `funding_agency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `funding_agency_bu`
--

DROP TABLE IF EXISTS `funding_agency_bu`;
CREATE TABLE IF NOT EXISTS `funding_agency_bu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funding_agency_id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `funding_agency_id` (`funding_agency_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
CREATE TABLE IF NOT EXISTS `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  UNIQUE KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locationdescription`
--

DROP TABLE IF EXISTS `locationdescription`;
CREATE TABLE IF NOT EXISTS `locationdescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dis` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_authentications`
--

DROP TABLE IF EXISTS `page_authentications`;
CREATE TABLE IF NOT EXISTS `page_authentications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authentication` varchar(100) NOT NULL,
  `approve_to` varchar(100) NOT NULL,
  `level_id` varchar(100) NOT NULL,
  `notify_to` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=313 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE IF NOT EXISTS `program` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `district_id` (`district_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_budget_line`
--

DROP TABLE IF EXISTS `project_budget_line`;
CREATE TABLE IF NOT EXISTS `project_budget_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `project_budget_line_ibfk_1` (`project_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ro`
--

DROP TABLE IF EXISTS `ro`;
CREATE TABLE IF NOT EXISTS `ro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `contact_no` bigint(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `district_id` (`district_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `state_ibfk_1` (`country_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `travel_expenses`
--

DROP TABLE IF EXISTS `travel_expenses`;
CREATE TABLE IF NOT EXISTS `travel_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `visit_from` varchar(100) NOT NULL,
  `visit_to` varchar(100) NOT NULL,
  `t_mode` varchar(100) NOT NULL,
  `fare` int(11) NOT NULL,
  `local_conv` int(11) NOT NULL,
  `hotel_expenses` int(11) NOT NULL,
  `miscellaneous` int(11) NOT NULL,
  `food` int(11) NOT NULL,
  `uploads` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

DROP TABLE IF EXISTS `upload`;
CREATE TABLE IF NOT EXISTS `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `request_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(6) NOT NULL,
  `level_id` int(11) NOT NULL DEFAULT '1',
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `profile_id` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `parent_id`, `level_id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `profile_id`, `created_at`, `updated_at`) VALUES
(1, 0, 5, 'admin', 'I1RNkGjH61p7dewRGRNiRdWq34rWZgBC', '$2y$10$oby5qJcrlcgVcSIF6tjLBeJEvlIBLAQr0zmNOASMhcZPxAlzPrVQ.', NULL, 'admin@yahoo.com', 10, 0, 1542351781, 1542351781),
(18, 19, 1, 'EM0001', '3e458078ea07207fb741fa5b5539f086', '$2y$13$oMSP7EzB8k7UUi4DmJLN2OI.X7lpmt0MbNNEwxPQa6reNO7wNlk0.', NULL, 'emp1@gmail.com', 10, 6, 1548420522, 1548420522),
(19, 21, 2, 'RO0001', 'd4ded7fe32d23cb229b8010ff2330137', '$2y$13$IrGNNlsnUbuMwKD36UcTyOg2Nbe2vQVJkWzQXtzU8wLFT5p1OWS/C', NULL, 'RO@GMAIL.COM', 10, 2, 1548420995, 1548420995),
(20, 19, 1, 'EM0002', 'e572cde680b88af8b2bd1efb541423ee', '$2y$13$ob66R69B5d6oArPwWUm4J.iuMlX5zNP4bX0627UegfwxBmNr5.EVK', NULL, 'emp2@gmail.com', 10, 7, 1548421102, 1548421102),
(21, 0, 3, 'HO', 'e572cde680b88af8b2bd1efb541423ee', '$2y$13$ob66R69B5d6oArPwWUm4J.iuMlX5zNP4bX0627UegfwxBmNr5.EVK', NULL, 'HO@GMAIL.COM', 10, 0, 0, 0),
(22, 0, 4, 'AC', 'e572cde680b88af8b2bd1efb541423ee', '$2y$13$ob66R69B5d6oArPwWUm4J.iuMlX5zNP4bX0627UegfwxBmNr5.EVK', NULL, 'AC@gmail.com', 10, 0, 0, 0),
(23, 0, 1, 'EM0003', 'b67cdb58d7da9f21f843532769224fa2', '$2y$13$fzKqw5cu2/N4.O/JZaHx/e5uDgYWtXYbcuJlWB1IwL.ty3zDUmD0C', NULL, 'bharat.kalia@dhwaniris.com', 10, 8, 1548755878, 1548755878),
(24, 21, 2, 'RO0002', 'bb0cc421676a994d27746517e94ec626', '$2y$13$239xXuA3xW8O8xKWfSGtkepMLR1Gt4DiT3QXRANAxSFuJkaLiAESm', NULL, 'apoorv@dhwaniris.com', 10, 3, 1548756677, 1548756677);

-- --------------------------------------------------------

--
-- Table structure for table `user_levels`
--

DROP TABLE IF EXISTS `user_levels`;
CREATE TABLE IF NOT EXISTS `user_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(100) NOT NULL,
  `level_authentications` text NOT NULL,
  `level_type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ro_id` int(11) NOT NULL,
  `vendor_no` varchar(50) NOT NULL,
  `name_unit` varchar(50) NOT NULL,
  `vendor_type` varchar(30) NOT NULL COMMENT 'Staff,Service Contract,Meeting Participant,NGO,Supplier,Others',
  `applicabiity` tinyint(1) NOT NULL COMMENT 'Individual, Company',
  `salutation` varchar(5) NOT NULL COMMENT 'Mr,Mrs,Ms,Dr',
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) NOT NULL,
  `nationality` varchar(20) DEFAULT NULL,
  `address` text NOT NULL,
  `district_id` int(11) NOT NULL,
  `pincode` int(11) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  `contact_no` bigint(15) NOT NULL,
  `pan_no` varchar(15) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `parent_company_name` varchar(50) DEFAULT NULL,
  `website` varchar(30) DEFAULT NULL,
  `company_address` text NOT NULL,
  `company_pincode` int(11) NOT NULL,
  `company_district_id` int(11) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `branch_id` varchar(30) NOT NULL,
  `branch_name` varchar(30) NOT NULL,
  `branch_address` text NOT NULL,
  `bank_pincode` int(11) NOT NULL,
  `bank_district_id` int(11) NOT NULL,
  `bank_account_name` varchar(50) NOT NULL,
  `bank_currency` varchar(10) NOT NULL COMMENT 'INR, Euro, USD',
  `bank_account_no` varchar(30) NOT NULL,
  `bank_account_type` varchar(15) NOT NULL COMMENT 'Savings, Current',
  `ifsc_code` varchar(30) NOT NULL,
  `swift_code` varchar(30) DEFAULT NULL,
  `iban` varchar(40) DEFAULT NULL,
  `cb_bank_name` varchar(50) DEFAULT NULL COMMENT 'CB-Correspondent Bank',
  `cb_address` text,
  `cb_account_no` varchar(30) DEFAULT NULL,
  `cb_swift_code` varchar(30) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '2' COMMENT 'active = 1 deactive = 2 delete  = 0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `district_id` (`district_id`) USING BTREE,
  KEY `ro_id` (`ro_id`) USING BTREE,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_contact_person`
--

DROP TABLE IF EXISTS `vendor_contact_person`;
CREATE TABLE IF NOT EXISTS `vendor_contact_person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL COMMENT 'proprietor',
  `address` text,
  `contact_no` bigint(15) NOT NULL,
  `pan_no` varchar(15) NOT NULL,
  `service_tax_no` decimal(15,0) DEFAULT NULL,
  `email_id` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_payment`
--

DROP TABLE IF EXISTS `vendor_payment`;
CREATE TABLE IF NOT EXISTS `vendor_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'Request Create By ',
  `status_id` tinyint(4) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `service_by` varchar(191) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `upload_approval` varchar(255) NOT NULL,
  `upload_bill` varchar(255) NOT NULL,
  `natural_head` varchar(191) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `funding_agency_id` int(11) DEFAULT NULL,
  `funding_agency_bu_id` int(11) DEFAULT NULL,
  `cost_center_id` int(11) DEFAULT NULL,
  `cost_centre_sub` int(11) DEFAULT NULL,
  `lo` varchar(191) DEFAULT NULL,
  `comment_ho` varchar(255) DEFAULT NULL,
  `cv_ref` varchar(60) DEFAULT NULL,
  `cr_date` varchar(30) DEFAULT NULL,
  `comment_ac` varchar(255) DEFAULT NULL,
  `comment_ro` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `program_id` (`program_id`),
  KEY `funding_agency_id` (`funding_agency_id`),
  KEY `funding_agency_bu_id` (`funding_agency_bu_id`),
  KEY `cost_center_id` (`cost_center_id`),
  KEY `cost_centre_sub` (`cost_centre_sub`),
  KEY `vendor_payment_ibfk_1` (`vendor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Triggers `vendor_payment`
--
DROP TRIGGER IF EXISTS `vendor_payment_update_log`;
DELIMITER $$
CREATE TRIGGER `vendor_payment_update_log` AFTER INSERT ON `vendor_payment` FOR EACH ROW INSERT INTO `vendor_payment_log` (`id`, `request_id`, `status_id`, `update_at`) VALUES (NULL, new.`id`, new.`status_id`, CURRENT_TIMESTAMP)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_payment_log`
--

DROP TABLE IF EXISTS `vendor_payment_log`;
CREATE TABLE IF NOT EXISTS `vendor_payment_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `status_id` tinyint(1) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `claim_request`
--
ALTER TABLE `claim_request`
  ADD CONSTRAINT `claim_request_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `claim_request_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `claim_request_ibfk_3` FOREIGN KEY (`project_budget_line_id`) REFERENCES `project_budget_line` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `claim_request_ibfk_4` FOREIGN KEY (`costcenter_id`) REFERENCES `cost_centre_sub` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `claim_request_ibfk_5` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `claim_request_ibfk_6` FOREIGN KEY (`locationdescription_id`) REFERENCES `locationdescription` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vendor_payment`
--
ALTER TABLE `vendor_payment`
  ADD CONSTRAINT `vendor_payment_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`id`),
  ADD CONSTRAINT `vendor_payment_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `vendor_payment_ibfk_3` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`),
  ADD CONSTRAINT `vendor_payment_ibfk_4` FOREIGN KEY (`funding_agency_id`) REFERENCES `funding_agency` (`id`),
  ADD CONSTRAINT `vendor_payment_ibfk_5` FOREIGN KEY (`funding_agency_bu_id`) REFERENCES `funding_agency_bu` (`id`),
  ADD CONSTRAINT `vendor_payment_ibfk_6` FOREIGN KEY (`cost_center_id`) REFERENCES `cost_centre` (`id`),
  ADD CONSTRAINT `vendor_payment_ibfk_7` FOREIGN KEY (`cost_centre_sub`) REFERENCES `cost_centre_sub` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
