<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSeoUrlPlugin\Generator;

use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Product\Generator\SlugGeneratorInterface;
use Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface;

final class ProductSlugGenerator implements ProductSlugGeneratorInterface
{
    const SLUG_SEPARATOR = '/';

    /**
     * @var TaxonRepositoryInterface
     */
    private $taxonRepository;

    /**
     * @var SlugGeneratorInterface
     */
    private $baseSlugGenerator;

    public function __construct(TaxonRepositoryInterface $taxonRepository, SlugGeneratorInterface $baseSlugGenerator)
    {
        $this->taxonRepository = $taxonRepository;
        $this->baseSlugGenerator = $baseSlugGenerator;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(string $productName, string $mainTaxonCode): string
    {
        /** @var TaxonInterface|null $mainTaxon */
        $mainTaxon = $this->taxonRepository->findOneBy(['code' => $mainTaxonCode]);

        if (null === $mainTaxon) {
            return $this->baseSlugGenerator->generate($productName);
        }

        return $mainTaxon->getSlug() . self::SLUG_SEPARATOR . $this->baseSlugGenerator->generate($productName);
    }
}
