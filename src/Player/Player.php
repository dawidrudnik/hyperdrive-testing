<?php

declare(strict_types=1);

namespace Hyperdrive\Player;

use Hyperdrive\GalaxyAtlas\GalaxyAtlas;
use Hyperdrive\Geography\Planet;
use Hyperdrive\Navigator\HyperdriveNavigator;
use JetBrains\PhpStorm\Pure;

class Player
{
    protected PlayerProfile $profile;
    protected Planet $targetPlanet;
    protected Planet $currentPlanet;
    protected HyperdriveNavigator $navigator;

    public function __construct(PlayerProfile $profile, GalaxyAtlas $atlas)
    {
        $this->profile = $profile;
        $this->navigator = new HyperdriveNavigator($atlas);
        $this->targetPlanet = $this->navigator->getRandomPlanet();
        $this->currentPlanet = $this->navigator->getRandomPlanet();
    }

    #[Pure]
    public function getName(): string
    {
        return $this->profile->getName();
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
