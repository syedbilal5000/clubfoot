-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2022 at 10:48 AM
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
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_status` int(2) DEFAULT 0,
  `previous_appointment_id` int(11) DEFAULT 0,
  `inserted_at` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--


-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lookups`
--

CREATE TABLE `lookups` (
  `lookup_id` int(11) NOT NULL,
  `day` int(1) NOT NULL,
  `name` varchar(10) NOT NULL,
  `count` int(11) NOT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lookups`
--

INSERT INTO `lookups` (`lookup_id`, `day`, `name`, `count`, `description`) VALUES
(1, 1, 'tuesday', 20, NULL),
(2, 2, 'wednesday', 25, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

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

--
-- Dumping data for table `patients`
--


-- --------------------------------------------------------

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
-- Dumping data for table `patient_diagnoses`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_examinations`
--

CREATE TABLE `patient_examinations` (
  `id` int(20) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `is_head` int(1) NOT NULL DEFAULT 0,
  `is_heart` int(1) NOT NULL DEFAULT 0,
  `is_urinary` int(1) NOT NULL DEFAULT 0,
  `is_skin` int(1) NOT NULL DEFAULT 0,
  `is_spine` int(1) NOT NULL DEFAULT 0,
  `is_hips` int(1) NOT NULL DEFAULT 0,
  `is_upper` int(1) NOT NULL DEFAULT 0,
  `is_lower` int(1) NOT NULL DEFAULT 0,
  `is_neuro` int(1) NOT NULL DEFAULT 0,
  `is_arms` int(1) NOT NULL DEFAULT 0,
  `is_legs` int(1) NOT NULL DEFAULT 0,
  `is_other` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_examinations`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient_families`
--

CREATE TABLE `patient_families` (
  `patient_family_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `is_relatable` int(1) NOT NULL DEFAULT 0,
  `preg_len` int(11) NOT NULL DEFAULT 0,
  `has_complicated_preg` int(1) NOT NULL DEFAULT 0,
  `complications` varchar(50) DEFAULT NULL,
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


-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(2) NOT NULL,
  `status_name` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_name`) VALUES
(1, 'Done'),
(2, 'Pending'),
(3, 'Reject'),
(4, 'Extend');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lookups`
--
ALTER TABLE `lookups`
  ADD PRIMARY KEY (`lookup_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `patient_diagnoses`
--
ALTER TABLE `patient_diagnoses`
  ADD PRIMARY KEY (`pateint_diagnosis_id`);

--
-- Indexes for table `patient_examinations`
--
ALTER TABLE `patient_examinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_families`
--
ALTER TABLE `patient_families`
  ADD PRIMARY KEY (`patient_family_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10001;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lookups`
--
ALTER TABLE `lookups`
  MODIFY `lookup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10001;

--
-- AUTO_INCREMENT for table `patient_diagnoses`
--
ALTER TABLE `patient_diagnoses`
  MODIFY `pateint_diagnosis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `patient_examinations`
--
ALTER TABLE `patient_examinations`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `patient_families`
--
ALTER TABLE `patient_families`
  MODIFY `patient_family_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
