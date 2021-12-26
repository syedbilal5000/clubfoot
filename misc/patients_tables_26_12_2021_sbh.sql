-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2021 at 09:21 AM
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

-- To add address2 field
ALTER TABLE `patients` ADD `address2` VARCHAR(50) NULL AFTER `address`;

--
-- Table structure for table `patient_diagnoses`
--

CREATE TABLE `patient_diagnoses` (
  `pateint_diagnosis_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `evaluator_name` varchar(30) DEFAULT NULL,
  `evaluation_date` date DEFAULT NULL,
  `evaluator_title` int(1) NOT NULL DEFAULT 0,
  `feet_affected` int(1) NOT NULL DEFAULT 0,
  `diagnosis` int(1) NOT NULL DEFAULT 0,
  `has_birth_deformity` int(1) NOT NULL DEFAULT 0,
  `has_treated` int(1) NOT NULL DEFAULT 0,
  `treatments` int(11) NOT NULL DEFAULT 0,
  `treatment_type` int(11) NOT NULL DEFAULT 0,
  `has_diagnosed` int(1) NOT NULL DEFAULT 0,
  `preg_week` int(11) NOT NULL DEFAULT 0,
  `has_birth_confirmed` int(1) NOT NULL DEFAULT 0,
  `diagnosis_comments` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `patient_families`
--

CREATE TABLE `patient_families` (
  `patient_family_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `is_relatable` int(1) NOT NULL DEFAULT 0,
  `preg_len` int(11) NOT NULL DEFAULT 0,
  `has_complicated_preg` int(1) NOT NULL DEFAULT 0,
  `is_alcoholic` int(1) NOT NULL DEFAULT 0,
  `is_smoked` int(1) NOT NULL DEFAULT 0,
  `has_complicated_birth` int(1) NOT NULL DEFAULT 0,
  `birth_place` int(1) NOT NULL DEFAULT 0,
  `referral_source` int(1) NOT NULL DEFAULT 0,
  `doctor_name` varchar(30) DEFAULT NULL,
  `referral_hospital` varchar(50) DEFAULT NULL,
  `other_referral` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_families`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient_diagnoses`
--
ALTER TABLE `patient_diagnoses`
  ADD PRIMARY KEY (`pateint_diagnosis_id`);

--
-- Indexes for table `patient_families`
--
ALTER TABLE `patient_families`
  ADD PRIMARY KEY (`patient_family_id`);


--
-- AUTO_INCREMENT for table `patient_diagnoses`
--
ALTER TABLE `patient_diagnoses`
  MODIFY `pateint_diagnosis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient_families`
--
ALTER TABLE `patient_families`
  MODIFY `patient_family_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

