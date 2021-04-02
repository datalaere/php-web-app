<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of the web app, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Web\App\Container;

/*
|--------------------------------------------------------------------------
| Setup environment
|--------------------------------------------------------------------------
|
| Check if application is in development or production mode.
|
*/

$env = ABSPATH . '/env.ini';

if(file_exists($env)) {
    $_ENV = parse_ini_file($env, true);
}

/*
|--------------------------------------------------------------------------
| Bind Important Services
|--------------------------------------------------------------------------
|
| Next, we need to bind some important services into the container so
| we will be able to resolve them when needed. 
|
*/

require_once ABSPATH . '/bootstrap/helpers.php';

require_once ABSPATH . '/config/services.php';

require_once ABSPATH . '/config/models.php';

require_once ABSPATH . '/config/controllers.php';

require_once ABSPATH . '/config/middlewares.php';

require_once ABSPATH . '/routes/main.php';

/*
|--------------------------------------------------------------------------
| Migrate database and seeds
|--------------------------------------------------------------------------
|
| If we have database to migrate, do so.
|
*/

if(config('db.migrate')) {
    sql()->import(ABSPATH . '/database/migrates/' . config('db.migrate'), db()->pdo);
}

if(config('db.seed')) {
    sql()->import(ABSPATH . '/database/seeds/' . config('db.seed'), db()->pdo);
}
