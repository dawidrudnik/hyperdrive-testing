<?php

declare(strict_types=1);

namespace Hyperdrive\Player;

use Hyperdrive\GalaxyAtlas\GalaxyAtlas;
use Hyperdrive\Geography\Planet;
use Hyperdrive\Navigator\HyperdriveNavigator;

class Player
{
    protected string $name;
    protected Planet $targetPlanet;
    protected Planet $currentPlanet;
    protected HyperdriveNavigator $navigator;

    public function __construct(string $name, GalaxyAtlas $atlas)
    {
        $this->name = $name;
        $this->navigator = new HyperdriveNavigator($atlas);
        $this->targetPlanet = $this->navigator->getRandomPlanet();
        $this->currentPlanet = $this->navigator->getRandomPlanet();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTargetPlanet(): Planet
    {
        return $this->targetPlanet;
    }

    public function getCurrentPlanet(): Planet
    {
        return $this->currentPlanet;
    }

    public function checkPlanetsEquals(): bool
    {
        return $this->currentPlanet === $this->targetPlanet;
    }

    public function jumpToPlanet(Planet $planet): void
    {
        $this->navigator->jumpTo($planet);
        $this->currentPlanet = $this->navigator->getCurrentPlanet();
    }
}
