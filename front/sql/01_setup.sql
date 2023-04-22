DROP SCHEMA IF EXISTS `proj` ;
CREATE SCHEMA IF NOT EXISTS `proj` DEFAULT CHARACTER SET utf8 ;
USE `proj` ;

-- -----------------------------------------------------
-- Create below: Table `proj`.`employees`
-- -----------------------------------------------------

CREATE TABLE employees
(
    EMPLOYEE_ID VARCHAR(6) PRIMARY KEY NOT NULL,
    MANAGE_PROJECT_ID VARCHAR(6),
    EMPLOYEE_NAME VARCHAR(20) NOT NULL,
    AGE DECIMAL(2, 0) NOT NULL,
    ENTRY_DATE DATE NOT NULL,
    GENDER VARCHAR(20) NOT NULL,
    SALARY DECIMAL(8, 2) NOT NULL,
    POSITION VARCHAR(20) NOT NULL,
    LOCATION VARCHAR(20) NOT NULL,
    PASSWORD VARCHAR(20) NOT NULL
);

-- -----------------------------------------------------
-- Create below: Table `proj`.`projects`
-- -----------------------------------------------------

CREATE TABLE projects
(
    PROJECT_ID VARCHAR(6) PRIMARY KEY NOT NULL,
    ADMINISTRATOR_ID VARCHAR(6) NOT NULL,
    PROJECT_NAME VARCHAR(20) NOT NULL,
    START_DATE DATE NOT NULL,
    END_DATE DATE NOT NULL,
    FRONT_END_NUMBER DECIMAL(2, 0) NOT NULL,
    BACK_END_NUMBER DECIMAL(2, 0) NOT NULL,
    TESTING_NUMBER DECIMAL(2, 0) NOT NULL,
    BUDGET VARCHAR(20) NOT NULL
);

-- -----------------------------------------------------
-- Create below: Table `proj`.`administers`
-- -----------------------------------------------------

CREATE TABLE administrators
(
    ADMINISTRATOR_ID VARCHAR(6) PRIMARY KEY NOT NULL,
    SUBCOMPANY_ID VARCHAR(6) NOT NULL,
    ADMINISTRATOR_NAME VARCHAR(20) NOT NULL,
    PASSWORD VARCHAR(20) NOT NULL
);

-- -----------------------------------------------------
-- Create below: Table `proj`.`subcompanies`
-- -----------------------------------------------------

CREATE TABLE subcompanies
(
    SUBCOMPANY_ID VARCHAR(6) PRIMARY KEY NOT NULL,
    BUDGET VARCHAR(20) NOT NULL,
    LOCATION VARCHAR(20) NOT NULL
);

-- -----------------------------------------------------
-- Create below: Table `proj`.`jobs`
-- -----------------------------------------------------

CREATE TABLE jobs
(
    EMPLOYEE_ID VARCHAR(6) NOT NULL,
    PROJECT_ID VARCHAR(6) NOT NULL,
    PRIMARY KEY (EMPLOYEE_ID, PROJECT_ID)
);

-- -----------------------------------------------------
-- Create below: Table `proj`.`managers`
-- -----------------------------------------------------

CREATE TABLE managers
(
    MANAGER_ID VARCHAR(6) NOT NULL,
    PROJECT_ID VARCHAR(6) NOT NULL,
    PRIMARY KEY (MANAGER_ID, PROJECT_ID)
);