# Logs
Manage log files

### Dependencies
- [Routing](https://github.com/evildevel/php-shell/tree/master/protected/modules/Routing)
- [Crypt](https://github.com/evildevel/php-shell/tree/master/protected/modules/Crypt)
- [Utils](https://github.com/evildevel/php-shell/tree/master/protected/modules/Utils)

### Files
```
/protected
├── /modules
│   └── /Logs
│       ├── MANIFEST
│       ├── README.md
│       ├── class.php
│       ├── conf.php
│       ├── install.php
│       └── uninstall.php
└── /render
    └── /logs
        └── /admin
            ├── index.php
            ├── nav.php
            ├── remove.php
            └── view.php
```

### WEB interfaces
```
/logs                   // Manage log files
/logs/view/<file>       // View log file
/logs/remove/<file>     // Remove log file
```