# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

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
