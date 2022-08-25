<?php

declare(strict_types = 1);

namespace Tests\unit;

use DateTime;
use PHPUnit\Framework\TestCase;
use SocialPost\Hydrator\FictionalPostHydrator;
use Tests\unit\Fixture\Concrete\PostsFixture;

/**
 * Class PostsHydrateTest.
 *
 * @package Tests\unit
 */
class PostsHydrateTest extends TestCase
{
    use PostsFixture;

    /**
     * @test
     */
    public function testHydrator(): void
    {
        $hydrator = new FictionalPostHydrator();
        $rawPost = $this->posts[0];
        $post = $hydrator->hydrate($rawPost);
        $this->assertEquals($post->getId(), $rawPost["id"]);
        $this->assertEquals($post->getAuthorName(), $rawPost["from_name"]);
        $this->assertEquals($post->getAuthorId(), $rawPost["from_id"]);
        $this->assertEquals($post->getText(), $rawPost["message"]);
        $this->assertEquals($post->getType(), $rawPost["type"]);
        $this->assertEquals($post->getDate()->format(DateTime::ATOM), $rawPost["created_time"]);


    }
}
