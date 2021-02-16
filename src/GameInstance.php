<?php

declare(strict_types=1);

namespace Hyperdrive;

use Hyperdrive\GalaxyAtlas\GalaxyAtlas;
use Hyperdrive\GalaxyAtlas\GalaxyAtlasBuilder;
use Hyperdrive\Geography\Planet;
use Hyperdrive\Player\Player;
use League\CLImate\CLImate;

class GameInstance
{
    protected CLImate $cli;
    protected GalaxyAtlas $atlas;
    protected Player $player;

    public function __construct(private string $filePath = "./resources/routes.yaml")
    {
        $this->cli = new CLImate();
        $this->atlas = GalaxyAtlasBuilder::buildFromYaml($this->filePath);
        $this->player = new Player("Dawid", $this->atlas);
    }

    public function start(): void
    {
        $this->cli->info("Your target is the {$this->player->getTargetPlanet()}.");

        while (true) {
            if ($this->player->checkPlanetsEquals()) {
                $this->cli->info("You reached the {$this->player->getTargetPlanet()}!");
                break;
            }

            $this->cli->info("You're on the {$this->player->getCurrentPlanet()}. You can jump to:");

            $options = $this->player->getCurrentPlanet()->getNeighbours()->toArray() + [
                "more" => "[show more option]",
            ];
            $result = $this->selectOption("Select jump target planet", $options);

            if ($result === "more") {
                $options = [
                    "return" => "return",
                    "quit" => "quit application",
                ];
                $result = $this->selectOption("Select option", $options);

                if ($result === "quit") {
                    break;
                }
                continue;
            }

            $this->player->jumpToPlanet($result);
        }
    }

    private function selectOption(string $message, array $options): string|Planet
    {
        return $this->cli->radio($message, $options)->prompt();
    }
}
