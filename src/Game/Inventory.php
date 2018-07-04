<?php

namespace BinaryStudioAcademy\Game;


class Inventory
{
    public $inventory;

    public function __construct()
    {
        $this->inventory = [
            'modules' => [
                'control_unit' => 0,
                'engine' => 0,
                'ic' => 0,
                'launcher' => 0,
                'porthole' => 0,
                'shell' => 0,
                'tank' => 0,
                'wires' => 0
            ],
            'resources' => [
                'carbon' => 0,
                'copper' => 0,
                'fire' => 0,
                'fuel' => 0,
                'iron' => 0,
                'metal' => 0,
                'sand' => 0,
                'silicon' => 0,
                'water' => 0
            ],
            'spaceship' => 0
        ];
    }
}