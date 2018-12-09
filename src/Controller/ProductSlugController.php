<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSeoUrlPlugin\Controller;

use StefanDoorn\SyliusSeoUrlPlugin\Generator\ProductSlugGeneratorInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class ProductSlugController
{
    /** @var ProductSlugGeneratorInterface */
    private $productSlugGenerator;

    public function __construct(ProductSlugGeneratorInterface $productSlugGenerator)
    {
        $this->productSlugGenerator = $productSlugGenerator;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $name = $request->query->get('name');
        $mainTaxonCode = $request->query->get('mainTaxonCode');

        return new JsonResponse([
            'slug' => $this->productSlugGenerator->generate($name, $mainTaxonCode),
        ]);
    }
}
