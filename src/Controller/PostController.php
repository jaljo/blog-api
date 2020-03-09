<?php

namespace App\Controller;

use App\JsonDefinition\Post;
use App\Service\PostDAO;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostController extends Controller
{
    public function getBlogPosts(): JsonResponse
    {
        try {
            $postDao = $this->get(PostDAO::class);
            $blogPosts = $postDao->findAll();
        }
        catch (Exception $exception) {
            return new JsonResponse(["error" => $exception->getMessage()]);
        }

        $postsDefinitions = [];
        foreach ($blogPosts as $post) {
            $postsDefinitions[] = new Post($post);
        }

        return new JsonResponse($postsDefinitions);
    }

    public function getBlogPost(string $seoTitle): JsonResponse
    {
      try {
          $postDao = $this->get(PostDAO::class);
          $blogPost = $postDao->find($seoTitle);
      }
      catch (Exception $exception) {
          return new JsonResponse(["error" => $exception->getMessage()]);
      }

      return new JsonResponse(new Post($blogPost));
    }
}
