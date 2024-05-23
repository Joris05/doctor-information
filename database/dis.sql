-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 23, 2024 at 06:38 AM
-- Server version: 8.2.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctors_info`
--

DROP TABLE IF EXISTS `tbl_doctors_info`;
CREATE TABLE IF NOT EXISTS `tbl_doctors_info` (
  `doc_id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `middlename` varchar(25) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `prc_license_type` varchar(50) NOT NULL,
  `prc_license_no` varchar(50) NOT NULL,
  `prc_expiry_date` date NOT NULL,
  `residential_address` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`doc_id`),
  KEY `lastname` (`lastname`),
  KEY `firstname` (`firstname`),
  KEY `middlename` (`middlename`),
  KEY `birthdate` (`birthdate`),
  KEY `gender` (`gender`),
  KEY `prc_license_type` (`prc_license_type`),
  KEY `prc_license_no` (`prc_license_no`),
  KEY `prc_expiry_date` (`prc_expiry_date`),
  KEY `residential_address` (`residential_address`),
  KEY `date_added` (`date_added`),
  KEY `photo` (`photo`(250))
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctor_contactno`
--

DROP TABLE IF EXISTS `tbl_doctor_contactno`;
CREATE TABLE IF NOT EXISTS `tbl_doctor_contactno` (
  `doc_contact_id` int NOT NULL AUTO_INCREMENT,
  `doctor_id` int NOT NULL,
  `mobile_no` varchar(11) NOT NULL,
  PRIMARY KEY (`doc_contact_id`),
  KEY `doc_contact_id` (`doc_contact_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_doctor_contactno`
--

INSERT INTO `tbl_doctor_contactno` (`doc_contact_id`, `doctor_id`, `mobile_no`) VALUES
(10, 1, '09916785093'),
(9, 1, '09058152278'),
(4, 2, '09123456789'),
(5, 2, '09058152278'),
(11, 3, '23123213123'),
(12, 4, '12345678901'),
(13, 5, '12345678901'),
(14, 6, '09058152278');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctor_prc_license`
--

DROP TABLE IF EXISTS `tbl_doctor_prc_license`;
CREATE TABLE IF NOT EXISTS `tbl_doctor_prc_license` (
  `prclicense_id` int NOT NULL AUTO_INCREMENT,
  `doctor_id` int NOT NULL,
  `prc_license_no` varchar(50) NOT NULL,
  `prc_expiry_date` date NOT NULL,
  `prc_license_type` varchar(50) NOT NULL,
  `prc_license_status` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`prclicense_id`),
  KEY `prc_license_no` (`prc_license_no`),
  KEY `prc_expiry_date` (`prc_expiry_date`),
  KEY `prc_license_type` (`prc_license_type`),
  KEY `prc_license_status` (`prc_license_status`),
  KEY `date_added` (`date_added`),
  KEY `date_updated` (`date_updated`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `complete_name` varchar(100) NOT NULL,
  `user_type` varchar(25) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  KEY `username` (`username`),
  KEY `password` (`password`(250)),
  KEY `complete_name` (`complete_name`),
  KEY `date_registered` (`date_registered`),
  KEY `user_type` (`user_type`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `password`, `complete_name`, `user_type`, `date_registered`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator', 'administrator', '2024-05-18 11:25:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
