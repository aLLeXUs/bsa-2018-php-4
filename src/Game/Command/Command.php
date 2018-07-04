<?php

namespace BinaryStudioAcademy\Game\Command;


abstract class Command implements \BinaryStudioAcademy\Game\Contracts\Command\Command
{
    public abstract function execute(string $params = '');
}