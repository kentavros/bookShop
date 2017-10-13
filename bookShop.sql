-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 13 2017 г., 16:59
-- Версия сервера: 5.5.53
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bookShop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Johanna Basford'),
(2, 'Rupi Kaur'),
(3, 'Paul Auster'),
(4, 'B. A. Paris'),
(5, 'Roald Dahl'),
(6, 'George R. R. Martin'),
(7, 'J.K. Rowling'),
(8, 'Jane Austen');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `description` text NOT NULL,
  `discount` decimal(7,2) DEFAULT '0.00',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  `img` varchar(255) NOT NULL DEFAULT 'no_image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `title`, `price`, `description`, `discount`, `active`, `img`) VALUES
(1, 'Ivy and the Inky Butterfly', '12.95', 'Bring your own colour to the story. From colouring book queen Johanna Basford, a lavishly illustrated fable about a girl named Ivy who stumbles upon a secret door leading to the magical world of Enchantia. A charming story that interacts playfully with beautiful, colourable artwork in Johanna\'s signature style, Ivy and the Inky Butterfly is a one-of-a-kind adventure for the whole family and readers of all ages to customise, colour and cherish. Johanna has picked a crisp ivory paper that accentuates and compliments your chosen colour palette. The smooth, untextured pages allows for beautiful blending or gradient techniques with coloured pencils, or are perfect for pens, allowing the nib to glide evenly over the surface without feathering.', '5.00', 'yes', 'static/img/butterfly.jpg'),
(2, 'The Sun and Her Flowers', '11.06', 'From Rupi Kaur, the top ten Sunday Times bestselling author of milk and honey, comes her long-awaited second collection of poetry. Illustrated by Kaur, the sun and her flowers is a journey of wilting, falling, rooting, rising and blooming. It is a celebration of love in all its forms. this is the recipe of life said my mother as she held me in her arms as i wept think of those flowers you plantin the garden each year they will teach youthat people toomust wiltfallrootrisein order to bloom Praise for Sunday Times bestseller milk and honey: `Kaur is at the forefront of a poetry renaissance\' Observer `Kaur made her name with poems about love, life and grief. They resonate hugely\' Sunday Times `Poems tackling feminism, love, trauma and healing in short lines as smooth as pop music\' New York Times `Caught the imagination of a large, atypical poetry audience...Kaur knows the good her poetry does: it saves lives\' Evening Standard `Breathing new life into poetry...It has people reading, and listening\' The Pool', '35.00', 'yes', 'static/img/flowers.jpg'),
(3, '4 3 2 1', '21.77', 'LONGLISTED FOR THE MAN BOOKER PRIZE 2017On March 3, 1947, in the maternity ward of Beth Israel Hospital in Newark, New Jersey, Archibald Isaac Ferguson, the one and only child of Rose and Stanley Ferguson, is born. From that single beginning, Ferguson\'s life will take four simultaneous and independent fictional paths. Four Fergusons made of the same genetic material, four boys who are the same boy, will go on to lead four parallel and entirely different lives. Family fortunes diverge. Loves and friendships and intellectual passions contrast. Chapter by chapter, the rotating narratives evolve into an elaborate dance of inner worlds enfolded within the outer forces of history as, one by one, the intimate plot of each Ferguson\'s story rushes on across the tumultuous and fractured terrain of mid twentieth-century America. A boy grows up-again and again and again.As inventive and dexterously constructed as anything Paul Auster has ever written 4 3 2 1 is an unforgettable tour de force, the crowning work of this masterful writer\'s extraordinary career.', '0.00', 'yes', 'static/img/4321.jpg'),
(4, '\r\nThe Breakdown: The 2017 gripping thriller from the bestselling author of Behind Closed Doors', '21.21', '`A psychological page-turner\' - Good Housekeeping If you can\'t trust yourself, who can you trust? It all started that night in the woods. Cass Anderson didn\'t stop to help the woman in the car, and now she\'s dead. Ever since, silent calls have been plaguing Cass and she\'s sure someone is watching her. Consumed by guilt, she\'s also starting to forget things. Whether she took her pills, what her house alarm code is - and if the knife in the kitchen really had blood on it. Bestselling author B A Paris is back with a brand new psychological thriller full of twists and turns that will keep you on the edge of your seat.', '0.00', 'yes', 'static/img/break.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `book_to_author`
--

CREATE TABLE `book_to_author` (
  `id_book` int(11) NOT NULL,
  `id_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `book_to_author`
--

INSERT INTO `book_to_author` (`id_book`, `id_author`) VALUES
(1, 1),
(1, 3),
(2, 2),
(2, 1),
(3, 3),
(4, 4),
(4, 5),
(4, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `book_to_genre`
--

CREATE TABLE `book_to_genre` (
  `id_book` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `book_to_genre`
--

INSERT INTO `book_to_genre` (`id_book`, `id_genre`) VALUES
(1, 4),
(1, 3),
(2, 9),
(2, 8),
(3, 5),
(3, 4),
(3, 7),
(3, 6),
(4, 5),
(4, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `login` varchar(11) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `discount` decimal(7,0) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'detective'),
(2, 'thriller'),
(3, 'drama'),
(4, 'documental literature'),
(5, 'art'),
(6, 'love story'),
(7, 'poetry'),
(8, 'novel'),
(9, 'western');

-- --------------------------------------------------------

--
-- Структура таблицы `history_book`
--

CREATE TABLE `history_book` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `price` decimal(7,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `status` enum('processed','sent') NOT NULL DEFAULT 'processed',
  `id_payment` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `total_price` decimal(7,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders_full_info`
--

CREATE TABLE `orders_full_info` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_book` int(11) NOT NULL,
  `title_book` varchar(255) NOT NULL,
  `count` int(11) NOT NULL,
  `price` decimal(7,0) NOT NULL,
  `discount_book` decimal(7,0) NOT NULL,
  `discount_client` decimal(7,0) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `book_to_author`
--
ALTER TABLE `book_to_author`
  ADD KEY `book_to_author_fk0` (`id_author`),
  ADD KEY `book_to_author_fk1` (`id_book`);

--
-- Индексы таблицы `book_to_genre`
--
ALTER TABLE `book_to_genre`
  ADD KEY `book_to_genre_fk0` (`id_genre`),
  ADD KEY `book_to_genre_fk1` (`id_book`);

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_fk0` (`id_book`),
  ADD KEY `cart_fk1` (`id_client`);

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `history_book`
--
ALTER TABLE `history_book`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_fk0` (`id_client`),
  ADD KEY `orders_fk1` (`id_payment`);

--
-- Индексы таблицы `orders_full_info`
--
ALTER TABLE `orders_full_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_full_info_fk0` (`id_order`),
  ADD KEY `orders_full_info_fk1` (`id_book`);

--
-- Индексы таблицы `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `history_book`
--
ALTER TABLE `history_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `orders_full_info`
--
ALTER TABLE `orders_full_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book_to_author`
--
ALTER TABLE `book_to_author`
  ADD CONSTRAINT `book_to_author_fk0` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id`),
  ADD CONSTRAINT `book_to_author_fk1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`);

--
-- Ограничения внешнего ключа таблицы `book_to_genre`
--
ALTER TABLE `book_to_genre`
  ADD CONSTRAINT `book_to_genre_fk0` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id`),
  ADD CONSTRAINT `book_to_genre_fk1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`);

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_fk0` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `cart_fk1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_fk0` FOREIGN KEY (`id_client`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `orders_fk1` FOREIGN KEY (`id_payment`) REFERENCES `payment` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders_full_info`
--
ALTER TABLE `orders_full_info`
  ADD CONSTRAINT `orders_full_info_fk0` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orders_full_info_fk1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
