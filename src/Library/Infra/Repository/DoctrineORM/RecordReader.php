<?php

namespace App\Library\Infra\Repository\DoctrineORM;

use App\Library\Domain\Record;
use App\Library\Domain\Repository\RecordReaderInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

class RecordReader implements RecordReaderInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function find(Uuid $id): Record
    {
        /** @var Record $record */
        $record = $this->entityManager->find(Record::class, $id);

        return $record;
    }
}