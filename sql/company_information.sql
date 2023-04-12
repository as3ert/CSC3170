-- Return company information

SELECT subcompanies.SUBCOMPANY_ID, subcompanies.BUDGET - SUM(employees.SALARY),
       subcompanies.LOCATION
FROM subcompanies, employees, jobs
WHERE subcompanies.SUBCOMPANY_ID = '000001' AND 
      employees.LOCATION = subcompanies.LOCATION AND
      (distinct employees.EMPLOYEE_ID) IN jobs.EMPLOYEE_ID;