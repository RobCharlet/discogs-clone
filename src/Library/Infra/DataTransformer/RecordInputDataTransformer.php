<?php

namespace App\Library\Infra\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Library\App\Command\CreateRecordCommand;
use App\Library\Domain\Record;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;

final class RecordInputDataTransformer implements DataTransformerInterface
{
    private ValidatorInterface $validator;

    private MessageBusInterface $commandBus;

    public function __construct(ValidatorInterface $validator, MessageBusInterface $commandBus)
    {
        $this->validator = $validator;
        $this->commandBus = $commandBus;
    }

    public function transform($object, string $to, array $context = [])
    {
        // TODO: Fix empty object
        dd($object);

        $payload = [
            'title' => $object->title,
            'releaseDate' => $object->releaseDate
        ];

        $command = CreateRecordCommand::fromData(Uuid::v4()->toRfc4122(), $payload);
        $this->commandBus->dispatch($command);
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        // in the case of an input, the value given here is an array (the JSON decoded).
        // if it's a book we transformed the data already
        if ($data instanceof Record) {
            return false;
        }

        return Record::class === $to && null !== ($context['input']['class'] ?? null);
    }
}