<?php

namespace App\Library\Domain\DTO;

use Symfony\Component\Uid\Uuid;

final class RecordOutputDTO
{
    public Uuid $id;
    public string $title;
    public \DateTimeImmutable $createdAt;
    public \DateTimeImmutable $releaseDate;
}