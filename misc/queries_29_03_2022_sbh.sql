
ALTER TABLE `visit_details` ADD `img_path` VARCHAR(50) NULL AFTER `complication`;

ALTER TABLE `followup` ADD `img_path` VARCHAR(50) NULL AFTER `is_virtual`;