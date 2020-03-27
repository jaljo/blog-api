<?php

namespace App\Domain\Exception;

use Exception;

class ResourceNotFoundException extends Exception
{
    protected $message = 'Resource not found.';
}
