-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2022 年 1 月 24 日 08:35
-- サーバのバージョン： 5.7.34
-- PHP のバージョン: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `edumin`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `answers`
--

CREATE TABLE `answers` (
  `id` int(32) NOT NULL COMMENT '回答ID',
  `user_id` int(32) NOT NULL COMMENT 'ユーザーID',
  `submission_id` int(32) NOT NULL COMMENT '投稿ID',
  `body` text NOT NULL COMMENT '回答内容',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `answers`
--

INSERT INTO `answers` (`id`, `user_id`, `submission_id`, `body`, `created_at`) VALUES
(1, 16, 14, 'test', '2022-01-24 13:28:46'),
(2, 16, 14, 'test2', '2022-01-24 13:29:04'),
(3, 16, 15, 'test', '2022-01-24 14:24:46'),
(8, 26, 22, 'test', '2022-01-24 17:29:12');

-- --------------------------------------------------------

--
-- テーブルの構造 `favorites`
--

CREATE TABLE `favorites` (
  `id` int(32) NOT NULL COMMENT 'いいねID',
  `user_id` int(32) NOT NULL COMMENT 'ユーザーID',
  `submission_id` int(32) NOT NULL COMMENT '投稿ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `submission_id`) VALUES
(32, 26, 15);

-- --------------------------------------------------------

--
-- テーブルの構造 `quiz`
--

CREATE TABLE `quiz` (
  `id` int(32) NOT NULL COMMENT 'QUIZID',
  `user_id` int(32) NOT NULL COMMENT 'ユーザーID',
  `question` text NOT NULL COMMENT '問題',
  `choice1` varchar(255) NOT NULL COMMENT '選択肢1',
  `choice2` varchar(255) NOT NULL COMMENT '選択肢2',
  `choice3` varchar(255) NOT NULL COMMENT '選択肢3',
  `choice4` varchar(255) NOT NULL COMMENT '選択肢4',
  `answer` varchar(255) NOT NULL COMMENT '解答',
  `explanation` text COMMENT '解説',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `del_flg` int(32) NOT NULL DEFAULT '0' COMMENT '表示'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `quiz`
--

INSERT INTO `quiz` (`id`, `user_id`, `question`, `choice1`, `choice2`, `choice3`, `choice4`, `answer`, `explanation`, `created_at`, `del_flg`) VALUES
(1, 16, 'test', 'a', 'b', 'c', 'd', 'a', 'test', '2022-01-24 13:25:47', 0),
(2, 16, 'test2', 'a', 'b', 'c', 'd', 'a', 'test\r\ntest', '2022-01-24 13:27:39', 1),
(3, 16, 'quiz', 'a', 'b', 'c', 'd', 'a', '', '2022-01-24 14:29:54', 1),
(4, 16, 'test2', 'a', 'b', 'c', 'd', 'a', '', '2022-01-24 14:30:35', 1),
(5, 16, 'test3', 'a', 'b', 'c', 'd', 'a', '', '2022-01-24 14:30:53', 1),
(6, 16, 'test4', 'a', 'b', 'c', 'd', 'a', '', '2022-01-24 14:31:10', 1),
(7, 16, 'test5', 'a', 'b', 'c', 'd', 'a', '', '2022-01-24 14:31:27', 1),
(8, 16, 'test6', 'a', 'b', 'c', 'd', 'a', '', '2022-01-24 14:31:44', 1),
(9, 16, 'test7', 'a', 'b', 'c', 'd', 'a', '', '2022-01-24 14:32:06', 1),
(10, 16, 'test8', 'a', 'b', 'c', 'd', 'a', '', '2022-01-24 14:32:22', 1),
(11, 16, 'test9', 'a', 'b', 'c', 'd', 'a', '', '2022-01-24 14:32:36', 1),
(17, 26, 'test', 'a', 'b', 'c', 'd', 'a', 'test', '2022-01-24 17:31:08', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `submissions`
--

CREATE TABLE `submissions` (
  `id` int(32) NOT NULL COMMENT '投稿ID',
  `user_id` int(32) NOT NULL COMMENT 'ユーザーID',
  `title` varchar(255) NOT NULL COMMENT 'タイトル',
  `school` varchar(255) NOT NULL COMMENT '学校',
  `subject` varchar(255) NOT NULL COMMENT '教科',
  `body` text NOT NULL COMMENT '質問内容',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `del_flg` int(32) NOT NULL DEFAULT '0' COMMENT '表示'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `submissions`
--

INSERT INTO `submissions` (`id`, `user_id`, `title`, `school`, `subject`, `body`, `created_at`, `del_flg`) VALUES
(13, 16, 'test', '中学', '国語', 'test投稿', '2022-01-23 20:44:46', 1),
(14, 16, 'test', '中学', '国語', 'test\r\ntest', '2022-01-23 20:57:21', 1),
(15, 16, 'test', '中学', '国語', 'test\r\ntest', '2022-01-24 14:15:15', 1),
(22, 26, 'test', '高校', '社会', 'test', '2022-01-24 17:28:09', 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(32) NOT NULL COMMENT 'ユーザーID',
  `name` varchar(255) NOT NULL COMMENT 'ニックネーム',
  `email` varchar(255) NOT NULL COMMENT 'メールアドレス',
  `password` varchar(255) NOT NULL COMMENT 'パスワード',
  `role` int(32) NOT NULL DEFAULT '0' COMMENT '権限',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登録日時',
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新日時'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `update_at`) VALUES
(16, 'testPlayer', 'test@test.jp', '$2y$10$SB8nQDwwkX41kA6GQOJ2n.x7QfdElJp560QYqW3LY82fQ6hx1x94G', 0, '2022-01-23 20:12:29', '2022-01-24 16:22:47'),
(17, 'user1', 'test@test', '$2y$10$Lh8OF2czmL0yrUgKfvuS/.B88w8QjVYS.3e4ITD7nYHRxI.4oc0LG', 1, '2022-01-24 13:44:38', '2022-01-24 13:45:36'),
(18, 'test1', 'test@t.jp', '$2y$10$VZwNrwHRuHgzJ1NRStuun.f//.1Cd99L6Gze.EDtONI3ftek9TD5C', 0, '2022-01-24 13:58:29', '2022-01-24 13:58:29'),
(26, 'user3', 'test@test.com', '$2y$10$yEYY8jdxM8UBG7oDvNjJeeEpRjsnWX6sa8bh9KzZeISUSARlyuHrK', 0, '2022-01-24 17:26:49', '2022-01-24 17:31:55');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password` (`password`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT COMMENT '回答ID', AUTO_INCREMENT=9;

--
-- テーブルの AUTO_INCREMENT `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT COMMENT 'いいねID', AUTO_INCREMENT=33;

--
-- テーブルの AUTO_INCREMENT `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT COMMENT 'QUIZID', AUTO_INCREMENT=18;

--
-- テーブルの AUTO_INCREMENT `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT COMMENT '投稿ID', AUTO_INCREMENT=23;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT COMMENT 'ユーザーID', AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
