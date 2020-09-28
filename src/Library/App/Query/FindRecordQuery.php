<?php

namespace App\Library\App\Query;

use Symfony\Component\Uid\Uuid;

class FindRecordQuery
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function withId(string $id): FindRecordQuery
    {
        return new static($id);
    }

    public function getId(): Uuid
    {
        return Uuid::fromString($this->id);
    }
}