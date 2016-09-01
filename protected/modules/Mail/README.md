# Mail
Simple E-Mail sending. Senders and letters management system.

### Dependencies
- [Routing](https://github.com/evildevel/php-shell/tree/master/protected/modules/Routing)
- [Crypt](https://github.com/evildevel/php-shell/tree/master/protected/modules/Crypt)
- [Registry](https://github.com/evildevel/php-shell/tree/master/protected/modules/Registry)
- [DB](https://github.com/evildevel/php-shell/tree/master/protected/modules/DB)
- [Triggers](https://github.com/evildevel/php-shell/tree/master/protected/modules/Triggers)

### Files
```
/protected
├── /modules
│   └── /Mail
│       ├── MANIFEST
│       ├── README.md
│       ├── class.php
│       ├── conf.php
│       ├── install.php
│       └── uninstall.php
└── /render
    └── /mail
        └── /admin
            ├── /letters
            │   ├── /groups
            │   │   ├── add.php
            │   │   └── edit.php
            │   ├── add.php
            │   ├── edit.php
            │   ├── index.php
            │   └── preview.php
            ├── /senders
            │   ├── /groups
            │   │   ├── add.php
            │   │   └── edit.php
            │   ├── add.php
            │   ├── edit.php
            │   └── index.php
            ├── nav.php
            └── settings.php
```

### Methods
```php
// Send E-Mail message
array APP::Module('Mail')->Send(array $from, string $to, string $subject, array $message[, array $headers = false])
```

### Examples
```php
APP::Module('Mail')->Send(
    Array(
        'from email', 
        'from name'
    ), 
    'to email', 
    'subject', 
    Array(
        'html message',
        'plaintext message'
    ),
    // headers (optional)
    Array(
        'List-id' => 'php-shell'
    )
);
```

### Triggers
- Add letter
- Remove letter
- Update letter
- Add group of letters
- Remove group of letters
- Update group of letters
- Add sender
- Remove sender
- Update sender
- Add group of senders
- Remove group of senders
- Update group of senders
- Update mail settings
- Send mail

### WEB interfaces
```
/admin/mail/letters/<group_sub_id_hash>/preview/<letter_id_hash>         // Preview letter
/admin/mail/letters/<group_sub_id_hash>/groups/add                       // Add letters group
/admin/mail/letters/<group_sub_id_hash>/groups/<group_id_hash>/edit      // Edit letters group
/admin/mail/letters/<group_sub_id_hash>/add                              // Add letter
/admin/mail/letters/<group_sub_id_hash>/edit/<letter_id_hash>            // Edit letter
/admin/mail/letters/<group_sub_id_hash>                                  // Manage letters
/admin/mail/senders/<group_sub_id_hash>/groups/add                       // Add senders group
/admin/mail/senders/<group_sub_id_hash>/groups/<group_id_hash>/edit      // Edit senders group
/admin/mail/senders/<group_sub_id_hash>/add                              // Add sender
/admin/mail/senders/<group_sub_id_hash>/edit/<sender_id_hash>            // Edit sender
/admin/mail/senders/<group_sub_id_hash>                                  // Manage senders
/admin/mail/settings                                                     // Mail settings

/admin/mail/api/letters/add.json                                         // [API] Add letter
/admin/mail/api/letters/remove.json                                      // [API] Remove letter
/admin/mail/api/letters/update.json                                      // [API] Update letter
/admin/mail/api/letters/groups/add.json                                  // [API] Add letters group
/admin/mail/api/letters/groups/remove.json                               // [API] Remove letters group
/admin/mail/api/letters/groups/update.json                               // [API] Update letters group
/admin/mail/api/senders/add.json                                         // [API] Add sender
/admin/mail/api/senders/remove.json                                      // [API] Remove sender
/admin/mail/api/senders/update.json                                      // [API] Update sender
/admin/mail/api/senders/groups/add.json                                  // [API] Add senders group
/admin/mail/api/senders/groups/remove.json                               // [API] Remove senders group
/admin/mail/api/senders/groups/update.json                               // [API] Update senders group
/admin/mail/api/settings/update.json                                     // [API] Update mail settings
```

### Database
```sql
-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2016 at 07:17 PM
-- Server version: 10.0.23-MariaDB-0+deb8u1
-- PHP Version: 7.0.9-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `auto`
--

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

CREATE TABLE `letters` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `group_id` smallint(5) UNSIGNED NOT NULL,
  `sender_id` smallint(5) UNSIGNED NOT NULL,
  `subject` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `html` text COLLATE utf8_unicode_ci NOT NULL,
  `plaintext` text COLLATE utf8_unicode_ci NOT NULL,
  `list_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Письма';

-- --------------------------------------------------------

--
-- Table structure for table `letters_groups`
--

CREATE TABLE `letters_groups` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `sub_id` smallint(5) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Группы писем';

-- --------------------------------------------------------

--
-- Table structure for table `senders`
--

CREATE TABLE `senders` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `group_id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Отправители';

-- --------------------------------------------------------

--
-- Table structure for table `senders_groups`
--

CREATE TABLE `senders_groups` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `sub_id` smallint(5) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Группы отправителей';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`,`sender_id`,`list_id`),
  ADD KEY `group_id_2` (`group_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `letters_groups`
--
ALTER TABLE `letters_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- Indexes for table `senders`
--
ALTER TABLE `senders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `senders_groups`
--
ALTER TABLE `senders_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_id` (`sub_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `letters`
--
ALTER TABLE `letters`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `letters_groups`
--
ALTER TABLE `letters_groups`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `senders`
--
ALTER TABLE `senders`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `senders_groups`
--
ALTER TABLE `senders_groups`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `letters`
--
ALTER TABLE `letters`
  ADD CONSTRAINT `letters_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `letters_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `letters_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `senders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `senders`
--
ALTER TABLE `senders`
  ADD CONSTRAINT `senders_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `senders_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
```