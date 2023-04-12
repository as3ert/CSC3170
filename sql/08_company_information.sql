-- Return company information

SELECT subcompanies.SUBCOMPANY_ID, subcompanies.BUDGET - SUM(employees.SALARY),
       subcompanies.LOCATION
FROM subcompanies, employees
WHERE subcompanies.SUBCOMPANY_ID = '000001' AND 
      employees.LOCATION = subcompanies.LOCATION AND
      employees.EMPLOYEE_ID IN (SELECT jobs.EMPLOYEE_ID
                                FROM jobs);