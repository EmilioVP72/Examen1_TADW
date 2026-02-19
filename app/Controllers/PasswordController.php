<?php

namespace App\Controllers;

use App\Services\PasswordService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PasswordController
{
    public function generate(Request $request, Response $response)
    {
        $params = $request->getQueryParams();
        $service = new PasswordService();
        $password = $service->generate($params);

        $response->getBody()->write(json_encode([
            "password" => $password
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
