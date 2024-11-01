### Prerequisites
- PHP
- Laravel
- Composer
- Xampp

### To install Composer download package from this link
 https://getcomposer.org/download/

### Install laravel through composer
```
 composer global require laravel/installer
```

### Installation
- First clone this project, install dependencies
```
git clone https://github.com/Kan0n0n/bookShop.git
composer install
```

- Then create the necessary database
```
php artisan make:database bookshop
```

- Then run migrate
```
php artisan migrate
```
- To run Laravel web app use
```
 php artisan serve
```
