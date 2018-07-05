<?php

namespace BinaryStudioAcademy\Game\Resources;

abstract class Resource implements \BinaryStudioAcademy\Game\Contracts\Resources\Resource
{
    private $name;

    public function getName(): string
    {
        return $this->name;
    }
}