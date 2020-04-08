<?php

namespace App\Domain\Command\Bus;

use App\Domain\Command\Handler\CommandHandler;
use Exception;
use ReflectionClass;

class SimpleBus implements CommandBus
{
    /**
     * @var array
     */
    private $handlers;

    public function __construct(array $handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * {@inheritdoc}
     */
    public function executeCommand($command)
    {
        $handler = $this->getHandler($command);

        return $handler($command);
    }

    /**
     * @param object $command (Mais cette annotation peut carrément virer, si on utilise un vrai type-hint ci-dessous)
     *
     * @return callable
     *
     * @throws Exception
     */
    private function getHandler(object $command)
    {
        $commandClass = get_class($command);

        foreach ($this->handlers as $handler) {
            $handlerClass = get_class($handler);
            $handlerReflection = new ReflectionClass($handlerClass);

            $parameters = $handlerReflection
                ->getmethod('__invoke')
                ->getParameters()
            ;

            $commandType = count($parameters) >= 1
                ? $parameters[0]->getType()->__toString()
                : null
            ;

            if ($commandType === $commandClass) {
                return $handler;
            }
        }

        throw new Exception(sprintf('No handler found for %s', $commandClass));
    }
}
