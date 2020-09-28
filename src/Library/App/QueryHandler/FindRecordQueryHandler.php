<?php

namespace App\Library\App\QueryHandler;

use App\Library\App\Query\FindRecordQuery;
use App\Library\Domain\Record;
use App\Library\Domain\Repository\RecordReaderInterface;

class FindRecordQueryHandler
{
    private RecordReaderInterface $recordReader;

    public function __construct(RecordReaderInterface $recordReader)
    {
        $this->recordReader = $recordReader;
    }

    public function __invoke(FindRecordQuery $findRecordQuery): Record
    {
        return $this->recordReader->find($findRecordQuery->getId());
    }
}