# Swiftfood
Swiftfood is a food ordering project built in Laraval with SQLite database. It has a login/registration system and an admin panel with CRUD operations for the items, categories and orders. Every form is validated and the project provides authetication for the users and the admins.

Images of the project can be found in the example_images folder.

![Swiftfood main screen](./example_images/websho_start_page.PNG)

## System requirements for installation
 * PHP Version >= 7.3
 * Composer
 * XDebug

## Installation steps and running the project
* composer install (installs the necessary php packages)
* npm install (installs the necessary npm packages)
* npm run dev (runs the project in developer mode)
* php artisan migrate:fresh (refreshes the database)
* php artisan db:seed (seeds the database with pre-built data)
* php artisan serve (starts php built in developement server)
