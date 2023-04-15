-- Return project information

SELECT projects.PROJECT_ID, projects.PROJECT_NAME, administrators.ADMINISTRATOR_NAME,
       employees.EMPLOYEE_NAME, projects.START_DATE, projects.END_DATE, 
       projects.FRONT_END_NUMBER, projects.BACK_END_NUMBER, projects.TESTING_NUMBER,
       employees.LOCATION
FROM projects, employees, administrators, managers
WHERE projects.PROJECT_ID = '200001' AND
      managers.MANAGER_ID = employees.EMPLOYEE_ID AND
      managers.PROJECT_ID = projects.PROJECT_ID AND
      projects.ADMINISTRATOR_ID = administrators.ADMINISTRATOR_ID;