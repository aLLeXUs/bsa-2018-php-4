<?php

namespace BinaryStudioAcademy\Game;

class Schemes
{
    public $schemes;

    public function __construct()
    {
        $this->schemes = [
            'modules' => [
                'control_unit' => [
                    'modules' => ['ic', 'wires'],
                ],
                'engine' => [
                    'resources' => ['metal', 'carbon', 'fire'],
                ],
                'ic' => [
                    'resources' => ['metal', 'silicon'],
                ],
                'launcher' => [
                    'resources' => ['water', 'fire', 'fuel'],
                ],
                'porthole' => [
                    'resources' => ['sand', 'fire'],
                ],
                'shell' => [
                    'resources' => ['metal', 'fire'],
                ],
                'tank' => [
                    'resources' => ['metal', 'fuel'],
                ],
                'wires' => [
                    'resources' => ['copper', 'fire']
                ]
            ],
            'resources' => [
                'carbon' => [],
                'copper' => [],
                'fire' => [],
                'fuel' => [],
                'iron' => [],
                'metal' => [
                    'resources' => 'iron', 'fire',
                ],
                'sand' => [],
                'silicon' => [],
                'water' => []
            ]
        ];
    }
}