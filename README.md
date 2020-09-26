# Discogs clone - DDD CQRS - Api Platform

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
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
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
symfony serve
```

## Thanks!

Based on SymfonyCasts Readme
