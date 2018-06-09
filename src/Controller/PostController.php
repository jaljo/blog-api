<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @author jlanglois
 * @todo fetch data from database
 */
class PostController extends Controller
{
    public function getBlogPosts(): JsonResponse
    {
        $blogPosts = [
            ["id" => 1, "title" => "symfony title 1", "content" => " content 1", "date" => "January 1, 2017"],
            ["id" => 2, "title" => "title 2", "content" => "content 2", "date" => "January 1, 2017"],
            ["id" => 3, "title" => "title 3", "content" => "content 3", "date" => "January 1, 2017"]
        ];
        
        return new JsonResponse($blogPosts);
    }
}
