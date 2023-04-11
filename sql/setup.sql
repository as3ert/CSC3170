DROP SCHEMA IF EXISTS `proj` ;
CREATE SCHEMA IF NOT EXISTS `proj` DEFAULT CHARACTER SET utf8 ;
USE `proj` ;

-- -----------------------------------------------------
-- Create below: Table `proj`.`employees`
-- -----------------------------------------------------

CREATE TABLE employees
(
    EMPLOYEE_ID DECIMAL(6, 0) PRIMARY KEY NOT NULL,
    PROJECT_ID DECIMAL(6, 0),
    MANAGE_PROJECT_ID DECIMAL(6, 0),
    EMPLOYEE_NAME VARCHAR(20) NOT NULL,
    SALARY DECIMAL(8, 2) NOT NULL,
    POSITION VARCHAR(20) NOT NULL,
    LOCATION VARCHAR(20) NOT NULL
);

-- -----------------------------------------------------
-- Create below: Table `proj`.`projects`
-- -----------------------------------------------------

CREATE TABLE projects
(
    PROJECT_ID DECIMAL(6, 0) PRIMARY KEY NOT NULL,
    MANAGER_ID DECIMAL(6, 0) NOT NULL,
    ADMINISTER_ID DECIMAL(6, 0) NOT NULL,
    PROJECT_NAME VARCHAR(20) NOT NULL,
    START_DATE DATE NOT NULL,
    END_DATE DATE NOT NULL,
    FRONT_END_NUMBER DECIMAL(2, 0) NOT NULL,
    BACK_END_NUMBER DECIMAL(2, 0) NOT NULL,
    TESTING_NUMBER DECIMAL(2, 0) NOT NULL
);

-- -----------------------------------------------------
-- Create below: Table `proj`.`administers`
-- -----------------------------------------------------

CREATE TABLE administers
(
    ADMINISTER_ID DECIMAL(6, 0) PRIMARY KEY NOT NULL,
    SUBCOMPANY_ID DECIMAL(6, 0) NOT NULL,
    ADMINISTER_NAME VARCHAR(20) NOT NULL,
    LOCATION VARCHAR(20) NOT NULL
);

-- -----------------------------------------------------
-- Create below: Table `proj`.`subcompanies`
-- -----------------------------------------------------

CREATE TABLE subcompanies
(
    SUBCOMPANY_ID DECIMAL(6, 0) PRIMARY KEY NOT NULL,
    BUDGET VARCHAR(20) NOT NULL,
    LOCATION VARCHAR(20) NOT NULL
);