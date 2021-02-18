<?php

declare(strict_types=1);

namespace Hyperdrive\Panels;

use League\CLImate\CLImate;

abstract class BasePanel
{
    protected CLImate $cli;

    public function __construct()
    {
        $this->cli = new CLImate();
    }
}
