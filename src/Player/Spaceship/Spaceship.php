<?php

declare(strict_types=1);

namespace Hyperdrive\Player\Spaceship;

class Spaceship
{
    protected string $name;
    protected Tank $tank;

    public function __construct(array $spaceshipData)
    {
        $this->setPilotData($spaceshipData);
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function fuelConsumption(): void
    {
        $this->tank->fuelConsumption();
    }

    private function setPilotData(array $spaceshipData): void
    {
        $this->name = $spaceshipData["name"];
        $this->tank = new Tank($spaceshipData["tank"]);
    }
}
