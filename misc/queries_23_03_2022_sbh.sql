ALTER TABLE `visit_details` CHANGE `appointment_id` `appointment_id` INT(11) NULL DEFAULT '0';

DROP TABLE `follow_up`;

CREATE TABLE `followup` (
  `id` int(20) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_id` int(11) DEFAULT 0,
  `visit_date` date NOT NULL,
  `next_visit_date` date DEFAULT NULL,
  `relapse` int(2) DEFAULT 0 COMMENT 'NONE, & VARUS, CAVUS, EQUINUS with Early/Late options',
  `size` int(2) DEFAULT 0,
  `hours` int(2) DEFAULT 0,
  `treatment` int(1) DEFAULT 0 COMMENT 'Like Casted, Tenotomy, Reassurance, New Brace, Referred',
  `description` varchar(50) DEFAULT NULL,
  `inserted_at` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `followup` CHANGE `id` `id` INT(20) NOT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);