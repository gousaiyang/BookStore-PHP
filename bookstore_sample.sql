-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-03-19 16:47:42
-- 服务器版本： 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--
CREATE DATABASE IF NOT EXISTS `bookstore` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `bookstore`;

-- --------------------------------------------------------

--
-- 表的结构 `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) unsigned NOT NULL COMMENT '单位：分',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `books`
--

INSERT INTO `books` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'MySQL：从删库到跑路', 6530, '2017-03-19 23:38:09', '2017-03-19 23:38:09'),
(2, 'C语言：从入门到放弃', 8860, '2017-03-19 23:38:23', '2017-03-19 23:38:23'),
(3, '黑客攻防：从入门到入狱', 5660, '2017-03-19 23:38:33', '2017-03-19 23:38:33'),
(4, 'Android：从入门到变砖', 4540, '2017-03-19 23:38:45', '2017-03-19 23:38:45'),
(5, 'Java编程：从入门到改行', 7800, '2017-03-19 23:38:58', '2017-03-19 23:38:58'),
(6, 'TCP/IP：从上网到断网', 9890, '2017-03-19 23:39:08', '2017-03-19 23:39:08'),
(7, 'PHP：世界上最好的语言', 2880, '2017-03-19 23:39:16', '2017-03-19 23:39:16'),
(8, '<script>alert(''xss'');</script>', 1000, '2017-03-19 23:39:24', '2017-03-19 23:39:24'),
(9, ' <? phpinfo(); ?>', 500, '2017-03-19 23:39:37', '2017-03-19 23:39:37'),
(10, '''; drop database bookstore --', 10000, '2017-03-19 23:39:49', '2017-03-19 23:39:49'),
(11, '<b>text</b>', 100, '2017-03-19 23:39:56', '2017-03-19 23:39:56'),
(12, '最新的书', 1000000, '2017-03-19 23:40:04', '2017-03-19 23:40:04');

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) unsigned NOT NULL COMMENT '订单号',
  `uid` int(11) unsigned NOT NULL COMMENT '顾客id',
  `bid` int(11) unsigned NOT NULL COMMENT '书籍id',
  `quantity` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`id`, `uid`, `bid`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, '2017-03-19 20:00:00', '2017-03-19 20:00:00'),
(2, 6, 3, 5, '2017-03-19 21:00:00', '2017-03-19 21:00:00'),
(3, 2, 9, 1, '2017-03-19 22:00:00', '2017-03-19 22:00:00'),
(4, 8, 10, 47, '2017-03-19 23:00:00', '2017-03-19 23:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `nickname`, `created_at`, `updated_at`) VALUES
(1, 'admin', '管理员', '2017-03-19 22:00:00', '2017-03-19 22:00:00'),
(2, 'zhang', '张三', '2017-03-19 22:00:00', '2017-03-19 22:00:00'),
(3, 'woshilisi', '李四', '2017-03-19 22:41:34', '2017-03-19 22:41:34'),
(6, 'hello', '<script>alert(''xss'');</script>', '2017-03-19 22:56:09', '2017-03-19 22:56:09'),
(8, 'SQL_Injection', ''' or 1=1 --', '2017-03-19 22:56:58', '2017-03-19 22:56:58'),
(10, 'lazyuser', '哇咔咔', '2017-03-19 23:35:16', '2017-03-19 23:35:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单号',AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
