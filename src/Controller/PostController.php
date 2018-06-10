<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\PostDAO;
use Exception;

/**
 * @author jlanglois
 */
class PostController extends Controller
{
    /**
     * @todo fetch data from database
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
}
