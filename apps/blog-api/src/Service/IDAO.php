<?php

namespace App\Service;

interface IDAO
{
    public function findAll(): array;

    public function find(string $seoTitle): array;
}
