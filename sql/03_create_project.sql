-- Create project

INSERT INTO `projects` (`PROJECT_ID`, `MANAGER_ID`, `ADMINISTER_ID`,
                       `PROJECT_NAME`, `START_DATE`, `END_DATE`, `FRONT_END_NUMBER`,
                       `BACK_END_NUMBER`, `TESTING_NUMBER`) VALUES 
('200001', '000011', '100001', 'Shenzhen_Project1', '2023-01-01', '2024-01-01', '1', '1', '1');

UPDATE `employees` SET `MANAGE_PROJECT_ID` = '200001' WHERE `EMPLOYEE_ID` = '000011';

INSERT INTO `projects` (`PROJECT_ID`, `MANAGER_ID`, `ADMINISTER_ID`,
                       `PROJECT_NAME`, `START_DATE`, `END_DATE`, `FRONT_END_NUMBER`,
                       `BACK_END_NUMBER`, `TESTING_NUMBER`) VALUES 
('200002', '000012', '100001', 'Shenzhen_Project2', '2023-01-02', '2024-01-02', '1', '1', '1');

UPDATE `employees` SET `MANAGE_PROJECT_ID` = '200002' WHERE `EMPLOYEE_ID` = '000010';

INSERT INTO `projects` (`PROJECT_ID`, `MANAGER_ID`, `ADMINISTER_ID`,
                       `PROJECT_NAME`, `START_DATE`, `END_DATE`, `FRONT_END_NUMBER`,
                       `BACK_END_NUMBER`, `TESTING_NUMBER`) VALUES 
('200003', '000010', '100003', 'Berlin_Project1', '2023-01-03', '2024-01-03', '1', '1', '1');

UPDATE `employees` SET `MANAGE_PROJECT_ID` = '200002' WHERE `EMPLOYEE_ID` = '000012';