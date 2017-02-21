CREATE TABLE `pronwe`.`Teams` (
`id` INT NOT NULL AUTO_INCREMENT ,
 `name` VARCHAR(65) NOT NULL ,
 `description` TEXT NOT NULL ,
 `logo` TEXT NOT NULL ,
 PRIMARY KEY (`id`)) ENGINE = InnoDB;

CREATE TABLE `pronwe`.`Teams_Participants` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `id_team` INT(65) NOT NULL ,
  `id_participant` INT(65) NOT NULL ,
  `id_event` INT(65) NOT NULL ,
  PRIMARY KEY (`id`)) ENGINE = InnoDB;

ALTER TABLE `Teams` CHANGE `logo` `logo` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL;

ALTER TABLE `Teams` ADD `id_event` INT(65) NOT NULL AFTER `id`;

ALTER TABLE `Teams_Participants` DROP ` id_event `;