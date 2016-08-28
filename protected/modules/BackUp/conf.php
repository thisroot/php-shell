<?
return [
    'routes' => [
        ['admin\/backup(\?.*)?',                                         'BackUp', 'BackupList'],      // View all backups
        ['admin\/backup\/settings(\?.*)?',                                  'BackUp', 'Settings'],      // Settings
        ['admin\/backup\/api\/settings\/update\.json(\?.*)?', 'BackUp',      'APIUpdateSettings'],      // [API] Update settings
        ['backup\/make',                                                        'BackUp', 'Make'],      // make full backup 
    ],
    
    'dir_backup_DB' => 'db'
];