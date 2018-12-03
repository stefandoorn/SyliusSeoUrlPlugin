<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSeoUrlPlugin\Routing;

use Symfony\Component\Routing\RequestContext as BaseRequestContext;

final class RequestContext extends BaseRequestContext
{
    /** @var ProductSlugConditionChecker */
    private $productSlugConditionChecker;

    /** @var TaxonSlugConditionChecker */
    private $taxonSlugConditionChecker;

    /** @var string */
    private $localeCode;

    public function __construct(
        ProductSlugConditionChecker $productSlugConditionChecker,
        TaxonSlugConditionChecker $taxonSlugConditionChecker,
        string $localeCode,
        string $baseUrl = '',
        string $method = 'GET',
        string $host = 'localhost',
        string $scheme = 'http',
        int $httpPort = 80,
        int $httpsPort = 443,
        string $path = '/',
        string $queryString = ''
    ) {
        $this->productSlugConditionChecker = $productSlugConditionChecker;
        $this->taxonSlugConditionChecker = $taxonSlugConditionChecker;
        $this->localeCode = $localeCode;

        parent::__construct($baseUrl, $method, $host, $scheme, $httpPort, $httpsPort, $path, $queryString);
    }

    public function checkProductSlug(string $slug): bool
    {
        return $this->productSlugConditionChecker->isProductSlug($this->prepareSlug($slug));
    }

    public function checkTaxonSlug(string $slug): bool
    {
        return $this->taxonSlugConditionChecker->isTaxonSlug($this->prepareSlug($slug));
    }

    private function prepareSlug(string $slug): string
    {
        $slug = ltrim($slug, '/');

        if (false === strpos($slug, $this->localeCode)) {
            return $slug;
        }

        return str_replace(sprintf('%s/', $this->localeCode), '', $slug);
    }
}
