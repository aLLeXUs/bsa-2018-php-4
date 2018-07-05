<?php

namespace BinaryStudioAcademy\Game\Commands;

use BinaryStudioAcademy\Game\Contracts\Io\Writer;
use BinaryStudioAcademy\Game\Inventory;

class ProduceCommand extends Command
{
    private $writer;
    private $param;
    private $inventory;

    public function __construct(string $param, Inventory $inventory, Writer $writer)
    {
        $this->writer = $writer;
        $this->param = $param;
        $this->inventory = $inventory;
    }

    public function execute()
    {
        $this->inventory->produceResource($this->param);
    }
}