<?php

namespace App\Service;

use App\Service\IDAO;
use App\Service\IConnection;

/**
 * @author jlanglois
 */
class PostDAO implements IDAO
{
    /**
     * @var IConnection 
     */
    private $connection;
    
    /**
     * @param IConnection $connection
     */
    public function __construct(IConnection $connection)
    {
        $this->connection = $connection;
    }
    
    /**
     * @return array
     */
    public function findAll(): array
    {
        $conn = $this->connection->getConnection();       
        $query = $conn->query("SELECT * FROM post;");
        $blogPosts = $query->fetchAll();
        
        return $blogPosts;        
    }
}
