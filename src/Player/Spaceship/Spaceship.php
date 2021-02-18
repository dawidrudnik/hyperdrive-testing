<?php

declare(strict_types=1);

namespace Hyperdrive\Player\Spaceship;

use JetBrains\PhpStorm\ArrayShape;

class Spaceship
{
    protected string $name;
    protected Tank $tank;

    public function __construct(array $spaceshipData)
    {
        $this->setSpaceshipData($spaceshipData);
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function fuelConsumption(): void
    {
        $this->tank->fuelConsumption();
    }

    #[ArrayShape([
        "name" => "string",
        "fuel" => "int",
        "capacity" => "int",
        "fuelConsumption" => "int",
    ])]
    public function getSpaceshipData(): array
    {
        return [
            "name" => $this->name,
        ] + $this->tank->getTankData();
    }

    private function setSpaceshipData(array $spaceshipData): void
    {
        $this->name = $spaceshipData["name"];
        $this->tank = new Tank($spaceshipData["tank"]);
    }
}
