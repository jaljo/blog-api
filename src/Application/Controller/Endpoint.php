<?php

namespace App\Application\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

interface Endpoint
{
    public function list(): JsonResponse;

    public function read(string $slug): JsonResponse;

    public function create(Request $request): JsonResponse;
}
