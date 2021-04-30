-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 30, 2021 at 10:52 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_support_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_name` varchar(2000) NOT NULL,
  `problem_desc` varchar(4000) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_no` varchar(100) DEFAULT NULL,
  `reference_no` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL,
  `actioned_date` date DEFAULT NULL,
  `actioned_user` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `cust_name`, `problem_desc`, `email`, `phone_no`, `reference_no`, `status`, `actioned_date`, `actioned_user`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Vanessa', 'nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea', 'Vanessa@gmail.com', '123456789', '5fc933ab89154', 'PENDING', NULL, NULL, NULL, '2020-12-03 13:21:23', '2020-12-03 13:21:23'),
(3, 'Sally', 'nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat', 'Sally@gmail.com', '123456789', '5fc935b71c257', 'PENDING', NULL, NULL, NULL, '2020-12-03 13:30:07', '2020-12-03 13:30:07'),
(4, 'Rachel', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque', 'Rachel@gmail.com', '123456789', '5fc98aa4b277f', 'PENDING', NULL, NULL, NULL, '2020-12-03 19:32:28', '2020-12-03 19:32:28'),
(5, 'Penelope', 'adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et', 'Penelope@gmail.com', '123444444', '608ac482a306e', 'PENDING', NULL, NULL, NULL, '2021-04-29 09:06:50', '2021-04-29 09:06:50'),
(6, 'Olivia', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'Olivia@gmail.com', NULL, '608acff7ba999', 'OPENED', NULL, NULL, NULL, '2021-04-29 09:55:43', '2021-04-29 10:30:37'),
(7, 'Pippa', 'nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea', 'Pippa@gmail.com', NULL, '608acffc46b28', 'PENDING', NULL, NULL, NULL, '2021-04-29 09:55:48', '2021-04-29 10:15:12'),
(8, 'Molly', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium', 'Mollydade@gmail.com', '13242423', '608ade5e77951', 'PENDING', NULL, NULL, NULL, '2021-04-29 10:57:10', '2021-04-29 10:57:10'),
(9, 'Megan', 'nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea', 'Megan@gmail.com', '21312424214', '608aef88a5f6f', 'PENDING', NULL, NULL, NULL, '2021-04-29 12:10:24', '2021-04-29 12:10:24'),
(10, 'Katherine', 'adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et', 'Katherine@gmail.com', '21312424214', '608af000b8273', 'PENDING', NULL, NULL, NULL, '2021-04-29 12:12:24', '2021-04-29 12:12:24'),
(11, 'Alison', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium', 'Alison@gmail.com', '123456789', '608af08c0495e', 'PENDING', NULL, NULL, NULL, '2021-04-29 12:14:44', '2021-04-29 12:14:44'),
(12, 'Alexandra', 'nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat', 'Alexandra@gmail.com', '1234567', '608af09db5cbd', 'PENDING', NULL, NULL, NULL, '2021-04-29 12:15:01', '2021-04-29 12:15:01'),
(13, 'Abigail', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'Abigail@gmail.com', '123456789', '608af0a5b497e', 'PENDING', NULL, NULL, NULL, '2021-04-29 12:15:09', '2021-04-30 02:48:37'),
(14, 'customer test', 'product issue', 'sample@email.com', '123456789', '608bbe60c8420', 'OPENED', NULL, NULL, NULL, '2021-04-30 02:52:56', '2021-04-30 02:53:45'),
(15, 'Jason', 'nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehende\r\nnisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehende', 'jason@email.com', '078455555', '608bd8209e11d', 'PENDING', NULL, NULL, NULL, '2021-04-30 04:42:48', '2021-04-30 04:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_reply`
--

DROP TABLE IF EXISTS `ticket_reply`;
CREATE TABLE IF NOT EXISTS `ticket_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `reply` varchar(4000) NOT NULL,
  `actioned_date` date NOT NULL,
  `actioned_user` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_reply`
--

INSERT INTO `ticket_reply` (`id`, `ticket_id`, `reply`, `actioned_date`, `actioned_user`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 6, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis', '2021-04-29', 1, NULL, '2021-04-29 10:15:12', '2021-04-29 10:15:12'),
(2, 6, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem', '2021-04-29', 1, NULL, '2021-04-29 10:30:37', '2021-04-29 10:30:37'),
(3, 6, 'aspernatur aut odit aut fugit, sed quia consequuntur magni', '2021-04-29', 1, NULL, '2021-04-29 10:30:42', '2021-04-29 10:30:42'),
(11, 14, 'issue checked', '2021-04-30', 2, NULL, '2021-04-30 02:53:45', '2021-04-30 02:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'admin@email.com', NULL, '$2y$10$h4msG2YutuF86PKD88gre.xvLnGt4DGCDfa2dn1jFl0HFJ0r0JT.q', 'sVlDu3OADGVis205F11S8rB5indDf4na3HBwjQfWJduljIeUvGk9VEb2zEie', '2021-04-30 02:33:09', '2021-04-30 02:33:09', 'admin'),
(2, 'Kasun', 'kasun@email.com', NULL, '$2y$10$3DfdxTRcsaJickqvg3mYlewDBC8M9L8x5olOA//ivxXo33/45eIv2', '6UDL7iGxIIzbSss70BWRO6gT6T5Rq9himA9CZ8AeVYOj0btFKZPAIzZ6p0dK', '2021-04-30 02:33:09', '2021-04-30 02:33:09', 'user'),
(3, 'User 1', 'user1@email.com', NULL, '$2y$10$dnjEyW4iBg83xJVBE1VGDuW5rNZxLvoAFWIHbKIVeql7BNHsbV6ny', NULL, '2021-04-30 02:36:42', '2021-04-30 02:36:42', 'user'),
(4, 'User 2', 'user2@email.com', NULL, '$2y$10$p8IUVPj.6MPbWsfpV5e2SOOPHW0dNmBhmSJmHQSLGudY1ibF3b4r.', NULL, '2021-04-30 02:37:06', '2021-04-30 02:37:06', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
