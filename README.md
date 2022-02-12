# Laravel Hotel
Laravel Hotel is an open-source web application built with laravel 8.0, enchanced with laravel websockets features to have realtime notification experience.

## Instalation 

### Init DB
- Create DB Name: hotel_app
or via terminal
```
mysql -u root -p
```
enter your db credential
```
create database hotel_app;
exit;
```
### Init Commands:
```
composer install
npm install && npm run dev
php artisan migrate:fresh --seed
php artisan serv                => Terminal 1
php artisan websockets:serv     => Terminal 2   //run the websocket server for realtime notification
```


