<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Io\Writer;

class BuildCommand extends Command
{
    private $writer;
    private $param;

    public function __construct(string $param, Writer $writer)
    {
        $this->writer = $writer;
        $this->param = $param;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
    }
}