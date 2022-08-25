<?php

namespace Tests\unit\Fixture;

use Error;

trait StoragePath {
    /**
     * Returns path to directory with asset files.
     * @return string
     */
    protected function storagePath(): string {
        $realpath = join(DIRECTORY_SEPARATOR, [__DIR__, "..", "..", "data"]);
        $path = realpath($realpath);
        if (!$path)
            throw new Error("{$realpath} directory with test data does not exists");
        return $path;
    }
}