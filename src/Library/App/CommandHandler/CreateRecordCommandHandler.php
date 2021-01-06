<?php

namespace App\Library\App\CommandHandler;

use App\Library\App\Command\CreateRecordCommand;
use App\Library\Domain\Record;
use App\Library\Domain\Repository\RecordWriterInterface;

class CreateRecordCommandHandler
{
    private RecordWriterInterface $recordWriter;

    /**
     * CreateRecordCommandHandler constructor.
     *
     * @param RecordWriterInterface $recordWriter
     */
    public function __construct(RecordWriterInterface $recordWriter)
    {
        $this->recordWriter = $recordWriter;
    }

    /**
     * @param CreateRecordCommand $command
     *
     * @return void
     */
    public function __invoke(CreateRecordCommand $command): void
    {
        $id = $command->getId();
        $title = $command->getTitle();
        $release = $command->getReleaseDate();

        $record = new Record($id, $title, $release);

        $this->recordWriter->save($record);
    }
}