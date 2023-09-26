CREATE TABLE `products` (
	`item_id` INT(10) AUTO_INCREMENT NOT NULL,
	`item_name` VARCHAR(20) NOT NULL, 
	`item_desc` VARCHAR(200) NOT NULL, 
	`item_img` VARCHAR(20) NOT NULL, 
	`item_price` DECIMAL(4,2) NOT NULL, 
	PRIMARY KEY (`item_id`)
	);
