<?php

namespace BinaryStudioAcademy\Game\Resource;

abstract class Resource implements \BinaryStudioAcademy\Game\Contracts\Resource\Resource
{
    private $name;

    public function getName(): string
    {
        return $this->name;
    }
}