# Building the project

First, `cp` to the project directory, then run the following commands:

```
$ make cp-env build install-deps start
```

Create the `blog_api` database and run the migrations:

```
$ docker exec -it $(docker ps -q --filter name=api_mysql) mysql CREATE DATABASE blog_api;
$ docker exec -it $(docker ps -q --filter name=api_php) bin/console doctrine:migrations:migrate
```

You now have an API running on `http://localhost:8081`.


# Deploying to production

First, create a release tag from the master branch on github, i.e. `v1.0`.

Then, from the master branch, use the following command to deploy:

```
$ STAGE=prod IMAGE_TAG=v1.0 make build push remote-deploy
```
