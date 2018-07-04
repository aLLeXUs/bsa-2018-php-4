<?php

namespace BinaryStudioAcademy\Game\Modules;

abstract class Module implements \BinaryStudioAcademy\Game\Contracts\Modules\Module
{
    private $name;

    public function getName(): string
    {
        return $this->name;
    }
}