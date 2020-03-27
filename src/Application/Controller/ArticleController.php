<?php

namespace App\Application\Controller;

use App\Application\Form\ArticleType;
use App\Application\JsonDefinition\Article as ArticleDefinition;
use App\Domain\Command as Command;
use App\Domain\Command\Bus\CommandBus;
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
            $articles = $this->bus->executeCommand(new Command\ListArticles());
        }
        catch (Exception $exception) {
            return new JsonResponse(
                ["error" => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        if (0 === count($articles)) {
            return new JsonResponse([], Response::HTTP_NO_CONTENT);
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
            $article = $this->bus->executeCommand(new Command\ReadArticle($slug));
        }
        catch (Exception $exception) {
            return new JsonResponse(
                ["error" => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        if (null === $article) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(new ArticleDefinition($article));
    }

    // @todo add swager doc here
    public function create(Request $request): JsonResponse
    {
        $createArticle = new Command\CreateArticle();

        $form = $this->formFactory->create(ArticleType::class, $createArticle);
        $form->submit($request->request->all());

        if (!$form->isSubmitted() || !$form->isValid()) {
            return new JsonResponse(
                // @TODO improve this to have clearer error output
                $form->getErrors(true)->__toString(),
                Response::HTTP_BAD_REQUEST
            );
        }

        try {
            $article = $this->bus->executeCommand($createArticle);
        } catch(Exception $exception) {
            return new JsonResponse(
                ["error" => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return new JsonResponse(
            new ArticleDefinition($article),
            Response::HTTP_CREATED
        );
    }

    // @todo add swager doc here
    public function publish(int $id): JsonResponse
    {
        try {
            $article = $this->bus->executeCommand(new Command\PublishArticle($id));
        }
        catch (Exception $exception) {
            return new JsonResponse(
                ["error" => $exception->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return new JsonResponse(new ArticleDefinition($article));
    }
}
