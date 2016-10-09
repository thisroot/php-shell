<?
return [
    'routes' => [
      ['',                                                               'Student', 'LectureFind'],              // View all backups /admin
      ['students\/user\/lectures\/add(\?.*)?',                           'Student', 'LectureAdd'],         // View all backups /admin
      ['students\/user\/lectures\/list(\?.*)?',                          'Student', 'LectureList'],        // View all backups /admin
      ['students\/lectures\/find(\?.*)?',                                'Student', 'LectureFind'],        // View all backups /admin
      ['students\/user\/lecture\/(?P<hash>.*)\/edit(\?.*)?',             'Student', 'LectureEdit'],        // View all backups /admin
      ['students\/user\/lecture\/(?P<hash>.*)(\?.*)?',                   'Student', 'LectureView'],        // View all backups /admin
      ['students\/user\/settings(\?.*)?',                                'Student', 'UserSettings'],       // View all backups /admin
        
        
      ['students\/user\/api\/edit\/settings.json(\?.*)?',                'Student', 'APIUserSettings'],    // View all backups /admin
      ['students\/user\/api\/get\/vkdata.json(\?.*)?',                   'Student', 'APIGetVkData'],       // View all backups /admin
      ['students\/user\/api\/get\/filter\/lectures.json(\?.*)?',         'Student', 'APILectureFind'],     // View all backups /admin
      ['students\/user\/api\/add\/lecture.json(\?.*)?',                  'Student', 'APILectureAdd'],      // View all backups /admin
      ['students\/user\/api\/edit\/lecture.json(\?.*)?',                 'Student', 'APILectureEdit'],     // View all backups /admi
      ['students\/user\/api\/add\/block.json(\?.*)?',                    'Student', 'APIBlockAdd'],        // View all backups /admin
      ['students\/user\/api\/edit\/block.json(\?.*)?',                   'Student', 'APIBlockEdit'],       // View all backups /admin
      ['students\/user\/api\/get\/list.json(\?.*)?',                     'Student', 'APIBlockList'],       // View all backups /admin
      ['students\/user\/api\/delete\/block.json(\?.*)?',                 'Student', 'APIBlockDelete'],     // View all backups /admin
      ['students\/user\/api\/delete\/lecture.json(\?.*)?',               'Student', 'APILectureDelete'],   // View all backups /admin
      ['students\/user\/api\/get\/lectures\/list.json(\?.*)?',           'Student', 'APILectureList'],     // View all backups /admin
      ['students\/api\/get\/lectures\/list.json(\?.*)?',                 'Student', 'APILectureOpenList']  // View all backups /admin
    ]
];