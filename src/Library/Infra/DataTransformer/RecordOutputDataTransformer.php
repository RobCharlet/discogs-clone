<?php

namespace App\Library\Infra\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Library\App\Query\FindRecordQuery;
use App\Library\Domain\DTO\RecordOutputDTO;
use App\Library\Domain\Record;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class RecordOutputDataTransformer implements DataTransformerInterface
{
    private MessageBusInterface $queryBus;
    private NormalizerInterface $normalizer;

    public function __construct(MessageBusInterface $queryBus, NormalizerInterface $normalizer)
    {
        $this->queryBus = $queryBus;
        $this->normalizer = $normalizer;
    }

    public function transform($data, string $to, array $context = [])
    {
        $query = FindRecordQuery::withId($data->id);
        $envelope = $this->queryBus->dispatch($query);

        $record = $envelope->last(HandledStamp::class)->getResult();

        return $this->normalizer->normalize($record);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return RecordOutputDTO::class === $to && $data instanceof Record;
    }
}