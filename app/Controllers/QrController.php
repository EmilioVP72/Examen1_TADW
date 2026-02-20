<?php

namespace App\Controllers;

use App\Services\QrService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class QrController
{
    public function generate(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        if (!isset($data['content']) || !is_string($data['content'])) {
            $response->getBody()->write(json_encode([
                "error" => "el campo 'content' es obligatorio y debe ser una cadena de texto"
            ]));
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(400);
        }

        $size = isset($data['size']) ? (int)$data['size'] : 300;

        $qr = new QrService();
        $image = $qr->generate($data['content'], $size);

        $response->getBody()->write(json_encode([
            "qr" => $image
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }
}
