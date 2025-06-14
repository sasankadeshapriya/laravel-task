## Installation Guide
```bash
git clone https://github.com/sasankadeshapriya/laravel-task.git
cd laravel-task
composer install
cp .env.example .env
```
Open .env file and configure your database:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=your_password
```
next:
```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```
