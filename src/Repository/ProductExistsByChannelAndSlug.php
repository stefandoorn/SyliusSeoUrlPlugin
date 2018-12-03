<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSeoUrlPlugin\Repository;

use Sylius\Component\Core\Model\ChannelInterface;

trait ProductExistsByChannelAndSlug
{
    public function existsOneByChannelAndSlug(ChannelInterface $channel, string $locale, string $slug): bool
    {
        $count = $this->createQueryBuilder('o')
            ->select('COUNT(o.id)')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere('translation.slug = :slug')
            ->andWhere(':channel MEMBER OF o.channels')
            ->andWhere('o.enabled = true')
            ->setParameter('channel', $channel)
            ->setParameter('locale', $locale)
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getSingleScalarResult();

        return $count > 0;
    }
}
