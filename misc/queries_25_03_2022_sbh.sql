
ALTER TABLE `followup` ADD `is_virtual` INT(1) NOT NULL DEFAULT '0' AFTER `treatment`;

ALTER TABLE `patients` ADD `out_of_city` INT(1) NOT NULL DEFAULT '0' AFTER `address2`;

ALTER TABLE `patient_diagnoses` CHANGE `pateint_diagnosis_id` `patient_diagnosis_id` INT(11) NOT NULL AUTO_INCREMENT;
