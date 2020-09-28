<?php

namespace App\Library\Infra\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Serializer\AbstractItemNormalizer;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Library\App\Command\CreateRecordCommand;
use App\Library\App\Command\UpdateRecordCommand;
use App\Library\Domain\Record;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
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

    public function transform($data, string $to, array $context = [])
    {
        $this->validator->validate($data);

        $payload = [
            'title' => $data->title,
            'releaseDate' => $data->releaseDate
        ];

        // UPDATE PROCESS
        if (array_key_exists('object_to_populate',$context)) {
            $existingRecord = $context[AbstractItemNormalizer::OBJECT_TO_POPULATE];
            $existingRecordId = $existingRecord->getId();
            $command = UpdateRecordCommand::fromData($existingRecordId->toRfc4122(), $payload);
            $this->commandBus->dispatch($command);
            return new Response('', Response::HTTP_NO_CONTENT);
        }
        // CREATE PROCESS
        else {
            $command = CreateRecordCommand::fromData(Uuid::v4()->toRfc4122(), $payload);
            $this->commandBus->dispatch($command);

            return new JsonResponse(
                '',
                Response::HTTP_CREATED,
                ['X-RESOURCE-ID' => $command->getId()]
            );
        }
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