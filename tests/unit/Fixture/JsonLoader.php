<?php
declare(strict_types=1);

namespace Tests\unit\Fixture;

use Error;

trait JsonLoader
{
    /**
     * Loads JSON from asset file
     * @param string $path
     * @return array
     * @throws Error
     */
    protected function loadJSON(string $path): array
    {
        try {
            return json_decode(file_get_contents(join(DIRECTORY_SEPARATOR, [
                $path
            ])), true);
        } catch (Error $e) {
            throw new Error("Was unable to load JSON asset from {$path}");
        }
    }
}