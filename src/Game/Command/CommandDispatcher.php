<?php

namespace BinaryStudioAcademy\Game\Command;

use BinaryStudioAcademy\Game\Contracts\Io\Writer;

class CommandDispatcher
{
    private $registry = [];
    private $writer;

    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
    }

    public function add(Command $command, string $name)
    {
        $this->registry[$name] = $command;
    }

    public function run(string $command)
    {
        if (strpos($command, ':') === false) {
            $name = $command;
            $params = '';
        } else {
            $name = substr($command, 0, strpos($command, ':'));
            $params = substr($command, strpos($command, ':') + 1);
        }

        if (isset($this->registry[$name])) {
            $this->registry[$name]->execute($params);
        } else {
            $this->writer->writeln("There is no command $name");
        }
    }
}