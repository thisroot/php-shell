<?
return [
    'routes' => [
      ['', 'Student', 'Index'],                                          // View all backups /admin
      ['students\/lectures\/add(\?.*)?', 'Student', 'AddLection'],               // View all backups /admin
      ['students\/api\/get\/country.json(\?.*)?', 'Student', 'GetCountry']               // View all backups /admin
    ]
];