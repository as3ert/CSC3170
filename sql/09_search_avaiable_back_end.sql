-- Return information of avaiable back end employees

SELECT E1.EMPLOYEE_ID, E1.EMPLOYEE_NAME, E1.AGE,
       E1.ENTRY_DATE, E1.GENDER, E1.SALARY
FROM employees as E1, employees as E2, managers
WHERE managers.PROJECT_ID = '200001' AND 
      managers.MANAGER_ID = E2.EMPLOYEE_ID AND
      E1.LOCATION = E2.LOCATION AND
      E1.POSITION = 'Back End' AND
      ISNULL(E1.MANAGE_PROJECT_ID) = 1;