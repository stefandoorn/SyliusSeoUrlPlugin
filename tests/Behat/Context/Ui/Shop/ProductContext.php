<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusSeoUrlPlugin\Behat\Context\Ui\Shop;

use Behat\Behat\Context\Context;
use Tests\StefanDoorn\SyliusSeoUrlPlugin\Behat\Page\Shop\Product\IndexPageInterface;
use Tests\StefanDoorn\SyliusSeoUrlPlugin\Behat\Page\Shop\Product\ShowPageInterface;
use Webmozart\Assert\Assert;

final class ProductContext implements Context
{
    /** @var IndexPageInterface */
    private $indexPage;

    /** @var ShowPageInterface */
    private $showPage;

    public function __construct(
        IndexPageInterface $indexPage,
        ShowPageInterface $showPage
    ) {
        $this->indexPage = $indexPage;
        $this->showPage = $showPage;
    }

    /**
     * @Then /^the taxon page response status code should be (?P<code>\d+)$/
     */
    public function iShouldGetStatusCodeOnTaxonPage($code)
    {
        Assert::same((int) $code, $this->indexPage->getStatusCode());
    }

    /**
     * @Then /^the product page response status code should be (?P<code>\d+)$/
     */
    public function iShouldGetStatusCodeOnProductPage($code)
    {
        Assert::same((int) $code, $this->showPage->getStatusCode());
    }
}
