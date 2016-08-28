# Sessions
Storing Sessions in a Database

### Dependencies
- [Routing](https://github.com/evildevel/php-shell/tree/master/protected/modules/Routing)
- [Crypt](https://github.com/evildevel/php-shell/tree/master/protected/modules/Crypt)
- [DB](https://github.com/evildevel/php-shell/tree/master/protected/modules/DB)
- [Registry](https://github.com/evildevel/php-shell/tree/master/protected/modules/Registry)

### Files
```
/protected
├── /modules
│   └── /Sessions
│       ├── MANIFEST
│       ├── README.md
│       ├── class.php
│       ├── conf.php
│       ├── install.php
│       └── uninstall.php
└── /render
    └── /sessions
        └── /admin
            ├── index.php
            └── nav.php
```

### Properties
```php
// An array containing session variables
mixed APP::Module('Sessions')->session
```

### Methods
```php
// Read session data
mixed APP::Module('Sessions')->Read(string $id)

// Write session data
bool APP::Module('Sessions')->Write(string $id, string $data)

// Destroy session
bool APP::Module('Sessions')->Destroy(string $id)

// Serialize session data
string APP::Module('Sessions')->Serialize(mixed $data[, bool $safe = true])

// Unserialize session data
mixed APP::Module('Sessions')->Unserialize(string $data)
```

### WEB interfaces
```
/admin/sessions                              // Sessions settings
/admin/sessions/api/settings/update.json     // [API] Update sessions settings
```

### Database
```sql
-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2016 at 07:46 PM
-- Server version: 10.0.23-MariaDB-0+deb8u1
-- PHP Version: 7.0.9-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `auto`
--

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `touched` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);
```