# Shorten the URL

## Setup
You can setup this sample manually or use [Vagrant](https://www.vagrantup.com/) to automatically set up a development environment for you.

## Manual
* Clone repo ```git clone {{repo name}}```
* Create your .env file from the example file: ```cp .env.example .env```
* Install composer dependencies: composer install
* Run the following commands:
  * ```php artisan migrate```
* Server: run ```php artisan serve```
* Browse to localhost:8000
