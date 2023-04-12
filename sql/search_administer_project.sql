-- Return project_ID belong to the administer

SELECT projects.PROJECT_ID
FROM projects, administers
WHERE administer.ADMINISTER_ID = '100001' AND
      projects.ADMINISTER_ID = administers.ADMINISTER_ID;