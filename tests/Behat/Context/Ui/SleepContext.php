<?php

declare(strict_types=1);

namespace Tests\StefanDoorn\SyliusSeoUrlPlugin\Behat\Context\Ui;

use Behat\Behat\Context\Context;

final class SleepContext implements Context
{
    /**
     * @Then I wait :seconds seconds
     */
    public function waitFor(int $seconds): void
    {
        sleep($seconds);
    }
}
