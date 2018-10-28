-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- 생성 시간: 15-12-03 14:41
-- 서버 버전: 5.6.25
-- PHP 버전: 5.4.43

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `board`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `board_table`
--

CREATE TABLE IF NOT EXISTS `board_table` (
  `id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `context` text NOT NULL,
  `auther` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- 테이블의 덤프 데이터 `board_table`
--

INSERT INTO `board_table` (`id`, `password`, `title`, `context`, `auther`, `created`, `view`) VALUES
(1, '111', '첫번째 게시글', '첫번째', 'test', '2015-11-04 17:00:29', 24),
(2, '111', '두번째 게시글', '두번째', 'test', '2015-11-04 17:06:11', 0),
(3, '111', '세번째 게시글', '셋', 'test', '2015-11-04 17:06:24', 0),
(4, '', '네번째 게시글', '넷\r\n', 'test', '2015-11-11 16:10:13', 0),
(5, '111', '다섯번째 게시글', '다섯', 'test', '2015-11-11 16:10:26', 0),
(6, '111', '여섯번째 글', '여섯', 'test', '2015-11-11 16:10:41', 0),
(7, '', '일곱번째 글', '일곱번', 'test', '2015-11-11 16:10:51', 0),
(8, '111', '여덟번째 게시글', '여덟\r\n', 'test', '2015-11-17 11:03:00', 0),
(9, '111', '아홉번째 게시글', '아홉', 'test', '2015-11-17 11:03:13', 12),
(10, '111', '열번째 게시글', '열', 'test', '2015-11-17 11:03:23', 0),
(11, '111', '열한번째 게시글', '열한번째 게시글', 'test', '2015-11-17 11:03:32', 0),
(12, '111', '열두번째 게시글', '열두번', 'test', '2015-11-17 11:03:42', 0),
(13, '111', '열세번째 게시글', '열셋', 'test', '2015-11-17 11:03:51', 0),
(14, '111', '열네번째 게시글', '열넷', 'test', '2015-11-17 11:04:00', 0),
(15, '111', '열다섯번째 게시글', '열다섯', 'test', '2015-11-17 11:04:09', 0),
(16, '111', '열여섯번째 게시글', '열여셧', 'test', '2015-11-17 11:04:18', 0),
(17, '111', '열일곱번째 게시글', '열일곱', 'test', '2015-11-18 11:16:35', 0),
(18, '111', '열여덟번째 게시글', '열여덟', 'test', '2015-11-18 11:16:49', 0),
(19, '111', '열아홉번째 게시글', '열아홉', 'test', '2015-11-18 16:12:29', 12),
(20, '111', '스물!', '!!!', 'test', '2015-11-18 16:12:39', 6),
(21, '111', '스물한번째 게시글', '스물하나', 'test', '2015-11-18 16:13:26', 12),
(22, '111', '스물 두번째 게시글', '스물둘', 'manager', '2015-11-18 16:14:18', 3),
(23, '111', '스물 세번째 게시글', '수믈셋', 'manager', '2015-11-18 16:14:33', 103),
(24, '111', '스물 네번째 게시글', '스물넷', 'manager', '2015-11-18 16:14:53', 3),
(25, '111', '스물 다섯번째 게시글', '스물다섯', 'manager', '2015-11-18 16:15:04', 76),
(26, '111', '스물 여섯번째 게시글', '스물 여섯', 'test', '2015-11-18 16:15:46', 9),
(27, '111', '스물 일곱번째 게시글', '스무일곱', 'test', '2015-11-18 16:15:57', 10),
(28, '111', '스물 여덟번째 게시글', '수물여덜', 'test', '2015-11-18 16:16:09', 32),
(29, '111', '스물아홉번째 게시글', '스물아홉', 'test', '2015-11-18 16:16:20', 24),
(31, '111', '서른한번째 게시글', '서른하나', 'client', '2015-11-18 16:17:02', 27),
(32, '111', '서른 두번째 게시글', '서른 둘', 'test', '2015-12-03 23:03:10', 2),
(33, '111', '서른 세번째 게시글', '서른 셋', 'test', '2015-12-03 23:28:57', 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `reply_table`
--

CREATE TABLE IF NOT EXISTS `reply_table` (
  `r_id` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `r_auther` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `r_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `r_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `reply_table`
--

INSERT INTO `reply_table` (`r_id`, `id`, `r_auther`, `r_content`, `r_created`) VALUES
(1, 25, 'client', 'sdfdd', '2015-12-03 17:18:40'),
(2, 19, 'client', 'sdfeeee', '2015-12-03 17:22:25'),
(3, 19, 'client', 'sddd', '2015-12-03 17:23:03'),
(4, 21, 'client', 'sdfeeee', '2015-12-03 17:23:17'),
(5, 24, 'client', 'sdfeee', '2015-12-03 17:26:02'),
(6, 23, 'client', 'ssss', '2015-12-03 21:53:55'),
(7, 25, 'client', 'ssss', '2015-12-03 21:54:06'),
(9, 22, 'client', 'sseddd', '2015-12-03 22:09:52'),
(10, 31, 'client', 'reply1', '2015-12-03 22:19:22'),
(11, 31, 'client', 'reply2', '2015-12-03 22:19:30'),
(12, 31, 'client', 'reply3', '2015-12-03 22:19:40'),
(13, 31, 'manager', 'reply4', '2015-12-03 22:20:36'),
(14, 31, 'manager', 'reply5', '2015-12-03 22:20:45'),
(15, 31, 'test', 'reply6', '2015-12-03 22:21:21'),
(16, 31, 'test', 'reply7', '2015-12-03 22:21:32'),
(21, 20, 'test', 'reply1', '2015-12-03 22:42:05'),
(22, 20, 'test', 'reply2', '2015-12-03 22:43:04'),
(23, 31, 'test', 'reply8', '2015-12-03 22:55:30'),
(24, 23, 'test', '댓댓댓', '2015-12-03 23:39:47');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `board_table`
--
ALTER TABLE `board_table`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `reply_table`
--
ALTER TABLE `reply_table`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `id` (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board_table`
--
ALTER TABLE `board_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- 테이블의 AUTO_INCREMENT `reply_table`
--
ALTER TABLE `reply_table`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `reply_table`
--
ALTER TABLE `reply_table`
  ADD CONSTRAINT `reply_table_ibfk_1` FOREIGN KEY (`id`) REFERENCES `board_table` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
