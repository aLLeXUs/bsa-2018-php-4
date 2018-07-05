<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Io\Writer;
use BinaryStudioAcademy\Game\Inventory;

class StatusCommand extends Command
{
    private $writer;
    private $inventory;

    public function __construct(Writer $writer, Inventory $inventory)
    {
        $this->writer = $writer;
        $this->inventory = $inventory;
    }

    public function execute()
    {
        $this->inventory->status();
    }
}