<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Commands\CommandsDispatcher;
use BinaryStudioAcademy\Game\Contracts\Io\Reader;
use BinaryStudioAcademy\Game\Contracts\Io\Writer;

class Game
{
    private $inventory;

    public function start(Reader $reader, Writer $writer): void
    {
        $writer->writeln("Welcome to Spaceship constructor.");

        $inventory = new Inventory($writer);
        while (true) {
            $writer->write("Type command: ");
            $input = trim($reader->read());

            $dispatcher = new CommandsDispatcher($writer, $inventory);
            $dispatcher->run($input);
        }
    }

    public function run(Reader $reader, Writer $writer): void
    {
        if (is_null($this->inventory)) {
            $this->inventory = new Inventory($writer);
        } else {
            $this->inventory->changeWriter($writer);
        }

        $input = trim($reader->read());

        $dispatcher = new CommandsDispatcher($writer, $this->inventory);
        $dispatcher->run($input);
    }
}
