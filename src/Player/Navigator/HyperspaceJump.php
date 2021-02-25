<?php

declare(strict_types=1);

namespace Hyperdrive\Player\Navigator;

use Hyperdrive\Galaxy\Geography\Planet;
use Hyperdrive\Player\Capital\Capital;
use Hyperdrive\PriceList\PriceList;
use Illuminate\Support\Collection;
use Symfony\Component\Config\Definition\Exception\Exception;

class HyperspaceJump
{
    protected int $price;
    protected int $distance;
    protected Collection $options;

    public function __construct(protected HyperdriveNavigator $hyperdriveNavigator, protected Capital $capital)
    {
        $this->options = collect();
    }

    public function setDistance(string $name): void
    {
        $hyperspaceJump = PriceList::getHyperspaceJumpValues($name);
        $this->price = $hyperspaceJump["price"];
        $this->distance = $hyperspaceJump["distance"];
        $this->capital->isThereEnoughMoney($this->price);
    }

    public function jumpTo(Planet $planet): void
    {
        $this->capital->spendingMoney($this->price);
        $this->hyperdriveNavigator->hyperspaceJumpTo($planet);
    }

    public function getOptions(): Collection
    {
        $this->getDistantPlanet(
            $this->hyperdriveNavigator->getCurrentPlanet()->getId() - $this->distance
        );
        $this->getDistantPlanet(
            $this->hyperdriveNavigator->getCurrentPlanet()->getId() + $this->distance
        );
        return $this->options;
    }

    private function getDistantPlanet(int $id): void
    {
        try {
            $this->options->add($this->hyperdriveNavigator->getRoute()->getPlanetById($id));
        } catch (Exception) {
        }
    }
}
