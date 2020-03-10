<?php

namespace App\Controller;

use App\Command\Bus\CommandBus;
use App\Command\ReadArticle;
use App\JsonDefinition\Article as ArticleDefinition;
use App\Service\PostDAO;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ArticleController implements Endpoint
{
    /**
     * @var CommandBus
     */
    private $bus;

    public function __construct(CommandBus $bus) {
        $this->bus = $bus;
    }

    // @todo add swager doc here
    public function list(): JsonResponse
    {
        exit;

        try {
            $articles = $this->repository->findAll();
        }
        catch (Exception $exception) {
            return new JsonResponse(["error" => $exception->getMessage()], Response::HTTP_SERVER_ERROR);
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
        $readArticle = $this->bus->executeCommand(new ReadArticle($slug));
      }
      catch (Exception $exception) {
          return new JsonResponse(["error" => $exception->getMessage()], Response::HTTP_SERVER_ERROR);
      }

      if ($readArticle->getResult() === null) {
          return new JsonResponse(null, Response::HTTP_NOT_FOUND);
      }

      return new JsonResponse(new ArticleDefinition($readArticle->getResult()));
    }
}
