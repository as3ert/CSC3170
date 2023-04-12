-- Return employee information

SELECT employees.EMPLOYEE_ID, employees.EMPLOYEE_NAME, employees.AGE,
       employees.ENTRY_DATE, employees.GENDER, employees.SALARY, 
       employees.POSITION, employees.LOCATION
FROM employees 
WHERE employees.EMPLOYEE_ID = '000012';