<?php

namespace App;

use PDO;

class Database
{
    public static function connect()
    {
        return new PDO(
            "mysql:host=db;dbname=api_db",
            "user",
            "secret",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }
}
