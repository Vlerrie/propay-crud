<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## PROPAY Basic Crud Test

### Requirements
- Laravel >= 9
- PHP >= 8.1
- MySql
- npm

### Setup
First rename the ".env.example" file to ".env" and update following fields to match a database schema that was created
<pre>
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=**dbName
DB_USERNAME=root
DB_PASSWORD=
</pre>

When the database has been created and the fields above are correct please enter these commands within the project folder
<pre>
composer update
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npm run dev
php artisan queue:work
</pre>

If using Apache point the root directory to the project/public folder or just use the 'php artisan serve' command.

When everything is up and running please register a user to start managing people.
