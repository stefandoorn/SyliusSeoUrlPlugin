<?php

declare(strict_types=1);

namespace spec\StefanDoorn\SyliusSeoUrlPlugin\Routing;

use PhpSpec\ObjectBehavior;
use StefanDoorn\SyliusSeoUrlPlugin\Routing\TaxonSlugConditionChecker;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface;

final class TaxonSlugConditionCheckerSpec extends ObjectBehavior
{
    function let(
        TaxonRepositoryInterface $taxonRepository,
        LocaleContextInterface $localeContext
    ) {
        $this->beConstructedWith($taxonRepository, $localeContext);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TaxonSlugConditionChecker::class);
    }

    function it_checks_if_passed_slug_belongs_to_any_taxon(
        LocaleContextInterface $localeContext,
        TaxonRepositoryInterface $taxonRepository,
        TaxonInterface $taxon
    ) {
        $localeContext->getLocaleCode()->willReturn('en_US');

        $taxonRepository
            ->findOneBySlug('taxon-slug', 'en_US')
            ->willReturn($taxon, null);

        $this->isTaxonSlug('taxon-slug')->shouldReturn(true);
        $this->isTaxonSlug('taxon-slug')->shouldReturn(false);
    }
}
