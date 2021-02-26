<?php

declare(strict_types=1);

namespace Hyperdrive\Panels;

use Hyperdrive\Panels\Resources\FinalScoreResource;
use Hyperdrive\Player\Player;

class FinalScorePanel extends BasePanel
{
    public function __construct(protected Player $player)
    {
        parent::__construct();
    }

    public function show(): void
    {
        $collection = collect();
        $baseResource = new FinalScoreResource();
        $finalScore = $this->player->getFinalScore();

        foreach ($finalScore->getFinalScore() as $name => $value) {
            $collection->add($baseResource($name, $value));
        }

        $this->cli->table($collection->toArray());
    }
}