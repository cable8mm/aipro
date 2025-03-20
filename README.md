# AI Pro - Smart WMS Solution

[![build & tests](https://github.com/cable8mm/aipro/actions/workflows/run-tests.yml/badge.svg)](https://github.com/cable8mm/aipro/actions/workflows/run-tests.yml)
[![coding style](https://github.com/cable8mm/aipro/actions/workflows/code-style.yml/badge.svg)](https://github.com/cable8mm/aipro/actions/workflows/code-style.yml)
[![minimum PHP version](https://img.shields.io/badge/php-%5E8.3-8892BF?logo=php)](https://github.com/cable8mm/aipro)
![Laravel 12.x](https://img.shields.io/badge/Laravel-%5E12.0-FF2D20?logo=Laravel&logoColor=FF2D20&labelColor=white)
![Laravel Nova 5.x](https://img.shields.io/badge/Nova-%5E5.0-00E2FE?logo=Laravel%20nova&logoColor=00E2FE&color=00E2FE)

AIPro is a solution designed for companies with warehouses to keep their WMS (Warehouse Management System) and product information up-to-date, providing this information effectively to vendors and customers. It leverages AI technology and mobile tools to enhance operational convenience and deliver cost-efficient services.

![Main Screen](docs/images/aipro_screen_main.png)*Main page*

![Goods Screen](docs/images/aipro_screen_items.png)*Goods List*

![API document](docs/images/aipro_screen_apidoc.png)*API Documents*

## Installation

[Install Laravel Herd](https://herd.laravel.com) and set up as php 8.3.

Cloning:

```sh
cd ~/Sites

git clone https://github.com/cable8mm/aipro.git

cd aipro
```

Setting:

```sh
composer install # install Project

php artisan storage:link # for uploading images and files

herd secure # set https

composer global update; # update global composer

npm install # install npm libraries

herd open # visit https://aipro.test
```

Database:

- Database : aipro

```sh
php artisan migrate

php artisan nova:user

# make Name, Email Address, Password and create user
```

You'd better use not mysql but sqlite while you has developed.

Mail:

```sh
brew install mailpit

brew services start mailpit
```

Visit to <http://localhost:8025>

## Maintenance

### API Testing

You would visit <https://aipro.test/docs/api> when you wanna test your apis

### Add languages

```sh
php artisan lang:add jp
```

Refer to [this link](https://laravel-lang.com/available-locales-list.html#lists-available-locales-am) about it.

## Test

```sh
composer test
```

## Build

Development:

```sh
npm run dev
```

Production:

**Push must be done in Production state.**

```sh
npm run prod
```

## CI/CD

For testing third party integration, you should make github repository secrets as belows.

*Laravel Nova* is required,

- NOVA_PASSWORD
- NOVA_USERNAME
