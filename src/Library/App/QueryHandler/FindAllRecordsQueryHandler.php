<?php

namespace App\Library\App\QueryHandler;

use App\Library\App\Query\FindAllRecordsQuery;
use App\Library\Domain\Repository\RecordReaderInterface;

class FindAllRecordsQueryHandler
{
    private RecordReaderInterface $recordReader;

    public function __construct(RecordReaderInterface $recordReader)
    {
        $this->recordReader = $recordReader;
    }

    public function __invoke(FindAllRecordsQuery $findRecordQuery): Array
    {
        return $this->recordReader->findAll();
    }
}