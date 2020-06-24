<?php

namespace App\Command\Bus;

use App\Command\Command;
use App\Command\CommandResult;

interface CommandBus
{
    public function executeCommand(Command $command): CommandResult;
}
