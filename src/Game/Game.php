<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Io\Reader;
use BinaryStudioAcademy\Game\Contracts\Io\Writer;
use BinaryStudioAcademy\Game\Command\CommandDispatcher;
use BinaryStudioAcademy\Game\Command\BuildCommand;
use BinaryStudioAcademy\Game\Command\ExitCommand;
use BinaryStudioAcademy\Game\Command\HelpCommand;
use BinaryStudioAcademy\Game\Command\MineCommand;
use BinaryStudioAcademy\Game\Command\ProduceCommand;
use BinaryStudioAcademy\Game\Command\SchemeCommand;
use BinaryStudioAcademy\Game\Command\StatusCommand;

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
