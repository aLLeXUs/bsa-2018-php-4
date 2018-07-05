<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Io\Writer;

class Inventory implements \BinaryStudioAcademy\Game\Contracts\Inventory
{
    private $writer;
    private $inventory;

    public function __construct(Writer $writer)
    {
        $this->writer = $writer;
        $this->inventory = [
            'modules' => [
                'control_unit' => [
                    'name' => 'Control_unit',
                    'amount' => 0,
                    'scheme' => [
                        'modules' => ['ic', 'wires']
                    ]
                ],
                'engine' => [
                    'name' => 'Engine',
                    'amount' => 0,
                    'scheme' => [
                        'resources' => ['metal', 'carbon', 'fire']
                    ]
                ],
                'launcher' => [
                    'name' => 'Launcher',
                    'amount' => 0,
                    'scheme' => [
                        'resources' => ['water', 'fire', 'fuel']
                    ]
                ],
                'porthole' => [
                    'name' => 'Porthole',
                    'amount' => 0,
                    'scheme' => [
                        'resources' => ['sand', 'fire']
                    ]
                ],
                'shell' => [
                    'name' => 'Shell',
                    'amount' => 0,
                    'scheme' => [
                        'resources' => ['metal', 'fire']
                    ]
                ],
                'tank' => [
                    'name' => 'Tank',
                    'amount' => 0,
                    'scheme' => [
                        'resources' => ['metal', 'fuel']
                    ]
                ],
                'wires' => [
                    'name' => 'Wires',
                    'amount' => 0,
                    'scheme' => [
                        'resources' => ['copper', 'fire']
                    ],
                    'submodule' => true
                ],
                'ic' => [
                    'name' => 'Ic',
                    'amount' => 0,
                    'scheme' => [
                        'resources' => ['metal', 'silicon']
                    ],
                    'submodule' => true
                ]
            ],
            'resources' => [
                'carbon' => [
                    'name' => 'Carbon',
                    'amount' => 0
                ],
                'copper' => [
                    'name' => 'Copper',
                    'amount' => 0
                ],
                'fire' => [
                    'name' => 'Fire',
                    'amount' => 0
                ],
                'fuel' => [
                    'name' => 'Fuel',
                    'amount' => 0
                ],
                'iron' => [
                    'name' => 'Iron',
                    'amount' => 0
                ],
                'sand' => [
                    'name' => 'Sand',
                    'amount' => 0
                ],
                'silicon' => [
                    'name' => 'Silicon',
                    'amount' => 0
                ],
                'water' => [
                    'name' => 'Water',
                    'amount' => 0
                ],
                'metal' => [
                    'name' => 'Metal',
                    'amount' => 0,
                    'scheme' => [
                        'resources' => ['iron', 'fire']
                    ],
                    'producible' => true
                ]
            ]
        ];
    }

    public function status()
    {
        $this->writer->writeln('You have:');
        foreach ($this->inventory['resources'] as $resource) {
            if ($resource['amount'] > 0) {
                $this->writer->writeln(" - {$resource['name']} - {$resource['amount']}");
            }
        }
        $this->writer->writeln('Parts ready:');
        foreach ($this->inventory['modules'] as $module) {
            if ($module['amount'] > 0) {
                $this->writer->writeln(" - {$module['name']}");
            }
        }
        $this->writer->writeln('Parts to build:');
        foreach ($this->inventory['modules'] as $module) {
            if ($module['amount'] == 0) {
                $this->writer->writeln(" - {$module['name']}");
            }
        }
    }

    public function scheme(string $name)
    {
        if (!empty($name) && isset($this->inventory['modules'][$name]['scheme'])) {
            $scheme = $this->inventory['modules'][$name]['scheme'];
            $components = [];
            if (isset($scheme['modules'])) {
                foreach ($scheme['modules'] as $module) {
                    $components[] = $module;
                }
            }
            if (isset($scheme['resources'])) {
                foreach ($scheme['resources'] as $resource) {
                    $components[] = $resource;
                }
            }
            $this->writer->writeln("{$this->inventory['modules'][$name]['name']} => " . implode('|', $components));
        } else {
            $this->writer->writeln('There is no such spaceship module.');
        }
    }

    private function checkWin()
    {
        foreach ($this->inventory['modules'] as $module) {
            $submodule = false;
            if (isset($module['submodule']) && $module['submodule']) {
                $submodule = true;
            }
            if (!$submodule && $module['amount'] == 0) {
                return false;
            }
        }
        return true;
    }

    public function buildModule(string $name)
    {
        $missing = [];
        if (!empty($name) && isset($this->inventory['modules'][$name])) {
            if ($this->inventory['modules'][$name]['amount'] > 0) {
                $this->writer->writeln("Attention! {$this->inventory['modules'][$name]['name']} is ready.");
                return;
            }
            $scheme = $this->inventory['modules'][$name]['scheme'];
            if (isset($scheme['modules'])) {
                foreach ($scheme['modules'] as $module) {
                    if ($this->inventory['modules'][$module]['amount'] == 0) {
                        $missing[] = $module;
                    }
                }
            }
            if (isset($scheme['resources'])) {
                foreach ($scheme['resources'] as $resource) {
                    if ($this->inventory['resources'][$resource]['amount'] == 0) {
                        $missing[] = $resource;
                    }
                }
            }
            if (empty($missing)) {
                if (isset($scheme['modules'])) {
                    foreach ($scheme['modules'] as $module) {
                        $this->inventory['modules'][$module]['amount']--;
                    }
                }
                if (isset($scheme['resources'])) {
                    foreach ($scheme['resources'] as $resource) {
                        $this->inventory['resources'][$resource]['amount']--;
                    }
                }
                $this->inventory['modules'][$name]['amount']++;
                if ($this->checkWin()) {
                    $this->writer->writeln("{$this->inventory['modules'][$name]['name']} is ready! => You won!");
                } else {
                    $this->writer->writeln("{$this->inventory['modules'][$name]['name']} is ready!");
                }
            } else {
                $this->writer->writeln('Inventory should have: ' . implode(',', $missing) . '.');
            }
        } else {
            $this->writer->writeln('There is no such spaceship module.');
        }
    }

    public function addResource(string $name)
    {
        $producible = false;
        if (isset($this->inventory['resources'][$name]['producible']) && $this->inventory['resources'][$name]['producible']) {
            $producible = true;
        }
        if (!empty($name) && isset($this->inventory['resources'][$name]) && !$producible) {
            $this->inventory['resources'][$name]['amount']++;
            $this->writer->writeln("{$this->inventory['resources'][$name]['name']} added to inventory.");
        } else {
            $this->writer->writeln('No such resource.');
        }
    }

    public function produceResource(string $name)
    {
        $producible = false;
        if (isset($this->inventory['resources'][$name]['producible']) && $this->inventory['resources'][$name]['producible']) {
            $producible = true;
        }
        $missing = [];
        if (!empty($name) && isset($this->inventory['resources'][$name]) && $producible) {
            $scheme = $this->inventory['resources'][$name]['scheme'];
            if (isset($scheme['resources'])) {
                foreach ($scheme['resources'] as $resource) {
                    if ($this->inventory['resources'][$resource]['amount'] == 0) {
                        $missing[] = $resource;
                    }
                }
            }
            if (empty($missing)) {
                if (isset($scheme['resources'])) {
                    foreach ($scheme['resources'] as $resource) {
                        $this->inventory['resources'][$resource]['amount']--;
                    }
                }
                $this->inventory['resources'][$name]['amount']++;
                $this->writer->writeln("{$this->inventory['resources'][$name]['name']} added to inventory.");
            } else {
                $this->writer->writeln('You need to mine: ' . implode(',', $missing) . '.');
            }
        } else {
            $this->writer->writeln('No such resource.');
        }
    }

    public function changeWriter(Writer $writer)
    {
        $this->writer = $writer;
    }
}