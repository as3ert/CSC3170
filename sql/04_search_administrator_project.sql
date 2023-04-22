-- Return project_ID belong to the administrator

SELECT projects.PROJECT_ID
FROM projects
WHERE projects.ADMINISTRATOR_ID = '100001';