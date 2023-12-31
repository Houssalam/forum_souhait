-- MySQL Script generated by MySQL Workbench
-- Fri Jun 23 09:09:11 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema liste_de_souhaits
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `liste_de_souhaits` ;

-- -----------------------------------------------------
-- Schema liste_de_souhaits
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `liste_de_souhaits` DEFAULT CHARACTER SET utf8 ;
USE `liste_de_souhaits` ;

-- -----------------------------------------------------
-- Table `liste_de_souhaits`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `liste_de_souhaits`.`user` ;

CREATE TABLE IF NOT EXISTS `liste_de_souhaits`.`user` (
  `iduser` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL,
  `mail` VARCHAR(45) NULL,
  `mdp` VARCHAR(255) NULL,
  `isActive` INT NULL,
  `role` INT NULL,
  `avatar` VARCHAR(45) NULL,
  `liste_de_souhait_user_iduser` INT NOT NULL,
  PRIMARY KEY (`iduser`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `liste_de_souhaits`.`liste_de_souhait`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `liste_de_souhaits`.`liste_de_souhait` ;

CREATE TABLE IF NOT EXISTS `liste_de_souhaits`.`liste_de_souhait` (
  `idliste_de_souhait` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL,
  `description` VARCHAR(255) NULL,
  `date` DATE NULL,
  `user_iduser` INT NOT NULL,
  PRIMARY KEY (`idliste_de_souhait`),
  INDEX `fk_liste_de_souhait_user1_idx` (`user_iduser` ASC) VISIBLE,
  CONSTRAINT `fk_liste_de_souhait_user1`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `liste_de_souhaits`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `liste_de_souhaits`.`article`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `liste_de_souhaits`.`article` ;

CREATE TABLE IF NOT EXISTS `liste_de_souhaits`.`article` (
  `idarticle` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL,
  `description` VARCHAR(255) NULL,
  PRIMARY KEY (`idarticle`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `liste_de_souhaits`.`commentaire`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `liste_de_souhaits`.`commentaire` ;

CREATE TABLE IF NOT EXISTS `liste_de_souhaits`.`commentaire` (
  `idcommentaire` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NULL,
  `date` DATE GENERATED ALWAYS AS () VIRTUAL,
  `user_iduser` INT NOT NULL,
  `liste_de_souhait_idliste_de_souhait` INT NOT NULL,
  PRIMARY KEY (`idcommentaire`),
  INDEX `fk_commentaire_user1_idx` (`user_iduser` ASC) VISIBLE,
  INDEX `fk_commentaire_liste_de_souhait1_idx` (`liste_de_souhait_idliste_de_souhait` ASC) VISIBLE,
  CONSTRAINT `fk_commentaire_user1`
    FOREIGN KEY (`user_iduser`)
    REFERENCES `liste_de_souhaits`.`user` (`iduser`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_commentaire_liste_de_souhait1`
    FOREIGN KEY (`liste_de_souhait_idliste_de_souhait`)
    REFERENCES `liste_de_souhaits`.`liste_de_souhait` (`idliste_de_souhait`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `liste_de_souhaits`.`liste_de_souhait_has_article`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `liste_de_souhaits`.`liste_de_souhait_has_article` ;

CREATE TABLE IF NOT EXISTS `liste_de_souhaits`.`liste_de_souhait_has_article` (
  `liste_de_souhait_idliste_de_souhait` INT NOT NULL,
  `article_idarticle` INT NOT NULL,
  PRIMARY KEY (`liste_de_souhait_idliste_de_souhait`, `article_idarticle`),
  INDEX `fk_liste_de_souhait_has_article_article1_idx` (`article_idarticle` ASC) VISIBLE,
  INDEX `fk_liste_de_souhait_has_article_liste_de_souhait1_idx` (`liste_de_souhait_idliste_de_souhait` ASC) VISIBLE,
  CONSTRAINT `fk_liste_de_souhait_has_article_liste_de_souhait1`
    FOREIGN KEY (`liste_de_souhait_idliste_de_souhait`)
    REFERENCES `liste_de_souhaits`.`liste_de_souhait` (`idliste_de_souhait`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_liste_de_souhait_has_article_article1`
    FOREIGN KEY (`article_idarticle`)
    REFERENCES `liste_de_souhaits`.`article` (`idarticle`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
