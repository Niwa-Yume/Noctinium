-- MySQL Script generated by MySQL Workbench
-- Wed Jan 25 15:38:03 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema noctinium
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `noctinium` ;

-- -----------------------------------------------------
-- Schema noctinium
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `noctinium` DEFAULT CHARACTER SET utf8 ;
USE `noctinium` ;

-- -----------------------------------------------------
-- Table `noctinium`.`imageuser`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `noctinium`.`imageuser` ;

CREATE TABLE IF NOT EXISTS `noctinium`.`imageuser` (
  `imageuser_id` INT NOT NULL AUTO_INCREMENT,
  `imageuser_url` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`imageuser_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `noctinium`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `noctinium`.`user` ;

CREATE TABLE IF NOT EXISTS `noctinium`.`user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `user_surname` VARCHAR(45) NOT NULL,
  `user_name` VARCHAR(45) NOT NULL,
  `user_username` VARCHAR(20) NOT NULL,
  `user_email` VARCHAR(50) NOT NULL,
  `user_telephone` VARCHAR(12) NOT NULL,
  `user_birthdate` DATE NOT NULL,
  `user_password` VARCHAR(60) NOT NULL,
  `user_timecreation` DATETIME NOT NULL,
  `user_type` INT NOT NULL DEFAULT 1,
  `user_typesubcription` INT NOT NULL DEFAULT 1,
  `user_decription` VARCHAR(500) NULL,
  `user_instagram` VARCHAR(100) NULL,
  `user_twitter` VARCHAR(100) NULL,
  `user_site` VARCHAR(50) NULL,
  `user_imageuser_id` INT NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `user_email_UNIQUE` (`user_email` ASC),
  UNIQUE INDEX `user_username_UNIQUE` (`user_username` ASC),
  UNIQUE INDEX `user_telephone_UNIQUE` (`user_telephone` ASC),
  INDEX `fk_user_image1_idx` (`user_imageuser_id` ASC),
  CONSTRAINT `fk_user_image1`
    FOREIGN KEY (`user_imageuser_id`)
    REFERENCES `noctinium`.`imageuser` (`imageuser_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `noctinium`.`event`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `noctinium`.`event` ;

CREATE TABLE IF NOT EXISTS `noctinium`.`event` (
  `event_id` INT NOT NULL AUTO_INCREMENT,
  `event_title` VARCHAR(30) NOT NULL,
  `event_datetime` DATETIME NOT NULL,
  `event_location` VARCHAR(45) NOT NULL,
  `event_description` VARCHAR(1500) NOT NULL,
  `event_music` INT NOT NULL,
  `event_type` INT NOT NULL,
  `event_private` TINYINT NOT NULL DEFAULT 0,
  `event_maskedlocation` DATETIME NULL,
  `event_price` DECIMAL NULL,
  `event_user_id` INT NOT NULL,
  PRIMARY KEY (`event_id`),
  INDEX `fk_event_user1_idx` (`event_user_id` ASC),
  CONSTRAINT `fk_event_user1`
    FOREIGN KEY (`event_user_id`)
    REFERENCES `noctinium`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `noctinium`.`commentevent`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `noctinium`.`commentevent` ;

CREATE TABLE IF NOT EXISTS `noctinium`.`commentevent` (
  `commentevent_id` INT NOT NULL AUTO_INCREMENT,
  `commentevent_content` VARCHAR(500) NOT NULL,
  `commentevent_date` DATETIME NOT NULL,
  `commentevent_user_id` INT NOT NULL,
  `commentevent_event_id` INT NOT NULL,
  PRIMARY KEY (`commentevent_id`),
  INDEX `fk_comment_user1_idx` (`commentevent_user_id` ASC),
  INDEX `fk_comment_event1_idx` (`commentevent_event_id` ASC),
  CONSTRAINT `fk_comment_user1`
    FOREIGN KEY (`commentevent_user_id`)
    REFERENCES `noctinium`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_event1`
    FOREIGN KEY (`commentevent_event_id`)
    REFERENCES `noctinium`.`event` (`event_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `noctinium`.`rating`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `noctinium`.`rating` ;

CREATE TABLE IF NOT EXISTS `noctinium`.`rating` (
  `rating_id` INT NOT NULL AUTO_INCREMENT,
  `rating_value` INT NOT NULL,
  `rating_user_id` INT NOT NULL,
  `rating_organiser_id` INT NOT NULL,
  PRIMARY KEY (`rating_id`),
  INDEX `fk_rating_user1_idx` (`rating_user_id` ASC),
  INDEX `fk_rating_user2_idx` (`rating_organiser_id` ASC),
  CONSTRAINT `fk_rating_user1`
    FOREIGN KEY (`rating_user_id`)
    REFERENCES `noctinium`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_rating_user2`
    FOREIGN KEY (`rating_organiser_id`)
    REFERENCES `noctinium`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `noctinium`.`commentorganiser`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `noctinium`.`commentorganiser` ;

CREATE TABLE IF NOT EXISTS `noctinium`.`commentorganiser` (
  `commentorganiser_id` INT NOT NULL AUTO_INCREMENT,
  `commentorganiser_content` VARCHAR(500) NOT NULL,
  `commentorganiser_date` DATETIME NOT NULL,
  `commentorganiser_user_id` INT NOT NULL,
  `commentorganiser_organiser_id` INT NOT NULL,
  PRIMARY KEY (`commentorganiser_id`),
  INDEX `fk_comment_user1_idx` (`commentorganiser_user_id` ASC),
  INDEX `fk_commentorganiser_user1_idx` (`commentorganiser_organiser_id` ASC),
  CONSTRAINT `fk_comment_user10`
    FOREIGN KEY (`commentorganiser_user_id`)
    REFERENCES `noctinium`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commentorganiser_user1`
    FOREIGN KEY (`commentorganiser_organiser_id`)
    REFERENCES `noctinium`.`user` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `noctinium`.`imageevent`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `noctinium`.`imageevent` ;

CREATE TABLE IF NOT EXISTS `noctinium`.`imageevent` (
  `imageevent_id` INT NOT NULL AUTO_INCREMENT,
  `imageevent_url` VARCHAR(70) NOT NULL,
  `imageevent_event_id` INT NULL,
  PRIMARY KEY (`imageevent_id`),
  INDEX `fk_image_event1_idx` (`imageevent_event_id` ASC),
  CONSTRAINT `fk_image_event10`
    FOREIGN KEY (`imageevent_event_id`)
    REFERENCES `noctinium`.`event` (`event_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
