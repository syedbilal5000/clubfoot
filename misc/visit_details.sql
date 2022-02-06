-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 09, 2022 at 11:52 AM
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
-- Table structure for table `visit_details`
--

DROP TABLE IF EXISTS `visit_details`;
CREATE TABLE IF NOT EXISTS `visit_details` (
  `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'must be start from 5 digits',
  `patient_id` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `next_visit_date` date DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `side` varchar(1) DEFAULT NULL COMMENT 'L/R',
  `CLB` float DEFAULT NULL,
  `MC` float DEFAULT NULL,
  `LHT` float DEFAULT NULL,
  `PC` float DEFAULT NULL,
  `RE` float DEFAULT NULL,
  `EH` float DEFAULT NULL,
  `mid_foot_score` float DEFAULT NULL,
  `hind_foot_score` float DEFAULT NULL,
  `total_score` float DEFAULT NULL,
  `treatment` int(1) DEFAULT NULL COMMENT 'Like Casted, Tenotomy',
  `complication` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11102 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visit_details`
--

INSERT INTO `visit_details` (`id`, `patient_id`, `visit_date`, `next_visit_date`, `appointment_id`, `side`, `CLB`, `MB`, `LHT`, `PC`, `RE`, `EH`, `mid_foot_score`, `hind_foot_score`, `total_score`, `treatment`, `complic`, `next_app`, `no_of_cast`) VALUES
(11101, 2, '20220223134134', '20220229144234', 1, 'L', 1, 0, 1, 0, 1, 0, 2, 1, 3, 'C', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
