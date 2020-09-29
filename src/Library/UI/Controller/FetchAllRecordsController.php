<?php

namespace App\Library\UI\Controller;

use App\Library\App\Query\FindAllRecordsQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class FetchAllRecordsController
{
    private MessageBusInterface $queryBus;
    private NormalizerInterface $normalizer;

    public function __construct(MessageBusInterface $queryBus, NormalizerInterface $normalizer)
    {
        $this->queryBus = $queryBus;
        $this->normalizer = $normalizer;
    }

    public function __invoke(FindAllRecordsQuery $findAllRecordQuery)
    {
        $query = $findAllRecordQuery::findAll();
        $envelope = $this->queryBus->dispatch($query);

        $records = $envelope->last(HandledStamp::class)->getResult();

        return new JsonResponse($this->normalizer->normalize($records), Response::HTTP_OK);
    }
}