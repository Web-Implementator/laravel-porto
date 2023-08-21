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

- [Laravel 10](https://github.com/laravel/laravel?ysclid=l9luwglcyd378360370)
- [Porto architecture](https://github.com/Mahmoudz/Porto)
- [Swagger](https://github.com/DarkaOnLine/L5-Swagger?ysclid=l9lv0y79lt190343942)
- [Data Transfer Object](https://spatie.be/docs/laravel-data)
- [Fractal](https://github.com/spatie/laravel-fractal?ysclid=l9lv0ltaw3330622122)
- [Horizon](https://laravel.su/docs/8.x/horizon?ysclid=l9o0yhkvvd508817367)

All local requests to the model go through

- [API Resources](https://laravel.com/docs/9.x/eloquent-resources)

All tests must be placed inside the container
``` bash
App/Containers/*/Tests
App/Containers/*/*/Tests
```

All migrations must be placed inside the container
``` bash
App/Containers/*/Data/Migrations
App/Containers/*/*/Data/Migrations
```

All routes must be placed inside the container
``` bash
App/Containers/*/UI/API/Routes/api.php
App/Containers/*/*/UI/API/Routes/api.php

App/Containers/*/UI/Web/Routes/web.php
App/Containers/*/*/UI/Web/Routes/web.php
```

## Installation

Cloning the repository
``` bash
git clone https://github.com/Web-Implementator/laravel-porto.git
```

Copy and edit config .env file
``` bash
cp .env.example .env
```

Run installer
``` bash
make project-install
```

Database migration
``` bash
make migrate
```

### Additional features

Rules for pint.json
https://mlocati.github.io/php-cs-fixer-configurator/

Generate container
``` bash
docker-compose exec app php artisan make:container Test
```

Fake data generation
``` bash
make seed
```

Start Horizon
``` bash
make horizon
```

Generation of API documentation
``` bash
make api-docs
```

After generation go to documentation to url (localhost or your APP_URL)
```
http://localhost/api/documentation
```

Running Autotests
``` bash
php artisan test
```
