<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About Small Test Task

Two lists are given:
- car list
- a list of users

Need to make an API for renting a car.

Additional requirements:
- at one time, 1 user can drive only one car
- only 1 user can drive 1 car at a time

## About Project

Basic Laravel project for architecture Porto

- [Laravel 9.3](https://github.com/laravel/laravel?ysclid=l9luwglcyd378360370)
- [Porto architecture](https://github.com/Mahmoudz/Porto)
- [Swagger](https://github.com/DarkaOnLine/L5-Swagger?ysclid=l9lv0y79lt190343942)
- [Data Transfer Object](https://github.com/spatie/data-transfer-object?ysclid=l9lv0a72yl154342806)
- [Fractal](https://github.com/spatie/laravel-fractal?ysclid=l9lv0ltaw3330622122)
- [Horizon](https://laravel.su/docs/8.x/horizon?ysclid=l9o0yhkvvd508817367)

All tests must be placed inside the container
``` bash
App/Containers/*/Tests
```

All migrations must be placed inside the container
``` bash
App/Containers/*/Data/Migrations
```

All routes must be placed inside the container
``` bash
App/Containers/*/UI/API/Routes/api.php
App/Containers/*/UI/Web/Routes/web.php
```

## Installation

Cloning the repository
``` bash
git clone https://github.com/Web-Implementator/laravel-porto.git
```

Copy and edit config .env file
``` bash
cd ./laravel-porto
cp .env.example .env
```

Install composer dependencies
``` bash
composer install
```

Generate App key
``` bash
php artisan key:generate
```

Database creation
``` bash
php artisan migrate
```

### Additional features

Fake data generation
``` bash
php artisan db:seed
```

Start Horizon
``` bash
php artisan horizon
```

Generation of API documentation
``` bash
php artisan l5-swagger:generate
```

Running Autotests
``` bash
php artisan test
```
