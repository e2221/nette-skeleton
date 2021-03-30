-- Adminer 4.7.5 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

INSERT INTO `acl_privileges` (`id`, `privilege`, `description`) VALUES
(1,	'read',	'User has permission to read the resource.'),
(2,	'write',	'User has permission to write (edit) the resource.'),
(3,	'manage',	'User has full access to the resource.');

INSERT INTO `acl_resources` (`id`, `name`, `description`) VALUES
(1,	'GuestResources',	'Universal resource to enable components for guest.'),
(2,	'AuthenticatedResources',	'Universal resource to enable components for authenticated users.'),
(3,	'ManagerResources',	NULL),
(4,	'AdminResources',	NULL);

INSERT INTO `acl_roles` (`id`, `parent_id`, `name`, `editable`, `admin`) VALUES
(1,	NULL,	'guest',	0,	0),
(2,	1,	'authenticated',	0,	0),
(3,	2,	'manager',	0,	0),
(4,	3,	'admin',	0,	1);

INSERT INTO `acl_roles_resources` (`id`, `id_role`, `id_resource`, `id_privilege`) VALUES
(1,	2,	2,	1);

INSERT INTO `acl_users` (`id`, `login`, `password`, `email`, `name`, `group_id`, `enabled`) VALUES
(1,	'admin',	'$2y$10$8U0V04hNPx.YR/HL1cSDPu.zKEPOyVvg2wPcgLZ4BInn9uHqxX3nG',	'',	'admin',	NULL,	1),
(2,	'user',	'$2y$10$8U0V04hNPx.YR/HL1cSDPu.zKEPOyVvg2wPcgLZ4BInn9uHqxX3nG',	'',	'user',	NULL,	1),
(3,	'krall',	'$2y$10$9IALFdEWgPnzrmcAxjKkFOgoIFa89CglIIvrZ.bCmNwhxntpvexzK',	'lukas.kral@schedl.de',	'Král Lukáš',	6,	1);


INSERT INTO `acl_users_roles` (`id`, `id_user`, `id_role`) VALUES
(38,	1,	4),
(39,	3,	3),
(45,	2,	2);


INSERT INTO `main_menu` (`id`, `component_id`, `parent`, `target_blank`, `title`, `description`, `enabled`, `rank`, `url`, `acl`) VALUES
(1,	NULL,	NULL,	0,	'Home',	NULL,	1,	0,	'Homepage:default',	2);

-- 2021-03-29 13:10:15