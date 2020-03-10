<?php

namespace App\Command\Handler;

use App\Command\Command;
use App\Command\CommandResult;

interface CommandHandler
{
    public function handle(Command $command): CommandResult;
}
