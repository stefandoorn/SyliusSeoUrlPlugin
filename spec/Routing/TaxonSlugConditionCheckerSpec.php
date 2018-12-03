<?php

namespace spec\StefanDoorn\SyliusSeoUrlPlugin\Routing;

use PhpSpec\ObjectBehavior;
use StefanDoorn\SyliusSeoUrlPlugin\Routing\TaxonSlugConditionChecker;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Taxonomy\Repository\TaxonRepositoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class TaxonSlugConditionCheckerSpec extends ObjectBehavior
{
    function let(
        ContainerInterface $container,
        TaxonRepositoryInterface $taxonRepository,
        ChannelContextInterface $channelContext,
        LocaleContextInterface $localeContext
    ) {
        $container->get('sylius.repository.taxon')->willReturn($taxonRepository);
        $container->get('sylius.context.channel')->willReturn($channelContext);
        $container->get('sylius.context.locale')->willReturn($localeContext);

        $this->beConstructedWith($container);
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
