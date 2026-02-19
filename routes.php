<?php

use Slim\App;
use App\Controllers\PasswordController;

return function (App $app) {

    $app->get('/api/password', PasswordController::class . ':generate');
};
