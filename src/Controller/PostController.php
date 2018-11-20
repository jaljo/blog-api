<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\PostDAO;
use Exception;

class PostController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function getBlogPosts(): JsonResponse
    {
        try{
            $postDao = $this->get(PostDAO::class);
            $blogPosts = $postDao->findAll();

            return new JsonResponse($blogPosts);
        }
        catch(Exception $exception) {
            return new JsonResponse(["error" => $exception->getMessage()]);
        }
    }

    /**
     * @return JsonResponse
     */
    public function getBlogPost(string $seoTitle): JsonResponse
    {
      try{
          $postDao = $this->get(PostDAO::class);
          $blogPost = $postDao->find($seoTitle);

          return new JsonResponse($blogPost);
      }
      catch(Exception $exception) {
          return new JsonResponse(["error" => $exception->getMessage()]);
      }
    }
}
