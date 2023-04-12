-- Return project_ID belong to the administer

SELECT projects.PROJECT_ID
FROM projects
WHERE projects.ADMINISTER_ID = '100001';