-- Return project_ID belong to the employee

SELECT projects.PROJECT_ID
FROM projects, jobs
WHERE jobs.EMPLOYEE_ID = '000011';