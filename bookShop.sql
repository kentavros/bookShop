-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 23 2017 г., 15:57
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
(41, '2A.S. 11'),
(4, 'B. A. Paris'),
(45, 'ccccccc1111'),
(43, 'edittttttttt'),
(6, 'George R. R. Martin'),
(7, 'J.K. Rowling'),
(8, 'Jane Austen'),
(1, 'Johanna Basford'),
(44, 'Kukushkin'),
(3, 'Paul Auster'),
(5, 'Roald Dahl'),
(2, 'Rupi Kaur'),
(9, 'Sarah Winman');

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
  `img` varchar(255) NOT NULL DEFAULT 'static/img/no_image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `title`, `price`, `description`, `discount`, `active`, `img`) VALUES
(1, 'Ivy and the Inky Butterfly', '12.95', 'Bring your own colour to the story. From colouring book queen Johanna Basford, a lavishly illustrated fable about a girl named Ivy who stumbles upon a secret door leading to the magical world of Enchantia. A charming story that interacts playfully with beautiful, colourable artwork in Johanna\'s signature style, Ivy and the Inky Butterfly is a one-of-a-kind adventure for the whole family and readers of all ages to customise, colour and cherish. Johanna has picked a crisp ivory paper that accentuates and compliments your chosen colour palette. The smooth, untextured pages allows for beautiful blending or gradient techniques with coloured pencils, or are perfect for pens, allowing the nib to glide evenly over the surface without feathering.', '5.00', 'yes', 'static/img/butterfly.jpg'),
(2, 'The Sun and Her Flowers', '11.06', 'From Rupi Kaur, the top ten Sunday Times bestselling author of milk and honey, comes her long-awaited second collection of poetry. Illustrated by Kaur, the sun and her flowers is a journey of wilting, falling, rooting, rising and blooming. It is a celebration of love in all its forms. this is the recipe of life said my mother as she held me in her arms as i wept think of those flowers you plantin the garden each year they will teach youthat people toomust wiltfallrootrisein order to bloom Praise for Sunday Times bestseller milk and honey: `Kaur is at the forefront of a poetry renaissance\' Observer `Kaur made her name with poems about love, life and grief. They resonate hugely\' Sunday Times `Poems tackling feminism, love, trauma and healing in short lines as smooth as pop music\' New York Times `Caught the imagination of a large, atypical poetry audience...Kaur knows the good her poetry does: it saves lives\' Evening Standard `Breathing new life into poetry...It has people reading, and listening\' The Pool', '35.00', 'yes', 'static/img/flowers.jpg'),
(3, '4 3 2 1 MAN BOOKER', '21.77', 'LONGLISTED FOR THE MAN BOOKER PRIZE 2017On March 3, 1947, in the maternity ward of Beth Israel Hospital in Newark, New Jersey, Archibald Isaac Ferguson, the one and only child of Rose and Stanley Ferguson, is born. From that single beginning, Ferguson\'s life will take four simultaneous and independent fictional paths. Four Fergusons made of the same genetic material, four boys who are the same boy, will go on to lead four parallel and entirely different lives. Family fortunes diverge. Loves and friendships and intellectual passions contrast. Chapter by chapter, the rotating narratives evolve into an elaborate dance of inner worlds enfolded within the outer forces of history as, one by one, the intimate plot of each Ferguson\'s story rushes on across the tumultuous and fractured terrain of mid twentieth-century America. A boy grows up-again and again and again.As inventive and dexterously constructed as anything Paul Auster has ever written 4 3 2 1 is an unforgettable tour de force, the crowning work of this masterful writer\'s extraordinary career.', '0.00', 'yes', 'static/img/4321.jpg'),
(4, 'The Breakdown: The 2017', '21.21', 'A psychological page-turner\' - Good Housekeeping If you can\'t trust yourself, who can you trust? It all started that night in the woods. Cass Anderson didn\'t stop to help the woman in the car, and now she\'s dead. Ever since, silent calls have been plaguing Cass and she\'s sure someone is watching her. Consumed by guilt, she\'s also starting to forget things. Whether she took her pills, what her house alarm code is - and if the knife in the kitchen really had blood on it. Bestselling author B A Paris is back with a brand new psychological thriller full of twists and turns that will keep you on the edge of your seat.', '0.00', 'yes', 'static/img/break.jpg'),
(5, 'Milk and Honey', '8.93', 'New York Times bestseller Milk and Honey is a collection of poetry and prose about survival. About the experience of violence, abuse, love, loss, and femininity. The book is divided into four chapters, and each chapter serves a different purpose. Deals with a different pain. Heals a different heartache. Milk and Honey takes readers through a journey of the most bitter moments in life and finds sweetness in them because there is sweetness everywhere if you are just willing to look. * Self-published edition sold 10,000 copies in nine months in the US, and over 1400 copies through UK Bookscan. * Over 1.5million copies sold worldwide. * AMP edition has now sold over 71,000 copies through UK Bookscan (June 2017), and is the bestselling Poetry book in 2017 in the UK. * As of July 2017, Milk and Honey was the bestselling title in the US - across all categories. * Rupi has 1.3m Instagram followers; 130K twitter followers; and 346K Facebook fans. * Strong appeal for fans of Lang Laev, author of Love & Misadventure and Lullabies.', '0.00', 'yes', 'static/img/no_image.jpg'),
(6, 'Tin Man', '11.31', 'The beautiful and heartbreaking new novel from Sarah Winman, author of the international bestseller WHEN GOD WAS A RABBIT.\'Her best novel to date\' Observer\'An exquisitely crafted tale of love and loss\' Guardian\'A marvel\' Sunday Express\'Astoundingly beautiful\' Matt HaigIt begins with a painting won in a raffle: fifteen sunflowers, hung on the wall by a woman who believes that men and boys are capable of beautiful things. And then there are two boys, Ellis and Michael,who are inseparable. And the boys become men,and then Annie walks into their lives,and it changes nothing and everything.Tin Man sees Sarah Winman follow the acclaimed success of When God Was A Rabbit and A Year Of Marvellous Ways with a love letter to human kindness and friendship, loss and living.', '0.00', 'yes', 'static/img/tin_man.jpg'),
(8, 'The Very Hungry', '6.49', 'Eric Carle\'s classic, The Very Hungry Caterpillar, in board book format.A much-loved classic, The Very Hungry Caterpillar has won over millions of readers with its vivid and colourful collage illustrations and its deceptively simply, hopeful story. With its die-cut pages and finger-sized holes to explore, this is a richly satisfying book for children.Eric Carle is an internationally bestselling and award-winning author and illustrator of books for very young children. Eric lives in Massachusetts with his wife, Barbara. The Carles opened The Eric Carle Museum of Picture Book Art in Massachusetts in 2002.Don\'t miss all the other Very Hungry Caterpillar and Eric Carle books:The Very Hungry Caterpillar; Eric Carle\'s Very Special Baby Book; Polar Bear, Polar Bear, What do You Hear?; The Very busy Spider; The Very Quiet Cricket; The Artist Who Painted a Blue Horse; 1, 2, 3 to the Zoo; Baby Bear, Baby Bear, What do you See?; The Very Hungry Caterpillar Pop-Up Book; Polar Bear, Polar Bear, What Do You Hear?; The Very Hungry Caterpillar\'s Buggy Book; Brown Bear', '0.00', 'yes', 'static/img/no_image.jpg'),
(12, 'Artem1', '35.54', 'zzcazcasdcacasccasc', '50.00', 'yes', 'static/img/no_image.jpg'),
(13, 'test3333', '2.00', 'testtesttesttest', '4.00', 'yes', 'static/img/no_image.jpg'),
(14, '2test3', '50.45', 'fffff', '0.00', 'no', 'static/img/no_image.jpg'),
(15, 'Book7', '35.50', 'dfvsvsdsdvsdvsdvdsv', '41.60', 'yes', 'static/img/no_image.jpg');

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
(4, 6),
(5, 2),
(6, 9),
(8, 4),
(12, 41),
(14, 7),
(14, 8),
(13, 7),
(13, 6),
(15, 45);

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
(4, 6),
(5, 6),
(6, 6),
(8, 7),
(12, 6),
(14, 1),
(14, 5),
(13, 5),
(15, 10);

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

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `id_book`, `id_client`, `count`) VALUES
(9, 6, 20, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `login` varchar(11) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `discount` decimal(7,2) NOT NULL DEFAULT '0.00',
  `hash` varchar(255) NOT NULL DEFAULT 'first_hash',
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `login`, `pass`, `discount`, `hash`, `role`, `active`) VALUES
(1, 'Бронислав', 'aaaa', 'aaaa', '2f7b52aacfbf6f44e13d27656ecb1f59', '10.00', 'db3c35a71fb3de325024686521dbeaa1', 'user', 'yes'),
(13, 'dderuiiu', 'dsvvdff', 'vasia', '2f7b52aacfbf6f44e13d27656ecb1f59', '30.00', 'ae8969467b0cc30d43996fb481fca56d', 'user', 'yes'),
(15, 'Рутище', 'СуперПупер', 'admin', 'c3284d0f94606de1fd2af172aba15bf3', '0.00', '1b6617c0b3e76c3a5b9a5f859550d633', 'admin', 'yes'),
(16, 'pup', 'ssss', 'vbnm', 'ec6a6536ca304edf844d1d248a4f08dc', '0.00', 'first_hash', 'user', 'yes'),
(17, 'cccccv', 'vvvvvv', 'rrrr', '2f7b52aacfbf6f44e13d27656ecb1f59', '0.00', 'first_hash', 'user', 'yes'),
(18, 'PUPA', 'ZaBrulov', 'Pzaaa', '2f7b52aacfbf6f44e13d27656ecb1f59', '0.00', 'first_hash', 'user', 'yes'),
(19, 'Xrusha', 'Ivanov', 'bbbb', '4e3da2ae832730d1abbf10611df36ea6', '0.00', '687a6cc3953abb928f3247357832a1d7', 'user', 'yes'),
(20, 'АлЁша', 'Sherbanyk', 'artem', '14e1b600b1fd579f47433b88e8d85291', '1.00', '0a43522ec79e9db58c43688bc02c249c', 'user', 'yes'),
(22, 'Федот222', 'Кукушкин', 'vvvv', '2f7b52aacfbf6f44e13d27656ecb1f59', '0.00', 'c3a4697224bb03f4288ce02cc2381eda', 'user', 'yes');

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(5, 'art'),
(1, 'detective'),
(4, 'documental literature'),
(3, 'drama'),
(6, 'love story'),
(10, 'nnnnnn11111'),
(8, 'novel'),
(7, 'poetry'),
(2, 'thriller'),
(9, 'western');

-- --------------------------------------------------------

--
-- Структура таблицы `history_book`
--

CREATE TABLE `history_book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `price` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `history_book`
--

INSERT INTO `history_book` (`id`, `title`, `genre`, `author`, `price`) VALUES
(1, 'test', 'drama love story novel ', 'edittttttttt George R. R. Martin ', '2.00'),
(2, '2test', 'drama ', 'George R. R. Martin J.K. Rowling ', '1.00'),
(3, 'Book7', 'nnnnnn11111 ', 'ccccccc1111 ', '35.50');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `discount_client` decimal(10,0) NOT NULL DEFAULT '0',
  `status` enum('processed','sent') NOT NULL DEFAULT 'processed',
  `id_payment` int(11) NOT NULL,
  `total_discount` decimal(7,2) NOT NULL,
  `total_price` decimal(7,2) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `id_client`, `discount_client`, `status`, `id_payment`, `total_discount`, `total_price`, `date_time`) VALUES
(57, 1, '10', 'processed', 8, '6.47', '17.54', '2017-10-18 13:32:00'),
(59, 1, '10', 'processed', 4, '21.56', '153.27', '2017-10-18 13:54:13'),
(60, 1, '10', 'processed', 5, '6.47', '17.54', '2017-10-18 14:05:33'),
(61, 1, '10', 'sent', 8, '1.88', '11.07', '2017-10-18 14:06:02'),
(62, 1, '10', 'sent', 7, '30.67', '119.06', '2017-10-18 19:07:34'),
(63, 1, '10', 'processed', 1, '10.60', '95.45', '2017-10-18 23:38:29'),
(64, 1, '10', 'processed', 3, '5.63', '33.22', '2017-10-19 19:39:51'),
(65, 19, '0', 'processed', 5, '0.00', '24.29', '2017-10-22 03:26:09'),
(66, 20, '0', 'processed', 1, '7.74', '59.62', '2017-10-22 07:14:12'),
(67, 15, '0', 'sent', 8, '3.87', '7.19', '2017-10-22 14:52:03'),
(68, 1, '10', 'processed', 8, '19.61', '95.05', '2017-10-23 12:10:16'),
(69, 22, '0', 'sent', 7, '3.24', '61.51', '2017-10-23 12:11:20');

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
  `price` decimal(7,2) NOT NULL,
  `discount_book` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders_full_info`
--

INSERT INTO `orders_full_info` (`id`, `id_order`, `id_book`, `title_book`, `count`, `price`, `discount_book`) VALUES
(15, 57, 1, 'Ivy and the Inky Butterfly', 1, '12.95', '5.00'),
(16, 57, 2, 'The Sun and Her Flowers', 1, '11.06', '35.00'),
(17, 59, 6, 'Tin Man', 4, '11.31', '0.00'),
(18, 59, 8, 'The Very Hungry', 6, '6.49', '0.00'),
(19, 59, 1, 'Ivy and the Inky Butterfly', 7, '12.95', '5.00'),
(20, 60, 1, 'Ivy and the Inky Butterfly', 1, '12.95', '5.00'),
(21, 60, 2, 'The Sun and Her Flowers', 1, '11.06', '35.00'),
(22, 61, 1, 'Ivy and the Inky Butterfly', 1, '12.95', '5.00'),
(23, 62, 1, 'Ivy and the Inky Butterfly', 9, '12.95', '5.00'),
(24, 62, 2, 'The Sun and Her Flowers', 3, '11.06', '35.00'),
(25, 63, 4, 'The Breakdown: The 2017', 5, '21.21', '0.00'),
(26, 64, 1, 'Ivy and the Inky Butterfly', 3, '12.95', '5.00'),
(27, 65, 8, 'The Very Hungry', 2, '6.49', '0.00'),
(28, 65, 6, 'Tin Man', 1, '11.31', '0.00'),
(29, 66, 2, 'The Sun and Her Flowers', 2, '11.06', '35.00'),
(30, 66, 6, 'Tin Man', 4, '11.31', '0.00'),
(31, 67, 2, 'The Sun and Her Flowers', 1, '11.06', '35.00'),
(32, 68, 1, 'Ivy and the Inky Butterfly', 8, '12.95', '5.00'),
(33, 68, 2, 'The Sun and Her Flowers', 1, '11.06', '35.00'),
(34, 69, 1, 'Ivy and the Inky Butterfly', 5, '12.95', '5.00');

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `payment`
--

INSERT INTO `payment` (`id`, `name`) VALUES
(1, 'PayPal'),
(2, 'RBK Money'),
(3, 'Yandex Money'),
(4, 'LiqPay'),
(5, 'Ukash'),
(6, 'EasyPay'),
(7, 'AlertPay'),
(8, 'QIWI');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

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
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `history_book`
--
ALTER TABLE `history_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT для таблицы `orders_full_info`
--
ALTER TABLE `orders_full_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT для таблицы `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
  ADD CONSTRAINT `book_to_genre_fk0` FOREIGN KEY (`id_genre`) REFERENCES `genres` (`id`),
  ADD CONSTRAINT `book_to_genre_fk1` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`);

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_fk0` FOREIGN KEY (`id_book`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `cart_fk1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_fk0` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`),
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
