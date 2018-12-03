<?php

namespace spec\StefanDoorn\SyliusSeoUrlPlugin\Routing;

use PhpSpec\ObjectBehavior;
use StefanDoorn\SyliusSeoUrlPlugin\Repository\ProductExistsByChannelAndSlugAwareInterface as ProductRepositoryInterface;
use StefanDoorn\SyliusSeoUrlPlugin\Routing\ProductSlugConditionChecker;
use Sylius\Component\Channel\Context\ChannelContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

final class ProductSlugConditionCheckerSpec extends ObjectBehavior
{
    function let(
        ContainerInterface $container,
        ProductRepositoryInterface $productRepository,
        ChannelContextInterface $channelContext,
        LocaleContextInterface $localeContext
    ) {
        $container->get('sylius.repository.product')->willReturn($productRepository);
        $container->get('sylius.context.channel')->willReturn($channelContext);
        $container->get('sylius.context.locale')->willReturn($localeContext);

        $this->beConstructedWith($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ProductSlugConditionChecker::class);
    }


    function it_checks_if_passed_slug_belongs_to_any_product(
        ChannelContextInterface $channelContext,
        ChannelInterface $channel,
        LocaleContextInterface $localeContext,
        ProductRepositoryInterface $productRepository
    ) {
        $channelContext->getChannel()->willReturn($channel);
        $localeContext->getLocaleCode()->willReturn('en_US');

        $productRepository
            ->existsOneByChannelAndSlug($channel, 'en_US', 'product-slug')
            ->willReturn(true, false);

        $this->isProductSlug('product-slug', 'en')->shouldReturn(true);
        $this->isProductSlug('product-slug', 'en')->shouldReturn(false);
    }
}
