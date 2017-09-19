# Dotenv file

`.env` is part of the yii-app-yarcode template. 

He loads environment variables from .env to getenv(), $_ENV and $_SERVER automagically.

## Why dot env?
`.env` file is an easy way to load custom configuration variables that your application needs.

Storing configuration in the environment is one of the tenets of a twelve-factor app. 

[Learn more...](https://github.com/vlucas/phpdotenv)

## Usage

`.env` file is added to `.gitignore` so it is not checked-in the code.

Add variable in `.env` file

```
SECRET_KEY="super_seekret_key"
```

Get variable in php
```
$key = getenv('SECRET_KEY');
```