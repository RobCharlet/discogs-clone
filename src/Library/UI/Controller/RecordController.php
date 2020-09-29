<?php

namespace App\Library\UI\Controller;

use App\Library\App\Command\CreateRecordCommand;
use App\Library\App\Command\DeleteRecordCommand;
use App\Library\App\Command\UpdateRecordCommand;
use App\Library\App\Query\FindRecordQuery;
use App\Library\Domain\Record;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Uid\Uuid;

class RecordController
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

    /**
     * @Route("/records/{id}.json", name="get_record", methods={"GET"}, requirements={"_format": "json"})
     * @param MessageBusInterface $queryBus
     * @param NormalizerInterface $normalizer
     * @param string              $id
     *
     * @return JsonResponse
     * @throws \Symfony\Component\Serializer\Exception\ExceptionInterface
     */
    public function getRecordController(
        MessageBusInterface $queryBus,
        NormalizerInterface $normalizer,
        string $id
    )
    {
        $query = FindRecordQuery::withId($id);
        $envelope = $queryBus->dispatch($query);

        $record = $envelope->last(HandledStamp::class)->getResult();

        return new JsonResponse(
            $normalizer->normalize($record),
            Response::HTTP_OK
        );
    }


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
     * @return Response
     */
    public function updateRecordController(Request $request, MessageBusInterface $commandBus, string $id)
    {
        $payload = json_decode($request->getContent(), true);
        $command = UpdateRecordCommand::fromData($id, $payload);
        $commandBus->dispatch($command);

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/records/{id}.json", name="delete_record", methods={"DELETE"}, requirements={"_format": "json"})
     * @param MessageBusInterface $commandBus
     * @param string              $id
     *
     * @return Response
     */
    public function deleteController(MessageBusInterface $commandBus, string $id)
    {
        $command = DeleteRecordCommand::fromId($id);
        $commandBus->dispatch($command);

        return new Response('', Response::HTTP_NO_CONTENT);
    }
}