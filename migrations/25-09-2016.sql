ALTER TABLE `Organizations` ADD `dt_update` DATE NOT NULL AFTER `dt_created`;
ALTER TABLE `Organizations` ADD `id_removed` BOOLEAN NOT NULL AFTER `dt_update`;
ALTER TABLE `Organizations` ADD `logo` TEXT NOT NULL AFTER `website`, ADD `cover` TEXT NOT NULL AFTER `logo`;