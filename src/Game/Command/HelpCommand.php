<?php

namespace BinaryStudioAcademy\Game\Command;

use BinaryStudioAcademy\Game\Contracts\Io\Writer;

class HelpCommand extends Command
{
    private $writer;

    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    public function execute(string $params = '')
    {
        // TODO: Implement execute() method.
    }
}