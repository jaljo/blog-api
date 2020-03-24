<?php

namespace App\Command\Bus;

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

    /**
     * {@inheritdoc}
     */
    public function executeCommand($command)
    {
        $handler = $this->getHandler($command);

        return $handler->handle($command);
    }

    /**
     * @param mixed $command
     */
    private function getHandler($command): CommandHandler
    {
        $handlerClass = preg_replace(
            '/^([\w+\\\]+)(\\\[\w]+)$/',
            '${1}\Handler${2}',
            get_class($command)
        );

        return $this->container->get($handlerClass);
    }
}
