<?php

declare(strict_types=1);

namespace Hyperdrive\Player;

class PlayerProfile
{
    public function __construct(protected string $name)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
