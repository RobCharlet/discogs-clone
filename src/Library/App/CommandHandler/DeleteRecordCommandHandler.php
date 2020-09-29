<?php

namespace App\Library\App\CommandHandler;

use App\Library\App\Command\DeleteRecordCommand;
use App\Library\Domain\Repository\RecordReaderInterface;
use App\Library\Domain\Repository\RecordWriterInterface;

class DeleteRecordCommandHandler
{
    private RecordWriterInterface $recordWriter;
    private RecordReaderInterface $recordReader;

    public function __construct(RecordWriterInterface $recordWriter, RecordReaderInterface $recordReader)
    {
        $this->recordWriter = $recordWriter;
        $this->recordReader = $recordReader;
    }

    public function __invoke(DeleteRecordCommand $command)
    {
        $record = $this->recordReader->find($command->getId());
        $this->recordWriter->delete($record);
    }
}