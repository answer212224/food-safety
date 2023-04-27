# 食安平台

### Installation

A step by step guide that will tell you how to get the development environment up and running.

```
composer install
composer run-script post-root-package-install
php artisan key:generate
npm install & npm run dev
php artisan migrate:fresh --seed
```

## Account
- super-admin
    - email: super-admin@example.com
    - password: 123
- admin
    - email: admin@example.com
    - password: 123
- auditor
    - email: auditor@example.com
    - password: 123

## Usage

```php
php artisan permission:show
php artisan permission:create-role role_name
php artisan permission:create-permission permission_name
php artisan permission:assign-permission-to-role permission_name role_name
php artisan permission:assign-role-to-user role_name user_name
```
```php
php artisan make:filament-resource ModelName --simple
php artisan make:filament-resource ModelName
php artisan make:filament-relation-manager RoleResource permissions name
php artisan make:filament-resource ModelName --generate
php artisan make:filament-page Settings
php artisan make:filament-widget CustomerOverview --resource=CustomerResource
php artisan make:filament-page SortUsers --resource=UserResource --type=custom
```

```php

```

## EER

![eer](https://i.imgur.com/GJEtU09.jpg)

### Server

* PHP >= 8.1
* Ctype PHP Extension
* cURL PHP Extension
* DOM PHP Extension
* Fileinfo PHP Extension
* Filter PHP Extension
* Hash PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PCRE PHP Extension
* PDO PHP Extension
* Session PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension* 

## Additional Documentation and Acknowledgments

- [laravel-permission](https://spatie.be/docs/laravel-permission/v5/introduction)
- [tailwindcss](https://tailwindcss.com/)
- [CalendarWidget](https://github.com/saade/filament-fullcalendar)

