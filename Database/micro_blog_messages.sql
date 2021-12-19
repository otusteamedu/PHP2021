-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 13 2020 г., 19:41
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `users_bd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `micro_blog_messages`
--

CREATE TABLE `micro_blog_messages` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `user_id` varchar(256) NOT NULL,
  `isset_image` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `micro_blog_messages`
--

INSERT INTO `micro_blog_messages` (`id`, `text`, `date`, `user_id`, `isset_image`) VALUES
(508, 'hi', '2020-06-13', '229', 1),
(509, 'e', '2020-06-13', '229', 0),
(510, 'e', '2020-06-13', '229', 0),
(511, 'qqq', '2020-06-13', '229', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `micro_blog_messages`
--
ALTER TABLE `micro_blog_messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `micro_blog_messages`
--
ALTER TABLE `micro_blog_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=517;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
