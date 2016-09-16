# BackUp
Manage backups for files and databases

### Dependencies

- [Routing](https://github.com/evildevel/php-shell/tree/master/protected/modules/Routing)
- [DB] (https://github.com/evildevel/php-shell/tree/master/protected/modules/DB)
- [Cron] (https://github.com/evildevel/php-shell/tree/master/protected/modules/Cron)
- [Registry] (https://github.com/evildevel/php-shell/tree/master/protected/modules/Registry)
- [Crypt](https://github.com/evildevel/php-shell/tree/master/protected/modules/Crypt)
- [Users] (https://github.com/evildevel/php-shell/tree/master/protected/modules/Users)

### Files
```
/protected
├── /modules
│   └── /BackUp
│       ├── MANIFEST
│       ├── README.md
│       ├── class.php
│       ├── conf.php
│       ├── install.php
│       └── uninstall.php
└── /render
    └── /backup
         └── admin
              ├── index.php
              ├── nav.php
              └── settings.php


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
        ['backup\/user\/server\/upload(\?.*)?',                  'BackUp', 'GetFile'],                  // Get and save backup archieve /user 
        ['backup\/user\/api\/server\/list\.json(\?.*)?',         'BackUp', 'APIServerList'],            // [API] Get backups list (use APIClientList) /user
        ['backup\/api\/server\/download\.json(\?.*)?',           'BackUp', 'APIServerDownload'],        // [API] Download archieve (use APIClienDownload) /default
        ['backup\/api\/server\/remove\.json(\?.*)?',             'BackUp', 'APIServerRemove'],          // [API] Remove archieve (use APIClientRemove) /default
        ['backup\/api\/server\/params\.json(\?.*)?',             'BackUp', 'APIServerParams'],          // [API] Get server params (use APIClientRemove) /default

```

### WEB interfaces
```
/admin/backup/list              // Manage backups
/admin/backup/settings          // Manage settings

```

### API interfaces
```
#### Client mode && Server mode (request on the self server)

/admin/backup/api/settings/update.json      // Edit settings
/admin/backup/api/add.json                  // Create point of backup
/admin/backup/api/list.json                 // Get backups list
/admin/backup/api/restore.json              // Resore point of backup

#### Server mode (requests on the remote server)

/backup/user/api/server/list.json           // Get backups list
/backup/api/server/download.json            // Download .zip archive   
/backup/api/server/remove.json              // Remove point of backup
/backup/api/server/params.json              // Get server params
 
```

### Methods
```
/admin/backup/make                          // Make and get full backup /admin
/admin/backup/send                          // Settings /admin
/backup/user/server/upload                  // Server mode: Get and save backup archieve /user 

```
```
