<?php

namespace BinaryStudioAcademy\Game;

use BinaryStudioAcademy\Game\Contracts\Io\Writer;

class Inventory implements \BinaryStudioAcademy\Game\Contracts\Inventory
{
    public $writer;
    public $inventory;
    public $schemes;

    public function __construct(Writer $writer, Schemes $schemes)
    {
        $this->writer = $writer;
        $this->schemes = $schemes->schemes;
        $this->inventory = [
            'modules' => [
                'control_unit' => 0,
                'engine' => 0,
                'launcher' => 0,
                'porthole' => 0,
                'shell' => 0,
                'tank' => 0,
                'wires' => 0,
                'ic' => 0
            ],
            'resources' => [
                'carbon' => 0,
                'copper' => 0,
                'fire' => 0,
                'fuel' => 0,
                'iron' => 0,
                'sand' => 0,
                'silicon' => 0,
                'water' => 0,
                'metal' => 0
            ],
            'spaceship' => 0
        ];
    }

    public function status()
    {
        $this->writer->writeln('You have:');
        foreach ($this->inventory['resources'] as $name => $amount) {
            $this->writer->writeln(" - $name - $amount");
        }
        $this->writer->writeln('Parts ready:');
        foreach ($this->inventory['modules'] as $name => $amount) {
            if ($amount > 0) {
                $this->writer->writeln(" - $name");
            }
        }
        $this->writer->writeln('Parts to build:');
        foreach ($this->inventory['modules'] as $name => $amount) {
            if ($amount == 0) {
                $this->writer->writeln(" - $name");
            }
        }
    }

    public function scheme(string $name)
    {
        if (!empty($name) && isset($this->schemes['modules'][$name])) {
            $scheme = $this->schemes['modules'][$name];
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
            $this->writer->writeln("$name => " . implode('|', $components));
        } else {
            $this->writer->writeln('There is no such spaceship module.');
        }
    }

    public function checkWin()
    {
        foreach ($this->inventory['modules'] as $amount) {
            if ($amount == 0) {
                return false;
            }
        }
        return true;
    }

    public function buildModule(string $name)
    {
        $missing = [];
        if (!empty($name) && isset($this->inventory['modules'][$name])) {
            $scheme = $this->schemes->schemes['modules'][$name];
            if (isset($scheme['modules'])) {
                foreach ($scheme['modules'] as $module) {
                    if ($this->inventory['modules'][$module] == 0) {
                        $missing[] = $module;
                    }
                }
            }
            if (isset($scheme['resources'])) {
                foreach ($scheme['resources'] as $resource) {
                    if ($this->inventory['resources'][$resource] == 0) {
                        $missing[] = $resource;
                    }
                }
            }
            if (empty($missing)) {
                if (isset($scheme['modules'])) {
                    foreach ($scheme['modules'] as $module) {
                        $this->inventory['modules'][$module]--;
                    }
                }
                if (isset($scheme['resources'])) {
                    foreach ($scheme['resources'] as $resource) {
                        $this->inventory['resources'][$resource]--;
                    }
                }
                $this->inventory['modules'][$name]++;
                if ($this->checkWin()) {
                    $this->writer->writeln("$name is ready! => You won!");
                } else {
                    $this->writer->writeln("$name is ready!");
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
        if (!empty($name) && isset($this->inventory['resources'][$name])) {
            $this->inventory['resources'][$name]++;
            $this->writer->writeln("$name added to inventory.");
        } else {
            $this->writer->writeln('No such resource.');
        }
    }

    public function produceResource(string $name)
    {
        $missing = [];
        if (!empty($name) && isset($this->inventory['resources'][$name])) {
            $scheme = $this->schemes->schemes['resources'][$name];
            if (isset($scheme['resources'])) {
                foreach ($scheme['resources'] as $resource) {
                    if ($this->inventory['resources'][$resource] == 0) {
                        $missing[] = $resource;
                    }
                }
            }
            if (empty($missing)) {
                if (isset($scheme['modules'])) {
                    foreach ($scheme['modules'] as $module) {
                        $this->inventory['modules'][$module]--;
                    }
                }
                if (isset($scheme['resources'])) {
                    foreach ($scheme['resources'] as $resource) {
                        $this->inventory['resources'][$resource]--;
                    }
                }
                $this->inventory['resources'][$name]++;
                $this->writer->writeln("$name is ready!");
            } else {
                $this->writer->writeln('You need to mine: ' . implode(',', $missing) . '.');
            }
        } else {
            $this->writer->writeln('There is no such spaceship module.');
        }
    }
}