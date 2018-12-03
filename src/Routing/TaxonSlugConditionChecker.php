<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSeoUrlPlugin\Routing;

use Symfony\Component\DependencyInjection\ContainerInterface;

final class TaxonSlugConditionChecker
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function isTaxonSlug(string $slug): bool
    {
        return null !== $this->container->get('sylius.repository.taxon')->findOneBySlug($slug, $this->container->get('sylius.context.locale')->getLocaleCode());
    }
}
