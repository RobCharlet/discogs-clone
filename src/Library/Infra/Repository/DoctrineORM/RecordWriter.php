<?php

namespace App\Library\Infra\Repository\DoctrineORM;

use App\Library\Domain\Record;
use App\Library\Domain\Repository\RecordWriterInterface;
use Doctrine\ORM\EntityManagerInterface;

class RecordWriter implements RecordWriterInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Record $record): void
    {
        $this->entityManager->persist($record);
        $this->entityManager->flush();
    }

    public function delete(Record $record): void
    {
        $this->entityManager->remove($record);
        $this->entityManager->flush();
    }
}