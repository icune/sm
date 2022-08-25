<?php

declare(strict_types = 1);

namespace Tests\unit;

use DateTime;
use PHPUnit\Framework\TestCase;
use SocialPost\Hydrator\FictionalPostHydrator;
use Statistics\Calculator\Factory\StatisticsCalculatorFactory;
use Statistics\Dto\ParamsTo;
use Statistics\Dto\StatisticsTo;
use Statistics\Enum\StatsEnum;
use Statistics\Service\StatisticsService;
use Tests\unit\Fixture\Concrete\HydratedPostsFixture;
use Tests\unit\Fixture\Concrete\PostsFixture;

/**
 * Class PostsHydrateTest.
 *
 * @package Tests\unit
 */
class AveragePostNumberPerUserTest extends TestCase
{
    use HydratedPostsFixture;

    /**
     * @test
     */
    public function testCalculation(): void
    {
        $statService = new StatisticsService(
            new StatisticsCalculatorFactory()
        );
        $startDate = DateTime::createFromFormat(DATE_ATOM, $this->params["min_ts"]);
        $endDate = DateTime::createFromFormat(DATE_ATOM, $this->params["max_ts"]);
        $stats = $statService->calculateStats($this->hydratedPosts, [
            (new ParamsTo())
                ->setStatName(StatsEnum::AVERAGE_POST_NUMBER_PER_USER)
                ->setStartDate($startDate)
                ->setEndDate($endDate),
        ]);
        $this->assertEquals(count($stats->getChildren()), 1);
        $this->assertTrue($stats->getChildren()[0] instanceof StatisticsTo);
        $this->assertEquals($stats->getChildren()[0]->getValue(), $this->asserts["average_posts_per_user"]);
    }
}
