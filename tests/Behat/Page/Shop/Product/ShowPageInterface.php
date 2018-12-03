<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusSeoUrlPlugin\Behat\Page\Shop\Product;

use Sylius\Behat\Page\Shop\Product\ShowPageInterface as BaseShowPageInterface;

interface ShowPageInterface extends BaseShowPageInterface
{
    public function getStatusCode(): int;
}
