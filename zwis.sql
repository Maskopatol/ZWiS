SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `zwis` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `zwis` ;

-- -----------------------------------------------------
-- Table `zwis`.`Users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Users` (
  `id_user` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `email` VARCHAR(64) NOT NULL ,
  `password` VARCHAR(64) NOT NULL ,
  `name` VARCHAR(32) NULL DEFAULT 'Anonymous' ,
  `surname` VARCHAR(32) NULL DEFAULT 'Anonymous' ,
  `registration_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `photo` varchar(255) null,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  PRIMARY KEY (`id_user`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `zwis`.`Locations`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `Locations` (
  `id_user` INT UNSIGNED NOT NULL ,
  `add_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `latitude` FLOAT NOT NULL,
  `longitude` FLOAT NOT NULL,
  PRIMARY KEY (`id_user`) ,
  CONSTRAINT `fk_Locations_Users`
    FOREIGN KEY (`id_user` )
    REFERENCES `mydb`.`Users` (`id_user` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `mydb`.`Univerity`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `University` (
  `name` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `established` int(4) NOT NULL,
  `students` int(5) NOT NULL,
  `home_page` varchar(128) NOT NULL DEFAULT 'http://www.',
  PRIMARY KEY (`name`)
) ENGINE=InnoDB;




SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
