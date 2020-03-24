<?php

namespace App\Command\Bus;

use App\Command\Command;

interface CommandBus
{
    /**
     * @param mixed $command
     *
     * @return mixed
     */
    public function executeCommand($command);
}
