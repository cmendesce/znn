# Developing ZNN

ZNN is web system based on a LAMP stack. To build ZNN requires that apache, mysql, php, and some other packages.

## Getting started

Before start, check if you have installed **php 7**, **composer**, **docker** and **docker-compose**. Docker and docker-compose aren't required, it's used to run mysql.

## Installing mysql

DRAFT

If you have a mysql installation avaliable, configure it as described in this document, otherwise install docker and docker-compose to get mysql running for development proporses.

Assuming you have docker-compose running, run `docker-compose up -d` and you'll have a mysql instance running with the credentials configured in docker-compose file.

/DRAFT

## Installing database

Assuming you have a mysql instance running and have set the `.env` file, so you just run `php init.php` to create the tables and populate then.

## Running locally

Run `composer install` to download all dependencies.

Run `php -S localhost:8088` and open your browser at [http://localhost:8088/news.php](http://localhost:8088/news.php) to get ZNN news page.