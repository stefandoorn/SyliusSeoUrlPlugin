<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusSeoUrlPlugin\Behat\Page\Shop\Product;

use Sylius\Behat\Page\Shop\Product\ShowPage as BaseShowPage;

final class ShowPage extends BaseShowPage implements ShowPageInterface
{
    public function getStatusCode(): int
    {
        return $this->getSession()->getStatusCode();
    }
}
