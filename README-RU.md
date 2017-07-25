Yii 2 YarCode Project Template 
=============================== 

[![Build Status](https://travis-ci.org/yarcode/yii2-app-yarcode.svg?branch=master)](https://travis-ci.org/yarcode/yii2-app-yarcode) 

Требования 
---------- 
Минимальное требование по этому шаблону проекта - PHP 7+. 

Установка 
--------- 
Для начала установите [composer](http://getcomposer.org]). 

Далее выполните следующие команды 
``` 
composer create-project --prefer-dist yarcode/yii2-app-yarcode yarcode 
сd yarcode 
php init 
``` 
Сделайте изменения в файле `common/config/main-local.php` и примините миграции, убедитесь, что у вас корректно настроено подключение к базе данных. 
``` 
php yii migrate 
``` 
Установка проекта на этом закончена. Теперь ознакомимя со струтурой проекта. 

Струркутра проекта 
------------------ 

Корневой каталог YarCode Project Template содержит следуюшие каталоги и файлы: 

```
api                 web приложение реализующее промтое REST API 
    component/           содержит компоненты для api
    config/              содержит конфигурацию api
    models/              содержит классы моделей для api
    runtime/             cодержит файлы, созданные во время выполнения
    tests/               содержит тесты для приложения api
    web/                 содержит содержит сценарий запуска
    codeception.yaml     конфигурация для codeception
backend            приложение backend
    assets/              содержит ресурсы приложения (*.js, *.css)
    config/              содержит конфигурацию backend
    controllers/         содержит классы Web контроллеров
    models/              содержит классы моделей для backend
    runtime/             cодержит файлы, созданные во время выполнения
    tests/               содержит тесты для приложения backend   
    views/               содержит представления для web приложения
    web/                 содержит содержит сценарий запуска и ресурсы
    codeception.yaml     конфигурация для codeception
common              файлы общие для всего приложения
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console             консольное приложение
    config/              содержит конфигурацию console
    controllers/         содержит классы Console контроллеров(команды)
    migrations/          содержит миграции базы данных
    models/              содержит классы моделей для console
    runtime/             cодержит файлы, созданные во время выполнения
environments/       содержит настройки среды
frontend            frontend приложение
    assets/              содержит ресурсы приложения (*.js, *.css)
    config/              содержит конфигурацию frontend
    controllers/         содержит классы Web контроллеров
    models/              содержит классы моделей для frontend
    runtime/             cодержит файлы, созданные во время выполнения
    tests/               содержит тесты для приложения frontend   
    views/               содержит представления для web приложения
    web/                 содержит содержит сценарий запуска и ресурсы
    codeception.yaml     конфигурация для codeception
tools/              содержит хелпер для IDE       
vendor/             содержит зависимые сторонние пакеты
.gitignore          содержит список каталогов, игнорируемых GIT 
.php_cs             файл конфигурации PHP Coding Standards Fixer
.travis.yaml        файл конфигурации Travis CI 
codeception.yaml    файл конфигурации тестирования Codeception 
composer.json       конфигурация Composer. 
init                скрипт инициализации. 
init.bat            скрипт инициализации (для Windows). 
LICENSE.md          информация о лицензии. Поместите свою лицензию на проект. 
README.md           базовая информация об установке шаблона (Английский язык). 
README-RU.md        базовая информация об установке шаблона (Русский язык). 
requirements.php    проверка требований шаблона. 
yii                 консольное приложение, для выполнения консольных команд. 
yii.bat             консольное приложение (для Windows). 
```

Контроль качества кода 
---------------------- 

### Тестирование 
Тесты находятся в каталогах тестов `{приложение}/tests`. Они разработаны с использованием [Codeception](http://codeception.com/). По умолчанию есть 2 набора тестов для каждого приложения (`api`, `frontend`, `backend`): 

- модульные 
- функциональные 

Более подробно про тестированию Yii2 приложений можно прочитать [тут](http://codeception.com/docs/modules/Yii2) 

Вы можете запустить все тесты которые есть в шаблоне 
``` 
vendor\bin\codecept run 
``` 
Возможно запустить только модульные или только функциональные тесты для конкретного приложения, напрмпер 
``` 
vendor\bin\codecept run unit -c backend 
vendor\bin\codecept run functional -c api 
``` 
Так же вы можете запустить какой-то определенный тест указав путь до него 
``` 
vendor\bin\codecept run functional -c api v1/ApiCest 
``` 
Для отладки может быть удобно запускать тесты с флагами `-f` и `--debug` 
``` 
vendor\bin\codecept run functional -c api v1/ApiCest -f --debug 
``` 

### Travis CI 

Для автоматической сборки и тестирования приложения в шаблоне используется [Travis CI](https://docs.travis-ci.com/user/getting-started/), конфигурация находится в файле `.travis.yaml`. 

В конфигурационном файле помимо сборки и тестирования настроен [PHP Coding Standards Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer). 

### PHP Coding Standards Fixer

Это средство позволяет нам автоматически проверять код проекта на соответсвие стандартам и правилам. 

Конфигурация находится в файле `.php_cs` в корневом каталоге проекта. 

Выполните команду для проверки кода на соответствие стандарту [PSR-2](http://www.php-fig.org/psr/psr-2/) 
``` 
vendor/bin/php-cs-fixer fix -v --dry-run 
```