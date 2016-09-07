# Logs
Prepare to exams

### Dependencies
- [Routing](https://github.com/evildevel/php-shell/tree/master/protected/modules/Routing)
- [Crypt](https://github.com/evildevel/php-shell/tree/master/protected/modules/DB)

### Files
```
/protected
├── /modules
│   └── /Examine
│       ├── MANIFEST
│       ├── README.md
│       ├── class.php
│       ├── conf.php
│       ├── install.php
│       └── uninstall.php
└── /render
    └── /examine
            ├── index.php
            ├── add.php
```

### WEB interfaces
```
/examine                 // View examines questions
/examine/add/            // add question
/api/examine/items.json  // get question items
/api/examine/add.json    // set question items
/api/examine/edit.json   // edit question items

```