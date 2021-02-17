<?php

declare(strict_types=1);

namespace Hyperdrive\Player\Spaceship;

use Symfony\Component\Config\Definition\Exception\Exception;

class Tank
{
    protected int $fuel;
    protected int $capacity;
    protected int $fuelConsumption;

    public function __construct(array $tankData)
    {
        $this->setTankData($tankData);
    }

    public function getFuel(): int
    {
        return $this->fuel;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    /**
     * @throws Exception
     */
    public function fuelConsumption(): void
    {
        if ($this->fuel - $this->fuelConsumption < 0) {
            throw new Exception("You don't have enough fuel. You need to refuel");
        }
        $this->fuel -= $this->fuelConsumption;
    }

    private function setTankData(array $tankData): void
    {
        $this->fuel = $tankData["fuel"];
        $this->capacity = $tankData["capacity"];
        $this->fuelConsumption = $tankData["fuelConsumption"];
    }
}
