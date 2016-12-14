-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 15 2016 г., 06:38
-- Версия сервера: 5.5.25
-- Версия PHP: 5.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `kurs`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `keywords` tinytext NOT NULL,
  `magazine_title` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `title`, `description`, `user_id`, `created_at`, `keywords`, `magazine_title`) VALUES
(2, 'Первая публикация', 'ыапва', 4, '2016-12-14 16:36:26', 'первая, впи, слово', 'Вестник ВПИ'),
(3, 'fdsgfdg', 'dfgdfg', 4, '2016-12-14 16:46:05', 'dfgdfg', 'dgfdg'),
(4, 'Криптографические протоколы: основные свойства и уязвимости', 'В лекции рассматриваются основные понятия, связанные с криптографическими протоколами, определяются их основные свойства и уязвимости. Приводятся примеры атак на протоколы. Изложение сопровождается примерами, иллюстрирующими слабости некоторых известных протоколов. Приводится описание некоторых современных систем автоматизированного анализа протоколов.', 5, '2016-12-14 21:48:39', 'вестник, автоматика, протоколы', 'Вестник ВПИ'),
(5, 'dfhgfg', '23434543', 5, '2016-12-14 22:06:19', 'fhf', 'hfghgf');

-- --------------------------------------------------------

--
-- Структура таблицы `collaboration`
--

CREATE TABLE IF NOT EXISTS `collaboration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `collaboration`
--

INSERT INTO `collaboration` (`id`, `article_id`, `user_id`) VALUES
(3, 5, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `price`, `teacher_id`) VALUES
(2, 'fghfghf', 'gdfgd', 2323, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `created_at`, `title`, `content`) VALUES
(3, 324324, 'efgfg', 'fghf');

-- --------------------------------------------------------

--
-- Структура таблицы `olympics`
--

CREATE TABLE IF NOT EXISTS `olympics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `desctiption` text NOT NULL,
  `from_ts` int(11) NOT NULL,
  `to_ts` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `olympics`
--

INSERT INTO `olympics` (`id`, `title`, `desctiption`, `from_ts`, `to_ts`, `teacher_id`) VALUES
(1, 'efgdfg', 'dfgfdg', 1480896000, 1480982400, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` text NOT NULL,
  `second_name` text NOT NULL,
  `third_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`id`, `first_name`, `second_name`, `third_name`) VALUES
(1, 'Марина', 'Фадеева', 'Павловна');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `salt` tinytext NOT NULL,
  `first_name` tinytext NOT NULL,
  `second_name` tinytext NOT NULL,
  `third_name` tinytext NOT NULL,
  `address_residence` tinytext NOT NULL,
  `place_work` tinytext NOT NULL,
  `birth_date` int(11) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `salt`, `first_name`, `second_name`, `third_name`, `address_residence`, `place_work`, `birth_date`, `role`) VALUES
(1, 'admin', '923ed0f2eeafcf069f5e67bc4f8d8b1e', 'GfXiNaPKVW0hX7', '', '', '', '', '', 0, -1),
(5, 'xxx', '0204485e87a9cb887ae2d3dc4b590d75', '$2y$13$zxxJvACU3RIpFN1pjqxuSR', 'Артем', 'Заяцкий', 'Владимирович', 'Санкт-Петербург', 'Санкт-Петербург', 628214400, 0),
(4, 'yyy', 'c9170139ac66ee987de7e0a623018bb2', '$2y$13$KKV5KVp9YKO.oA39DOZSD7', 'sdfgfdg', 'dfgd', 'gdfgdfg', 'dfgdfg', 'dfgdf', 1482796800, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
