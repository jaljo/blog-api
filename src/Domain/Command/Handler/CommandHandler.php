<?php

namespace App\Domain\Command\Handler;

interface CommandHandler
{
    /**
     * @param mixed $command
     *
     * @return mixed
     */
    public function handle($command);
}
