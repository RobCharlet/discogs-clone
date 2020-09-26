<?php

namespace App\Library\Domain\Repository;

use App\Library\Domain\Record;
use Symfony\Component\Uid\Uuid;

interface RecordReaderInterface
{
    public function find(Uuid $i): Record;
}