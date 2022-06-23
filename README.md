# Laravel 9 + Jetstream + Livewire CURD

## Getting started

## Docker:

```shell
# spin up the containers for the web server
$ docker-compose up -d --build
```

The following are built for our web server, with their exposed ports detailed:

- **nginx** - `:80`
- **mysql** - `:3306`
- **php** - `:9000`

## Install Dependency


```shell
# install composer-dependency
$ composer install

# install npm package
$ npm install

# build dev
$ npm run dev
```

## Setup Application

```shell
## create copy of .env
$ cp .env.example .env

# create laravel key
$ docker-compose exec app php artisan key:generate

# laravel migrate and seed
$ docker-compose exec app php artisan migrate --seed
```

## Login

http://localhost:8000

User : admin@test.com 
Password : password


## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
