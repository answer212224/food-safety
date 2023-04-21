# 食安平台

### Installation

A step by step guide that will tell you how to get the development environment up and running.

```
composer install
composer run-script post-root-package-install
php artisan key:generate
npm install & npm run dev
php artisan migrate:fresh --seed --seeder=PermissionsDemoSeeder
```

## Usage

A few examples of useful commands and/or tasks.

```
php artisan permission:show
php artisan permission:create-role role_name
$ And keep this in mind
```

## Deployment

Additional notes on how to deploy this on a live or release system. Explaining the most important branches, what pipelines they trigger and how to update the database (if anything special).

### Server

* Live:
* Release:
* Development:

### Branches

* Master:
* Feature:
* Bugfix:
* etc...

## Additional Documentation and Acknowledgments

* Project folder on server:
* Confluence link:
* Asana board:
* etc...
