-- Return project_ID belong to the administer

SELECT projects.PROJECT_ID
FROM projects,managers
WHERE projects.ADMINISTER_ID = '100001' AND
	  projects.PROJECT_ID = managers.PROJECT_ID; # need change

-- Return project_ID belong to the employee

SELECT jobs.PROJECT_ID
FROM jobs
WHERE jobs.EMPLOYEE_ID = '000011';  # need change

-- Return project information

SELECT projects.PROJECT_ID, projects.PROJECT_NAME, administers.ADMINISTER_NAME,
       employees.EMPLOYEE_NAME, projects.START_DATE, projects.END_DATE, managers.MANAGER_ID,
       projects.FRONT_END_NUMBER, projects.BACK_END_NUMBER, projects.TESTING_NUMBER,
       employees.LOCATION
FROM projects, employees, administers, managers
WHERE projects.PROJECT_ID = '200001' AND  # need change
      managers.MANAGER_ID = employees.EMPLOYEE_ID AND
      projects.ADMINISTER_ID = administers.ADMINISTER_ID AND
      projects.PROJECT_ID = managers.PROJECT_ID;
      
-- Return company information

SELECT subcompanies.SUBCOMPANY_ID, subcompanies.BUDGET - SUM(employees.SALARY),
       subcompanies.LOCATION
FROM subcompanies, employees
WHERE subcompanies.SUBCOMPANY_ID = '000001' AND  # need change
      employees.LOCATION = subcompanies.LOCATION AND
      employees.EMPLOYEE_ID IN (SELECT jobs.EMPLOYEE_ID
                                FROM jobs);
                                
-- Return employee information

SELECT employees.EMPLOYEE_ID, employees.EMPLOYEE_NAME, employees.AGE,
       employees.ENTRY_DATE, employees.GENDER, employees.SALARY, 
       employees.POSITION, employees.LOCATION
FROM employees 
WHERE employees.EMPLOYEE_ID = '000012'; # need change

-- Return information of avaiable back end employees

SELECT E1.EMPLOYEE_ID, E1.EMPLOYEE_NAME, E1.AGE,
       E1.ENTRY_DATE, E1.GENDER, E1.SALARY
FROM employees as E1, employees as E2, projects, managers
WHERE projects.PROJECT_ID = '200001' AND  # need change
      managers.MANAGER_ID = E2.EMPLOYEE_ID AND
      E1.LOCATION = E2.LOCATION AND
      E1.POSITION = 'Back End' AND
      ISNULL(E1.MANAGE_PROJECT_ID) = 1;
      
-- Return information of avaiable front end employees

SELECT E1.EMPLOYEE_ID, E1.EMPLOYEE_NAME, E1.AGE,
       E1.ENTRY_DATE, E1.GENDER, E1.SALARY
FROM employees as E1, employees as E2, projects, managers
WHERE projects.PROJECT_ID = '200001' AND  # need change
      managers.MANAGER_ID = E2.EMPLOYEE_ID AND
      E1.LOCATION = E2.LOCATION AND
      E1.POSITION = 'Front End' AND
      ISNULL(E1.MANAGE_PROJECT_ID) = 1;
      
-- Return information of avaiable testing employees

SELECT E1.EMPLOYEE_ID, E1.EMPLOYEE_NAME, E1.AGE,
       E1.ENTRY_DATE, E1.GENDER, E1.SALARY
FROM employees as E1, employees as E2, projects, managers
WHERE projects.PROJECT_ID = '200001' AND   # need change
      managers.MANAGER_ID = E2.EMPLOYEE_ID AND
      E1.LOCATION = E2.LOCATION AND
      E1.POSITION = 'Testing' AND
      ISNULL(E1.MANAGE_PROJECT_ID) = 1;
