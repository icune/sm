<?php

declare(strict_types = 1);

namespace Statistics\Calculator\Concrete;

use SocialPost\Dto\SocialPostTo;
use Statistics\Calculator\AbstractCalculator;
use Statistics\Dto\StatisticsTo;

class AveragePostNumberPerUser extends AbstractCalculator
{
    protected const UNITS = "posts";
    private array $per_user = [];
    /**
     * @inheritDoc
     */
    protected function doAccumulate(SocialPostTo $postTo): void
    {
        $this->per_user[$postTo->getAuthorId()] = ($this->per_user[$postTo->getAuthorId()] ?? 0) + 1;
    }

    /**
     * @inheritDoc
     */
    protected function doCalculate(): StatisticsTo
    {
        return (new StatisticsTo())->setValue(array_sum($this->per_user) / count($this->per_user));
    }
}
