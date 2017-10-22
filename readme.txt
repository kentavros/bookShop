1) for class DB
ALTER TABLE `authors` ADD UNIQUE(`name`);

ALTER TABLE `genres` ADD UNIQUE(`name`);

ALTER TABLE `books` ADD UNIQUE(`title`);

ALTER TABLE `history_book` CHANGE `name` `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;

ALTER TABLE `history_book` CHANGE `price` `price` DECIMAL(7,2) NOT NULL;