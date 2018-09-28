Yii 2 YarCode Project Template
==============================
[![Build Status](https://travis-ci.org/yarcode/yii2-app-yarcode.svg?branch=master)](https://travis-ci.org/yarcode/yii2-app-yarcode) 

Yii 2 YarCode Project - is a skeleton [Yii 2](http://www.yiiframework.com/) application.
* [Differences](#differences-from-yii2-app-advanced)
* [Requirements](#requirements)
* [Installation](#installation)
* [Quality Control](#quality-control)
* [Vrutalization](#vrutalization)
* [Template structure](#template-structure)

Differences from yii2-app-advanced
----------------------------------
In contrast to the  [yii2-app-advanced](https://github.com/yiisoft/yii2-app-advanced) this template out of the box has:
* [Support for .env file](docs/DOTENV-FILE.md)
* [API application](docs/API-APPLICATION.md)
* [Include yii2-tools-yarcode](https://github.com/yarcode/yii2-tools-yarcode)
* [Set of docker containers](#vrutalization)
* Integration with [Travis CI](https://travis-ci.org/)
* Pre-installed [AdminLTE](https://adminlte.io/) theme for the backend application

Requirements
------------
The minimum requirement by this project template that your Web server supports PHP 7+.

Installation
------------
Install [composer](http://getcomposer.org]).

You can then install this project template using the following command:

```
composer create-project --prefer-dist yarcode/yii2-app-yarcode yarcode 
сd yarcode 
php init 
```

Copy .env file

```
cp .env.example .env
```

Configure `.env` and apply migrations. Make sure that you are properly configured to connect to the database.

``` 
php yii migrate 
``` 

The template installation is now complete.

Quality Control
---------------
### Travis CI 

To automatically build and test the application in a template, use [Travis CI](https://docs.travis-ci.com/user/getting-started/). The configuration is located in the file `.travis.yml` in the project's root directory. 

In the configuration file added [PHP Coding Standards Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer). 

### PHP Coding Standards Fixer

This tool allows us to automatically check the project code for compliance with standards and rules.

The configuration is in the file `.php_cs` in the project's root directory.

Execute the command to verify the code for compliance with the [PSR-2](http://www.php-fig.org/psr/psr-2/) standard 
``` 
vendor/bin/php-cs-fixer fix -v --dry-run 
```

## Virtualization

This template supports [Docker](https://www.docker.com/) technology

### Base usage

Declare default environment variables in file
```
cp .env.example .env
```
Build your containers
```
docker-compose build
```
Create volume
```
docker volume create --name=yiidock_postgres_data
```
Init and apply migration:
```
cp docker-compose.override-example.yml docker-compose.override.yml
docker-compose run --rm workspace composer install
docker-compose run --rm workspace php init
docker-compose run --rm yii migrate
```
Start the containers:
```
docker-compose up -d
```

Now app must be working:

* frontend app: [http://localhost:8001](http://localhost:8001)
* backend app: [http://localhost:8002](http://localhost:8002)
* api app: [http://localhost:8003](http://localhost:8003)

You can also start the services individually. 
Example, start only backend:
```
docker-compose up -d nginx-backend 
```
### Test environment
Tests are in the test catalogs `{application}/tests`.
They are developed with [Codeception PHP Testing Framework](http://codeception.com/). By default there are 2 test suites for each applications(`api`, `frontend`, `backend`): 

- unit 
- functional 

For more information about testing Yii2 applications, [read here](http://codeception.com/docs/modules/Yii2) 

To run tests in a container can be used `docker-compose.test.yml` file.
Follow these three simple steps:
1. Create test volume:    ` docker volume create --name=test_postgres_data`
2. Apply migration for test database: `docker-compose -f docker-compose.test.yml run --rm yii_test migrate  `
3. Run all the tests that are in the template: `docker-compose -f docker-compose.test.yml run --rm codeception run `
    
It is possible to run only unit or only functional tests for the application, for example
``` 
docker-compose -f docker-compose.test.yml run --rm codeception run unit -c backend 
docker-compose -f docker-compose.test.yml run --rm codeception run functional -c api 
``` 
Also you can run some specific test by specifying the path to it
``` 
docker-compose -f docker-compose.test.yml run --rm codeception run functional -c api v1/ApiCest 
``` 
For debugging, it can be convenient to run tests with the flags `-f` and` --debug`
``` 
docker-compose -f docker-compose.test.yml run --rm codeception run functional -c api v1/ApiCest -f --debug 
``` 
Template structure
------------------
The root directory contains the following subdirectories and files:
```
api                 web application implements simple REST API    
    component/           contains components api
    config/              contains api configurations
    models/              contains api-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    web/                 contains the entry script
    codeception.yaml     configuration file for Codeception
backend             backend web application
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    codeception.yaml     configuration file for Codeception
common              files shared for the whole application
    component/           contains shared components
    config/              contains shared configurations
    fixtures/            contains fixtures
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes        
console             console application
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
environments/       contains environment-based overrides
frontend            frontend web application
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
    codeception.yaml     configuration file for Codeception
tools/              contains helper for IDE       
vendor/             contains dependent 3rd-party packages
.env.example        dotenv file example
.env.travis         dotenv file for Tavis CI
.gitignore          contains a list of directories ignored by git version system. 
.php_cs             configuration file for PHP Coding Standards Fixer
.travis.yaml        configuration file for Travis CI 
codeception.yaml    cnfiguration file for Codeception 
composer.json       composer config described in Configuring Composer.
init                initialization script described in Configuration and environments.
init.bat            same for Windows.
LICENSE.md          license info. Put your project license there.
README.md           basic info about installing template (EN).
README-RU.md        basic info about installing template (RU).
requirements.php    Yii requirements checker.
yii                 console application bootstrap.
yii.bat             same for Windows.
```