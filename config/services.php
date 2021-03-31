<?php

use Web\DI\Container;

// Config
$app->set('config', function() {
    $config = new Web\Config\Config;
    $config->load(ABSPATH . '/config/app.php');
    return $config;
});

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
$app->set('db', function(Container $c) {
    return new Web\Database\Connection($c->config->db);
});

// Model
$app->set('model', function(Container $c) {
    return new Web\Database\Model($c->db);
});

// SQL
$app->set('sql', function(Container $c) {
   return new Web\Database\SQL;
});

// Validator
$app->set('validator', function(Container $c) {
    return new Web\Security\Validator($c->model, $c->error);
});

// Auth
$app->set('auth', function(Container $c) {
    return new Web\Security\Auth($c->User);
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
    return new Web\Http\Router;
});
