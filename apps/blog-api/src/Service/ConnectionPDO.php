<?php

namespace App\Service;

use App\Service\IConnection;
use PDO;

/**
 * @author jlanglois
 */
class ConnectionPDO implements IConnection
{
    /**
     * @var string
     */
    private $dsn;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var array
     */
    private $options;

    /**
     * @param string $dsn
     * @param string $username
     * @param string $password
     */
    public function __construct(string $dsn, string $username, string $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        $pdo = new PDO($this->dsn, $this->username, $this->password, $this->options);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}
