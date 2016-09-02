-- phpMyAdmin SQL Dump
-- version 4.6.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 01, 2016 at 08:18 PM
-- Server version: 10.0.23-MariaDB-0+deb8u1
-- PHP Version: 7.0.9-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpshell_test1`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `letters`
--

INSERT INTO `letters` (`id`, `group_id`, `sender_id`, `subject`, `html`, `plaintext`, `list_id`, `up_date`) VALUES
(1, 1, 1, 'Welcome', '<h1>Welcome</h1>\n\nLogin page:\n<br>\n<a href="<?= APP::Module(\'Routing\')->root ?>login"><?= APP::Module(\'Routing\')->root ?>login</a>\n<br>\n\n<h2>Login details</h2>\n<table border="0" cellpadding="3" width="300">\n<tr>\n<td>E-Mail</td>\n<td><strong><?= $data[\'email\'] ?></strong></td>\n</tr>\n<tr>\n<td>Password</td>\n<td><strong><?= $data[\'password\'] ?></strong></td>\n</tr>\n</table>\n<br>\n\n<h2>Warning!</h2>\nYou must confirm your E-Mail address until <?= strftime(\'%e %B %Y\', $data[\'expire\']) ?>.\n<br>\nFollow the link to confirm your E-Mail address: <a href="<?= $data[\'link\'] ?>" target="_blank"><?= $data[\'link\'] ?></a>', 'Welcome\n\nLogin page\n--------------------\n<?= APP::Module(\'Routing\')->root ?>login\n\nLogin details\n--------------------\nE-Mail: <?= $data[\'email\'] ?>\nPassword: <?= $data[\'password\'] ?>\n\nWarning!\n--------------------\nYou must confirm your E-Mail address until <?= strftime(\'%e %B %Y\', $data[\'expire\']) ?>.\n\nFollow the link to confirm your E-Mail address:\n<?= $data[\'link\'] ?>', 'users', '2016-09-01 19:40:18'),
(2, 1, 1, 'Reset password', '<h1>Reset password</h1>\r\n\r\nFollow the link to set new password: <a href="<?= $data[\'link\'] ?>" target="_blank"><?= $data[\'link\'] ?></a>', 'Reset password\r\n\r\nFollow the link to set new password: <?= $data[\'link\'] ?>', 'users', '2016-09-01 19:40:18'),
(3, 1, 1, 'Password successfully changed', '<h1>Password successfully changed</h1>\r\n\r\nLogin page:\r\n<br>\r\n<a href="<?= APP::Module(\'Routing\')->root ?>login"><?= APP::Module(\'Routing\')->root ?>login</a>\r\n<br>\r\n\r\n<h2>Login details</h2>\r\n<table border="0" cellpadding="3" width="300">\r\n<tr>\r\n<td>E-Mail</td>\r\n<td><strong><?= $data[\'email\'] ?></strong></td>\r\n</tr>\r\n<tr>\r\n<td>Password</td>\r\n<td><strong><?= $data[\'password\'] ?></strong></td>\r\n</tr>\r\n</table>', 'Password successfully changed\r\n\r\nLogin page\r\n--------------------\r\n<?= APP::Module(\'Routing\')->root ?>login\r\n\r\nLogin details\r\n--------------------\r\nE-Mail: <?= $data[\'email\'] ?>\r\nPassword: <?= $data[\'password\'] ?>', 'users', '2016-09-01 19:40:18'),
(4, 1, 1, 'Welcome', '<h1>Welcome</h1>\r\n\r\nLogin page:\r\n<br>\r\n<a href="<?= APP::Module(\'Routing\')->root ?>login"><?= APP::Module(\'Routing\')->root ?>login</a>\r\n<br>\r\n\r\n<h2>Login details</h2>\r\n<table border="0" cellpadding="3" width="300">\r\n<tr>\r\n<td>E-Mail</td>\r\n<td><strong><?= $data[\'email\'] ?></strong></td>\r\n</tr>\r\n<tr>\r\n<td>Password</td>\r\n<td><strong><?= $data[\'password\'] ?></strong></td>\r\n</tr>\r\n</table>', 'Welcome\r\n\r\nLogin page\r\n--------------------\r\n<?= APP::Module(\'Routing\')->root ?>login\r\n\r\nLogin details\r\n--------------------\r\nE-Mail: <?= $data[\'email\'] ?>\r\nPassword: <?= $data[\'password\'] ?>', 'users', '2016-09-01 19:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `letters_groups`
--

CREATE TABLE `letters_groups` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `sub_id` smallint(5) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `letters_groups`
--

INSERT INTO `letters_groups` (`id`, `sub_id`, `name`, `up_date`) VALUES
(0, 0, '/', '2016-09-01 19:40:02'),
(1, 0, 'Users', '2016-09-01 19:40:18');

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
-- Dumping data for table `registry`
--

INSERT INTO `registry` (`id`, `sub_id`, `item`, `value`, `up_date`) VALUES
(1, 0, 'module_crypt_key', 'f4fb6e520dd5f38a30bb335cee8b39bc', '2016-09-01 19:39:55'),
(2, 0, 'module_trigger_type', '["add_trigger", "Triggers", "Add trigger"]', '2016-09-01 19:39:55'),
(3, 0, 'module_trigger_type', '["remove_trigger", "Triggers", "Remove trigger"]', '2016-09-01 19:39:55'),
(4, 0, 'module_trigger_type', '["update_trigger", "Triggers", "Update trigger"]', '2016-09-01 19:39:55'),
(5, 0, 'module_sessions_cookie_domain', 'domain.com', '2016-09-01 20:16:53'),
(6, 0, 'module_sessions_cookie_lifetime', '0', '2016-09-01 19:39:58'),
(7, 0, 'module_sessions_compress', '9', '2016-09-01 19:39:58'),
(8, 0, 'module_sessions_gc_maxlifetime', '1440', '2016-09-01 19:39:58'),
(9, 0, 'module_trigger_type', '["update_sessions_settings", "Sessions", "Update settings"]', '2016-09-01 19:39:58'),
(10, 0, 'module_mail_charset', 'UTF-8', '2016-09-01 19:40:02'),
(11, 0, 'module_mail_x_mailer', 'php-shell', '2016-09-01 19:40:02'),
(12, 0, 'module_trigger_type', '["mail_add_letter", "Mail / Letters", "Add"]', '2016-09-01 19:40:02'),
(13, 0, 'module_trigger_type', '["mail_remove_letter", "Mail / Letters", "Remove"]', '2016-09-01 19:40:02'),
(14, 0, 'module_trigger_type', '["mail_update_letter", "Mail / Letters", "Update"]', '2016-09-01 19:40:02'),
(15, 0, 'module_trigger_type', '["mail_add_letters_group", "Mail / Letters", "Add group"]', '2016-09-01 19:40:02'),
(16, 0, 'module_trigger_type', '["mail_remove_letters_group", "Mail / Letters", "Remove group"]', '2016-09-01 19:40:02'),
(17, 0, 'module_trigger_type', '["mail_update_letters_group", "Mail / Letters", "Update group"]', '2016-09-01 19:40:02'),
(18, 0, 'module_trigger_type', '["mail_add_sender", "Mail / Senders", "Add"]', '2016-09-01 19:40:02'),
(19, 0, 'module_trigger_type', '["mail_remove_sender", "Mail / Senders", "Remove"]', '2016-09-01 19:40:02'),
(20, 0, 'module_trigger_type', '["mail_update_sender", "Mail / Senders", "Update"]', '2016-09-01 19:40:02'),
(21, 0, 'module_trigger_type', '["mail_add_senders_group", "Mail / Senders", "Add group"]', '2016-09-01 19:40:02'),
(22, 0, 'module_trigger_type', '["mail_remove_senders_group", "Mail / Senders", "Remove group"]', '2016-09-01 19:40:02'),
(23, 0, 'module_trigger_type', '["mail_update_senders_group", "Mail / Senders", "Update group"]', '2016-09-01 19:40:02'),
(24, 0, 'module_trigger_type', '["mail_update_settings", "Mail", "Update settings"]', '2016-09-01 19:40:02'),
(25, 0, 'module_trigger_type', '["mail_send_letter", "Mail", "Send mail"]', '2016-09-01 19:40:02'),
(26, 0, 'module_users_register_activation_letter', '1', '2016-09-01 19:40:18'),
(27, 0, 'module_users_reset_password_letter', '2', '2016-09-01 19:40:18'),
(28, 0, 'module_users_change_password_letter', '3', '2016-09-01 19:40:18'),
(29, 0, 'module_users_register_letter', '4', '2016-09-01 19:40:18'),
(30, 0, 'module_users_role', 'default', '2016-09-01 19:40:18'),
(31, 0, 'module_users_role', 'new', '2016-09-01 19:40:18'),
(32, 0, 'module_users_role', 'user', '2016-09-01 19:40:18'),
(33, 0, 'module_users_role', 'admin', '2016-09-01 19:40:18'),
(34, 30, 'module_users_rule', '["users\\\\/actions\\\\/change-password(.*)","users\\/actions\\/login"]', '2016-09-01 19:40:18'),
(35, 30, 'module_users_rule', '["users\\\\/profile","users\\/actions\\/login"]', '2016-09-01 19:40:18'),
(36, 30, 'module_users_rule', '["admin(.*)","users\\/actions\\/login"]', '2016-09-01 19:40:18'),
(37, 31, 'module_users_rule', '["admin(.*)","users\\/actions\\/login"]', '2016-09-01 19:40:18'),
(38, 32, 'module_users_rule', '["admin(.*)","users\\/actions\\/login"]', '2016-09-01 19:40:18'),
(39, 0, 'module_users_auth_token', '1', '2016-09-01 19:40:18'),
(40, 0, 'module_users_change_password_service', '1', '2016-09-01 19:40:18'),
(41, 0, 'module_users_check_rules', '1', '2016-09-01 19:40:18'),
(42, 0, 'module_users_gen_pass_length', '6', '2016-09-01 19:40:18'),
(43, 0, 'module_users_login_service', '1', '2016-09-01 19:40:18'),
(44, 0, 'module_users_min_pass_length', '3', '2016-09-01 19:40:18'),
(45, 0, 'module_users_register_service', '1', '2016-09-01 19:40:18'),
(46, 0, 'module_users_reset_password_service', '1', '2016-09-01 19:40:18'),
(47, 0, 'module_users_social_auth_fb_id', '0', '2016-09-01 19:40:18'),
(48, 0, 'module_users_social_auth_fb_key', '0', '2016-09-01 19:40:18'),
(49, 0, 'module_users_social_auth_google_id', '0', '2016-09-01 19:40:18'),
(50, 0, 'module_users_social_auth_google_key', '0', '2016-09-01 19:40:18'),
(51, 0, 'module_users_social_auth_vk_id', '0', '2016-09-01 19:40:18'),
(52, 0, 'module_users_social_auth_vk_key', '0', '2016-09-01 19:40:18'),
(53, 0, 'module_users_social_auth_ya_id', '0', '2016-09-01 19:40:18'),
(54, 0, 'module_users_social_auth_ya_key', '0', '2016-09-01 19:40:18'),
(55, 0, 'module_users_timeout_activation', '3 days', '2016-09-01 19:40:18'),
(56, 0, 'module_users_timeout_email', '1 year', '2016-09-01 19:40:18'),
(57, 0, 'module_users_timeout_token', '1 year', '2016-09-01 19:40:18'),
(58, 0, 'module_trigger_type', '["user_logout", "Users", "Logout"]', '2016-09-01 19:40:18'),
(59, 0, 'module_trigger_type', '["user_activate", "Users", "Activate"]', '2016-09-01 19:40:18'),
(60, 0, 'module_trigger_type', '["remove_user", "Users", "Remove"]', '2016-09-01 19:40:18'),
(61, 0, 'module_trigger_type', '["add_user", "Users", "Add"]', '2016-09-01 19:40:18'),
(62, 0, 'module_trigger_type', '["user_login", "Users", "Login"]', '2016-09-01 19:40:18'),
(63, 0, 'module_trigger_type', '["user_double_login", "Users", "Double login"]', '2016-09-01 19:40:18'),
(64, 0, 'module_trigger_type', '["register_user", "Users", "Register"]', '2016-09-01 19:40:18'),
(65, 0, 'module_trigger_type', '["reset_user_password", "Users", "Reset password"]', '2016-09-01 19:40:18'),
(66, 0, 'module_trigger_type', '["change_user_password", "Users", "Change password"]', '2016-09-01 19:40:18'),
(67, 0, 'module_trigger_type', '["update_user", "Users", "Update"]', '2016-09-01 19:40:18'),
(68, 0, 'module_trigger_type', '["add_user_role", "Users / Roles", "Add"]', '2016-09-01 19:40:18'),
(69, 0, 'module_trigger_type', '["remove_user_role", "Users / Roles", "Remove"]', '2016-09-01 19:40:18'),
(70, 0, 'module_trigger_type', '["add_user_rule", "Users / Rules", "Add"]', '2016-09-01 19:40:18'),
(71, 0, 'module_trigger_type', '["remove_user_rule", "Users / Rules", "Remove"]', '2016-09-01 19:40:18'),
(72, 0, 'module_trigger_type', '["update_user_rule", "Users / Rules", "Update"]', '2016-09-01 19:40:18'),
(73, 0, 'module_trigger_type', '["update_users_oauth_settings", "Users / Settings", "Update OAuth"]', '2016-09-01 19:40:18'),
(74, 0, 'module_trigger_type', '["update_users_notifications_settings", "Users / Settings", "Update notifications"]', '2016-09-01 19:40:18'),
(75, 0, 'module_trigger_type', '["update_users_services_settings", "Users / Settings", "Update services"]', '2016-09-01 19:40:18'),
(76, 0, 'module_trigger_type', '["update_users_auth_settings", "Users / Settings", "Update auth"]', '2016-09-01 19:40:18'),
(77, 0, 'module_trigger_type', '["update_users_passwords_settings", "Users / Settings", "Update passwords"]', '2016-09-01 19:40:18'),
(78, 0, 'module_trigger_type', '["update_users_timeouts_settings", "Users / Settings", "Update timeouts"]', '2016-09-01 19:40:18'),
(79, 0, 'module_trigger_type', '["import_locale_module", "Admin", "Import locale module"]', '2016-09-01 19:40:18'),
(80, 0, 'module_trigger_type', '["remove_imported_module", "Admin", "Remove imported module"]', '2016-09-01 19:40:18'),
(81, 0, 'module_trigger_type', '["export_module", "Admin", "Export module"]', '2016-09-01 19:40:18'),
(82, 0, 'module_trigger_type', '["uninstall_module", "Admin", "Uninstall module"]', '2016-09-01 19:40:18'),
(83, 0, 'module_trigger_type', '["add_ssh_connection", "SSH", "Add connection"]', '2016-09-01 19:40:18'),
(84, 0, 'module_trigger_type', '["remove_ssh_connection", "SSH", "Remove connection"]', '2016-09-01 19:40:18'),
(85, 0, 'module_trigger_type', '["update_ssh_connection", "SSH", "Update connection"]', '2016-09-01 19:40:18'),
(86, 0, 'module_cron_tmp_file', '/tmp/crontab', '2016-09-01 19:40:19'),
(87, 0, 'module_trigger_type', '["add_cron_job", "Cron", "Add job"]', '2016-09-01 19:40:19'),
(88, 0, 'module_trigger_type', '["update_cron_job", "Cron", "Update job"]', '2016-09-01 19:40:19'),
(89, 0, 'module_trigger_type', '["remove_cron_job", "Cron", "Remove job"]', '2016-09-01 19:40:19'),
(90, 0, 'module_trigger_type', '["update_cron_settings", "Cron", "Update settings"]', '2016-09-01 19:40:19'),
(91, 0, 'module_trigger_type', '["remove_log_file", "Logs", "Remove log file"]', '2016-09-01 19:40:19');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `senders`
--

INSERT INTO `senders` (`id`, `group_id`, `name`, `email`, `up_date`) VALUES
(1, 0, 'Admin', 'admin@domain.com', '2016-09-01 20:16:41');

-- --------------------------------------------------------

--
-- Table structure for table `senders_groups`
--

CREATE TABLE `senders_groups` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `sub_id` smallint(5) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `up_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `senders_groups`
--

INSERT INTO `senders_groups` (`id`, `sub_id`, `name`, `up_date`) VALUES
(0, 0, '/', '2016-09-01 19:40:02');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `touched` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `reg_date`, `last_visit`) VALUES
(1, 'admin', '-U5CqS3GteC0Wg5Hw8bxAXwngZ7M1SRC3vFmRgD_osY', 'admin', '2016-09-01 19:40:18', '2016-09-01 19:40:18');

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
-- Indexes for table `registry`
--
ALTER TABLE `registry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`item`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `letters`
--
ALTER TABLE `letters`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `letters_groups`
--
ALTER TABLE `letters_groups`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `registry`
--
ALTER TABLE `registry`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `senders`
--
ALTER TABLE `senders`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `senders_groups`
--
ALTER TABLE `senders_groups`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `social_accounts`
--
ALTER TABLE `social_accounts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD CONSTRAINT `social_accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
