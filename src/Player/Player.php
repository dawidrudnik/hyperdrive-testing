<?php

declare(strict_types=1);

namespace Hyperdrive\Player;

use Hyperdrive\Galaxy\Geography\Planet;
use Hyperdrive\Player\Capital\Capital;
use Hyperdrive\Player\Navigator\HyperdriveNavigator;
use Hyperdrive\Player\Navigator\HyperspaceJump;
use Hyperdrive\Player\Pilot\Pilot;
use Hyperdrive\Player\Spaceship\Spaceship;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class Player
{
    protected Planet $targetPlanet;

    public function __construct(
        protected Capital $capital,
        protected Pilot $pilot,
        protected Spaceship $spaceship,
        protected HyperdriveNavigator $hyperdriveNavigator
    )
    {
        $this->targetPlanet = $this->hyperdriveNavigator->getRandomPlanet();
        $this->hyperdriveNavigator->getRandomPlanet();
    }

    public function getTargetPlanet(): Planet
    {
        return $this->targetPlanet;
    }

    #[Pure]
    public function getCurrentPlanet(): ?Planet
    {
        return $this->hyperdriveNavigator->getCurrentPlanet();
    }

    #[Pure]
    public function isPlanetsEqual(): bool
    {
        return $this->getCurrentPlanet() === $this->targetPlanet;
    }

    public function refuelingSpaceship(): void
    {
        $this->spaceship->fullRefueling($this->capital);
    }

    public function jumpToPlanet(Planet $planet): void
    {
        $this->spaceship->fuelConsumption();
        $this->hyperdriveNavigator->jumpTo($planet);
    }

    public function getSpaceshipData(): array
    {
        return $this->spaceship->getSpaceshipData();
    }

    #[ArrayShape([
        "name" => "string",
        "capital" => "int",
        "target planet" => "string",
        "current planet" => "string",
    ])]
    public function getPlayerData(): array
    {
        return [
            "name" => $this->pilot->__toString(),
            "capital" => $this->capital->getCapital(),
            "target planet" => $this->targetPlanet->__toString(),
            "current planet" => $this->getCurrentPlanet()->__toString(),
        ];
    }

    public function getMap(): array
    {
        return $this->hyperdriveNavigator->getMap();
    }

    #[Pure]
    public function hyperspaceJump(): HyperspaceJump
    {
        return new HyperspaceJump($this->hyperdriveNavigator, $this->capital);
    }
}
