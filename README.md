# CSC3170 Course Project

## 1. Project Overall Description

This is our implementation for the course project of CSC3170, 2023 Spring, CUHK(SZ). For details of the project, you can refer to [CSC3170_Project_Report.pdf](CSC3170_Project_Report.pdf).

## 2. Team Members

Our team consists of the following members, listed in the table below (the team leader is shown in the first row, and is marked with 🚩 behind his name):

<!-- change the info below to be the real case -->

| Student ID | Student Name |
| ---------- | ------------ |
| 120090086  | 李子健 🚩    |
| 120090244  | 赵广昕       |
| 120090581  | 丁奕杰       |
| 120090873  | 张雨阳       |
| 120090090  | 李浩贤       |
| 121090344  | 刘铭昊       |
| 120090102  | 曹若曦       |

## 3. How to run

Our code include following files:

### SQL files

    01_setup.sql --> set up the sql tables
    02_insert.sql --> create 3 sub-companies, 3 administrators and 30 employees

### PHP and CSS files

    config.php
    login.php --> login page
    login.css
    worker.php --> employee information page
    worker.css
    administrator.php --> administrator information page
    adm_1.php --> recruit and dismiss employees page
    adm_2.php --> create new projects page

If you want to run the code. First, please open mysql and connect to the local server, then run the first two sql files. Second, change the password and username into your own in the config.php file. Finally, go to the login.php file and run the code, login the website using employees' or administrators' ID and password, which are set in advance (for example, ID: 100001, password: 123456).

#### some other SQL files (used in simulation):

    03_search_administer_project.sql
    04_search_administrator_project.sql
    05_search_employee_project.sql
    06_project_information.sql
    07_company_information.sql
    08_employee_information.sql
    09_search_available_back_end.sql
    10_search_available_front_end.sql
    11_search_available_testing.sql
