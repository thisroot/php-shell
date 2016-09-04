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
```

### WEB interfaces
```
/backup/make              // Make full backup and download .zip archieve 
/admin/backup             // Get list of all backups
/admin/backup/settings    // Edit settings

```

### API interfaces
```
/admin/backup/api/settings/update.json      // Edit settings
```