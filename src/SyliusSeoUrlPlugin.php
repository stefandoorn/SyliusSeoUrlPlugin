<?php

declare(strict_types=1);

namespace StefanDoorn\SyliusSeoUrlPlugin;

use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SyliusSeoUrlPlugin extends Bundle
{
    use SyliusPluginTrait;
}
