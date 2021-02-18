<?php

declare(strict_types=1);

namespace Hyperdrive;

use Hyperdrive\GalaxyAtlas\GalaxyAtlas;
use Hyperdrive\Panels\MainPanel;
use Hyperdrive\Panels\StartPanel;
use Hyperdrive\Player\Navigator\HyperdriveNavigator;
use Hyperdrive\Player\Player;
use Hyperdrive\Player\Spaceship\SpaceshipsCollection;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Config\Definition\Exception\Exception;

class GameInstance
{
    protected StartPanel $startPanel;
    protected MainPanel $mainPanel;
    protected Player $player;
    protected GalaxyAtlas $atlas;
    protected Collection $pilots;
    protected SpaceshipsCollection $spaceships;

    #[Pure]
    public function __construct(GalaxyAtlas $atlas, Collection $pilots, SpaceshipsCollection $spaceships)
    {
        $this->atlas = $atlas;
        $this->pilots = $pilots;
        $this->spaceships = $spaceships;
        $this->startPanel = new StartPanel();
        $this->mainPanel = new MainPanel();
    }

    public function start(): void
    {
        $this->createPlayer();
        $this->mainPanel->setPLayer($this->player);
        $this->mainPanel->showTarget();

        try {
            while (true) {
                $this->mainPanel->checkPlanetsEquals();
                $this->mainPanel->showCurrentPlanet();
                $this->mainPanel->mainSelectSection();
            }
        } catch (Exception $exception) {
            $this->mainPanel->showException($exception);
        }
    }

    private function createPlayer(): void
    {
        $pilot = $this->startPanel->selectPilot($this->pilots);
        $spaceship = $this->startPanel->selectSpaceship($this->spaceships);
        $this->player = new Player($pilot, $spaceship, new HyperdriveNavigator($this->atlas));
    }
}
