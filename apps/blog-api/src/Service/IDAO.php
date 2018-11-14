<?php

namespace App\Service;

/**
 * @author jlanglois
 */
interface IDAO
{
    public function findAll(): array;

    public function find(string $seoTitle): array;
}
