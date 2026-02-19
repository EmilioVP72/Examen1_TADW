<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;

class QrService
{
    public function generate(string $data, int $size = 300)
    {
        $result = Builder::create()
            ->data($data)
            ->size($size)
            ->build();

        return $result->getDataUri();
    }
}
