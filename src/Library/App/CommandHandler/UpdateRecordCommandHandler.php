<?php

namespace App\Library\App\CommandHandler;

use App\Library\App\Command\UpdateRecordCommand;
use App\Library\Domain\Repository\RecordReaderInterface;
use App\Library\Domain\Repository\RecordWriterInterface;

class UpdateRecordCommandHandler
{
    private RecordWriterInterface $recordWriter;
    private RecordReaderInterface $recordReader;

    /**
     * CreateRecordCommandHandler constructor.
     *
     * @param RecordWriterInterface $recordWriter
     * @param RecordReaderInterface $recordReader
     */
    public function __construct(RecordWriterInterface $recordWriter, RecordReaderInterface $recordReader)
    {
        $this->recordWriter = $recordWriter;
        $this->recordReader = $recordReader;
    }

    /**
     * @param UpdateRecordCommand   $command
     *
     * @return void
     */
    public function __invoke(UpdateRecordCommand $command): void
    {
        $id = $command->getId();
        $title = $command->getTitle();
        $releaseDate = $command->getReleaseDate();

        $record = $this->recordReader->find($id);
        $record->setTitle($title);
        $record->setReleaseDate($releaseDate);

        $this->recordWriter->save($record);
    }
}