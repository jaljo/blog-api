<?php

namespace App\Service;

interface IDAO
{
    public function findAll(): array;

    /**
     * @return array
     *
     * @throws Exception
     */
    public function find(string $seoTitle): array;
}
