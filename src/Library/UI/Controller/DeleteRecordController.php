<?php

namespace App\Library\UI\Controller;

use App\Library\App\Command\DeleteRecordCommand;
use App\Library\Domain\Record;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class DeleteRecordController
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Record $record)
    {
        $command = DeleteRecordCommand::fromId($record->getId());
        $this->commandBus->dispatch($command);

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}