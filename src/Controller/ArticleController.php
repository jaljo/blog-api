<?php

namespace App\Controller;

use App\JsonDefinition\Article as ArticleDefinition;
use App\Service\PostDAO;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\ArticleRepository;

class ArticleController implements Endpoint
{
    /**
     * @var ServiceEntityRepository
     */
    private $repository;

    public function __construct(ArticleRepository $repository) {
        $this->repository = $repository;
    }

    // @todo add swager doc here
    public function list(): JsonResponse
    {
        try {
            $articles = $this->repository->findAll();
        }
        catch (Exception $exception) {
            return new JsonResponse(["error" => $exception->getMessage()]);
        }

        $definitions = [];
        foreach ($articles as $article) {
            $definitions[] = new ArticleDefinition($article);
        }

        return new JsonResponse($definitions);
    }

    // @todo add swager doc here
    public function read(string $slug): JsonResponse
    {
      try {
          $article = $this->repository->findOneBySlug($slug);
      }
      catch (Exception $exception) {
          return new JsonResponse(["error" => $exception->getMessage()]);
      }

      return new JsonResponse(new ArticleDefinition($article));
    }
}
