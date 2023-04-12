-- Create project

INSERT INTO `project` (`PROJECT_ID`, `MANAGER_ID`, `ADMINISTER_ID`,
                       `PROJECT_NAME`, `START_DATE`, `END_DATE`, `FRONT_END_NUMBER`,
                       `BACK_END_NUMBER`, `TESTING_NUMBER`) VALUES 
('200001', '000011', '100001', 'Project1', '2023-01-01', '2024-01-01', '1', '1', '1');

UPDATE `employees` SET `MANAGE_PROJECT_ID` = '200001' WHERE `EMPLOYEE_ID` = '000011';