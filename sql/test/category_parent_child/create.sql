CREATE TABLE `category_parent_child` (
  `category_parent_child_id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int unsigned NOT NULL,
  `child_id` int unsigned NOT NULL,
  PRIMARY KEY (`category_parent_child_id`),
  UNIQUE KEY `parent_id_child_id` (`parent_id`, `child_id`),
  FOREIGN KEY (`parent_id`) REFERENCES `category` (`category_id`),
  FOREIGN KEY (`child_id`) REFERENCES `category` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
