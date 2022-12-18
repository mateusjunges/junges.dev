# Junges.dev

The source code for my personal website.

## Running the project

To run this project, you need to have [Docker](https://www.docker.com/) installed on your machine. Firstly clone the repository:

```sh
git clone git@github.com:mateusjunges/junges.dev.git
```
Then, copy the `.env.example` file to `.env` and fill the variables with your own values.

```sh
cp .env.example .env
```

Now, you need to export some variables to be able to create the containers:
```shell
export CUR_USER_ID=$(id -u)
export CUR_USER_ID=$(id -g)
export CUR_USER_NAME=$(whoami)
```

Finally, run the following command to start the project:

```sh
docker compose up -d --build
```

You should be able to acess the local env at `http://localhost:8000`.
