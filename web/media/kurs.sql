-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2016 at 07:49 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 5.6.28-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kurs`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keywords` tinytext NOT NULL,
  `magazine_title` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `description`, `user_id`, `created_at`, `keywords`, `magazine_title`) VALUES
(2, 'Первая публикация', 'ыапва', 4, '2016-12-14 16:36:26', 'первая, впи, слово', 'Вестник ВПИ'),
(3, 'fdsgfdg', 'dfgdfg', 4, '2016-12-14 16:46:05', 'dfgdfg', 'dgfdg');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `price`, `teacher_id`) VALUES
(2, 'fghfghf', 'gdfgd', 2323, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `created_at`, `title`, `content`) VALUES
(3, 324324, 'efgfg', 'fghf');

-- --------------------------------------------------------

--
-- Table structure for table `olympics`
--

CREATE TABLE `olympics` (
  `id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `desctiption` text NOT NULL,
  `from_ts` int(11) NOT NULL,
  `to_ts` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `olympics`
--

INSERT INTO `olympics` (`id`, `title`, `desctiption`, `from_ts`, `to_ts`, `teacher_id`) VALUES
(1, 'efgdfg', 'dfgfdg', 1480896000, 1480982400, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `second_name` text NOT NULL,
  `third_name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `first_name`, `second_name`, `third_name`) VALUES
(1, 'Марина', 'Фадеева', 'Павловна');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `salt` tinytext NOT NULL,
  `first_name` tinytext NOT NULL,
  `second_name` tinytext NOT NULL,
  `third_name` tinytext NOT NULL,
  `address_residence` tinytext NOT NULL,
  `place_work` tinytext NOT NULL,
  `birth_date` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `salt`, `first_name`, `second_name`, `third_name`, `address_residence`, `place_work`, `birth_date`, `role`) VALUES
(1, 'admin', '923ed0f2eeafcf069f5e67bc4f8d8b1e', 'GfXiNaPKVW0hX7', '', '', '', '', '', 0, 0),
(2, 'student', '87d732f21c1498557c070e9804bd9611', '$2y$13$p56268sm3FR08ZxvnSPHlU', '', '', '', '', '', 0, 0),
(3, 'xxx', '8357c10d17d51c51558eb5e23c5fcf48', '$2y$13$w0veSBg8UdGtECKm055g/t', '', '', '', '', '', 0, 0),
(4, 'yyy', 'c9170139ac66ee987de7e0a623018bb2', '$2y$13$KKV5KVp9YKO.oA39DOZSD7', 'sdfgfdg', 'dfgd', 'gdfgdfg', 'dfgdfg', 'dfgdf', 1482796800, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `olympics`
--
ALTER TABLE `olympics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_2` (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `olympics`
--
ALTER TABLE `olympics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
