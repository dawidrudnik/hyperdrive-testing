<?php

declare(strict_types=1);

namespace Hyperdrive\Player\Navigator;

use Hyperdrive\Galaxy\Geography\Planet;
use Hyperdrive\Player\Capital\Capital;
use Illuminate\Support\Collection;
use Symfony\Component\Config\Definition\Exception\Exception;

class HyperspaceJump
{
    protected int $price = 200;
    protected int $distance;

    public function __construct(protected HyperdriveNavigator $hyperdriveNavigator, protected Capital $capital)
    {
    }

    public function setDistance(int $distance): void
    {
        $this->capital->isThereEnoughMoney($this->price * $distance);
        $this->distance = $distance;
    }

    public function jumpTo(Planet $planet): void
    {
        $this->capital->spendingMoney($this->price * $this->distance);
        $this->hyperdriveNavigator->hyperspaceJumpTo($planet);
    }

    public function getOptions(): Collection
    {
        $options = collect();

        $options->add($this->getDistantPlanet(
            $this->hyperdriveNavigator->getCurrentPlanet()->getId() - $this->distance
        ));
        $options->add($this->getDistantPlanet(
            $this->hyperdriveNavigator->getCurrentPlanet()->getId() + $this->distance
        ));

        return $options->filter(function ($value) {
            return !is_null($value);
        });
    }

    private function getDistantPlanet(int $id): ?Planet
    {
        try {
            return $this->hyperdriveNavigator->getRoute()->getPlanetById($id);
        } catch (Exception) {
            return null;
        }
    }
}