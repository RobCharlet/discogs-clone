<?php

namespace App\Library\Domain\Repository;

use App\Library\Domain\Record;

interface RecordWriterInterface
{
    /**
     * @param Record $record
     *
     * @return void
     */
    public function save(Record $record): void;

    /**
     * @param Record $record
     *
     * @return void
     */
    public function delete(Record $record): void;
}