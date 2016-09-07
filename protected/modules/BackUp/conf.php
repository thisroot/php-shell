<?
return [
    'routes' => [
        // Views
        ['admin\/backup\/list(\?.*)?',                           'BackUp', 'BackupList'],               // View all backups /admin
        ['admin\/backup\/settings(\?.*)?',                       'BackUp', 'Settings'],                 // Settings /admin
        
        // Client methods
        ['admin\/backup\/make',                                  'BackUp', 'Make'],                     // Make and get full backup /admin
        ['admin\/backup\/send',                                  'BackUp', 'SendFile'],                 // Make backup and send it on a remote server /admin
        ['admin\/backup\/api\/settings\/update\.json(\?.*)?',    'BackUp', 'APIClientUpdateSettings'],  // [API] Update settings /admin
        ['admin\/backup\/api\/add\.json',                        'BackUp', 'APIClientAddBackUp'],       // [API] Create point of backup /admin
        ['admin\/backup\/api\/list\.json',                       'BackUp', 'APIClientList'],            // [API] Get backups list /admin
        ['admin\/backup\/api\/restore\.json',                    'BackUp', 'APIClientRestore'],         // [API] Resore point of backup /admin
                
        // Server mode
        ['backup\/user\/server\/upload(\?.*)?',                  'BackUp', 'GetFile'],                  // [API] Get and save backup archieve /user 
        ['backup\/user\/api\/server\/list\.json(\?.*)?',         'BackUp', 'APIServerList'],            // [API] Get backups list (use APIClientList) /user
        ['backup\/api\/server\/download\.json(\?.*)?',           'BackUp', 'APIServerDownload'],        // [API] Download archieve (use APIClienDownload) /default
        ['backup\/api\/server\/remove\.json(\?.*)?',             'BackUp', 'APIServerRemove'],          // [API] Remove archieve (use APIClientRemove) /default
        ['backup\/api\/server\/params\.json(\?.*)?',             'BackUp', 'APIServerParams'],          // [API] Get server params (use APIClientRemove) /default
        
    ],
    'connection' => 'auto',
    'dir_backup_DB' => 'db'
];