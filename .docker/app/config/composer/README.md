# Composer auth

Of course, we don’t like to store passwords in a repository.
On other hand, we also would like to provide smooth DX for our developers,
so this a good compromise in this case.

## Alternative ideas

1. Remove `auth.json` file from repo, created it from Dockerfile, pass values (GitHub auth token and login+password) using .env file and environment vars.
Requires developers to manage their .env files and add these 2-3 variables manually (before docker first run).

## Materials
 - [Authenticating Nova in Continuous Integration (CI) Environments](https://nova.laravel.com/docs/3.0/installation.html#authenticating-nova-in-continuous-integration-ci-environments)
