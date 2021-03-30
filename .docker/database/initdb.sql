-- Adminer 4.7.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `acl_privileges`;
CREATE TABLE `acl_privileges` (
                                  `id` int(11) NOT NULL AUTO_INCREMENT,
                                  `privilege` varchar(100) NOT NULL,
                                  `description` text DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `acl_resources`;
CREATE TABLE `acl_resources` (
                                 `id` int(11) NOT NULL AUTO_INCREMENT,
                                 `name` varchar(100) NOT NULL,
                                 `description` text DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `acl_roles`;
CREATE TABLE `acl_roles` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `parent_id` int(11) DEFAULT NULL,
                             `name` varchar(100) DEFAULT NULL,
                             `editable` tinyint(1) NOT NULL DEFAULT 1,
                             `admin` tinyint(1) NOT NULL DEFAULT 0,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `acl_roles_resources`;
CREATE TABLE `acl_roles_resources` (
                                       `id` int(11) NOT NULL AUTO_INCREMENT,
                                       `id_role` int(11) DEFAULT NULL,
                                       `id_resource` int(11) DEFAULT NULL,
                                       `id_privilege` int(11) DEFAULT NULL,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `acl_users`;
CREATE TABLE `acl_users` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `login` varchar(100) NOT NULL,
                             `password` text DEFAULT NULL,
                             `email` varchar(100) DEFAULT NULL,
                             `name` varchar(100) DEFAULT NULL,
                             `group_id` int(11) DEFAULT NULL,
                             `enabled` tinyint(1) NOT NULL DEFAULT 1,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `acl_users_resources`;
CREATE TABLE `acl_users_resources` (
                                       `id` int(11) NOT NULL AUTO_INCREMENT,
                                       `id_user` int(11) DEFAULT NULL,
                                       `id_resource` int(11) DEFAULT NULL,
                                       `id_privilege` int(11) DEFAULT NULL,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `acl_users_roles`;
CREATE TABLE `acl_users_roles` (
                                   `id` int(11) NOT NULL AUTO_INCREMENT,
                                   `id_user` int(11) DEFAULT NULL,
                                   `id_role` int(11) DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `components`;
CREATE TABLE `components` (
                              `id` int(11) NOT NULL,
                              `route_id` int(11) DEFAULT NULL,
                              `link` text COLLATE utf8_czech_ci DEFAULT NULL,
                              `acl_resource_id` int(11) DEFAULT NULL,
                              `group_id` int(11) DEFAULT NULL,
                              `title` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


DROP TABLE IF EXISTS `globals_keys`;
CREATE TABLE `globals_keys` (
                                `id` int(11) NOT NULL AUTO_INCREMENT,
                                `global_key` varchar(100) NOT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `globals_values`;
CREATE TABLE `globals_values` (
                                  `id` int(11) NOT NULL AUTO_INCREMENT,
                                  `int_key` varchar(100) NOT NULL,
                                  `glob_key` int(11) DEFAULT NULL,
                                  `value` text DEFAULT NULL,
                                  `description` text DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `main_menu`;
CREATE TABLE `main_menu` (
                             `id` int(11) NOT NULL AUTO_INCREMENT,
                             `component_id` int(11) DEFAULT NULL,
                             `parent` int(11) DEFAULT NULL,
                             `target_blank` tinyint(1) NOT NULL DEFAULT 0,
                             `title` varchar(100) COLLATE utf8_czech_ci DEFAULT NULL,
                             `description` text COLLATE utf8_czech_ci DEFAULT NULL,
                             `enabled` tinyint(1) NOT NULL DEFAULT 1,
                             `rank` int(11) NOT NULL DEFAULT 0,
                             `url` text COLLATE utf8_czech_ci DEFAULT NULL,
                             `acl` int(11) DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


-- 2021-03-29 13:08:00