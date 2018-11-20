<?php

namespace App\Service;

use PDO;

interface IConnection
{
    public function getConnection(): PDO;
}
