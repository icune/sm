<?php

declare(strict_types=1);

namespace Tests\unit\Fixture\Concrete;

use ArrayObject;
use PhpParser\Node\Expr\ArrayItem;
use SocialPost\Hydrator\FictionalPostHydrator;
use Tests\unit\Fixture\JsonLoader;
use Tests\unit\Fixture\StoragePath;
use Traversable;

trait HydratedPostsFixture
{
    use PostsFixture;

    protected Traversable $hydratedPosts;
    /**
     * @before
     */
    protected function setUpHydratedPosts(): void
    {
        $hydrator = new FictionalPostHydrator();
        $arr = [];
        foreach ($this->posts as $post)
            array_push($arr, $hydrator->hydrate($post));

        $this->hydratedPosts = new ArrayObject($arr);


    }
}