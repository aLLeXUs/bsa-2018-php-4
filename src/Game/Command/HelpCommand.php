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
        $this->writer->writeln('help - show help menu.');
        $this->writer->writeln('status - show information about the number of available resources and what parts of the spaceship have not yet been builded.');
        $this->writer->writeln('build:<spaceship_module> - buid spaceship module.');
        $this->writer->writeln('scheme:<spaceship_module> - show build scheme of module/resource.');
        $this->writer->writeln('mine:<resource_name> - add resource to inventory.');
        $this->writer->writeln('produce:<combined_resource> - produce combined resource.');
        $this->writer->writeln('exit - exit game.');
    }
}