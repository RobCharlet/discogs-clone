<?php

namespace App\Library\UI\Controller;

use App\Library\App\Command\CreateRecordCommand;
use App\Library\Domain\Record;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateRecordController
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Record $record)
    {
        $command = CreateRecordCommand::fromId($record->getId());
        $this->commandBus->dispatch($command);

        return new Response('', Response::HTTP_ACCEPTED);
    }
}