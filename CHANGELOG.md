# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
