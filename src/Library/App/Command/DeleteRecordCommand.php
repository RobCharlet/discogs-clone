<?php

namespace App\Library\App\Command;

use Symfony\Component\Uid\Uuid;

class DeleteRecordCommand
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function fromId(string $id): DeleteRecordCommand
    {
       return new static($id);
    }

    public function getId()
    {
        return Uuid::fromString($this->id);
    }
}