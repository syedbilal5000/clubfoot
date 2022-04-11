ALTER TABLE `patient_diagnoses` ADD `other_diagnosis` VARCHAR(30) NULL AFTER `diagnosis`;

--
-- Table structure for table `appoint_delayed`
--

CREATE TABLE `appoint_delayed` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `reason` int(11) NOT NULL COMMENT 'Called, No Response, Wrong Number',
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for table `appoint_delayed`
--
ALTER TABLE `appoint_delayed`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `appoint_delayed`
--
ALTER TABLE `appoint_delayed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `appoint_delayed` CHANGE `reason` `reason` INT(11) NOT NULL DEFAULT '0' COMMENT 'Called, No Response, Wrong Number';
