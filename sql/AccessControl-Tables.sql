-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema accesscontrol
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema accesscontrol
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `accesscontrol`;
CREATE SCHEMA IF NOT EXISTS `accesscontrol` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `accesscontrol` ;

-- -----------------------------------------------------
-- Table `accesscontrol`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accesscontrol`.`user` (
  `userId` INT NOT NULL AUTO_INCREMENT,
  `name` TINYTEXT NOT NULL,
  `email` TINYTEXT NOT NULL,
  `username` TINYTEXT NOT NULL,
  `password` TINYTEXT NOT NULL,
  `role` TINYTEXT NOT NULL,
  PRIMARY KEY (`userId`)
)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `accesscontrol`.`useraccess`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `accesscontrol`.`useraccess` (
  `accessId` INT NOT NULL AUTO_INCREMENT,
  `timeAccess` TINYTEXT NOT NULL,
  `hashAccess` TINYTEXT NOT NULL,
  `isLocked` TINYTEXT NOT NULL,
  `userId` INT NOT NULL,
  PRIMARY KEY (`accessId`),
  INDEX `userId` (`userId` ASC) VISIBLE,
  CONSTRAINT `useraccess_ibfk_1`
    FOREIGN KEY (`userId`)
    REFERENCES `accesscontrol`.`user` (`userId`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

INSERT INTO `accesscontrol`.`user` (name, email, username, password, role) VALUES
('Administrator', 'admin@domain.com','administrator',"$2y$09$lGEbs3lV9V5gtHRs0xCUV.82npyHgbjAkfvIysz10b7hotLV6vQUW",'admin')
;

