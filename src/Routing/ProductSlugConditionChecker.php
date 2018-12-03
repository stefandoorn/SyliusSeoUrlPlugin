<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSeoUrlPlugin\Routing;

use Symfony\Component\DependencyInjection\ContainerInterface;

final class ProductSlugConditionChecker
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function isProductSlug(string $slug): bool
    {
        return $this->container->get('sylius.repository.product')->existsOneByChannelAndSlug(
            $this->container->get('sylius.context.channel')->getChannel(),
            $this->container->get('sylius.context.locale')->getLocaleCode(),
            $slug
        );
    }
}
