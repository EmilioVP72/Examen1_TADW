<?php

use Slim\App;
use App\Controllers\PasswordController;
use App\Controllers\QrController;
use App\Controllers\UrlController;

return function (App $app) {

    $app->get('/api/password', PasswordController::class . ':generate');
    $app->post('/api/qr', QrController::class . ':generate');
    $app->post('/api/shorten', UrlController::class . ':shorten');
    $app->get('/{code}', UrlController::class . ':redirect');
};
