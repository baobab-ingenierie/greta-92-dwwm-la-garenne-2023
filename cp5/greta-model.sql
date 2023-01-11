-- MySQL Script generated by MySQL Workbench
-- Wed Jan 11 14:49:48 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema greta
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema greta
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `greta` DEFAULT CHARACTER SET utf8 ;
USE `greta` ;

-- -----------------------------------------------------
-- Table `greta`.`teachers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `greta`.`teachers` (
  `idteachers` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(30) NOT NULL,
  `sex` TINYINT NULL,
  `dob` DATE NULL,
  PRIMARY KEY (`idteachers`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `greta`.`courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `greta`.`courses` (
  `idcourses` VARCHAR(5) NOT NULL,
  `title` VARCHAR(100) NOT NULL,
  `coef` INT NULL,
  PRIMARY KEY (`idcourses`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `greta`.`manages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `greta`.`manages` (
  `idteachers` INT NOT NULL,
  `idcourses` VARCHAR(5) NOT NULL,
  PRIMARY KEY (`idteachers`, `idcourses`),
  INDEX `fk_teachers_has_courses_courses1_idx` (`idcourses` ASC),
  INDEX `fk_teachers_has_courses_teachers_idx` (`idteachers` ASC),
  CONSTRAINT `fk_teachers_has_courses_teachers`
    FOREIGN KEY (`idteachers`)
    REFERENCES `greta`.`teachers` (`idteachers`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_teachers_has_courses_courses1`
    FOREIGN KEY (`idcourses`)
    REFERENCES `greta`.`courses` (`idcourses`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;