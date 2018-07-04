<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Io\Reader;
use BinaryStudioAcademy\Game\Contracts\Io\Writer;
use BinaryStudioAcademy\Game\Commands\CommandDispatcher;
use BinaryStudioAcademy\Game\Commands\BuildCommand;
use BinaryStudioAcademy\Game\Commands\ExitCommand;
use BinaryStudioAcademy\Game\Commands\HelpCommand;
use BinaryStudioAcademy\Game\Commands\MineCommand;
use BinaryStudioAcademy\Game\Commands\ProduceCommand;
use BinaryStudioAcademy\Game\Commands\SchemeCommand;
use BinaryStudioAcademy\Game\Commands\StatusCommand;

class Game
{
    public function start(Reader $reader, Writer $writer): void
    {
        // TODO: Implement infinite loop and process user's input
        // Feel free to delete these lines

        $dispatcher = new CommandDispatcher($writer);
        $dispatcher->add(new BuildCommand($writer), 'build');
        $dispatcher->add(new ExitCommand($writer), 'exit');
        $dispatcher->add(new HelpCommand($writer), 'help');
        $dispatcher->add(new MineCommand($writer), 'mine');
        $dispatcher->add(new ProduceCommand($writer), 'produce');
        $dispatcher->add(new SchemeCommand($writer), 'scheme');
        $dispatcher->add(new StatusCommand($writer), 'status');

        $writer->writeln("Welcome to Spaceship constructor.");

        while (true) {
            $writer->write("Type command: ");
            $input = trim($reader->read());
            $dispatcher->run($input);
        }
    }

    public function run(Reader $reader, Writer $writer): void
    {
        // TODO: Implement step by step mode with game state persistence between steps
        $writer->writeln("You can't play yet. Please read input and convert it to commands.");
        $writer->writeln("Don't forget to create game's world.");
    }
}
