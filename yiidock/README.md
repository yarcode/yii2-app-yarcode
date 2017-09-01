# Docker environment for Yii2 #

## Installation ##

Add yiidock submodule to your project.
```
git submodule add https://github.com/yarcode/yiidock yiidock
cd yiidock
```
Build your containers.
```bash
docker-compose build
cp docker-compose.override-example.yml docker-compose.override.yml
docker volume create --name=yiidock_postgres_data
docker-compose run --rm workspace composer install
docker-compose run --rm workspace php init
```
Change the database configuration. 
By default yiidock uses following configuration:
* Host: `postgres`
* Database: `yiidock`
* User: `yiidock`
* Password: `yiidock`

Apply the migrations:
```
docker-compose run --rm yii migrate
```

Start the containers:
```
docker-compose up -d nginx
```

Now app must be working:

* frontend app: [http://localhost:8001](http://localhost:8001)
* backend app: [http://localhost:8002](http://localhost:8002)
* api app: [http://localhost:8003](http://localhost:8003)
