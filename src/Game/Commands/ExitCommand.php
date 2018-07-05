<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Io\Writer;

class ExitCommand extends Command
{
    private $writer;

    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    public function execute()
    {
        $this->writer->writeln('You exited game.');
        exit;
    }
}