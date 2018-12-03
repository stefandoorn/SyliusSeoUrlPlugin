<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusSeoUrlPlugin\Behat\Page\Shop\Product;

use Sylius\Behat\Page\Shop\Product\IndexPage as BaseIndexPage;

final class IndexPage extends BaseIndexPage implements IndexPageInterface
{
    public function getStatusCode(): int
    {
        return $this->getSession()->getStatusCode();
    }
}
