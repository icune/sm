<?php

declare(strict_types=1);

namespace Tests\unit\Fixture\Concrete;

use Tests\unit\Fixture\JsonLoader;
use Tests\unit\Fixture\StoragePath;

trait PostsFixture
{
    use StoragePath, JsonLoader;
    protected array $posts;
    protected array $asserts;
    protected array $params;
    /**
     * @before
     */
    protected function setUpPosts(): void
    {
        $data = $this->loadJSON(join(DIRECTORY_SEPARATOR, [
            $this->storagePath(), "posts.json"
        ]));
        $this->posts = $data["posts"];
        $this->asserts = $data["asserts"];
        $this->params = $data["params"];
    }
}