<?php

declare(strict_types=1);

namespace Hyperdrive\Panels;

use Hyperdrive\Geography\Planet;
use Hyperdrive\Panels\Options\MainOptions;
use Hyperdrive\Panels\Options\MoreOptions;
use Hyperdrive\Player\Player;
use Symfony\Component\Config\Definition\Exception\Exception;

class MainPanel extends BasePanel
{
    protected ?Player $player;

    public function setPLayer(Player $player): void
    {
        $this->player = $player;
    }

    public function showTarget(): void
    {
        $this->cli->info("Your target is the {$this->player->getTargetPlanet()}.");
    }

    public function showCurrentPlanet(): void
    {
        $this->cli->info("You're on the {$this->player->getCurrentPlanet()}. You can jump to:");
    }

    /**
     * @throws Exception
     */
    public function checkPlanetsEquals(): void
    {
        if ($this->player->checkPlanetsEquals()) {
            throw new Exception("You reached the {$this->player->getTargetPlanet()}!");
        }
    }

    public function showException(Exception $exception): void
    {
        $this->cli->error($exception->getMessage());
    }

    public function mainSelectSection(): void
    {
        $options = new MainOptions();
        $result = $this->cli->radio("Select jump target planet", $options($this->player))->prompt();

        if ($result instanceof Planet) {
            try {
                $this->player->jumpToPlanet($result);
            } catch (Exception $exception) {
                $this->showException($exception);
            }
        } else {
            $this->moreSelectSection();
        }
    }

    private function moreSelectSection(): void
    {
        $options = new MoreOptions();
        $result = $this->cli->radio("Select option", $options())->prompt();
        $this->checkResult($result);
    }

    private function checkResult(string $result): void
    {
        switch ($result) {
            case "spaceship":
                $this->cli->table([$this->player->showSpaceshipData()]);
                break;
            case "player":
                $this->cli->table([$this->player->showPlayerData()]);
                break;
            case "refueling":
                try {
                    $this->player->refuelingSpaceship();
                } catch (Exception $exception) {
                    $this->showException($exception);
                }
                break;
            case "quit":
                throw new Exception("You left the game :(");
        }
    }
}
