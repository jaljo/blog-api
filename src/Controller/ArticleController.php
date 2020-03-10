<?php

namespace App\Controller;

use App\Command as Command;
use App\Command\Bus\CommandBus;
use App\Form\ArticleType;
use App\JsonDefinition\Article as ArticleDefinition;
use App\Service\PostDAO;
use Exception;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController implements Endpoint
{
    /**
     * @var CommandBus
     */
    private $bus;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    public function __construct(
        CommandBus $bus,
        FormFactoryInterface $formFactory
    ) {
        $this->bus = $bus;
        $this->formFactory = $formFactory;
    }

    // @todo add swager doc here
    public function list(): JsonResponse
    {
        try {
            $listArticles = $this->bus->executeCommand(new Command\ListArticles());
        }
        catch (Exception $exception) {
            return new JsonResponse(
                ["error" => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        if (0 === count($listArticles->getResult())) {
            return new JsonResponse([], Response::HTTP_NO_CONTENT);
        }

        $definitions = [];
        foreach ($listArticles->getResult() as $article) {
            $definitions[] = new ArticleDefinition($article);
        }

        return new JsonResponse($definitions);
    }

    // @todo add swager doc here
    public function read(string $slug): JsonResponse
    {
        try {
            $readArticle = $this->bus->executeCommand(new Command\ReadArticle($slug));
        }
        catch (Exception $exception) {
            return new JsonResponse(
                ["error" => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        if (null === $readArticle->getResult()) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(new ArticleDefinition($readArticle->getResult()));
    }

    // @todo add swager doc here
    public function create(Request $request): JsonResponse
    {
        $command = new Command\CreateArticle();

        $form = $this->formFactory->create(ArticleType::class, $command);
        $form->submit($request->request->all());

        if (!$form->isSubmitted() || !$form->isValid()) {
            return new JsonResponse($form, Response::HTTP_BAD_REQUEST);
        }

        var_dump($command);
        exit;
    }
}
