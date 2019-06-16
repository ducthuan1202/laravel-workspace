#!/bin/bash

echo -e "\e[96m STEP 1: Create .env \e[39m"
cp -i .env.example .env

echo -e "\e[96m STEP 2: Install composer \e[39m"
composer install

echo -e "\e[96m STEP 3: Composer dump-autoload \e[39m"
composer dump-autoload

echo -e "\e[96m STEP 4: Generate key \e[39m"
php artisan key:generate

echo -e "\e[96m STEP 6: Migrate and seeder data \e[39m"
php artisan migrate:refresh --seed

