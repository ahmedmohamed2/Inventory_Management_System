# Inventory Management System
## Guide to install

## 1 - Clone current repository
	git clone https://github.com/ahmedmohamed2/Inventory_Management_System.git

## 2 - Install dependencies
	composer install

## 3 - Change name of the (.env.examle) file to (.env)
	mv .env.example .env

## 4 - Generate key
	php artisan key:generate

## 5 - Create database
for example

	CREATE DATABASE inventory_system CHARACTER SET utf8 COLLATE utf8_general_ci

## 6 - Change database name, username and password in .env file
for example

	DB_DATABASE=inventory_system
	DB_USERNAME=root
	DB_PASSWORD=root

## 7 - Run migrate to create the tables
    php artisan migrate

## 8 - Run this seeder to add user to database
    php artisan db:seed --class=UsersSeeder

## 9 - Run the server
    php artisan serve

## 10 - Go To Browser
	http://127.0.0.1:8000/login
