-- Create project

INSERT INTO `projects` (`PROJECT_ID`, `ADMINISTRATOR_ID`,
                       `PROJECT_NAME`, `START_DATE`, `END_DATE`, `FRONT_END_NUMBER`,
                       `BACK_END_NUMBER`, `TESTING_NUMBER`,  `BUDGET`) VALUES 
('200001', '100001', 'Shenzhen_Project1', '2023-01-01', '2024-01-01', '1', '1', '1', '100000');

INSERT INTO `projects` (`PROJECT_ID`, `ADMINISTRATOR_ID`,
                       `PROJECT_NAME`, `START_DATE`, `END_DATE`, `FRONT_END_NUMBER`,
                       `BACK_END_NUMBER`, `TESTING_NUMBER`,  `BUDGET`) VALUES 
('200002', '100001', 'Shenzhen_Project2', '2023-01-02', '2024-01-02', '1', '1', '1', '100000');

INSERT INTO `projects` (`PROJECT_ID`, `ADMINISTRATOR_ID`,
                       `PROJECT_NAME`, `START_DATE`, `END_DATE`, `FRONT_END_NUMBER`,
                       `BACK_END_NUMBER`, `TESTING_NUMBER`,  `BUDGET`) VALUES 
('200003', '100003', 'Berlin_Project1', '2023-01-03', '2024-01-03', '1', '1', '1', '100000');

# project in New York
INSERT INTO `projects` (`PROJECT_ID`, `ADMINISTRATOR_ID`,
                       `PROJECT_NAME`, `START_DATE`, `END_DATE`, `FRONT_END_NUMBER`,
                       `BACK_END_NUMBER`, `TESTING_NUMBER`,  `BUDGET`) VALUES 
('200004', '100003', 'NewYork_Project1', '2023-04-03', '2023-12-30', '3', '2', '2', '100000');

-- Set managers
INSERT INTO `managers` (`PROJECT_ID`, `MANAGER_ID`) VALUES  ('200001', '000001');
INSERT INTO `managers` (`PROJECT_ID`, `MANAGER_ID`) VALUES  ('200002', '000005');
INSERT INTO `managers` (`PROJECT_ID`, `MANAGER_ID`) VALUES  ('200003', '000015');

UPDATE `employees` SET `MANAGE_PROJECT_ID` = '200001' WHERE `EMPLOYEE_ID` = '000001';
UPDATE `employees` SET `MANAGE_PROJECT_ID` = '200002' WHERE `EMPLOYEE_ID` = '000005';
UPDATE `employees` SET `MANAGE_PROJECT_ID` = '200003' WHERE `EMPLOYEE_ID` = '000015';

# UPDATE `employees` SET `MANAGE_PROJECT_ID` = '200002' WHERE `EMPLOYEE_ID` = '000015';
