-- Return project information

SELECT projects.PROJECT_ID, projects.PROJECT_NAME, administers.ADMINISTER_NAME,
       employees.EMPLOYEE_NAME, projects.START_DATE, projects.END_DATE, 
       projects.FRONT_END_NUMBER, projects.BACK_END_NUMBER, projects.TESTING_NUMBER,
       employees.LOCATION
FROM projects, employees, administers
WHERE projects.PROJECT_ID = '200001';