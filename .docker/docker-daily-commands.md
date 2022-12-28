# Docker daily commands

First think you should remember: `app` container is responsible for all PHP and composer calls.
So, please use it to run `artisan` and composer commands:
```sh
# via Docker:
docker compose exec app php artisan tinker
docker compose exec app composer update
# the same with alias
dce app php artisan tinker
dce app composer update
```

## Basic terms

- `image` is a basis of containers. It’s like a class in OOP languages.
- `container` is an instance of image. It’s like an object in OOP languages.
- `compose` or `docker compose` is a tool for defining and running complex applications with Docker.
  With Compose, you define a multi-container application in a single file,
  then spin your application up in a single command which does everything that needs to be done to get it running.

[Docker Glossary](https://docs.docker.com/glossary/)


## Commands

```sh
# List containers (-a for including not running)
docker ps -a

# Delete a stopped container (where 4242424242442 is container id got via `docker ps`)
docker rm 4242424242442

# Start an interactive tty shell session inside a running container (sh is preferable to bash for Alpine images because Alpine images don’t come with bash installed.)
docker exec -it 4242424242442 sh

# Start an interactive tty shell session inside a running container (with docker compose you can specify a container by name ("app" vs 4242424242442)).
docker compose exec app sh
# the same with alias
dce app sh
```

Update DB for testing (not parallel testing):
```sh
docker compose exec app php artisan migrate:fresh --seed --env=testing
```

If you have issues with parallel testing, try to re-create DBs:
```sh
docker compose exec app php artisan test --parallel --recreate-databases
```
