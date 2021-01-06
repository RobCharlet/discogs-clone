<?php

namespace App\Library\UI\Controller;

use App\Library\App\Command\CreateRecordCommand;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateRecordController
{

    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(CreateRecordCommand $command): Response
    {
        $id = $command->getId();
        $title = $command->getTitle();
        $releaseDate = $command->getReleaseDate();

        $command = CreateRecordCommand::fromData($id,[
            $title, $releaseDate
        ]);

        $this->commandBus->dispatch($command);

        return new Response('', Response::HTTP_CREATED);
    }
}