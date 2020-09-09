<?php

namespace App\Library\Domain;

use DateTimeImmutable;
use Symfony\Component\Uid\Uuid;

class Record
{
    /** @var Uuid $id */
    private $id;
    /** @var string $title */
    private $title;
    /** @var DateTimeImmutable */
    private $createdAt;
    /** @var DateTimeImmutable */
    private $release;


    public function __construct(Uuid $id, string $title, DateTimeImmutable $createdAt, DateTimeImmutable $release)
    {
        $this->id = $id;
        $this->title = $title;
        $this->createdAt = $createdAt;
        $this->release = $release;
    }

    public function updateTitle(string $title): string
    {
        $this->title = $title;
        return $this->title;
    }

    public function updateRelease(DateTimeImmutable $release): DateTimeImmutable
    {
        $this->release = $release;
        return $this->release;
    }
}