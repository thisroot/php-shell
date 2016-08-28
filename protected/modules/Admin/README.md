# Admin
Tools for managing system components

### Dependencies
- [Routing](https://github.com/evildevel/php-shell/tree/master/protected/modules/Routing)
- [Utils](https://github.com/evildevel/php-shell/tree/master/protected/modules/Utils)
- [Crypt](https://github.com/evildevel/php-shell/tree/master/protected/modules/Crypt)

### Files
```
/protected
├── /modules
│   └── /Admin
│       ├── MANIFEST
│       ├── README.md
│       ├── class.php
│       ├── conf.php
│       ├── install.php
│       └── uninstall.php
└── /render
    └── /admin
        ├── /app
        │   ├── /modules
        │   │   ├── import.php
        │   │   ├── network_import.php
        │   │   ├── uninstall.php
        │   │   └── install.php
        │   └── index.php
        ├── index.php
        └── system.php
```

### WEB interfaces
```
/admin          // Manage components
/admin/system   // System monitoring
/admin/app      // Application monitoring
```