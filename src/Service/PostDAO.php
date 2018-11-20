<?php

namespace App\Service;

use App\Service\IDAO;
use App\Service\IConnection;
use Exception;

class PostDAO implements IDAO
{
    /** @var IConnection */
    private $connection;

    public function __construct(IConnection $connection)
    {
        $this->connection = $connection->getConnection();
    }

    public function findAll(): array
    {
        $query = $this->connection->query(
          "SELECT * FROM post WHERE draft = 0 ORDER BY date_creation DESC;"
        );
        $blogPosts = $query->fetchAll();

        return $blogPosts;
    }

    public function find(string $seoTitle): array
    {
      $query = $this->connection->prepare(
        "SELECT * FROM post WHERE seo_title = :seo_title;"
      );
      $query->execute([":seo_title" => $seoTitle]);

      $blogPost = $query->fetch();

      if (!$blogPost) {
        throw new Exception("No blog post found !");
      }

      return $blogPost;
    }
}
