<?php

namespace BinaryStudioAcademy\Game\Modules;

class ModulesFactory
{
    public function createEngine(): Engine
    {
        return new Engine();
    }

    public function createControlUnit(): ControlUnit
    {
        return new ControlUnit();
    }

    public function createIC(): IC
    {
        return new IC();
    }

    public function createLauncher(): Launcher
    {
        return new Launcher();
    }

    public function createPorthole(): Porthole
    {
        return new Porthole();
    }

    public function createShell(): Shell
    {
        return new Shell();
    }

    public function createTank(): Tank
    {
        return new Tank();
    }

    public function createWires(): Wires
    {
        return new Wires();
    }
}