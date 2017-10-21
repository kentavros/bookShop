1) for class DB
ALTER TABLE `authors` ADD UNIQUE(`name`);

ALTER TABLE `genres` ADD UNIQUE(`name`);

ALTER TABLE `books` ADD UNIQUE(`title`);