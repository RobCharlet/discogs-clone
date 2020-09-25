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
    private $releaseDate;


    public function __construct(Uuid $id, string $title, DateTimeImmutable $releaseDate)
    {
        $this->id = $id;
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->createdAt = new DateTimeImmutable("now");
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getReleaseDate(): DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setReleaseDate(DateTimeImmutable $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }
}