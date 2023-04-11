USE proj;

-- -----------------------------------------------------

INSERT INTO `employees` (`EMPLOYEE_ID`, `EMPLOYEE_NAME`, `SALARY`,
                         `POSITION`, `LOCATION`) VALUES 
('000001', 'John', '11000', 'Front End', 'Shenzhen'),
('000002', 'Mary', '13000', 'Front End', 'Shenzhen'),
('000003', 'Peter', '12000', 'Front End', 'Shenzhen'),
('000004', 'Andrew', '11000', 'Front End', 'New York'),
('000005', 'Robert', '15000', 'Front End', 'New York'),
('000006', 'Michael', '8000', 'Front End', 'New York'),
('000007', 'Thomas', '14000', 'Front End', 'Berlin'),
('000008', 'Charles', '12000', 'Front End', 'Berlin'),
('000009', 'Christopher', '11000', 'Front End', 'Berlin'),
('000010', 'Song', '21000', 'Front End', 'Berlin'),
('000011', 'Arthur', '31000', 'Back End', 'Shenzhen'),
('000012', 'Paul', '17000', 'Back End', 'Shenzhen'),
('000013', 'Mark', '20000', 'Back End', 'Shenzhen'),
('000014', 'William', '26000', 'Back End', 'New York'),
('000015', 'Richard', '23000', 'Back End', 'New York'),
('000016', 'Joseph', '17000', 'Back End', 'New York'),
('000017', 'Daniel', '20000', 'Back End', 'Berlin'),
('000018', 'Matthew', '19000', 'Back End', 'Berlin'),
('000019', 'Anthony', '16000', 'Back End', 'Berlin'),
('000020', 'Donald', '21000', 'Back End', 'Berlin'),
('000021', 'James', '9000', 'Testing', 'Shenzhen'),
('000022', 'David', '12000', 'Testing', 'Shenzhen'),
('000023', 'Steven', '21000', 'Testing', 'Shenzhen'),
('000024', 'Mark', '14000', 'Testing', 'New York'),
('000025', 'Paul', '15000', 'Testing', 'New York'),
('000026', 'George', '13000', 'Testing', 'New York'),
('000027', 'Kenneth', '11000', 'Testing', 'Berlin'),
('000028', 'Andrew', '12000', 'Testing', 'Berlin'),
('000029', 'Edward', '10000', 'Testing', 'Berlin'),
('000030', 'Brian', '11000', 'Testing', 'Berlin');

INSERT INTO `administers` (`ADMINISTER_ID`, `SUBCOMPANY_ID`,
                           `ADMINISTER_NAME`, `LOCATION`) VALUES
('100001', '000001', 'Lucas', 'Shenzhen'),
('100002', '000002', 'Lily', 'New York'),
('100003', '000003', 'Tom', 'Berlin');

INSERT INTO `subcompanies` (`SUBCOMPANY_ID`, `BUDGET`, `LOCATION`) VALUES
('000001', '200000', 'Shenzhen'),
('000002', '200000', 'New York'),
('000003', '200000', 'Berlin');