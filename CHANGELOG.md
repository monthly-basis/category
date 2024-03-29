# Changelog

## v0.0.27

```
ALTER TABLE `category` ADD `active` tinyint unsigned NOT NULL DEFAULT '1' AFTER `question_count_cached`;
```

## v0.0.23

### Added

- Fulltext index on `category`.`name` column
```
ALTER TABLE `category` ADD FULLTEXT `name_fulltext` (`name`);
```

## v0.0.21

### Added

- `category`.`image_rru` column
```
 ALTER
 TABLE `category`
   ADD
COLUMN `image_rru` varchar(255) COLLATE utf8mb4_0900_as_cs DEFAULT NULL
 AFTER `description`
     ;
```

## v0.0.17

### Added

- `category`.`description` column
```
 ALTER
 TABLE `category`
   ADD
COLUMN `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_as_cs DEFAULT NULL
 AFTER `name`
     ;
```

## v0.0.13

### Added

- `category`.`question_count_cached` column
```
 ALTER
 TABLE `category`
   ADD
COLUMN `question_count_cached` int unsigned DEFAULT NULL
 AFTER `name`
     ;
```
