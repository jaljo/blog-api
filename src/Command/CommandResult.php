<?php

namespace App\Command;

interface CommandResult
{
    /**
     * @return mixed
     */
    public function getResult();
}
