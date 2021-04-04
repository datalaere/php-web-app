<?php

use Web\App\Container;

// Config
$app->set('config', function() {
    $config = new Web\App\Config;
    $config->load(ABSPATH . '/config/app.php');
    return $config;
});

// Translator
$app->set('translator', function() {
    $translator = new Web\App\Translator;
    $translator->setLocalesDir(ABSPATH . '/resources/locales');
    $translator->setDefaultLanguage('en-US');
    return $translator;
});

// Cookie
$app->set('cookie', Web\Session\Cookie::class);

// Session
$app->set('session', Web\Session\NativeSession::class);
$app->session->start();

// CSRF
$app->set('csrf', function(Container $c) {
   return new Web\Security\CSRF($c->config->get('app.key'));
});

// View
$app->set('view', function() {
    $view = new Web\Filesystem\View;
    $view->path = ABSPATH . '/resources/views/';
    return $view;
});

// Cache
$app->set('cache', function(Container $c) {
    $cache = new Web\Cache\FileCache(ABSPATH . '/storage/cache'); 
    #$cache = new Web\Cache\PDOCache($pdo, "my_cache_table_name");
    #$cache = new Web\Cache\ArrayCache(); 
    return $cache;
});

// Error handler
$app->set('error', function() {
    return new Web\Error\ErrorHandler;
});

// Database
$app->set('db', Web\Database\Connection::factory($app->config->db));

// SQL
$app->set('sql', function() {
   return new Web\Database\SQL;
});

// Validator
$app->set('validator', function(Container $c) {
    return new Web\Security\Validator($c->model, $c->error);
});

// Auth
$app->set('auth', function(Container $c) {
    return new Web\Security\Auth(
        $c->User,
        $c->session,
        $c->cookie
    );
});

// Hash
$app->set('hash', function(Container $c) {
    return new Web\Security\Hash;
});

// Request
$app->set('request', function() {
    return new Web\Http\Request;
});

// Response
$app->set('response', function(Container $c) {
    $response = new Web\Http\Response;
    $response->baseUrl = $c->config->get('app.url');
    return $response;
});

// Router
$app->set('router', function() {
    $router = new Web\Http\Router;
    $router->setup(config('app.url'));
    return $router;
});
