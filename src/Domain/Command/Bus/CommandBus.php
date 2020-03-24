<?php

namespace App\Domain\Command\Bus;

interface CommandBus
{
    /**
     * @param mixed $command
     *
     * @return mixed
     */
    public function executeCommand($command);
}
