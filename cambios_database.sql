ALTER TABLE `documentos` CHANGE `observaciones` `observaciones` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

ALTER TABLE `documentos` CHANGE `descripcion` `descripcion` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

/**

    DICIEMBRE 05 - 2018

 */
CREATE TABLE IF NOT EXISTS `archinet`.`certificados_laborales` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `anio` INT(11) NOT NULL,
  `consecutivo` VARCHAR(5) NOT NULL,
  `user_id` INT(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_certificados_laborales_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_certificados_laborales_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `archinet`.`users` (`id`)
    ON DELETE SET NULL
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;