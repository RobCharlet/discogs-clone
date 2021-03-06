# Discogs clone - DDD CQRS - Api Platform

## Requirement

- PHP 7.4

## Setup

**Download Composer dependencies**

```
composer install
```

**Start Docker Compose**

```
docker-compose up -d
```

**Configure the .env (or .env.local) File**

Open the `.env` file and make any adjustments you need - specifically
`DATABASE_URL`. Or, if you want, you can create a `.env.local` file
and *override* any configuration you need there (instead of changing
`.env` directly).

To get your symfony variables :

```
symfony var:export --multiline
```

**Setup the Database**

```
symfony console doctrine:database:create
symfony console doctrine:schema:create
symfony console doctrine:fixtures:load
```

**Load Schema for Tests**

```
symfony console doctrine:database:create --env=test
symfony console doctrine:schema:create --env=test
symfony run bin/phpunit
```

**Start the built-in web server**

You can use Nginx or Apache, but Symfony's local web server
works even better.

To install the Symfony local web server, follow
"Downloading the Symfony client" instructions found
here: https://symfony.com/download - you only need to do this
once on your system.

Then, to start the web server, open a terminal, move into the
project, and run:

```
symfony serve -d
```

**Enjoy the API**

https://127.0.0.1:8000/api

Based on SymfonyCasts Readme
