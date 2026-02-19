<?php

namespace App\Services;

class PasswordService
{
    public function generate(array $config): string
    {
        $length = $config['length'] ?? 12;

        if ($length < 4 || $length > 128) {
            throw new \Exception("Length must be between 4 and 128");
        }

        $pool = '';

        if ($config['includeUppercase'] ?? false) {
            $pool .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        if ($config['includeLowercase'] ?? false) {
            $pool .= 'abcdefghijklmnopqrstuvwxyz';
        }
        if ($config['includeNumbers'] ?? false) {
            $pool .= '0123456789';
        }
        if ($config['includeSymbols'] ?? false) {
            $pool .= '!@#$%^&*()';
        }

        if (!$pool) {
            throw new \Exception("No character types selected");
        }

        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $pool[random_int(0, strlen($pool)-1)];
        }

        return $password;
    }
}
