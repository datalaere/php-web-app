<?php

use Web\DI\Container;

$app->set('Authenticate', function() {
   return App\Http\Middlewares\Authenticate::handle();
});

$app->set('VerifyCSRF', function() {
    return App\Http\Middlewares\VerifyCSRF::handle();
 });