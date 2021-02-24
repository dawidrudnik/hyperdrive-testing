<?php

declare(strict_types=1);

namespace Hyperdrive\Player\Spaceship;

use Hyperdrive\Player\Capital\Capital;
use Hyperdrive\PriceList\PriceList;

class Spaceship
{
    protected Tank $tank;
    protected string $name;

    public function __construct(array $spaceshipData)
    {
        $this->setSpaceshipData($spaceshipData);
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function setFuel(int $fuel): void
    {
        $this->tank->setFuel($fuel);
    }

    public function fuelConsumption(): void
    {
        $this->tank->fuelConsumption();
    }

    public function fullRefueling(Capital $capital): void
    {
        $fuel = PriceList::getFuelValues();
        while (!$this->tank->isItFull()) {
            $capital->spendingMoney($fuel["price"]);
            $this->tank->refueling($fuel["capacity"]);
        }
    }

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
