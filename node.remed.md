1# Tạo project
composer create-project --prefer-dist laravel/laravel:^7.0 app

2# Tạo database with migrations
php artisan make:migration questions --create=questions
php artisan make:migration list_lesson --create=list_lesson
php artisan make:migration category --create=category
php artisan make:migration answer --create=answer

3# Running Migrations
php artisan migrate


$ php artisan make:controller Country\CountryController

$ php artisan make:controller Country\QuestionController --resource

$ php artisan make:model Mode

$ php artisan serve

$ php artisan migrate

$ php artisan make:resource QuestionResource

Rollback all migrations and run them all again


php artisan migrate:refresh

php artisan migrate:refresh --seed

php artisan migrate:reset
