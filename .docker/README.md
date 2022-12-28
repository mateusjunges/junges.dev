# About this directory

This is a directory to store configs docker compose services.

## System setup

### Install/update docker

- [Get docker](https://docs.docker.com/get-docker/)
- [Get docker compose](https://docs.docker.com/compose/install/)

### Use aliases

We recommend to use following terminal aliases ([macOS](https://coolestguidesontheplanet.com/make-an-alias-in-bash-shell-in-os-x-terminal/), [linux](https://linuxize.com/post/how-to-create-bash-aliases/)) to improve your performance with Docker:

```sh
alias dcu='docker compose up'
alias dcd='docker compose down'
alias dce='docker compose exec'

alias dc1='docker compose start'
alias dc0='docker compose stop'

alias dps='docker ps'
alias dpsa='docker ps -a'
````

and few more to run [artisan](https://laravel.com/docs/master/artisan) and composer commands:
```sh
alias art='docker compose exec app php artisan'
alias dceo='docker compose exec app composer'
```

## Setup app

```sh
cp .env.example .env
docker compose up
docker compose exec app composer install
docker compose exec app php artisan key:generate

# front end part
yarn install && yarn dev # if you have yarn installed locally
docker compose exec front yarn install && yarn dev # if you want to use Docker (slower)
```

The app should be available via http://localhost:8000/ (you should see an error page, because your DB not exists or empty).


### Create the database using a database seeder

Default DB seeder (`DatabaseSeeder`) used for PHPUnit tests also, so it should be small and fast.

This is why we extracted additional seed data to another seeder: `DevelopmentSeeder`.

```sh
docker compose exec app php artisan migrate:fresh --seed
docker compose exec app php artisan db:seed --class=DevelopmentSeeder
```

## Setup back-end tests

Laravel automatically creates multiple databases for parallel testing.
[Read official docs](https://laravel.com/docs/9.x/testing#running-tests-in-parallel)

Now you can run all tests:
```sh
docker compose exec app composer test
```

You can also configure PHPStorm to run your tests. In that case
you only need to migrate the `testing` database:
```sh
docker compose exec app php artisan migrate:fresh --seed --env=testing
```

## xdebug

Change `XDEBUG_MODE` env variable and restart `app` container:
```
XDEBUG_MODE=debug
```


## Links
- [Docker daily commands](./docker-daily-commands.md)
