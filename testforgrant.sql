-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 17 2018 г., 00:54
-- Версия сервера: 5.5.58
-- Версия PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testforgrant`
--

-- --------------------------------------------------------

--
-- Структура таблицы `interval_price`
--

CREATE TABLE `interval_price` (
  `interval_id` int(11) UNSIGNED NOT NULL,
  `prod_id` int(11) UNSIGNED NOT NULL,
  `interval_start` date NOT NULL,
  `interval_end` date NOT NULL,
  `interval_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `interval_price`
--

INSERT INTO `interval_price` (`interval_id`, `prod_id`, `interval_start`, `interval_end`, `interval_price`) VALUES
(25, 1, '2016-01-01', '9999-12-31', 8000),
(27, 1, '2016-05-01', '2017-01-01', 12000),
(28, 1, '2016-07-01', '2016-09-10', 15000),
(29, 1, '2017-06-01', '2017-10-20', 20000),
(30, 1, '2017-12-15', '2017-12-31', 5000),
(32, 2, '2016-07-01', '2016-09-10', 333);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_img` varchar(255) NOT NULL,
  `price_definition` tinyint(1) NOT NULL DEFAULT '0',
  `default_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `prod_name`, `prod_img`, `price_definition`, `default_price`) VALUES
(1, 'Школьная форма', '2Q0A8817k-auto-280.jpg', 0, 10000),
(2, 'Рубашка', '2Q0A8756k-auto-280.jpg', 0, 702222),
(3, 'Комбинезон', '19-auto-280.jpg', 1, 33);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `interval_price`
--
ALTER TABLE `interval_price`
  ADD PRIMARY KEY (`interval_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `interval_price`
--
ALTER TABLE `interval_price`
  MODIFY `interval_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `interval_price`
--
ALTER TABLE `interval_price`
  ADD CONSTRAINT `interval_price_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
