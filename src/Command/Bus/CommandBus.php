<?php

namespace App\Command\Bus;

use App\Command\Command;
use App\Command\CommandResult;

interface CommandBus
{
    /**
     * @param mixed $command
     */
    public function executeCommand($command): CommandResult;
}
