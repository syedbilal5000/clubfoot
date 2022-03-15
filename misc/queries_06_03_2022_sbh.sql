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
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `donor_email` varchar(30) DEFAULT NULL,
  `donor_number` varchar(15) NOT NULL,
  `donor_address` varchar(50) DEFAULT NULL,
  `city_id` int(11) NOT NULL DEFAULT 0,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `patients` ADD `donor_id` INT NOT NULL DEFAULT '0' AFTER `icr_number`;

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city`, `state`) VALUES
(1, 'Karachi', 'Sindh'),
(2, 'Lahore', 'Punjab'),
(3, 'Faisalabad', 'Punjab'),
(4, 'Rawalpindi', 'Punjab'),
(5, 'Gujranwala', 'Punjab'),
(6, 'Peshawar', 'Khyber Pakhtunkhwa'),
(7, 'Multan', 'Punjab'),
(8, 'Saidu Sharif', 'Khyber Pakhtunkhwa'),
(9, 'Hyderabad City', 'Sindh'),
(10, 'Islamabad', 'Punjab'),
(11, 'Quetta', 'Balochistān'),
(12, 'Bahawalpur', 'Punjab'),
(13, 'Sargodha', 'Punjab'),
(14, 'Sialkot City', 'Punjab'),
(15, 'Sukkur', 'Sindh'),
(16, 'Larkana', 'Sindh'),
(17, 'Chiniot', 'Punjab'),
(18, 'Shekhupura', 'Punjab'),
(19, 'Jhang City', 'Punjab'),
(20, 'Dera Ghazi Khan', 'Punjab'),
(21, 'Gujrat', 'Punjab'),
(22, 'Rahimyar Khan', 'Punjab'),
(23, 'Kasur', 'Punjab'),
(24, 'Mardan', 'Khyber Pakhtunkhwa'),
(25, 'Mingaora', 'Khyber Pakhtunkhwa'),
(26, 'Nawabshah', 'Sindh'),
(27, 'Sahiwal', 'Punjab'),
(28, 'Mirpur Khas', 'Sindh'),
(29, 'Okara', 'Punjab'),
(30, 'Mandi Burewala', 'Punjab'),
(31, 'Jacobabad', 'Sindh'),
(32, 'Saddiqabad', 'Punjab'),
(33, 'Kohat', 'Khyber Pakhtunkhwa'),
(34, 'Muridke', 'Punjab'),
(35, 'Muzaffargarh', 'Punjab'),
(36, 'Khanpur', 'Punjab'),
(37, 'Gojra', 'Punjab'),
(38, 'Mandi Bahauddin', 'Punjab'),
(39, 'Abbottabad', 'Khyber Pakhtunkhwa'),
(40, 'Turbat', 'Balochistān'),
(41, 'Dadu', 'Sindh'),
(42, 'Bahawalnagar', 'Punjab'),
(43, 'Khuzdar', 'Balochistān'),
(44, 'Pakpattan', 'Punjab'),
(45, 'Tando Allahyar', 'Sindh'),
(46, 'Ahmadpur East', 'Punjab'),
(47, 'Vihari', 'Punjab'),
(48, 'Jaranwala', 'Punjab'),
(49, 'New Mirpur', 'Azad Kashmir'),
(50, 'Kamalia', 'Punjab'),
(51, 'Kot Addu', 'Punjab'),
(52, 'Nowshera', 'Khyber Pakhtunkhwa'),
(53, 'Swabi', 'Khyber Pakhtunkhwa'),
(54, 'Khushab', 'Punjab'),
(55, 'Dera Ismail Khan', 'Khyber Pakhtunkhwa'),
(56, 'Chaman', 'Balochistān'),
(57, 'Charsadda', 'Khyber Pakhtunkhwa'),
(58, 'Kandhkot', 'Sindh'),
(59, 'Chishtian', 'Punjab'),
(60, 'Hasilpur', 'Punjab'),
(61, 'Attock Khurd', 'Punjab'),
(62, 'Muzaffarabad', 'Azad Kashmir'),
(63, 'Mianwali', 'Punjab'),
(64, 'Jalalpur Jattan', 'Punjab'),
(65, 'Bhakkar', 'Punjab'),
(66, 'Zhob', 'Balochistān'),
(67, 'Dipalpur', 'Punjab'),
(68, 'Kharian', 'Punjab'),
(69, 'Mian Channun', 'Punjab'),
(70, 'Bhalwal', 'Punjab'),
(71, 'Jamshoro', 'Sindh'),
(72, 'Pattoki', 'Punjab'),
(73, 'Harunabad', 'Punjab'),
(74, 'Kahror Pakka', 'Punjab'),
(75, 'Toba Tek Singh', 'Punjab'),
(76, 'Samundri', 'Punjab'),
(77, 'Shakargarh', 'Punjab'),
(78, 'Sambrial', 'Punjab'),
(79, 'Shujaabad', 'Punjab'),
(80, 'Hujra Shah Muqim', 'Punjab'),
(81, 'Kabirwala', 'Punjab'),
(82, 'Mansehra', 'Khyber Pakhtunkhwa'),
(83, 'Lala Musa', 'Punjab'),
(84, 'Chunian', 'Punjab'),
(85, 'Nankana Sahib', 'Punjab'),
(86, 'Bannu', 'Khyber Pakhtunkhwa'),
(87, 'Pasrur', 'Punjab'),
(88, 'Timargara', 'Khyber Pakhtunkhwa'),
(89, 'Parachinar', 'Khyber Pakhtunkhwa'),
(90, 'Chenab Nagar', 'Punjab'),
(91, 'Gwadar', 'Balochistān'),
(92, 'Abdul Hakim', 'Punjab'),
(93, 'Hassan Abdal', 'Punjab'),
(94, 'Tank', 'Khyber Pakhtunkhwa'),
(95, 'Hangu', 'Khyber Pakhtunkhwa'),
(96, 'Risalpur Cantonment', 'Khyber Pakhtunkhwa'),
(97, 'Karak', 'Khyber Pakhtunkhwa'),
(98, 'Kundian', 'Punjab'),
(99, 'Umarkot', 'Sindh'),
(100, 'Chitral', 'Khyber Pakhtunkhwa'),
(101, 'Dainyor', 'Gilgit-Baltistan'),
(102, 'Kulachi', 'Khyber Pakhtunkhwa'),
(103, 'Kalat', 'Balochistān'),
(104, 'Kotli', 'Azad Kashmir'),
(105, 'Gilgit', 'Gilgit-Baltistan'),
(106, 'Narowal', 'Punjab'),
(107, 'Khairpur Mir’s', 'Sindh'),
(108, 'Khanewal', 'Punjab'),
(109, 'Jhelum', 'Punjab'),
(110, 'Haripur', 'Khyber Pakhtunkhwa'),
(111, 'Shikarpur', 'Sindh'),
(112, 'Rawala Kot', 'Azad Kashmir'),
(113, 'Hafizabad', 'Punjab'),
(114, 'Lodhran', 'Punjab'),
(115, 'Malakand', 'Khyber Pakhtunkhwa'),
(116, 'Attock City', 'Punjab'),
(117, 'Batgram', 'Khyber Pakhtunkhwa'),
(118, 'Matiari', 'Sindh'),
(119, 'Ghotki', 'Sindh'),
(120, 'Naushahro Firoz', 'Sindh'),
(121, 'Alpurai', 'Khyber Pakhtunkhwa'),
(122, 'Bagh', 'Azad Kashmir'),
(123, 'Daggar', 'Khyber Pakhtunkhwa'),
(124, 'Leiah', 'Punjab'),
(125, 'Tando Muhammad Khan', 'Sindh'),
(126, 'Chakwal', 'Punjab'),
(127, 'Badin', 'Sindh'),
(128, 'Lakki', 'Khyber Pakhtunkhwa'),
(129, 'Rajanpur', 'Punjab'),
(130, 'Dera Allahyar', 'Balochistān'),
(131, 'Shahdad Kot', 'Sindh'),
(132, 'Pishin', 'Balochistān'),
(133, 'Sanghar', 'Sindh'),
(134, 'Upper Dir', 'Khyber Pakhtunkhwa'),
(135, 'Thatta', 'Sindh'),
(136, 'Dera Murad Jamali', 'Balochistān'),
(137, 'Kohlu', 'Balochistān'),
(138, 'Mastung', 'Balochistān'),
(139, 'Dasu', 'Khyber Pakhtunkhwa'),
(140, 'Athmuqam', 'Azad Kashmir'),
(141, 'Loralai', 'Balochistān'),
(142, 'Barkhan', 'Balochistān'),
(143, 'Musa Khel Bazar', 'Balochistān'),
(144, 'Ziarat', 'Balochistān'),
(145, 'Gandava', 'Balochistān'),
(146, 'Sibi', 'Balochistān'),
(147, 'Dera Bugti', 'Balochistān'),
(148, 'Eidgah', 'Gilgit-Baltistan'),
(149, 'Uthal', 'Balochistān'),
(150, 'Khuzdar', 'Balochistān'),
(151, 'Chilas', 'Gilgit-Baltistan'),
(152, 'Panjgur', 'Balochistān'),
(153, 'Gakuch', 'Gilgit-Baltistan'),
(154, 'Qila Saifullah', 'Balochistān'),
(155, 'Kharan', 'Balochistān'),
(156, 'Aliabad', 'Gilgit-Baltistan'),
(157, 'Awaran', 'Balochistān'),
(158, 'Dalbandin', 'Balochistān');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
