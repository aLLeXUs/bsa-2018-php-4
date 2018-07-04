<?php

namespace BinaryStudioAcademy\Game\Commands;


abstract class Command implements \BinaryStudioAcademy\Game\Contracts\Commands\Command
{
    public abstract function execute();
}