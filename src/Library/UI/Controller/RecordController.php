<?php

namespace App\Library\UI\Controller;

use App\Library\App\Command\CreateRecordCommand;
use App\Library\App\Command\UpdateRecordCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class RecordController
{
    /**
     * @Route("/api/records/create.json", name="create_record", methods={"POST"}, requirements={"_format": "json"})
     * @param Request             $request
     * @param MessageBusInterface $commandBus
     *
     * @return JsonResponse
     */
    public function createRecordController(Request $request, MessageBusInterface $commandBus)
    {
        $payload = json_decode($request->getContent(), true);
        $command = CreateRecordCommand::fromData(Uuid::v4()->toRfc4122(), $payload);
        $commandBus->dispatch($command);

        return new JsonResponse(
            '',
            Response::HTTP_CREATED,
            ['X-RESOURCE-ID' => $command->getId()]
        );
    }

    /**
     * @Route("/records/{id}.{_format}", name="update_record", methods={"PUT"}, requirements={"_format": "json"})
     * @param Request             $request
     * @param MessageBusInterface $commandBus
     * @param string              $id
     *
     * @return JsonResponse
     */
    public function updateRecordController(Request $request, MessageBusInterface $commandBus, string $id)
    {
        $payload = json_decode($request->getContent(), true);
        $command = UpdateRecordCommand::fromData($id, $payload);
        $commandBus->dispatch($command);

        return new JsonResponse(
            '',
            Response::HTTP_CREATED,
            ['X-RESOURCE-ID' => $command->getId()]
        );
    }
}