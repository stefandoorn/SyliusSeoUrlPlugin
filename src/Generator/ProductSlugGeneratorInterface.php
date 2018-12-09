<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSeoUrlPlugin\Generator;

interface ProductSlugGeneratorInterface
{
    public function generate(string $productName, string $mainTaxonCode): string;
}
