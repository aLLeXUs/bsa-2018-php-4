<?php

namespace BinaryStudioAcademy\Game\Resources;

class ResourcesFactory
{
    public function createCarbon(): Carbon
    {
        return new Carbon();
    }

    public function createCopper(): Copper
    {
        return new Copper();
    }

    public function createFire(): Fire
    {
        return new Fire();
    }

    public function createFuel(): Fuel
    {
        return new Fuel();
    }

    public function createIron(): Iron
    {
        return new Iron();
    }

    public function createSand(): Sand
    {
        return new Sand();
    }

    public function createSilicon(): Silicon
    {
        return new Silicon();
    }

    public function createWater(): Water
    {
        return new Water();
    }

    public function createMetal(): Metal
    {
        return new Metal();
    }
}