<?php

namespace BinaryStudioAcademy\Game\Contracts;

interface Inventory
{
    public function status();
    public function scheme(string $name);
    public function buildModule(string $name);
    public function addResource(string $name);
    public function produceResource(string $name);
}