<?php

namespace BinaryStudioAcademy\Game\Commands;

class Invoker
{
    private $command;

    public function setCommand(Command $cmd)
    {
        $this->command = $cmd;
    }

    public function run()
    {
        $this->command->execute();
    }
}