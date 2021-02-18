<?php

declare(strict_types=1);

namespace Hyperdrive\Player\Spaceship;

use JetBrains\PhpStorm\ArrayShape;
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

    #[ArrayShape([
        "fuel" => "int",
        "capacity" => "int",
        "fuelConsumption" => "int",
    ])]
    public function getTankData(): array
    {
        return [
            "fuel" => $this->fuel,
            "capacity" => $this->capacity,
            "fuelConsumption" => $this->fuelConsumption,
        ];
    }

    private function setTankData(array $tankData): void
    {
        $this->fuel = $tankData["fuel"];
        $this->capacity = $tankData["capacity"];
        $this->fuelConsumption = $tankData["fuelConsumption"];
    }
}
