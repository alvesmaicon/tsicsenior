-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema seniortsic
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema seniortsic
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `seniortsic` DEFAULT CHARACTER SET latin1 ;
USE `seniortsic` ;

-- -----------------------------------------------------
-- Table `seniortsic`.`documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `seniortsic`.`documento` (
  `iddocumento` INT(11) NOT NULL,
  `total` INT(11) NULL DEFAULT NULL,
  `confirmado` TINYINT(1) NULL DEFAULT NULL,
  PRIMARY KEY (`iddocumento`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `seniortsic`.`produto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `seniortsic`.`produto` (
  `idproduto` INT(11) NOT NULL,
  `descricao` TINYTEXT NULL DEFAULT NULL,
  `preco` DOUBLE NULL DEFAULT NULL,
  PRIMARY KEY (`idproduto`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `seniortsic`.`item`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `seniortsic`.`item` (
  `produto_idproduto` INT(11) NOT NULL,
  `documento_iddocumento` INT(11) NOT NULL,
  PRIMARY KEY (`produto_idproduto`, `documento_iddocumento`),
  INDEX `fk_item_produto_idx` (`produto_idproduto`) ,
  INDEX `fk_item_documento_idx` (`documento_iddocumento`),
  CONSTRAINT `fk_item_produto`
    FOREIGN KEY (`produto_idproduto`)
    REFERENCES `seniortsic`.`produto` (`idproduto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_documento1`
    FOREIGN KEY (`documento_iddocumento`)
    REFERENCES `seniortsic`.`documento` (`iddocumento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
