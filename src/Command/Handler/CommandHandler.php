<?php

namespace App\Command\Handler;

use App\Command\CommandResult;

interface CommandHandler
{
    /**
     * @param mixed $command
     */
    public function handle($command): CommandResult;
}
