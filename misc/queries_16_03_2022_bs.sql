CREATE TABLE `follow_up` (
  `id` int(20) NOT NULL COMMENT 'must be start from 5 digits',
  `patient_id` int(11) NOT NULL,
  `visit_date` date NOT NULL,
  `next_visit_date` date DEFAULT NULL,
  `age` varchar(20) DEFAULT NULL,
  `relapse` varchar(50) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `hours` varchar(10) DEFAULT NULL,
  `treatment` int(1) DEFAULT NULL COMMENT 'Like Casted, Tenotomy',
  `description` varchar(50) DEFAULT NULL,
  `inserted_at` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `follow_up` (`id`, `patient_id`, `visit_date`, `next_visit_date`, `age`, `relapse`, `size`, `hours`, `treatment`, `description`, `inserted_at`) VALUES ('10011', '10001', '2022-03-23', '2022-03-30', '2 years', 'g', '23', '0.15', '1', NULL, '2022-03-24');