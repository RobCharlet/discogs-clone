<?php

namespace App\Library\UI\Controller;

use App\Library\App\Command\CreateRecordCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;

class CreateRecordController
{

    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request ,CreateRecordCommand $command): Response
    {
        $payload = json_decode($request->getContent(), true);
        $command = CreateRecordCommand::fromData(Uuid::v4()->toRfc4122(), $payload);
        $this->commandBus->dispatch($command);

        return new JsonResponse(
            '',
            Response::HTTP_CREATED,
            ['X-RESOURCE-ID' => $command->getId()]
        );
    }
}