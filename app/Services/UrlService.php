<?php

namespace App\Services;

use App\Database;
use PDO;

class UrlService
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function shorten(string $url): string
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception("Invalid URL");
        }

        $code = $this->generateCode();

        $stmt = $this->db->prepare(
            "INSERT INTO short_urls (original_url, code) VALUES (?, ?)"
        );
        $stmt->execute([$url, $code]);

        return $code;
    }

    private function generateCode($length = 6): string
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($chars), 0, $length);
    }

    public function redirect(string $code)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM short_urls WHERE code = ?"
        );
        $stmt->execute([$code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
