<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Io\Writer;

class SchemeCommand extends Command
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