<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSeoUrlPlugin\Repository;

use Sylius\Component\Core\Model\ChannelInterface;

interface ProductExistsByChannelAndSlugAwareInterface
{
    public function existsOneByChannelAndSlug(ChannelInterface $channel, string $locale, string $slug): bool;
}
