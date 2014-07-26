# Obo demo application #
It is simple demo application for person, sex, note or tag registration. The main purpose is to present potential and usage of Obo framework for end programmers.

## Licence ##
http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0

## Requirements ##
 - PHP 5.3.1 or later
 - DB MySQL

## Installation ##
 - install dependencies with Composer
 - set write access for web-server user to log/ and temp/ folders
 - create database
 - execute demo.sql
 - configure database access in app/config/config.neon (better in app/config/config.local.neon)
 - learn and profit

### Files ###
 - app/models - domain logic
 - app/presenters
 - app/templates
 - app/components - paginator and filter components

 - app/config/config.neon - configuration of application
 - app/bootstrap.php - start file of application