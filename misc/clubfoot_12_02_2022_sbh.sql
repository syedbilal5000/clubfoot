-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2022 at 09:44 AM
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

INSERT INTO `appointment` (`appointment_id`, `appointment_date`, `patient_id`, `appointment_status`, `previous_appointment_id`, `inserted_at`) VALUES
(10010, '2022-03-01', 10001, 1, 0, '2022-01-31'),
(10008, '2022-02-04', 10001, 3, 0, '2022-01-22'),
(10009, '2022-02-04', 10001, 4, 0, '2022-01-22');

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

INSERT INTO `patients` (`patient_id`, `patient_name`, `father_name`, `gender`, `birth_date`, `address`, `address2`, `has_photo_consent`, `relation_to_patient`, `guardian_name`, `guardian_number`, `guardian_number_2`, `guardian_cnic`, `icr_number`, `inserted_at`) VALUES
(10001, 'Patient 2', 'Father', 0, '2021-01-01', NULL, NULL, 0, 0, NULL, '0312-3456789', NULL, '12345-6789012-3', '12345', '2022-01-19'),
(10002, 'Test Pateint 2', 'Test Father_2', 0, '2021-01-01', NULL, NULL, 0, 0, NULL, '0312-3456789', NULL, '12345-6789012-3', NULL, '2022-01-31');

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

INSERT INTO `patient_diagnoses` (`pateint_diagnosis_id`, `patient_id`, `evaluator_name`, `evaluation_date`, `evaluator_title`, `feet_affected`, `diagnosis`, `has_birth_deformity`, `has_treated`, `treatments`, `treatment_type`, `has_diagnosed`, `preg_week`, `has_birth_confirmed`, `diagnosis_comments`) VALUES
(1, 12, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(2, 13, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(3, 14, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(4, 15, 'evaluator123', NULL, 1, 1, 1, 1, 1, 3, 1, 1, 5, 1, 'diagnosis123'),
(5, 21, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(6, 22, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(7, 23, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(8, 24, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(9, 25, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(10, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(11, 10001, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL),
(12, 10002, NULL, NULL, 0, 2, 1, 1, 0, 0, 1, 0, 2, 0, NULL);

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

INSERT INTO `patient_examinations` (`id`, `patient_id`, `is_head`, `is_heart`, `is_urinary`, `is_skin`, `is_spine`, `is_hips`, `is_upper`, `is_lower`, `is_neuro`, `is_arms`, `is_legs`, `is_other`) VALUES
(124, 15, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(125, 21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(126, 22, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(127, 23, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(128, 24, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(129, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(130, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(131, 10001, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(132, 10002, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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

INSERT INTO `patient_families` (`patient_family_id`, `patient_id`, `is_relatable`, `preg_len`, `has_complicated_preg`, `complications`, `is_alcoholic`, `is_smoked`, `has_complicated_birth`, `birth_place`, `referral_source`, `doctor_name`, `referral_hospital`, `other_referral`) VALUES
(1, 9, 0, 0, 0, NULL, 0, 0, 0, 2, 1, NULL, NULL, 'test'),
(2, 11, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(3, 12, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(4, 13, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(5, 14, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(6, 15, 1, 2, 1, NULL, 1, 1, 1, 1, 1, 'doctor123', NULL, NULL),
(7, 21, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(8, 22, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(9, 23, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(10, 24, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(11, 25, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(12, 1, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(13, 10001, 0, 0, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL),
(14, 10002, 0, 8, 0, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL);

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

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Syed Bilal Hussain', 'syedbilalhussain168@gmail.com', NULL, '$2y$10$roHidmLGvHAl4xlFfGM6W./9eMHJ8Dq.3iX/iJeJaa2cL5oJPsT6C', 'hwQ7P98DUH3i53DxXERZTAh3oY03yLXBFy4oHKWSnw0UWO5SBt4Wqaorosmk', '2021-12-17 00:36:17', '2021-12-17 00:36:17'),
(2, 'Luqman Ahmed', 'luqman@clubfoot.com', NULL, '$2y$10$dmOFxlVM.QAar.7oFpIY8OUMWTO/6FqAsl8Q9PoduU1Kplo8JEY1S', NULL, '2022-01-12 03:20:01', '2022-01-12 03:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `visit_details`
--

CREATE TABLE `visit_details` (
  `id` int(20) NOT NULL COMMENT 'must be start from 5 digits',
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
  `inserted_at` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visit_details`
--

INSERT INTO `visit_details` (`id`, `patient_id`, `visit_date`, `next_visit_date`, `appointment_id`, `side`, `CLB`, `MC`, `LHT`, `PC`, `RE`, `EH`, `mid_foot_score`, `hind_foot_score`, `total_score`, `treatment`, `complication`, `description`, `inserted_at`) VALUES
(11102, 10001, '2022-02-06', '2022-02-13', NULL, 'R', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, '2022-02-06'),
(11103, 10001, '2022-02-06', '2022-02-13', 0, 'L', 0.5, 0, 1, 0, 0.5, 0, NULL, NULL, NULL, 1, NULL, NULL, '2022-02-06'),
(11104, 10001, '2022-02-06', '2022-02-13', 0, 'L', 0.5, 0, 1, 0, 0.5, 0, NULL, NULL, NULL, 1, NULL, NULL, '2022-02-06'),
(11105, 10001, '2022-02-06', '2022-02-13', 0, 'R', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, '2022-02-06'),
(11106, 10001, '2022-02-06', '2022-02-13', 0, 'L', 0, 0.5, 0, 0, 0.5, 0, NULL, NULL, NULL, 1, NULL, NULL, '2022-02-06'),
(11107, 10001, '2022-02-06', '2022-02-13', 0, 'R', 0, 0, 0, 0, 0.5, 0, NULL, NULL, NULL, 1, NULL, NULL, '2022-02-06'),
(11108, 10001, '2022-02-07', '2022-02-14', 10010, 'R', 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, NULL, '2022-02-07');

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
-- Indexes for table `visit_details`
--
ALTER TABLE `visit_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10011;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lookups`
--
ALTER TABLE `lookups`
  MODIFY `lookup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10003;

--
-- AUTO_INCREMENT for table `patient_diagnoses`
--
ALTER TABLE `patient_diagnoses`
  MODIFY `pateint_diagnosis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `patient_examinations`
--
ALTER TABLE `patient_examinations`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `patient_families`
--
ALTER TABLE `patient_families`
  MODIFY `patient_family_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visit_details`
--
ALTER TABLE `visit_details`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT COMMENT 'must be start from 5 digits', AUTO_INCREMENT=11109;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
