<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Io\Reader;
use BinaryStudioAcademy\Game\Contracts\Io\Writer;
use BinaryStudioAcademy\Game\Commands\CommandsDispatcher;
use BinaryStudioAcademy\Game\Commands\BuildCommand;
use BinaryStudioAcademy\Game\Commands\ExitCommand;
use BinaryStudioAcademy\Game\Commands\HelpCommand;
use BinaryStudioAcademy\Game\Commands\MineCommand;
use BinaryStudioAcademy\Game\Commands\ProduceCommand;
use BinaryStudioAcademy\Game\Commands\SchemeCommand;
use BinaryStudioAcademy\Game\Commands\StatusCommand;
use BinaryStudioAcademy\Game\Commands\Invoker;
use BinaryStudioAcademy\Game\Inventory;

class Game
{
    public function start(Reader $reader, Writer $writer): void
    {
        $writer->writeln("Welcome to Spaceship constructor.");

        $inventory = new Inventory($writer, new Schemes());
        while (true) {
            $writer->write("Type command: ");
            $input = trim($reader->read());

            if (strpos($input, ':') === false) {
                $name = $input;
                $param = '';
            } else {
                $name = substr($input, 0, strpos($input, ':'));
                $param = substr($input, strpos($input, ':') + 1);
            }

            $invoker = new Invoker();
            switch ($name) {
                case 'build':
                    $invoker->setCommand(new BuildCommand($param, $inventory, $writer));
                    $invoker->run();
                    break;
                case 'exit':
                    $invoker->setCommand(new ExitCommand($writer));
                    $invoker->run();
                    break;
                case 'help':
                    $invoker->setCommand(new HelpCommand($writer));
                    $invoker->run();
                    break;
                case 'mine':
                    $invoker->setCommand(new MineCommand($param, $inventory, $writer));
                    $invoker->run();
                    break;
                case 'produce':
                    $invoker->setCommand(new ProduceCommand($param, $inventory, $writer));
                    $invoker->run();
                    break;
                case 'scheme':
                    $invoker->setCommand(new SchemeCommand($param, $inventory, $writer));
                    $invoker->run();
                    break;
                case 'status':
                    $invoker->setCommand(new StatusCommand($writer, $inventory));
                    $invoker->run();
                    break;
                default:
                    $writer->writeln("There is no command $name");
            }
        }
    }

    public function run(Reader $reader, Writer $writer): void
    {
        // TODO: Implement step by step mode with game state persistence between steps
        $writer->writeln("You can't play yet. Please read input and convert it to commands.");
        $writer->writeln("Don't forget to create game's world.");
    }
}
