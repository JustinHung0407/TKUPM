-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- 主機: localhost:3306
-- 產生時間： 2018 年 01 月 12 日 15:47
-- 伺服器版本: 10.2.12-MariaDB-10.2.12+maria~artful
-- PHP 版本： 7.1.11-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `tku_package`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uid` int(20) NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `admin`
--

INSERT INTO `admin` (`id`, `uid`, `password`, `email`, `level`) VALUES
(4, 403840308, '$2y$10$KxdEGRDiZ.kxPutBvtLii.hh4VAWVY/a/V2TnYJ9M8cqkZH94hFUS', 'gene31105@gmail.com', 1),
(5, 12345678, '$2y$10$FeSjxGrBXic0EBq6CGvodOyAYmz6mHTrLOZzefHSt4X8v/wvkqRFm', '12345678@ff.com', 0),
(6, 111245677, '$2y$10$GmeiUpq/jU9uZVYQrBBKbOOmO/5iQ0wsFqj2sDeYkSfwxMwQ4k8nC', '111245677@gmail.com', 0),
(7, 131541415, '$2y$10$mYxe2EZ5ZJ0VoolPfA02J.puauL4HNYtzrNxT4eFd9FVPuRnycPXi', 'awfawf@gmail.com', 0),
(8, 9872247, '$2y$10$D/nGlXoqCHrtLt96v7bik.u2AlgQJpTLITHwn4HoU8vy.7LvPOecG', '123123123@ddd.com', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `package_info`
--

CREATE TABLE `package_info` (
  `id` int(11) NOT NULL,
  `recipients` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ptype` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pid` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pick` tinyint(1) NOT NULL DEFAULT 0,
  `is_notify` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp_arrive` date DEFAULT NULL,
  `timestamp_pickup` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `package_info`
--

INSERT INTO `package_info` (`id`, `recipients`, `ptype`, `storage`, `pid`, `is_pick`, `is_notify`, `timestamp_arrive`, `timestamp_pickup`) VALUES
(1, '林靜霞', '包裹', '501', '1234567', 0, 0, '2018-01-01', NULL),
(2, '林靜霞', '包裹2', '501', '1234567', 0, 0, '2018-01-01', NULL),
(3, '林靜霞', '包裹3', '501', '1234567', 0, 0, '2018-01-01', NULL),
(4, '陳銘澤', '包裹4', '501', '1234567', 0, 0, '2018-01-01', NULL);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `package_info`
--
ALTER TABLE `package_info`
  ADD PRIMARY KEY (`id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表 AUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表 AUTO_INCREMENT `package_info`
--
ALTER TABLE `package_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
