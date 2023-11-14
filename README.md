<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Taskmaster"></a></p>


## About Social Machine

Basic Demostration of a Single Page Application utilizing Vue JS, Tailwindcss and Laravel

## Requirements

- Requires NPM version 10.2.0
- Node Version 20.7.0
- Please point a test url to your localhost application for laravel and Vue JS to map routes correctly
## Taskmaster Setup

- Install Node Version v20.7.0 
- - Prefer to use node version manager for easy installation
- Install NPM version 10.2.0
- make a directory for the application
- - Go to root directory and do `git clone https://github.com/numerical25/taskmaster .`
- Go to the root directory of laravel
- - Composer Install `composer install`
- Copy .example.env to .env
- Go to `.env` to edit the database connection like the example bellow
```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=taskmaster
DB_USERNAME=root
DB_PASSWORD="Yourpassword"
```
- Build Task Master Database `php artisan migrate`
- To seed the taskmaster database run `php artisan db:seed`
- Then do a `npm install`
- Finally run `npm run dev`
- Be sure to have a apache server up and running
