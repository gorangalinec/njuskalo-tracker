# Njuškalo tracker

Track price changes of your favourite ads from njuskalo.hr

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Composer

```
composer
```

### Installing

Copy `.env.example` to `.env`

```
cp .env.example .env
```

Install project dependencies via `composer`

```
composer install
```

#### MySQL database

Uncomment these lines and create the according database

```
#DB_CONNECTION=mysql
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=njuskalo
#DB_USERNAME=njuskalo
#DB_PASSWORD=njuskalo
```

#### SQLite database

Uncomment these lines and change `$USER` with your local user

```
#DB_CONNECTION=sqlite
#DB_DATABASE=/home/{USER}/njuskalo-tracker.sqllite
```

Create the database file

```
touch /home/$USER/njuskalo-tracker.sqllite
```

## Running the tests

Unit and feature test can be run by

```
artisan test
```

## Deployment

Add additional notes about how to deploy this on a live system

## Built With

* [Laravel](https://laravel.com/) - The web framework used
* [Composer](https://getcomposer.org/) - A Dependency Manager for PHP

## Authors

* **Goran Galinec** - [gorangalinec](https://github.com/gorangalinec)
