<?php

declare(strict_types=1);

namespace spec\StefanDoorn\SyliusSeoUrlPlugin\Generator;

use PhpSpec\ObjectBehavior;
use StefanDoorn\SyliusSeoUrlPlugin\Generator\ProductSlugGenerator;
use StefanDoorn\SyliusSeoUrlPlugin\Generator\ProductSlugGeneratorInterface;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Product\Generator\SlugGeneratorInterface;
use Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface;

final class ProductSlugGeneratorSpec extends ObjectBehavior
{
    function let(TaxonRepositoryInterface $taxonRepository, SlugGeneratorInterface $baseSlugGenerator)
    {
        $this->beConstructedWith($taxonRepository, $baseSlugGenerator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProductSlugGenerator::class);
    }

    function it_implements_product_slug_generator_interface()
    {
        $this->shouldImplement(ProductSlugGeneratorInterface::class);
    }

    function it_generates_product_slug_based_on_its_name_and_its_main_taxon_slug(
        SlugGeneratorInterface $baseSlugGenerator,
        TaxonInterface $taxon,
        TaxonRepositoryInterface $taxonRepository
    ) {
        $taxonRepository->findOneBy(['code' => 'taxon_code'])->willReturn($taxon);
        $taxon->getSlug()->willReturn('parent-taxon-slug/taxon-slug');

        $baseSlugGenerator->generate('Product name')->willReturn('product-name');

        $this->generate('Product name', 'taxon_code')->shouldReturn('parent-taxon-slug/taxon-slug/product-name');
    }

    function it_generates_product_slug_based_only_on_its_name_if_main_taxon_does_with_passed_id_does_not_exist(
        SlugGeneratorInterface $baseSlugGenerator,
        TaxonRepositoryInterface $taxonRepository
    ) {
        $taxonRepository->findOneBy(['code' => 'taxon_code'])->willReturn(null);

        $baseSlugGenerator->generate('Product name')->willReturn('product-name');

        $this->generate('Product name', 'taxon_code')->shouldReturn('product-name');
    }
}
