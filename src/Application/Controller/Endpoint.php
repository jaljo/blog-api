<?php

namespace App\Application\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

interface Endpoint
{
    public function list(): JsonResponse;

    public function read(string $slug): JsonResponse;
}
