-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 02, 2022 at 08:08 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clubfoot`
--

-- --------------------------------------------------------

--
-- Table structure for table `physical_examination`
--

DROP TABLE IF EXISTS `physical_examination`;
CREATE TABLE IF NOT EXISTS `physical_examination` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `head` int(1) NOT NULL DEFAULT '0',
  `heart_lungs` int(1) NOT NULL DEFAULT '0',
  `urinary_digestive` int(1) NOT NULL DEFAULT '0',
  `skin` int(1) NOT NULL DEFAULT '0',
  `spine` int(1) NOT NULL DEFAULT '0',
  `hips` int(1) NOT NULL DEFAULT '0',
  `upper_extremities` int(1) NOT NULL DEFAULT '0',
  `lower_extremities` int(1) NOT NULL DEFAULT '0',
  `neurological` int(1) NOT NULL DEFAULT '0',
  `arms` int(1) NOT NULL DEFAULT '0',
  `legs` int(1) NOT NULL DEFAULT '0',
  `other` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `physical_examination`
--

INSERT INTO `physical_examination` (`id`, `patient_id`, `head`, `heart_lungs`, `urinary_digestive`, `skin`, `spine`, `hips`, `upper_extremities`, `lower_extremities`, `neurological`, `arms`, `legs`, `other`) VALUES
(123, 2, 0, 1, 0, 1, 1, 0, 1, 0, 0, 1, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
