USE proj;

-- -----------------------------------------------------

INSERT INTO `employees` (`EMPLOYEE_ID`, `EMPLOYEE_NAME`, `AGE`, `ENTRY_DATE`,
                         `GENDER`, `SALARY`, `POSITION`, `LOCATION`, `PASSWORD`) VALUES
('000001', 'John', '24', '2021-08-14', 'Male', '11000', 'Front End', 'Shenzhen', '123456'),
('000002', 'Mary', '23', '2022-07-18', 'Female', '13000', 'Front End', 'Shenzhen', '123456'),
('000003', 'Peter', '26', '2020-01-04', 'Male', '12000', 'Front End', 'Shenzhen', '123456'),
('000004', 'Andrew', '27', '2019-06-05', 'Male', '11000', 'Front End', 'New York', '123456'),
('000005', 'Robert', '25', '2020-09-30', 'Male', '15000', 'Front End', 'New York', '123456'),
('000006', 'Michael', '26', '2021-06-07', 'Female', '8000', 'Front End', 'New York', '123456'),
('000007', 'Thomas', '22', '2022-08-19', 'Male', '14000', 'Front End', 'Berlin', '123456'),
('000008', 'Charles', '29', '2017-04-18', 'Female', '12000', 'Front End', 'Berlin', '123456'),
('000009', 'Christopher', '30', '2017-01-20', 'Female', '11000', 'Front End', 'Berlin', '123456'),
('000010', 'Song', '21', '2022-03-13', 'Female', '21000', 'Front End', 'Berlin', '123456'),
('000011', 'Arthur', '22', '2021-12-30', 'Male', '31000', 'Back End', 'Shenzhen', '123456'),
('000012', 'Paul', '24', '2021-06-08', 'Male', '17000', 'Back End', 'Shenzhen', '123456'),
('000013', 'Mark', '26', '2020-03-05', 'Male', '20000', 'Back End', 'Shenzhen', '123456'),
('000014', 'William', '28', '2019-11-11', 'Male', '26000', 'Back End', 'New York', '123456'),
('000015', 'Richard', '24', '2021-08-18', 'Male', '23000', 'Back End', 'New York', '123456'),
('000016', 'Joseph', '27', '2019-01-15', 'Male', '17000', 'Back End', 'New York', '123456'),
('000017', 'Daniel', '25', '2021-12-02', 'Male', '20000', 'Back End', 'Berlin', '123456'),
('000018', 'Matthew', '29', '2019-09-02', 'Male', '19000', 'Back End', 'Berlin', '123456'),
('000019', 'Anthony', '22', '2022-10-01', 'Female', '16000', 'Back End', 'Berlin', '123456'),
('000020', 'Donald', '25', '2021-06-03', 'Male', '21000', 'Back End', 'Berlin', '123456'),
('000021', 'Jane', '23', '2022-07-09', 'Female', '9000', 'Testing', 'Shenzhen', '123456'),
('000022', 'David', '26', '2021-01-02', 'Male', '12000', 'Testing', 'Shenzhen', '123456'),
('000023', 'Steven', '28', '2020-01-01', 'Male', '21000', 'Testing', 'Shenzhen', '123456'),
('000024', 'Mark', '24', '2021-08-26', 'Male', '14000', 'Testing', 'New York', '123456'),
('000025', 'Paul', '23', '2022-09-24', 'Male', '15000', 'Testing', 'New York', '123456'),
('000026', 'George', '24', '2021-03-16', 'Male', '13000', 'Testing', 'New York', '123456'),
('000027', 'Kenneth', '23', '2022-06-28', 'Female', '11000', 'Testing', 'Berlin', '123456'),
('000028', 'Andrew', '27', '2019-08-09', 'Male', '12000', 'Testing', 'Berlin', '123456'),
('000029', 'Edward', '29', '2027-07-18', 'Female', '10000', 'Testing', 'Berlin', '123456'),
('000030', 'Brian', '28', '2021-08-29', 'Male', '11000', 'Testing', 'Berlin', '123456');

INSERT INTO `administrators` (`ADMINISTRATOR_ID`, `SUBCOMPANY_ID`,
                           `ADMINISTRATOR_NAME`, `PASSWORD`) VALUES
('100001', '000001', 'Lucas', '123456'),
('100002', '000002', 'Lily', '123456'),
('100003', '000003', 'Tom', '123456');

INSERT INTO `subcompanies` (`SUBCOMPANY_ID`, `BUDGET`, `LOCATION`) VALUES
('000001', '200000', 'Shenzhen'),
('000002', '200000', 'New York'),
('000003', '200000', 'Berlin');