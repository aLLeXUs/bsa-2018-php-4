<?php

namespace BinaryStudioAcademy\Game\Contracts\Command;

interface Command
{
    public function execute(string $params = '');
}