# Registry
Simple data store

### Dependencies
- [DB](https://github.com/evildevel/php-shell/tree/master/protected/modules/DB)

### Files
```
/protected
└── /modules
    └── /Registry
        ├── MANIFEST
        ├── README.md
        ├── class.php
        ├── conf.php
        ├── install.php
        └── uninstall.php
```

### Methods
```php
// Get registry data
mixed APP::Module('Registry')->Get(mixed $item[, mixed $fields = 'value'[, mixed $sub_id = 0]])

// Add registry data
int APP::Module('Registry')->Add(string $item, string $value[, int $sub_id = 0])

// Delete registry data
int APP::Module('Registry')->Delete(array $where)

// Update registry data
int APP::Module('Registry')->Update(array $fields, array $where)
```

### Examples
```php
// Get
APP::Module('Registry')->Get('foo');
APP::Module('Registry')->Get(['foo', 'bar']);
APP::Module('Registry')->Get(['foo'], 'bar');
APP::Module('Registry')->Get(['foo'], ['bar', 'baz']);
APP::Module('Registry')->Get(['foo'], ['bar'], 'baz');
APP::Module('Registry')->Get(['foo'], ['bar'], ['baz', 'quux']);

// Add
APP::Module('Registry')->Add('foo', 'bar');
APP::Module('Registry')->Add('foo', 'bar', 'baz');

// Delete
APP::Module('Registry')->Delete([['foo', '=', 'bar', PDO::PARAM_STR]]);
APP::Module('Registry')->Delete([
    ['foo', '=', 'bar', PDO::PARAM_STR],
    ['baz', '!=', 'quux', PDO::PARAM_INT]
]);

// Update
APP::Module('Registry')->Update(['foo' => 'bar'], [['baz', '=', 'quux', PDO::PARAM_STR]]);
```

### Database
```sql
-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2016 at 07:21 PM
-- Server version: 10.0.23-MariaDB-0+deb8u1
-- PHP Version: 7.0.9-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `auto`
--

-- --------------------------------------------------------

--
-- Table structure for table `registry`
--

CREATE TABLE `registry` (
  `id` mediumint(9) NOT NULL,
  `sub_id` mediumint(5) UNSIGNED NOT NULL,
  `item` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registry`
--
ALTER TABLE `registry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`item`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registry`
--
ALTER TABLE `registry`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
```