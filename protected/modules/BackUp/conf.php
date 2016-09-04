<?
return [
    'routes' => [
        // Views
        ['admin\/backup(\?.*)?',                                    'BackUp', 'BackupList'],            // View all backups /admin
        ['admin\/backup\/settings(\?.*)?',                          'BackUp', 'Settings'],              // Settings /admin
        
        // Client methods
        ['admin\/backup\/make',                                     'BackUp', 'Make'],                  // Make and get full backup /admin
        ['admin\/backup\/send',                                     'BackUp', 'SendFile'],              // Make backup and send it on a remote server /admin
        ['admin\/backup\/api\/settings\/update\.json(\?.*)?',       'BackUp', 'APIUpdateSettings'],               // [API] Update settings /admin
        ['admin\/backup\/api\/list\.json',                          'BackUp', 'APIClientList'],         // [API] Get backups list /admin
                
        // Server mode
        ['backup\/user\/server\/upload(\?.*)?',                     'BackUp', 'GetFile'],               // [API] Get and save backup archieve /user 
        ['backup\/user\/api\/server\/list\.json',                   'BackUp', 'APIServerList'],         // [API] Get backups list (use APIClientList) /user
        ['backup\/api\/server\/download\.json',                     'BackUp', 'APIServerDownload'],     // [API] Download archieve (use APIClienDownload) /default
        ['backup\/api\/server\/remove\.json',                       'BackUp', 'APIServerRemove'],       // [API] Remove archieve (use APIClientRemove) /default
                 
    ],
    'connection' => 'auto',
    'dir_backup_DB' => 'db'
];