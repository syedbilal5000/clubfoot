-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2022 at 03:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.23

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
-- Table structure for table `patients`
--

DROP TABLE patients;

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(30) NOT NULL,
  `father_name` varchar(30) NOT NULL,
  `gender` int(1) NOT NULL DEFAULT 0,
  `birth_date` date NOT NULL,
  `address` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `has_photo_consent` int(1) NOT NULL DEFAULT 0,
  `relation_to_patient` int(1) DEFAULT 0,
  `guardian_name` varchar(30) DEFAULT NULL,
  `guardian_number` varchar(15) NOT NULL,
  `guardian_number_2` varchar(15) DEFAULT NULL,
  `guardian_cnic` varchar(15) NOT NULL,
  `icr_number` varchar(15) DEFAULT NULL,
  `inserted_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `patient_families` ADD `complications` VARCHAR(50) NULL AFTER `has_complicated_preg`;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `patient_name`, `father_name`, `gender`, `birth_date`, `address`, `address2`, `has_photo_consent`, `relation_to_patient`, `guardian_name`, `guardian_number`, `guardian_number_2`, `guardian_cnic`, `icr_number`, `inserted_at`) VALUES
(10001, 'Patient 2', 'Father', 0, '2021-01-01', NULL, NULL, 0, 0, NULL, '0312-3456789', NULL, '12345-6789012-3', '12345', '2022-01-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10002;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
