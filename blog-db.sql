-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 04 2016 г., 19:01
-- Версия сервера: 10.1.13-MariaDB
-- Версия PHP: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog-db`
--
CREATE DATABASE IF NOT EXISTS `blog-db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `blog-db`;

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `date`) VALUES
(1, 'Computer Technologies', 'In the near future we will forget how to do stuff with hands&#46 We will all be dependent on technology, is it good or bad?\r\n\r\nThrough the Google voice search feature, users on all platforms that have a Google app have been able to conduct their internet explorations verbally for some time&#46 It&#39s an easy to use feature, and one that helps you with hands&#45free searching&#46\r\nBut most people probably don&#39t know that Google is keeping track of these searches too&#46&#46&#46 and in a different location from the rest of your search history&#46\r\nIf you&#39ve ever used a Google voice search, you might want to go check out that link above right now&#46\r\nBut even for those with clean search histories, it&#39s worth taking a look to make sure Google didn&#39t &#34hear&#34 anything you didn&#39t want it to hear&#46 Especially if you&#39re an Android user&#46\r\nOn Android phones, anyone can say the phrase &#34Ok Google&#34 within an earshot of an Android phone, and the phone will start listening, expecting orders&#46 You may not realize it&#39s been activated, and you may not realize it&#39s stored part of an intimate conversation, or whatever else it picked up&#46', '2016-06-04');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `hash`, `role`) VALUES
(1, 'admin', '1f32aa4c9a1d2ea010adcf2348166a04', '', 777),
(2, 'admin', '1f32aa4c9a1d2ea010adcf2348166a04', '', 777);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
