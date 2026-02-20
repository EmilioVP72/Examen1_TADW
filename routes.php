<?php

use Slim\App;
use App\Controllers\PasswordController;
use App\Controllers\QrController;

return function (App $app) {

    $app->get('/api/password', PasswordController::class . ':generate');
    $app->post('/api/qr', QrController::class . ':generate');
};
