<?php

namespace App\Command\Bus;

use App\Command\Command;
use App\Command\CommandResult;
use App\Command\Handler\CommandHandler;
use Symfony\Component\DependencyInjection\ContainerInterface;


class SimpleBus implements CommandBus
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function executeCommand(Command $command): CommandResult
    {
        $handler = $this->getHandler($command);

        return $handler->handle($command);
    }

    private function getHandler(Command $command): CommandHandler
    {
        $handlerClass = preg_replace(
            '/^([\w+\\\]+)(\\\[\w]+)$/',
            '${1}\Handler${2}',
            get_class($command)
        );

        return $this->container->get($handlerClass);
    }
}
