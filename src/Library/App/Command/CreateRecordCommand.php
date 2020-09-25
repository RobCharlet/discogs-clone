<?php

namespace App\Library\App\Command;

use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

class CreateRecordCommand
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var mixed[]
     */
    private $payload;

    /**
     * CreateRecordCommand constructor.
     *
     * @param string $id
     * @param array  $payload
     */
    private function __construct(string $id, array $payload)
    {
        $this->id = $id;
        $this->payload = $payload;
    }

    /**
     * @param string $id
     * @param array  $payload
     *
     * @return CreateRecordCommand
     */
    public static function fromData(string $id, array $payload): CreateRecordCommand
    {
        return new static($id, $payload);
    }

    /**
     * @return Uuid
     */
    public function getId(): Uuid
    {
        return Uuid::fromString($this->id);
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->payload['title'];
    }

    /**
     * @return DateTimeImmutable
     */
    public function getReleaseDate(): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat('Y-m-d', $this->payload['releaseDate']);
    }
}