# AI Pro - Smart WMS Solution

[![build & tests](https://github.com/cable8mm/aipro/actions/workflows/tests.yml/badge.svg)](https://github.com/cable8mm/aipro/actions/workflows/tests.yml)
[![coding style](https://github.com/cable8mm/aipro/actions/workflows/coding-style-php.yml/badge.svg)](https://github.com/cable8mm/aipro/actions/workflows/coding-style-php.yml)
[![release date](https://img.shields.io/github/release-date/cable8mm/aipro)](https://github.com/cable8mm/aipro/releases)
[![minimum PHP version](https://img.shields.io/badge/php-%3E%3D_8.2.0-8892BF.svg)](https://github.com/cable8mm/aipro)

에이아이프로는 물류센터를 보유한 회사가 WMS(창고관리시스템)와 상품 정보를 최신 상태로 유지하며, 이를 벤더와 소비자에게 효과적으로 제공할 수 있도록 설계된 솔루션입니다. AI 기술과 모바일 도구를 활용하여 운영의 편의성을 높이고, 비용 효율적인 서비스를 제공합니다.

## Installation

[Install valet](https://laravel.com/docs/10.x/valet#installation):

```sh
composer global require laravel/valet

echo "export PATH=~/.composer/vendor/bin:$PATH" >> ~/.bashrc
source ~/.bashrc

valet install
```

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

valet secure # set https

valet use; # setup php@8.2

composer global update; # update global composer

npm install # install npm libraries

valet open # visit https://aipro.test
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

### Add languages

```sh
php artisan lang:add af
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

*Google Login* is optional for social logins,

- GOOGLE_CLIENT_ID
- GOOGLE_CLIENT_SECRET

*Facebook Login* is optional for social logins,

- FACEBOOK_CLIENT_ID
- FACEBOOK_CLIENT_SECRET

*Kakao Login* is optional for social logins,

- KAKAO_CLIENT_ID
- KAKAO_CLIENT_SECRET

Additionally, *Github*, *Instagram* and *Naver* are supported to login.

The stage server is automatically deployed in Merge, and the live server is deployed manually at [Envoy](https://envoyer.io/). However, you must first create a GitHub Release before live deployment.
