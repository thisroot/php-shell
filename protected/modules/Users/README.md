# Users
User management system

### Dependencies
- [Routing](https://github.com/evildevel/php-shell/tree/master/protected/modules/Routing)
- [Sessions](https://github.com/evildevel/php-shell/tree/master/protected/modules/Sessions)
- [Crypt](https://github.com/evildevel/php-shell/tree/master/protected/modules/Crypt)
- [DB](https://github.com/evildevel/php-shell/tree/master/protected/modules/DB)
- [Registry](https://github.com/evildevel/php-shell/tree/master/protected/modules/Registry)
- [Mail](https://github.com/evildevel/php-shell/tree/master/protected/modules/Mail)
- [Triggers](https://github.com/evildevel/php-shell/tree/master/protected/modules/Triggers)

### Files
```
/protected
├── /modules
│   └── /Users
│       ├── MANIFEST
│       ├── README.md
│       ├── class.php
│       ├── conf.php
│       ├── install.php
│       └── uninstall.php
└── /render
    └── /users
        ├── /admin
        │   ├── /roles
        │   │   ├── /rules
        │   │   │   ├── add.php
        │   │   │   ├── edit.php
        │   │   │   └── index.php
        │   │   ├── add.php
        │   │   └── index.php
        │   ├── add.php
        │   ├── auth.php
        │   ├── edit.php
        │   ├── index.php
        │   ├── nav.php
        │   ├── notifications.php
        │   ├── oauth_clients.php
        │   ├── passwords.php
        │   ├── services.php
        │   └── timeouts.php
        ├── actions.php
        ├── activate.php
        ├── double_login.php
        ├── errors.php
        └── profile.php
```

### Properties
```php
// User data
array APP::Module('Users')->user
```

### Methods
```php
// Authentication
int APP::Module('Users')->Login(string $email, string $password)

// Register new user
int APP::Module('Users')->Register(string $email, string $password[, string $role = 'new'])

// Authorization
array APP::Module('Users')->Auth(int $id[, bool $set_cookie = true[, bool $save_password = false]])

// Generate password
string APP::Module('Users')->GeneratePassword(int $number)
```

### Triggers
- Logout
- Activate user
- Remove user
- Add user
- Login
- Double login
- Register new user
- Reset password
- Change password
- Update user
- Add role
- Remove role
- Add rule
- Remove rule
- Update rule
- Update OAuth settings
- Update notifications settings
- Update services settings
- Update auth settings
- Update passwords settings
- Update timeouts settings 

### WEB interfaces
```
/users/actions/<action>                                     // Actions
/users/login/vk                                             // Login via VK
/users/login/fb                                             // Login via Facebook
/users/login/google                                         // Login via Google
/users/login/ya                                             // Login via Yandex
/users/login/double/<return_hash>                           // Double login form
/users/activate/<user_id_hash>                              // User activation
/users/profile                                              // User profile
/users/logout                                               // Logout

/admin/users                                                // Manage users
/admin/users/add                                            // Add user
/admin/users/edit/<user_id_hash>                            // Edit user
/admin/users/oauth/clients                                  // Setup OAuth clients
/admin/users/notifications                                  // Setup notifications
/admin/users/services                                       // Setup services
/admin/users/auth                                           // Setup auth
/admin/users/passwords                                      // Setup passwords
/admin/users/timeouts                                       // Setup timeouts
/admin/users/roles                                          // Manage roles
/admin/users/roles/add                                      // Add role
/admin/users/roles/rules/<role_id_hash>/edit/<rule_id_hash> // Edit rule
/admin/users/roles/rules/<role_id_hash>/add                 // Add rule
/admin/users/roles/rules/<role_id_hash>                     // Manage rules of role

/users/api/login.json                                       // [API] Login
/users/api/double-login.json                                // [API] Double login
/users/api/logout.json                                      // [API] Logout
/users/api/register.json                                    // [API] Register
/users/api/reset-password.json                              // [API] Reset password
/users/api/change-password.json                             // [API] Change password

/admin/users/api/add.json                                   // [API] Add user
/admin/users/api/remove.json                                // [API] Remove user
/admin/users/api/update.json                                // [API] Update user
/admin/users/api/roles/list.json                            // [API] List roles
/admin/users/api/roles/add.json                             // [API] Add role
/admin/users/api/roles/remove.json                          // [API] Remove role
/admin/users/api/roles/rules/list.json                      // [API] List rules
/admin/users/api/roles/rules/add.json                       // [API] Add rule
/admin/users/api/roles/rules/update.json                    // [API] Update rule
/admin/users/api/roles/rules/remove.json                    // [API] Remove rule
/admin/users/api/oauth/clients/update.json                  // [API] Update OAuth clients settings
/admin/users/api/notifications/update.json                  // [API] Update notifications settings
/admin/users/api/services/update.json                       // [API] Update services settings
/admin/users/api/auth/update.json                           // [API] Update auth settings
/admin/users/api/passwords/update.json                      // [API] Update passwords settings
/admin/users/api/timeouts/update.json                       // [API] Update timeouts settings
```

### Database
```sql
-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2016 at 08:08 PM
-- Server version: 10.0.23-MariaDB-0+deb8u1
-- PHP Version: 7.0.9-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `auto`
--

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE `social_accounts` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `network` enum('vk','fb','google','ya') NOT NULL,
  `extra` varchar(250) NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_visit` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`email`,`password`,`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `social_accounts`
--
ALTER TABLE `social_accounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD CONSTRAINT `social_accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
```