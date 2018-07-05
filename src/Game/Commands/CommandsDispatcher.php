<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Io\Writer;
use BinaryStudioAcademy\Game\Inventory;

class CommandsDispatcher
{
    private $writer;
    private $inventory;

    public function __construct(Writer $writer, Inventory $inventory)
    {
        $this->writer = $writer;
        $this->inventory = $inventory;
    }

    public function run(string $command)
    {
        if (strpos($command, ':') === false) {
            $name = $command;
            $param = '';
        } else {
            $name = substr($command, 0, strpos($command, ':'));
            $param = substr($command, strpos($command, ':') + 1);
        }

        $invoker = new Invoker();
        switch ($name) {
            case 'build':
                $invoker->setCommand(new BuildCommand($param, $this->inventory, $this->writer));
                $invoker->run();
                break;
            case 'exit':
                $invoker->setCommand(new ExitCommand($this->writer));
                $invoker->run();
                break;
            case 'help':
                $invoker->setCommand(new HelpCommand($this->writer));
                $invoker->run();
                break;
            case 'mine':
                $invoker->setCommand(new MineCommand($param, $this->inventory, $this->writer));
                $invoker->run();
                break;
            case 'produce':
                $invoker->setCommand(new ProduceCommand($param, $this->inventory, $this->writer));
                $invoker->run();
                break;
            case 'scheme':
                $invoker->setCommand(new SchemeCommand($param, $this->inventory, $this->writer));
                $invoker->run();
                break;
            case 'status':
                $invoker->setCommand(new StatusCommand($this->writer, $this->inventory));
                $invoker->run();
                break;
            default:
                $this->writer->writeln("There is no command $name");
        }
    }
}