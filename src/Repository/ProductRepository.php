<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSeoUrlPlugin\Repository;

use Sylius\Bundle\CoreBundle\Doctrine\ORM\ProductRepository as BaseProductRepository;

class ProductRepository extends BaseProductRepository implements ProductExistsByChannelAndSlugAwareInterface
{
    use ProductExistsByChannelAndSlug;
}
