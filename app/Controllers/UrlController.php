<?php

namespace App\Controllers;

use App\Services\UrlService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UrlController
{
    public function shorten(Request $request, Response $response)
    {
        $data = $request->getParsedBody();
        $service = new UrlService();
        $code = $service->shorten($data['url']);

        $response->getBody()->write(json_encode([
            "short_url" => "http://localhost:8080/$code"
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }

    public function redirect(Request $request, Response $response, $args)
    {
        $service = new UrlService();
        $data = $service->redirect($args['code']);

        if (!$data) {
            return $response->withStatus(404);
        }

        return $response
            ->withHeader('Location', $data['original_url'])
            ->withStatus(302);
    }
}
